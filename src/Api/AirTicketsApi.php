<?php


namespace App\Api;


use GuzzleHttp\Client;

class AirTicketsApi
{
    public function search(array $data): string
    {
        $client = new Client();
        $url = 'http://air-tickets.com/api/route-schedule/search/';

        $response = $client->request('POST', $url, [
            'headers' => [
                'TOKEN' => '55555'
            ],
            'body' => json_encode($data),
        ]);

        return $response->getBody()->getContents();
    }

    public function decode(string $data): string
    {
        return base64_decode(json_decode($data));
    }
}