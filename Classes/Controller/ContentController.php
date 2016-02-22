<?php
namespace Keizer\KoningInstagram\Controller;

class ContentController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @inject
     * @var \Keizer\KoningInstagram\Domain\Repository\CredentialRepository
     */
    protected $credentialRepository;

    /**
     * @return void
     */
    public function showAction()
    {
        if (!isset($this->settings['data']['credential'])) {
            $this->view->assign('invalidConfiguration', true);
        } else {
            $credential = $this->credentialRepository->findByUid($this->settings['data']['credential']);
            if ($credential !== null) {
                /** @var \Keizer\KoningInstagram\Domain\Model\Credential $credential */
                $client = new \GuzzleHttp\Client();
                try {
                    $request = $client->request('GET', $this->settings['instagram']['baseUrl'] . 'v1/tags/' . $this->settings['data']['tags']. '/media/recent', array(
                        'query' => array(
                            'access_token' => $credential->getAccessToken(),
                            'count' => $this->settings['data']['limit']
                        )
                    ));
                    $response = json_decode($request->getBody(), true);

                    $this->view->assign('data', $response['data']);
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    $this->view->assign('error', true);
                }
            } else {
                $this->view->assign('invalidConfiguration', true);
            }
        }
    }
}