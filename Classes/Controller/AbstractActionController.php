<?php
namespace Keizer\KoningInstagram\Controller;

/**
 * Abstract Action Controller: Default action functions, variables and checks
 *
 * @package Keizer\KoningInstagram\Controller
 */
abstract class AbstractActionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController
{

    /**
     * @var \GuzzleHttp\Client
     */
    protected $httpClient;

    /**
     * @var \Keizer\KoningInstagram\Domain\Repository\CredentialRepository
     */
    protected $credentialRepository;

    /**
     * Initialize actions
     *
     * @return void
     * @throws \RuntimeException
     */
    public function initializeAction()
    {
        // @TODO: Extbase backend modules relies on frontend TypoScript for view, persistence
        // and settings. Thus, we need a TypoScript root template, that then loads the
        // ext_typoscript_setup.txt file of this module. This is nasty, but can not be
        // circumvented until there is a better solution in extbase.
        // For now we throw an exception if no settings are detected.
        if (empty($this->settings)) {
            throw new \RuntimeException('No settings detected. This module can not work then. This usually happens if there is no frontend TypoScript template with root flag set. ' . 'Please create a frontend page with a TypoScript root template.', 1344375003);
        }
    }

    /**
     * @return \TYPO3\CMS\Extbase\Object\ObjectManagerInterface
     */
    protected function getObjectManager()
    {
        return $this->objectManager;
    }

    /**
     * @return \Keizer\KoningInstagram\Domain\Repository\CredentialRepository
     */
    protected function getCredentialRepository()
    {
        if ($this->credentialRepository === null) {
            $this->credentialRepository = $this->objectManager->get('Keizer\\KoningInstagram\\Domain\\Repository\\CredentialRepository');
        }
        return $this->credentialRepository;
    }

    /**
     * @return \GuzzleHttp\Client
     * @throws \Exception
     */
    protected function getClient()
    {
        if (!class_exists('\GuzzleHttp\Client')) {
            throw new \Exception('GuzzleHttp Client not included, please run composer with guzzle requirement.');
        }
        if ($this->httpClient === null) {
            $this->httpClient = $this->getObjectManager()->get('GuzzleHttp\\Client');
        }
        return $this->httpClient;
    }

}