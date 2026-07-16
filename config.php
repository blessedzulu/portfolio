<?php

return [
    'production' => false,
    'baseUrl' => $_ENV['JIGSAW_BASE_URL'] ?? '',
    'title' => 'Blessed Zulu',
    'description' => 'Blessed Zulu is a software engineer in Zambia. He builds ambitious websites, apps and systems and ships them to real people.',
    'collections' => [
        'posts' => [
            'author' => 'Blessed Zulu',
            'sort' => '-date',
            'path' => 'writing/{filename}',
        ],
    ],
];
