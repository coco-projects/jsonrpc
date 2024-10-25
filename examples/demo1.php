<?php

    use Coco\jsonrpc\payload\NotificationPayload;

    require '../vendor/autoload.php';

    $p1 = NotificationPayload::method('test1');

    $p1->withParameter('a');
    $p1->withParameter('b');

//    print_r($p1->toJson());
    print_r($p1->toArray());