<?php
namespace Keizer\KoningInstagram\Controller;

use Keizer\KoningInstagram\Domain\Model\Credential;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AuthController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @inject
     * @var \Keizer\KoningInstagram\Domain\Repository\CredentialRepository
     */
    protected $credentialRepository;

    /**
     * @return void
     */
    public function handleAuthAction()
    {
        $responseCode = 200;
        $errorMessage = null;

        $getParams = GeneralUtility::_GET();
        if (!isset($getParams['code'])) {
            $responseCode = 400;
        } else {
            $client = new \GuzzleHttp\Client();
            try {
                $request = $client->request('POST', $this->settings['instagram']['baseUrl'] . 'oauth/access_token', array(
                    'form_params' => array(
                        'client_id' => $this->settings['instagram']['clientId'],
                        'client_secret' => $this->settings['instagram']['clientSecret'],
                        'redirect_uri' => $this->settings['instagram']['redirectUri'],
                        'grant_type' => 'authorization_code',
                        'code' => $getParams['code']
                    )
                ));

                $response = json_decode($request->getBody(), true);

                $credential = $this->credentialRepository->findOneByUserId($response['user']['id']);
                if ($credential === null) {
                    $credential = new Credential();
                    $credential->setUserId($response['user']['id']);
                    $credential->setUsername($response['user']['username']);
                    $credential->setAccessToken($response['access_token']);
                    $this->credentialRepository->add($credential);
                } else {
                    /** @var Credential $credential */
                    $credential->setUsername($response['user']['username']);
                    $credential->setAccessToken($response['access_token']);
                    $this->credentialRepository->update($credential);
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                if ($e->getResponse()->getStatusCode() === 400) {
                    $responseCode = 400;
                    $response = json_decode($e->getResponse()->getBody()->getContents(), true);
                    if (isset($response['error_message'])) {
                        $errorMessage = $response['error_message'];
                    }
                }
            }
        }

        $this->view->assignMultiple(array(
            'responseCode' => $responseCode,
            'errorMessage' => $errorMessage
        ));
    }
}