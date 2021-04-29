<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Api;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Sylapi\EurocommerceLinker\Entities\Order;
use Sylapi\EurocommerceLinker\Helpers\ResponseError;
use Sylapi\EurocommerceLinker\Exceptions\ValidateException;
use Sylapi\EurocommerceLinker\Exceptions\TransportException;

class Orders
{
    private $session;

    const API_PATH = 'orders';

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function get(int $productId)
    {
        try {
            $client = $this->session->client();
            $stream = $client->get(
                self::API_PATH .'/'. (int) $productId,
                [
                    'debug' => $this->session->parameters()->getDebug()
                ]
            );
    
            $result = json_decode($stream->getBody()->getContents());
        
            if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Json data is incorrect');
            }

            return (new Response\Order($result))->get();
        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }   
    }

    public function all()
    {
        try {
            $client = $this->session->client();
            $stream = $client->get(
                self::API_PATH,
                [
                    'debug' => $this->session->parameters()->getDebug()
                ]
            );
            $result = json_decode($stream->getBody()->getContents());

            if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Json data is incorrect');
            }
            return (new Response\Orders((array) $result))->get();
        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }   
    }    

    public function update(Order $order): Order
    {
        if(!$order->validate()) {
            throw $order->getErrors()->createValidateException();
        }

        if($order->getId() === null) {
            throw new ValidateException('Order Id not exist.');
        }

        try {

            $client = $this->session->client();
            $request = (new Request\Order($order))->update();            
            $stream = $client->put(
                self::API_PATH.'/'.(int) $order->getId(),
                [
                    'debug' => $this->session->parameters()->getDebug(),
                    'headers' => $this->session->headers(),
                    'json' => $request
                ]
            );

            $result = json_decode($stream->getBody()->getContents());

            if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Json data is incorrect');
            }

            return (new Response\Order($result))->get();

        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }
    }

    public function create(Order $order) 
    {
        if(!$order->validate()) {
            throw $order->getErrors()->createValidateException();
        }
        
        try {

            $client = $this->session->client();
            $requestOrder = (new Request\Order($order))->create();

            $stream = $client->post(
                self::API_PATH,
                [
                    'debug' => $this->session->parameters()->getDebug(),
                    'headers' => $this->session->headers(),
                    'json' => $requestOrder
                ]
            );

            $result = json_decode($stream->getBody()->getContents());

            if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Json data is incorrect');
            }

            return (new Response\Order($result))->get();

        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }
    }

    public function delete(int $orderId): bool
    {        
        try {
            $client = $this->session->client();
            $stream = $client->delete(
                self::API_PATH.'/'. (int) $orderId,
                [
                    'debug' => $this->session->parameters()->getDebug(),
                    'headers' => $this->session->headers()
                ]
            );

            return ($stream->getStatusCode() === 200);

        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }
    }
}