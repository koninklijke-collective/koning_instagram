<?php
if (!defined('TYPO3_MODE')) {
    die ('Access denied.');
}
$TCA['tx_koninginstagram_domain_model_credential'] = array(
    'ctrl' => $TCA['tx_koninginstagram_domain_model_credential']['ctrl'],
    'interface' => array(
        'showRecordFieldList' => 'user_id, username, access_token'
    ),
    'types' => array(
        0 => array(
            'showitem' => 'user_id, username, access_token'
        )
    ),
    'palettes' => array(),
    'columns' => array(
        'user_id' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_instagram/Resources/Private/Language/locallang_be.xlf:tx_koninginstagram_domain_model_credential.user_id',
            'config' => array(
                'readOnly' => true,
                'type' => 'input',
                'size' => 30,
            )
        ),
        'username' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_instagram/Resources/Private/Language/locallang_be.xlf:tx_koninginstagram_domain_model_credential.username',
            'config' => array(
                'readOnly' => true,
                'type' => 'input',
                'size' => 30,
            )
        ),
        'access_token' => array(
            'exclude' => 0,
            'label' => 'LLL:EXT:koning_instagram/Resources/Private/Language/locallang_be.xlf:tx_koninginstagram_domain_model_credential.access_token',
            'config' => array(
                'readOnly' => true,
                'type' => 'input',
                'size' => 30,
            )
        ),
    ),
);