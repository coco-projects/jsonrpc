<?php

    use Coco\jsonrpc\payload\Payload;

    require '../vendor/autoload.php';

    $p1 = Payload::method('test1');

    $p1->withNameParameter('a1', 'a11');
    $p1->withNameParameter('b1', 'b11');

//    print_r($p1->toJson());
    print_r($p1->toArray());