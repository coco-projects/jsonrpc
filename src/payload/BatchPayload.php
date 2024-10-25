<?php

    declare(strict_types = 1);

    namespace Coco\jsonrpc\payload;

class BatchPayload extends PayloadAbstract
{
    public array    $payloads = [];
    protected array $body     = [];

    public function addPayload(PayloadAbstract $payload): static
    {
        $this->payloads[] = $payload;

        return $this;
    }

    public function toArray(): array
    {
        foreach ($this->payloads as $payload) {
            $this->body[] = $payload->toArray();
        }

        return $this->body;
    }
}
