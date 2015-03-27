<?php

namespace NanarStore\Domain;

class Article 
{
    /**
     * Article id.
     *
     * @var integer
     */
    private $id;

    /**
     * Article title.
     *
     * @var string
     */
    private $title;

    /**
     * Article description.
     *
     * @var string
     */
    private $description;
	
	/**
     * Article category.
     *
     * @var string
     */
    private $category;
	
	/**
     * Article image.
     *
     * @var string
     */
	private $image;
	
	/**
     * Article price.
     *
     * @var string
     */
	private $price;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getTitle() {
        return $this->title;
    }

    public function setTitle($title) {
        $this->title = $title;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($desc) {
        $this->description = $desc;
    }
	
	public function getCategory() {
        return $this->category;
    }

    public function setCategory($cat) {
        $this->category = $cat;
    }
	
	public function getImage() {
		return $this->image;
	}
	
	public function setImage($img){
		$this->image = $img;
	}
	
	public function getPrice() {
		return $this->price;
	}
	
	public function setPrice($price){
		$this->price = $price;
	}
}