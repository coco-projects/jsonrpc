<?php

    use Coco\jsonrpc\JsonRPCClient;
    use Coco\jsonrpc\payload\Payload;

    require '../vendor/autoload.php';

    $url    = 'http://test';
    $client = new JsonRPCClient($url);

    $test = $client->notificationRequest('test1', [
        ['http://baidu.com'],
        [
            "dir" => "dir1",
            "out" => "out1",
        ],
    ]);

    print_r($test);