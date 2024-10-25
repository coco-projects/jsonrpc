<?php

    use Coco\jsonrpc\JsonRPCClient;
    use Coco\jsonrpc\payload\Payload;

    require '../vendor/autoload.php';

    $url    = 'http://test';
    $client = new JsonRPCClient($url);

    $p1 = Payload::method('test1');
    $p1->withNameParameter('a1', 'a11');
    $p1->withNameParameter('b1', 'b11');

    $result = $client->request($p1);