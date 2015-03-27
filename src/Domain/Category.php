<?php

namespace NanarStore\Domain;

class Category 
{
    /**
     * Category name.
     *
     * @var string
     */
    private $name;

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }
}
