<?php

    declare(strict_types = 1);

    namespace Coco\jsonrpc;

    use Coco\jsonrpc\payload\BatchPayload;
    use Coco\jsonrpc\payload\NotificationPayload;
    use Coco\jsonrpc\payload\Payload;
    use Coco\jsonrpc\payload\PayloadAbstract;
    use GuzzleHttp\Client;

class JsonRPCClient
{
    private Client $client;

    private static string $proxyHost   = '127.0.0.1';
    private static int    $proxyPort   = 1080;
    private static bool   $enableProxy = false;
    private static bool   $debug       = false;

    public function __construct(private string $api)
    {
        $options = [
            'timeout' => 10000,
            'verify'  => false,
            'debug'   => static::$debug,
        ];

        if (static::$enableProxy) {
            $options['proxy'] = "socks5h://" . static::$proxyHost . ":" . static::$proxyPort;
        }

        $this->client = new Client($options);
    }

    public static function setProxyEnable(bool $enable): void
    {
        static::$enableProxy = $enable;
    }

    public static function setDebug(bool $enable): void
    {
        static::$debug = $enable;
    }

    public static function setProxy($ip = '127.0.0.1', $port = '1080'): void
    {
        static::$proxyHost = $ip;
        static::$proxyPort = $port;
    }

    public function request(PayloadAbstract $payload): array
    {
        return $this->post($payload->toArray());
    }

    public function batchRequest(array $batchPayloadArray): array
    {
        $batchPayload = new BatchPayload();

        foreach ($batchPayloadArray as $k => $payload) {
            $batchPayload->addPayload($payload);
        }

        return $this->request($batchPayload);
    }

    public function baseRequest(string $method, array $params): array
    {
        $payload = Payload::method($method);

        foreach ($params as $k => $v) {
            $payload->withNameParameter($k, $v);
        }

        return $this->request($payload);
    }

    public function notificationRequest(string $method, array $params): array
    {
        $payload = NotificationPayload::method($method);

        foreach ($params as $k => $v) {
            $payload->withNameParameter($k, $v);
        }

        return $this->request($payload);
    }

    protected function post(array $data = []): array
    {
        $requestData['headers'] = [
            'Accept' => 'application/json',
        ];

        $requestData['json'] = $data;

        $contents = $this->client->post($this->api, $requestData)->getBody()->getContents();

        $response = json_decode($contents, true, 512, JSON_THROW_ON_ERROR);

        return $response;
    }
}
