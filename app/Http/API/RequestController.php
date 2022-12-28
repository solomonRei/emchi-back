<?php

namespace App\Http\API;

use App\Http\API\JWTController;
use App\Http\Controllers\Controller;
use http\Client\Request;
use Nette\Utils\JsonException;

class RequestController extends Controller
{
    private array $headers = [];
    private string $token;
//    private const API_URL = "http://192.168.133.21:32000/api/v2/";

    public function __construct()
    {
        $this->token = new JWTController();
        $this->setHeader("Authorization", $this->token);
    }

    /**
     * @throws \JsonException
     */
    public function sendResponse(array $data, string $action, string $method): array
    {
//      Form data for query
        $data_build = http_build_query($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_URL, env("API_URL").$action);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST,  1);
        }else {
            curl_setopt($ch, CURLOPT_URL, env("API_URL").$action."?".$data_build);
            curl_setopt($ch, CURLOPT_POST,  0);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        try {
            $data = json_decode(curl_exec($ch), true);
            curl_close($ch);

            if (isset($data['data']) && count($data['data']) > 0) {
                return [
                    'status' => 200,
                    'type' => 'success',
                    'response' => $data,
                ];
            }

            return [
                'status' => 200,
                'type' => 'error',
                'response' => $data,
            ];
        }catch (\JsonException $e) {
            return [
                'status' => 403,
                'type' => 'error'
            ];
        }

    }

    public function sendReponseClear(array $data, string $action, string $method)
    {
        $data_build = http_build_query($data);

        $ch = curl_init();

        curl_setopt($ch, CURLOPT_HTTPHEADER, $this->headers);

        if ($method === 'POST') {
            curl_setopt($ch, CURLOPT_URL, env("API_URL").$action);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            curl_setopt($ch, CURLOPT_POST,  1);
        }else {
            curl_setopt($ch, CURLOPT_URL, env("API_URL").$action."?".$data_build);
            curl_setopt($ch, CURLOPT_POST,  0);
        }

        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        try {
            $data = curl_exec($ch);
            curl_close($ch);
            dd($data);

        }catch (\JsonException $e) {
            return [
                'status' => 403,
                'type' => 'error'
            ];
        }
    }

    public function setHeader(string $key, string $value): void
    {
        $this->headers[] = "$key: $value";
    }

    public function getToken(): JWTController|string
    {
        return $this->token;
    }
}
