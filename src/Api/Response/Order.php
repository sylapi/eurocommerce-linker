<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Api\Response;

use stdClass;
use Sylapi\EurocommerceLinker\Entities\Delivery;
use Sylapi\EurocommerceLinker\Entities\Position;
use Sylapi\EurocommerceLinker\Entities\OrderParcel;
use Sylapi\EurocommerceLinker\Collections\Positions;
use Sylapi\EurocommerceLinker\Collections\OrderParcels;
use Sylapi\EurocommerceLinker\Entities\OrderAttachement;
use Sylapi\EurocommerceLinker\Collections\OrderAttachements;
use Sylapi\EurocommerceLinker\Entities\Order as OrderEntity;

class Order
{
    private $result;

    function __construct(stdClass $result)
    {
        $this->result = $result;
    }

    public function get(): OrderEntity
    {
        
        $delivery = null;
        if(isset($this->result->delivery) 
            && $this->result->delivery instanceof stdClass)
        {
            $delivery = new Delivery();
            $delivery->setCarier($this->result->delivery->carrier)
                ->setCurrencyCOD($this->result->delivery->currencyCOD)
                ->setAmountCOD($this->result->delivery->amountCOD)
                ->setAdditionalInfo($this->result->delivery->additionalInfo)
                ->setNote($this->result->delivery->note);
        }

        $positions = null;
        if(isset($this->result->positions) 
        && is_array($this->result->positions))
        {
            $positions = (count($this->result->positions) > 0) ? new Positions() : null;

            foreach ($this->result->positions as $item) {
                $position = new Position;
                $position->setId($item->id)
                    ->setProductId($item->productId)
                    ->setRefId($item->refid)
                    ->setAdditionalId($item->additionalId)
                    ->setQuantity($item->quantity);
                $positions->add($position);
            }
        }


        $parcels = null;
        if(isset($this->result->parcels) 
        && is_array($this->result->parcels))
        {
            $parcels = (count($this->result->parcels) > 0) ? new OrderParcels() : null;

            foreach ($this->result->parcels as $item) {
                $orderParcel = new OrderParcel();
                $orderParcel->setId($item->id)
                    ->setCarrier($item->carrier)
                    ->setNumber($item->number)
                    ->setStatus($item->statusDate)
                    ->setStatusDate($item->statusDate)
                    ->setOriginalStatus($item->originalStatus)
                    ->setAddData($item->addData)
                    ->setSentDate($item->sentDate)
                    ->setDeliveryDate($item->deliveryDate);
                $parcels->add($orderParcel);
            }
        }

        $attachements = null;
        if(isset($this->result->attachements) 
        && is_array($this->result->attachements))
        {
            $attachements = (count($this->result->attachements) > 0) ? new OrderAttachements() : null;

            foreach ($this->result->attachements as $item) {
                $orderAttachement = new OrderAttachement();
                $orderAttachement->setName($item->name)
                    ->setContent($item->content);

                $attachements->add($orderAttachement);
            }
        }

        $order = new OrderEntity;
        $order->setId($this->result->id)
            ->setRefId($this->result->refId)
            ->setNumber($this->result->number)
            ->setSignature($this->result->signature)
            ->setSource($this->result->source)
            ->setStatus($this->result->status)
            ->setStatusDate($this->result->statusDate)
            ->setAddDate($this->result->addDate)
            ->setForwardDate($this->result->forwardDate)
            ->setPackDate($this->result->packDate)
            ->setComments($this->result->comments)
            ->setDelivery($delivery)
            ->setContactPerson($this->result->contactPerson)
            ->setPhone($this->result->phone)
            ->setEmail($this->result->email)
            ->setName1($this->result->name1)
            ->setName2($this->result->name2)
            ->setName3($this->result->name3)
            ->setCountryCode($this->result->countryCode)
            ->setPostalCode($this->result->postalCode)
            ->setPlace($this->result->place)
            ->setStreet($this->result->street)
            ->setSerialNumber($this->result->serialNumber)
            ->setNote($this->result->note)
            ->setPositions($positions)
            ->setAttachements($attachements)
            ->setParcels($parcels);
            
        return $order;
    }
}