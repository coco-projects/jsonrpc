<?php

    use Coco\jsonrpc\payload\BatchPayload;
    use Coco\jsonrpc\payload\NotificationPayload;
    use Coco\jsonrpc\payload\Payload;

    require '../vendor/autoload.php';

    $p1 = NotificationPayload::method('test1');

    $p1->withParameter('a');
    $p1->withParameter('b');

    $p2 = Payload::method('test2');

    $p2->withParameter('a1');
    $p2->withParameter('b1');

    $p3 = new BatchPayload();

    $p3->addPayload($p1);
    $p3->addPayload($p2);

//    print_r($p3->toJson());
    print_r($p3->toArray());