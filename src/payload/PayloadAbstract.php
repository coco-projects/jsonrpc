<?php

    declare(strict_types = 1);

    namespace Coco\jsonrpc\payload;

abstract class PayloadAbstract
{
    abstract public function toArray();

    public function toJson(): false|string
    {
        return json_encode($this->toArray(), JSON_UNESCAPED_UNICODE);
    }
}
