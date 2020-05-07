<?php
$EM_CONF[$_EXTKEY] = [
    'title' => 'Embed Instagram posts',
    'description' => 'Embed Instagram posts in TYPO3',
    'category' => 'plugin',
    'version' => '2.0.1',
    'state' => 'obsolete',
    'clearCacheOnLoad' => true,
    'author' => 'Jesper Paardekooper',
    'author_email' => 'j.paardekooper@develement.nl',
    'author_company' => 'DevElement',
    'constraints' => [
        'depends' => [
            'typo3' => '6.2.0-10.4.99',
        ],
        'conflicts' => [],
        'suggests' => [],
    ],
    'autoload' => [
        'psr-4' => [
            'KoninklijkeCollective\\KoningInstagram\\' => 'Classes'
        ]
    ],
];
