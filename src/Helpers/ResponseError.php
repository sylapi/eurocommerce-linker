<?php

declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Helpers;

use GuzzleHttp\Exception\ClientException;

class ResponseError
{

    const DEFAULT_MESSAGE = 'Something went wrong!';

    public static function message(ClientException $e): string
    {
        $message = null;

        $response = $e->getResponse()->getBody()->getContents();
        $response = json_decode($response);

        if (isset($response->details)) {
            $message = json_encode($response->details);
        } elseif (isset($response->message)) {
            $message = $response->message;
        } elseif (isset($response->error)) {
            $message = $response->error;
        }

        if ($message === null) 
        {
            $message = self::messageByStatusCode($e->getResponse()->getStatusCode());
        }

        return $message ?? self::DEFAULT_MESSAGE;
    }

    public static function messageByStatusCode(int $code): ?string
    {
        $message = null;
        switch ($code) {
            case 400: 
                $message = '400 (Bad Request)';
                break;
            case 401:
                $message = '401 (Unauthorized)';
                break;
            case 403:
                $message = '403 (Forbidden)';
                break;
            case 404:
                $message = '404 (Not Found)';
                break;
            case 405:
                $message = '405 (Method Not Allowed)';
                break;
            case 406:
                $message = '406 (Not Acceptable)';
                break; 
            case 412:
                $message = '412 (Precondition Failed)';
                break;
            case 415:
                $message = '415 (Unsupported Media Type)';
                break;
            case 500:
                $message = '500 (Internal Server Error)';
                break;
            case 501:
                $message = '501 (Not Implemented)';
                break;                                                                                           
        }

        return $message;
    }

}