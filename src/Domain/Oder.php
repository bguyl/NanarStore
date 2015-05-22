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

    public function getArticleId() {
        return $this->articleId;
    }

    public function setArticleId($articleId) {
        $this->articleId = $articleId;
    }

    public function getUser() {
        return $this->user;
    }

    public function setUser(User $user) {
        $this->user = $user;
    }

    public function getQuantity() {
        return $this->quantity;
    }

    public function setQuantity($quantity) {
        $this->quantity = $quantity;
    }
}
