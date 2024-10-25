<?php

    declare(strict_types = 1);

    namespace Coco\jsonrpc\payload;

class NotificationPayload extends PayloadAbstract
{
    const string VERSION = '2.0';

    protected array $parameters = [];
    protected array $body       = [];

    public static function method(string $method): static
    {
        return new static($method);
    }

    protected function __construct(protected string $method)
    {
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function withParameter($parameter): static
    {
        $this->parameters[] = $parameter;

        return $this;
    }

    public function removeParameter($parameter): static
    {
        $this->parameters = array_filter($this->parameters, function ($item) use ($parameter) {
            return $item !== $parameter;
        });

        return $this;
    }

    public function removeParameterByName($name): static
    {
        if (isset($this->parameters[$name])) {
            unset($this->parameters[$name]);
        }

        return $this;
    }

    public function withNameParameter($name, $parameter): static
    {
        $this->parameters[$name] = $parameter;

        return $this;
    }

    public function withParameterArray(array $parameters): static
    {
        foreach ($parameters as $parameter) {
            $this->withParameter($parameter);
        }

        return $this;
    }

    public function withNameParameterArray(array $parameters): static
    {
        foreach ($parameters as $name => $parameter) {
            $this->withNameParameter($name, $parameter);
        }

        return $this;
    }

    public function toArray(): array
    {
        $this->body['jsonrpc'] = static::VERSION;
        $this->body['method']  = $this->method;

        if (count($this->parameters)) {
            $this->body['params'] = $this->parameters;
        }

        return $this->body;
    }
}
