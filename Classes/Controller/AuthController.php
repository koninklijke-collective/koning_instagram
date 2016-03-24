<?php
namespace Keizer\KoningInstagram\Controller;

use Keizer\KoningInstagram\Domain\Model\Credential;
use Keizer\KoningInstagram\Utility\ConfigurationUtility;
use TYPO3\CMS\Core\Utility\GeneralUtility;

/**
 * Controller: Authentication
 *
 * @package Keizer\KoningInstagram\Controller
 */
class AuthController extends AbstractActionController
{

    /**
     * Action: Handle authentication
     *
     * @return void
     */
    public function handleAuthAction()
    {
        $responseCode = 200;
        $errorMessage = null;

        $code = GeneralUtility::_GET('code');
        if (empty($code) || !ConfigurationUtility::isValid()) {
            $responseCode = 400;
        } else {
            try {
                $request = $this->getClient()->request('POST', $this->getInstagramSetting('baseUrl') . 'oauth/access_token', array(
                    'form_params' => array(
                        'client_id' => $this->getInstagramSetting('clientId'),
                        'client_secret' => $this->getInstagramSetting('clientSecret'),
                        'redirect_uri' => $this->getInstagramSetting('redirectUri'),
                        'grant_type' => 'authorization_code',
                        'code' => $code
                    )
                ));

                $response = json_decode($request->getBody(), true);
                if (is_array($response) && isset($response['user']['id'])) {
                    $credential = $this->getCredentialRepository()->findOneByUserId($response['user']['id']);
                    if ($credential === null) {
                        $credential = new Credential();
                        $credential->setUserId($response['user']['id']);
                        $credential->setUsername($response['user']['username']);
                        $credential->setAccessToken($response['access_token']);
                        $this->getCredentialRepository()->addAndPersist($credential);
                    } else {
                        /** @var Credential $credential */
                        $credential->setUsername($response['user']['username']);
                        $credential->setAccessToken($response['access_token']);
                        $this->getCredentialRepository()->update($credential);
                    }
                }
            } catch (\GuzzleHttp\Exception\ClientException $e) {
                if ($e->getResponse()->getStatusCode() === 400) {
                    $responseCode = 400;
                    $response = json_decode($e->getResponse()->getBody()->getContents(), true);
                    if (is_array($response) && isset($response['error_message'])) {
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
