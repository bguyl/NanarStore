<?php

namespace NanarStore\DAO;

use NanarStore\Domain\Basket;

class BasketDAO extends DAO
{
    /**
     * Return a list of oders matching the supplied user.
     *
     * @return array A list of oders.
     */
    public function find($user) {
        $sql = "select * from t_order where ord_usr=?";
        $row = $this->getDb()->fetchAssoc($sql, array($user));

        // Convert query result to an array of domain objects
        if(!$row)
          throw new \Exception("No basket matching this user " . $user);

        $basket = array();
        foreach ($result as $row) {
            $orderId = $row['ord_art'];
            $basket[$orderId] = $this->buildBasket($row);
        }
        return $basket;
    }

    protected function buildBasket($row){
        $basket = new Basket();
    }
}
