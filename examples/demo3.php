<?php

    use Coco\jsonrpc\payload\Payload;

    require '../vendor/autoload.php';

    $p1 = Payload::method('test1');
    $p1->setId('123');

    $p1->withParameter('a');
    $p1->withParameter('b');

    print_r($p1->getId());

    echo PHP_EOL;
//    print_r($p1->toJson());
    print_r($p1->toArray());