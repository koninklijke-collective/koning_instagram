<?php
$EM_CONF[$_EXTKEY] = array(
    'title' => 'Instagram integration',
    'description' => 'Offers Instagram integration for TYPO3',
    'category' => 'plugin',
    'version' => '1.2.0',
    'state' => 'stable',
    'clearCacheOnLoad' => true,
    'author' => 'Jesper Paardekooper',
    'author_email' => 'j.paardekooper@grandslam-media.nl',
    'author_company' => 'GrandSlam Media',
    'constraints' => array(
        'depends' => array(
            'typo3' => '6.2.0-8.99.99',
        ),
        'conflicts' => array(),
        'suggests' => array(),
    ),
    'autoload' => array(
        'psr-4' => array(
            'Keizer\\KoningInstagram\\' => 'Classes'
        )
    ),
);
