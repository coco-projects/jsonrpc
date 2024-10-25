<?php

    declare(strict_types = 1);

    namespace Coco\jsonrpc\payload;

    use Coco\snowflake\Snowflake;

class Payload extends NotificationPayload
{
    public ?string $id = null;

    public function __construct($method)
    {
        $this->id = (new Snowflake())->id();

        parent::__construct($method);
    }

    public function setId(string $id): static
    {
        $this->id = $id;

        return $this;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function toArray(): array
    {
        $this->body['id'] = $this->id;

        return parent::toArray();
    }
}
