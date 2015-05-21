<?php

namespace NanarStore\Domain;

class Basket
{
    /**
     * List of orders.
     *
     * @var Order[]
     */
    private $orders;

    public function getOrders() {
        return $this->orders;
    }

    public function setOrders($orders) {
        $this->orders = $orders;
    }
}
