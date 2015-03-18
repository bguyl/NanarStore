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
     * Article categorie.
     *
     * @var string
     */
    private $categorie;

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
	
	public function getCategorie() {
        return $this->categorie;
    }

    public function setCategorie($cat) {
        $this->categorie = $cat;
    }
}