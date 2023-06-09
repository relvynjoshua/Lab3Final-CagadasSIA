<?php

namespace App\Traits;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;

trait ConsumesExternalService
{
    public function performRequest($method, $requestUrl, $form_params = [], $headers = [])
    {
        $client = new Client([
            'base_uri' => $this->baseUri,
        ]);

        try {
            $response = $client->request($method, $requestUrl, [
                'form_params' => $form_params,
                'headers' => $headers,
            ]);

            return $response->getBody()->getContents();
        } catch (RequestException $e) {
            if ($e->hasResponse()) {
                $responseBody = $e->getResponse()->getBody()->getContents();
                $responseData = json_decode($responseBody, true);

                // Check if the error data is an array
                if (is_array($responseData) && isset($responseData['error'])) {
                    $errorData = [
                        'site' => $responseData['site'],
                        'message' => $responseData['error'],
                        'error number' => $responseData['code'],
                    ];

                    // Convert the error data to JSON string
                    return json_encode($errorData);
                }

                // If error data is not an array, return as a single error message
                return $responseData;
            }

            // Re-throw the exception if there is no response
            throw $e;
        }
    }
}
