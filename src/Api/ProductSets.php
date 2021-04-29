<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Api;

use Exception;
use GuzzleHttp\Exception\ClientException;
use Sylapi\EurocommerceLinker\Entities\ProductSet;
use Sylapi\EurocommerceLinker\Helpers\ResponseError;
use Sylapi\EurocommerceLinker\Exceptions\TransportException;

class ProductSets
{
    private $session;

    const API_PATH = 'productsets';

    public function __construct($session)
    {
        $this->session = $session;
    }

    public function delete(int $productSetId): bool
    {
        try {

            $client = $this->session->client();            
            $stream = $client->delete(
                self::API_PATH . '/' . (int) $productSetId,
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