<?php

namespace Drupal\factory_method\Classes;

abstract class FactoryMethod
{
    const CHEAP = 'cheap';
    const FAST = 'fast';

    abstract protected function createVehicle(string $type): VehicleInterface;

    public function create(string $type): VehicleInterface
    {
        $obj = $this->createVehicle($type);
        $obj->setColor('black');

        return $obj;
    }
}
