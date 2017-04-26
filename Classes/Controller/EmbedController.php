<?php
namespace KoninklijkeCollective\KoningInstagram\Controller;

/**
 * Controller: Embed
 *
 * @package KoninklijkeCollective\KoningInstagram\Controller
 */
class EmbedController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{
    /**
     * @var \KoninklijkeCollective\KoningInstagram\Service\InstagramService
     * @inject
     */
    protected $instagramService;

    /**
     * @return void
     */
    public function showAction()
    {
        $code = $this->instagramService->getEmbedCode($this->settings['data']);
        $this->view->assign('code', $code);
    }
}
