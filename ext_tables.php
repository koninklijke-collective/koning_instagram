<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

if (\Keizer\KoningInstagram\Utility\ConfigurationUtility::isValid()) {
    if ('BE' === TYPO3_MODE) {
        $mainModule = 'koninginstagram';

        \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addModule(
            $mainModule,
            '',
            '',
            'EXT:koning_instagram/Resources/Private/Modules/Container/'
        );

        \TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerModule(
            'Keizer.' . $_EXTKEY,
            $mainModule,
            'Admin',
            '',
            array(
                'Admin' => 'index, authorize'
            ),
            array(
                'access' => 'user,group',
                'icon' => 'EXT:' . $_EXTKEY . '/Resources/Public/Icons/module-overview.png',
                'labels' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/Backend/Admin.xlf'
            )
        );
    }
}
