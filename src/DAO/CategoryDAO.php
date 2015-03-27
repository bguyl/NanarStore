<?php

namespace NanarStore\DAO;

use NanarStore\Domain\Category;

class CategoryDAO extends DAO
{
    /**
     * Return a list of all categories.
     *
     * @return array A list of all categories.
     */
    public function findAll(){
        $sql = "select * from t_category order by cat_name";
        $result = $this->getDb()->fetchAll($sql);
     
        // Convert query result to an array of domain objects
        $categories = array();
        foreach ($result as $row) {
            $categoryName = $row['cat_name'];
            $categories[$categoryName] = $this->buildDomainObject($row);
        }
        return $categories;
        
    }
    
    
     /**
     * Returns a category matching the supplied name.
     *
     * @param string $name
     *
     * @return \NanarStore\Domain\Category|throws an exception if no matching category is found
     */
    public function find($name) {
        $sql = "select * from t_article where cat_name=?";
        $row = $this->getDb()->fetchAssoc($sql, array($name));

        if ($row)
            return $this->buildDomainObject($row);
        else
            throw new \Exception("No category matching name " . $name);
    }
    
    protected function buildDomainObject($row) {
        $category = new Category();
        $category->setName($row['cat_name']);
        return $category;
    }
}
