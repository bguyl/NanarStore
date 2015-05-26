<?php

namespace NanarStore\Domain;

class Order
{
    /**
     * Id of the article ordered.
     *
     * @var integer
     */
    private $articleId;

    /**
     * Id of the order's user.
     *
     * @var integer
     */
    private $userId;

    /**
     * Order quantity.
     *
     * @var integer
     */
    private $quantity;

    /**
      * Is saved in database ?
      * @var boolean
      */
    private $saved = false;

    public function getArticleId() {
        return $this->articleId;
    }

    public function setArticleId($articleId) {
        $this->articleId = $articleId;
    }

    public function getUserId() {
        return $this->userId;
    }

    public function setUserId($userId) {
        $this->userId = $userId;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }

    public function isSaved(){
        return $this->saved;
    }

    public function setSaved($bool){
        $this->saved = $bool;
    }
}
