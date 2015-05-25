<?php

namespace NanarStore\DAO;

use NanarStore\Domain\Order;

class OrderDAO extends DAO
{

	 /**
     * Returns an order matching the supplied user and article.
     *
     * @param integer $user
     * @param integer $article
     *
     * @return \NanarStore\Domain\Order|throws an exception if no matching order is found
     */
    public function find($user, $article) {
        $sql = "select * from t_order where ord_usr=? and ord_art=?";
        $result = $this->getDb()->fetchAssoc($sql, array($user, $article));

        if ($result)
            return $this->buildDomainObject($result);
        else
            throw new \Exception("No order matching user/article " . $user . $article);
    }

   /**
     * Return all the orders matching the supplied user id.
     * @param integer $user
     *
     * @return array All the order from the user
     */

    public function findAll($user){
        $sql = "select * from t_order where ord_usr=? order by ord_art";
        $result = $this->getDb()->fetchAssoc($sql, array($user));

        $orders = array();
        foreach ($result as $row) {
            $orderId = $row['ord_art'];
            $oders[$orderId] = $this->buildDomainObject($row);
        }

        return $orders;

    }

	/**
     * Saves an order into the database.
     *
     * @param \NanarStore\Domain\Order $order The order to save
     */
    public function save(Order $order) {
        $orderData = array(
            'ord_usr' => $order->getUserId(),
            'ord_art' => $order->getArticleId(),
			      'ord_qt' => $order->getQuantity(),
            );

        if ($order->isSaved()) {
          $this->getDb()->update('t_order', $orderData, array('ord_usr' => $order->getUserId(), 'ord_art'=> $order->getArticleId()));
        }
        else{
          $this->getDb()->insert('t_order', $orderData);
          $order->setSaved(true);
        }
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($user, $article) {
        // Delete the order
        $this->getDb()->delete('t_order', array('ord_usr' => $user, 'ord_art' => $article));
    }

    /**
     * Creates an Order object based on a DB row.
     *
     * @param array $row The DB row containing Order data.
     * @return \NanarStore\Domain\Order
     */
    protected function buildDomainObject($row) {
        $order = new Order();
        $order->setArticleId($row['ord_art']);
        $order->setUserId($row['ord_usr']);
        $order->setQuantity($row['ord_qt']);
        return $order;
    }
}
