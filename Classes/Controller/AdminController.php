<?php
namespace Keizer\KoningInstagram\Controller;

use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

class AdminController extends \TYPO3\CMS\Beuser\Controller\BackendUserController
{
    /**
     * @var \Keizer\KoningInstagram\Service\InstagramApiService
     * @inject
     */
    protected $instagramApiService;

    /**
     * @var string
     */
    protected $finalUrl;

    /**
     * @return void
     */
    public function indexAction()
    {
    }

    /**
     * @return void
     */
    public function authorizeAction()
    {
        $error = false;

        $url = $this->settings['instagram']['baseUrl'] . 'oauth/authorize/?client_id=' . $this->settings['instagram']['clientId'] . '&redirect_uri=' . $this->settings['instagram']['redirectUri'] . '&response_type=code&scope=public_content';
        $client = new \GuzzleHttp\Client();

        try {
            $client->request('GET', $url, array(
                'allow_redirects' => array(
                    'on_redirect' => function(
                        RequestInterface $request,
                        ResponseInterface $response,
                        UriInterface $uri
                    ) {
                        $this->finalUrl = $uri;
                    }
                )
            ));
        } catch (\GuzzleHttp\Exception\ClientException $e) {
            $error = true;
        }

        $this->view->assignMultiple(array(
            'url' => $this->finalUrl,
            'error' => $error
        ));
    }
}