<?php

$url = "https://discordapp.com/api/webhooks/";

$hookObject = json_encode([
    "content" => "New User",
    "username" => "Iloot.it Logs",
    "avatar_url" => "https://iloot.it/logo.png",
    "tts" => false,
    "embeds" => [
        [
            "type" => "rich",
            "description" => "". $_GET['desc'] ."",
            "url" => "https://iloot.it/",
            "timestamp" => "2018-03-10T19:15:45-05:00",
            "color" => hexdec( "FFFFFF" ),
            "author" => [
                "name" => "". $_GET['title'] ."",
                "url" => "https://iloot.it"
            ],
            "fields" => [
                [
                    "name" => "User IP",
                    "value" => "".$_SERVER['HTTP_X_FORWARDED_FOR']."",
                    "inline" => true
                ],
                [
                    "name" => "".$_GET['field2n']."",
                    "value" => "".$_GET['field2d']."",
                    "inline" => true
                ]
            ]
        ]
    ]

], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE );

$ch = curl_init();

curl_setopt_array( $ch, [
    CURLOPT_URL => $url,
    CURLOPT_POST => true,
    CURLOPT_POSTFIELDS => $hookObject,
    CURLOPT_HTTPHEADER => [
        "Content-Type: application/json"
    ]
]);

$response = curl_exec( $ch );
curl_close( $ch );

?>