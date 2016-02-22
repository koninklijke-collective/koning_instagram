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

$GLOBALS['TCA']['tx_koninginstagram_domain_model_credential'] = array(
    'ctrl' => array(
        'title' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:tx_koninginstagram_domain_model_credential.singular',
        'groupName' => 'LLL:EXT:' . $_EXTKEY . '/Resources/Private/Language/locallang_be.xlf:tx_koninginstagram_domain_model_credential.plural',
        'label' => 'username',
        'tstamp' => 'tstamp',
        'crdate' => 'crdate',
        'cruser_id' => 'cruser_id',
        'editlock' => 'editlock',
        'dividers2tabs' => true,
        'dynamicConfigFile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extPath($_EXTKEY) . 'Configuration/TCA/Credential.php',
        'iconfile' => \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::extRelPath($_EXTKEY) . 'Resources/Public/Icons/tx_koninginstagram_domain_model_credential.png',
        'rootLevel' => true,
        'canNotCollapse' => true,
        'hideTable' => false,
        'security' => array(
            'ignoreWebMountRestriction' => true,
            'ignoreRootLevelRestriction' => true,
        ),
    ),
);