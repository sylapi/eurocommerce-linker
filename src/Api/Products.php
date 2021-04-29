<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Api;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Sylapi\EurocommerceLinker\Api\Request;
use Sylapi\EurocommerceLinker\Api\Response;
use Sylapi\EurocommerceLinker\Entities\Product;
use Sylapi\EurocommerceLinker\Exceptions\ValidateException;
use Sylapi\EurocommerceLinker\Exceptions\TransportException;
use Sylapi\EurocommerceLinker\Helpers\ResponseError;
use Sylapi\EurocommerceLinker\Collections\Products as ProductsCollection;

class Products
{
    private $session;

    const API_PATH = 'products';

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function get(int $productId): Product
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
            
            return (new Response\Product($result))->get();

        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }   
    }

    public function all(): ProductsCollection
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
            
            return (new Response\Products((array) $result))->get();
        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }   
    }


    public function create(Product $product): Product
    {
        if(!$product->validate()) {
            throw $product->getErrors()->createValidateException();
        }
        
        try {

            $client = $this->session->client();
            $requestProduct = (new Request\Product($product))->create();
            $stream = $client->post(
                self::API_PATH,
                [
                    'debug' => $this->session->parameters()->getDebug(),
                    'headers' => $this->session->headers(),
                    'json' => $requestProduct
                ]
            );

            $result = json_decode($stream->getBody()->getContents());

            if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Json data is incorrect');
            }

            return (new Response\Product($result))->get();
        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }
    }


    public function update(Product $product): bool
    {
        if(!$product->validate()) {
            throw $product->getErrors()->createValidateException();
        }

        if($product->getId() === null) {
            throw new ValidateException('Product Id not exist.');
        }

        try {

            $client = $this->session->client();
            $requestProduct = (new Request\Product($product))->update();            
            $stream = $client->put(
                self::API_PATH.'/'.(int) $product->getId(),
                [
                    'debug' => $this->session->parameters()->getDebug(),
                    'headers' => $this->session->headers(),
                    'json' => $requestProduct
                ]
            );
            return ($stream->getStatusCode() === 204);

        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }
    }
}