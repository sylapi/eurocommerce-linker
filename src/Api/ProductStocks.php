<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Api;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Sylapi\EurocommerceLinker\Api\Response;
use Sylapi\EurocommerceLinker\Entities\ProductStock;
use Sylapi\EurocommerceLinker\Helpers\ResponseError;
use Sylapi\EurocommerceLinker\Exceptions\TransportException;
use Sylapi\EurocommerceLinker\Collections\ProductStocks as ProductStocksCollection;

class ProductStocks
{
    private $session;

    const API_PATH = 'productstocks';

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function get(int $productId): ProductStock
    {
        try {
            $client = $this->session->client();
            $stream = $client->get(
                self::API_PATH.'/'.(int) $productId,
                [
                    'debug' => $this->session->parameters()->getDebug()
                ]
            );
            $result = json_decode($stream->getBody()->getContents());

            if ($result === null && json_last_error() !== JSON_ERROR_NONE) {
                throw new Exception('Json data is incorrect');
            }
            return (new Response\ProductStock($result))->get();
        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }
    }

    public function all():ProductStocksCollection
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
            return (new Response\ProductStocks((array) $result))->get();
        } catch (ClientException $e) {
            throw new TransportException(ResponseError::message($e));
        } catch (Exception $e) {
            throw new TransportException($e->getMessage(), $e->getCode());
        }
    }
}