<?php declare(strict_types=1, encoding='UTF-8');

namespace App\Http\Clients;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

class OpenAIClient
{
    private static array $settings;
    private static string $token;

    public function __construct($token, $settings) {
        self::$token = $token;
        self::$settings = $settings;
    }

    public function requestEdits($input, $instruction): string
    {
        $client = new Client();

        $headers = [
            'Content-Type' => 'application/json',
            'Authorization' => 'Bearer ' . self::$token,
        ];

        $body = json_encode([
            'model' => self::$settings['model'],
            'input' => $input,
            'instruction' => $instruction,
        ]);

        try {
            $response = $client->post(self::$settings['uri'], [
                'headers' => $headers,
                'body' => $body,
            ]);

            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            // Handle exceptions from the request
            if ($e->hasResponse()) {
                $response = $e->getResponse();
                $responseBody = $response->getBody()->getContents();
                $statusCode = $response->getStatusCode();
                throw new \Exception("OpenAI API request failed with status code {$statusCode}. Response body: {$responseBody}");
            } else {
                throw new \Exception("OpenAI API request failed: " . $e->getMessage());
            }
        } catch (\Exception $e) {
            // Handle other exceptions
            throw new \Exception("OpenAI API request failed: " . $e->getMessage());
        }
    }
}
