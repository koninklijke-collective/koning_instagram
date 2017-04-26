<?php
if (!defined('TYPO3_MODE')) {
    die('Access denied.');
}

\TYPO3\CMS\Extbase\Utility\ExtensionUtility::registerPlugin(
    'koning_instagram',
    'Embed',
    'LLL:EXT:koning_instagram/Resources/Private/Language/locallang_be.xlf:plugin.embed'
);

$GLOBALS['TCA']['tt_content']['types']['list']['subtypes_addlist']['koninginstagram_embed'] = 'pi_flexform';
\TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addPiFlexFormValue(
    'koninginstagram_embed',
    'FILE:EXT:koning_instagram/Configuration/FlexForm/Embed.xml'
);
