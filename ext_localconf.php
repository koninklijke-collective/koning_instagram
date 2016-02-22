<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Keizer.' . $_EXTKEY,
    'Auth',
    array(
        'Auth' => 'handleAuth'
    ),
    array()
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::configurePlugin(
    'Keizer.' . $_EXTKEY,
    'Show',
    array(
        'Content' => 'show'
    ),
    array(
        'Content' => 'show'
    )
);