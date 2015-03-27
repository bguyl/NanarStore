<?php

namespace NanarStore\Domain;

class Comment 
{
    /**
     * Comment id.
     *
     * @var integer
     */
    private $id;

    /**
     * Comment author.
     *
     * @var \NanarStore\Domain\User
     */
    private $author;

    /**
     * Comment content.
     *
     * @var string 
     */
    private $content;
	
	/**
     * Comment grade.
     *
     * @var integer
     */
    private $grade;

    /**
     * Associated article.
     *
     * @var \NanarStore\Domain\Article
     */
    private $article;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getAuthor() {
        return $this->author;
    }

    public function setAuthor(User $author) {
        $this->author = $author;
    }

    public function getContent() {
        return $this->content;
    }

    public function setContent($content) {
        $this->content = $content;
    }
	
	public function getGrade() {
        return $this->grade;
    }

    public function setGrade($grade) {
        $this->grade = $grade;
    }

    public function getArticle() {
        return $this->article;
    }

    public function setArticle(Article $article) {
        $this->article = $article;
    }
}