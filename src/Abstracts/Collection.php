<?php
declare(strict_types=1);

namespace Sylapi\EurocommerceLinker\Abstracts;

use ArrayObject;
use Sylapi\EurocommerceLinker\Exceptions\CollectionException;

abstract class Collection extends ArrayObject
{

    public function add(Entity $entity)
    {
        $this->append($entity);
        return $this;
    }

    public function toArray(): array
    {
        $iterator = $this->getIterator();
        $response = [];

        while($iterator->valid()) {
            $item = $iterator->current();
            if(is_object($item) AND !method_exists($item, 'toArray')) {
                throw new CollectionException(get_class($item) .' has no method toArray.');
            }
            $response[] = (is_object($item)) ? $item->toArray() : $item;
            $iterator->next();
        }

        return $response;
    }
}
