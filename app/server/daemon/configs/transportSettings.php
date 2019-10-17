<?php

return [
    "transports" => [
        [
            "name" => "2ch",
            "domain" => "2ch.hk",
            "protocol" => "http"
        ],
        [
            "name" => "4chan",
            "domain" => "4chan.org",
            "protocol" => "http"
        ]
    ],

    "collectSchema" => [
        [
            "name" => "b",
            "description" => "Бред, рандом, может быть что угодно",
            "sourceBoards" => [
                "b:2ch",
                "b:4chan"
            ]
        ],
        [
            "name" => "a",
            "description" => "Аниме",
            "sourceBoards" => [
                "a:2ch",
                "a:4chan",
                "c:4chan"
            ]
        ],
        [
            "name" => "adult",
            "description" => "Для взрослых",
            "sourceBoards" => [
                "e:2ch",
                "s:4chan",
                "hc:4chan"
            ]
        ],
        [
            "name" => "cartoons",
            "description" => "Хентай, порно мультики",
            "sourceBoards" => [
                "h:2ch",
                "fur:2ch",
                "h:4chan",
                "u:4chan",
                "d:4chan",
                "e:4chan",
                "aco:4chan"
            ]
        ]
    ]
];