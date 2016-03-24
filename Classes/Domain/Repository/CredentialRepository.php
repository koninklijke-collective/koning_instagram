<?php
namespace Keizer\KoningInstagram\Domain\Repository;

/**
 * Repository: Credentials
 *
 * @package Keizer\KoningInstagram\Domain\Repository
 */
class CredentialRepository extends \TYPO3\CMS\Extbase\Persistence\Repository
{

    /**
     * Add and persist database for uid generation
     *
     * @param \Keizer\KoningInstagram\Domain\Model\Credential $credential
     * @throws \TYPO3\CMS\Extbase\Persistence\Exception\IllegalObjectTypeException
     */
    public function addAndPersist(\Keizer\KoningInstagram\Domain\Model\Credential $credential)
    {
        $this->add($credential);
        $this->persistenceManager->persistAll();
    }

}
