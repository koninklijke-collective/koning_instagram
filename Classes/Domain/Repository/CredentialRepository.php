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
     * Find credential by given user id
     *
     * @param string $userId
     * @return mixed|null|object
     */
    public function findByUserId($userId)
    {
        $query = $this->createQuery();
        $result = $query->matching($query->equals('userId', $userId))->setLimit(1)->execute();
        if ($result instanceof \TYPO3\CMS\Extbase\Persistence\QueryResultInterface) {
            return $result->getFirst();
        } elseif (is_array($result)) {
            return isset($result[0]) ? $result[0] : null;
        }
        return null;
    }

}