<?php

    use Coco\jsonrpc\JsonRPCClient;
    use Coco\jsonrpc\payload\NotificationPayload;
    use Coco\jsonrpc\payload\Payload;

    require '../vendor/autoload.php';

    $p1 = NotificationPayload::method('test1');
    $p1->withParameter('a');
    $p1->withParameter('b');

    $p2 = Payload::method('test2');
    $p2->withParameter('a1');
    $p2->withParameter('b1');

    $url    = 'http://test';
    $client = new JsonRPCClient($url);

    $test = $client->batchRequest([
        $p1,
        $p2,
    ]);

    print_r($test);