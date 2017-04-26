<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

call_user_func(function($extKey, $cacheKey) {

    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        $extKey,
        'Configuration/TypoScript/',
        'Koning Instagram'
    );

    \TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
        'KoninklijkeCollective.' . $extKey,
        'Embed',
        ['Embed' => 'show'],
        ['Embed' => 'show']
    );

    if (!is_array($GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$cacheKey])) {
        $GLOBALS['TYPO3_CONF_VARS']['SYS']['caching']['cacheConfigurations'][$cacheKey] = [
            'frontend' => \TYPO3\CMS\Core\Cache\Frontend\StringFrontend::class,
            'backend' => \TYPO3\CMS\Core\Cache\Backend\FileBackend::class
        ];
    }

}, $_EXTKEY, \KoninklijkeCollective\KoningInstagram\Service\InstagramService::CACHE_KEY);
