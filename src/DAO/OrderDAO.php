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
        $sql = "select * from t_oder where ord_usr=? and ord_art=?";
        $result = $this->getDb()->fetchAssoc($sql, array($user), array($article));

        if ($row)
            return $this->buildOrder($row);
        else
            throw new \Exception("No order matching user/article " . $user . $article);
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
          $this->getDb()->update('t_order', $orderData, array('ord_usr' => $order->getUserId(), 'ord_art'=> $order->getArticleId());)
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
    private function buildOrder(array $row) {
        $order = new Order();
        $order->setArticleId($row['ord_art']);
        $order->setUserId($row['ord_usr']);
        $order->setQuantity($row['ord_qt']);
        return $order;
    }
}
