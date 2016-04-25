<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'koning_instagram',
    'Show',
    'LLL:EXT:koning_instagram/Resources/Private/Language/locallang_be.xlf:plugin.show'
);

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'koning_instagram',
    'User',
    'LLL:EXT:koning_instagram/Resources/Private/Language/locallang_be.xlf:plugin.user'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['koninginstagram_show'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'koninginstagram_show',
    'FILE:EXT:koning_instagram/Configuration/FlexForm/Show.xml'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['koninginstagram_user'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'koninginstagram_user',
    'FILE:EXT:koning_instagram/Configuration/FlexForm/User.xml'
);
