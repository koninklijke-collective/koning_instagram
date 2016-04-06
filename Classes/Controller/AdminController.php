<?php
namespace Keizer\KoningInstagram\Controller;

use Keizer\KoningInstagram\Utility\ConfigurationUtility;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\UriInterface;

/**
 * Backend Module Controller: Admin interface
 *
 * @package Keizer\KoningInstagram\Controller
 */
class AdminController extends AbstractActionController
{
    /**
     * @var string
     */
    protected $url;

    /**
     * Action: Display default action overview
     *
     * @return void
     */
    public function indexAction()
    {
    }

    /**
     * Action: Authorize incoming parameters client
     *
     * @return void
     */
    public function authorizeAction()
    {
        $error = true;
        $errorMessage = null;
        if (ConfigurationUtility::isValid()) {
            $error = false;

            $url = $this->getInstagramSetting('baseUrl') . 'oauth/authorize/?client_id=' . $this->getInstagramSetting('clientId') . '&redirect_uri=' . $this->getInstagramSetting('redirectUri') . '&response_type=code&scope=public_content';
            try {
                $this->getClient()->request('GET', $url, array(
                    'allow_redirects' => array(
                        'on_redirect' => function (
                            RequestInterface $request,
                            ResponseInterface $response,
                            UriInterface $uri
                        ) {
                            $this->url = $uri;
                        }
                    )
                ));
            } catch (\Exception $e) {
                $error = true;
                $errorMessage = $e->getMessage();
            }
        }

        $this->view->assignMultiple(array(
            'url' => $this->url,
            'error' => $error,
            'errorMessage' => $errorMessage
        ));
    }
}
