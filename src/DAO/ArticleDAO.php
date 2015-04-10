<?php

namespace NanarStore\DAO;

use NanarStore\Domain\Article;

class ArticleDAO extends DAO
{
    /**
     * Return a list of all articles, sorted by date (most recent first).
     *
     * @return array A list of all articles.
     */
    public function findAll() {
        $sql = "select * from t_article order by art_id desc";
        $result = $this->getDb()->fetchAll($sql);

        // Convert query result to an array of domain objects
        $articles = array();
        foreach ($result as $row) {
            $articleId = $row['art_id'];
            $articles[$articleId] = $this->buildDomainObject($row);
        }
        return $articles;
    }

	 /**
     * Returns an article matching the supplied id.
     *
     * @param integer $id
     *
     * @return \NanarStore\Domain\Article|throws an exception if no matching article is found
     */
    public function find($id) {
        $sql = "select * from t_article where art_id=?";
        $row = $this->getDb()->fetchAssoc($sql, array($id));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No article matching id " . $id);
    }

    /**
      * Returns articles matching with the supplied category.
      *
      * @param integer $name
      *
      * @return \NanarStore\Domain\Article|throws an exception if no matching article is found
      */
    public funtion findByCategory($name){
      $sql = "select * from t_article where art_category=?";
      $result = $this->getDb()->fetchAll($sql, array($name));

      $articles = array();
      foreach ($result as $row){
          $articleId = $row['art_id'];
          $articles[$articlesId] = $this->buildDomainObject($row);
      }

      if ($articles)
          return $articles;
      else
          throw new \Exception("No article matching category " . $name);

    }

	/**
     * Saves an article into the database.
     *
     * @param \NanarStore\Domain\Article $article The article to save
     */
    public function save(Article $article) {
        $articleData = array(
            'art_title' => $article->getTitle(),
            'art_description' => $article->getDescription(),
			'art_category' => $article->getCategory(),
			'art_image' => $article->getImage(),
			'art_price' => $article->getPrice(),
            );

        if ($article->getId()) {
            // The article has already been saved : update it
            $this->getDb()->update('t_article', $articleData, array('art_id' => $article->getId()));
        } else {
            // The article has never been saved : insert it
            $this->getDb()->insert('t_article', $articleData);
            // Get the id of the newly created article and set it on the entity.
            $id = $this->getDb()->lastInsertId();
            $article->setId($id);
        }
    }

    /**
     * Removes an article from the database.
     *
     * @param integer $id The article id.
     */
    public function delete($id) {
        // Delete the article
        $this->getDb()->delete('t_article', array('art_id' => $id));
    }

    /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \NanarStore\Domain\Article
     */
    private function buildArticle(array $row) {
        $article = new Article();
        $article->setId($row['art_id']);
        $article->setTitle($row['art_title']);
        $article->setDescription($row['art_description']);
		$article->setCategory($row['art_category']);
		$article->setImage($row['art_image']);
		$article->setPrice($row['art_price']);
        return $article;
    }

	 /**
     * Creates an Article object based on a DB row.
     *
     * @param array $row The DB row containing Article data.
     * @return \NanarStore\Domain\Article
     */
    protected function buildDomainObject($row) {
        $article = new Article();
        $article->setId($row['art_id']);
        $article->setTitle($row['art_title']);
        $article->setDescription($row['art_description']);
		$article->setCategory($row['art_category']);
		$article->setImage($row['art_image']);
		$article->setPrice($row['art_price']);
        return $article;
    }
}
