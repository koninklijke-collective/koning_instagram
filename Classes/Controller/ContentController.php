<?php
namespace Keizer\KoningInstagram\Controller;

/**
 * Frontend Controller: Content
 *
 * @package Keizer\KoningInstagram\Controller
 */
class ContentController extends AbstractActionController
{
    /**
     * Action: Show media with configured credentials
     *
     * @return void
     */
    public function showAction()
    {
        if (!isset($this->settings['data']['credential'])) {
            $this->view->assign('invalidConfiguration', true);
        } else {
            $credential = $this->getCredentialRepository()->findByUid($this->settings['data']['credential']);
            if ($credential !== null) {
                /** @var \Keizer\KoningInstagram\Domain\Model\Credential $credential */
                try {
                    $request = $this->getClient()->request('GET', $this->settings['instagram']['baseUrl'] . 'v1/tags/' . $this->settings['data']['tags'] . '/media/recent',
                        array(
                            'query' => array(
                                'access_token' => $credential->getAccessToken(),
                                'count' => $this->settings['data']['limit']
                            )
                        ));
                    $response = json_decode($request->getBody(), true);

                    if (is_array($response) && isset($response['data'])) {
                        $this->view->assign('data', $response['data']);
                    }
                } catch (\GuzzleHttp\Exception\ClientException $e) {
                    $this->view->assign('error', true);
                }
            } else {
                $this->view->assign('invalidConfiguration', true);
            }
        }
    }
}