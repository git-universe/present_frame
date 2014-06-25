<?php

class LangModel
{
    /**
     * Every model needs a database connection, passed to the model
     * @param object $db A PDO database connection
     */
    function __construct($db) {
        try {
            $this->db = $db;
        } catch (PDOException $e) {
            exit('Database connection could not be established.');
        }
    }


    /**
     * Translates the passed expresion
     * @param string $uri Language uri
     */
    public function translate($expression)
    {
        if ($_SESSION['lang'] == LANG) {
            return $expression;
        } else {
            $sql = "SELECT COALESCE(t.translation, 'N/A' ) AS translation
                    FROM translations t
                    JOIN languages l ON t.languages_id = l.id
                    LEFT OUTER JOIN translations tr ON tr.id = t.translations_id
                    WHERE tr.translation = :expr AND l.short = :lang";
            $query = $this->db->prepare($sql);
            $query->execute( array(':expr' => $expression, ':lang' => $_SESSION['lang']) );

            $result = $query->fetch();

            if (!$result) {
                return "(" . $expression . ") translation N/A";
            } else {
                return $result->translation;
            }
        }
    }


    /**
     * Returns all languages
     */
    public function getLanguages()
    {
        $sql = "SELECT * FROM languages";
        
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }
    

    /**
     * Returns correct link for passed language
     * @param string $newLang Language requred for link transfrom
     */
    public function linkTransform($newLang)
    {
        $uri = str_replace ("/".$_SESSION['lang'], "/".$newLang, $_SERVER["REQUEST_URI"]);
        $url = "//".$_SERVER["SERVER_NAME"] . $uri;

        return $url;
    }

    public function isLanguage($short) {
        $short = strip_tags($short);

        $sql = "SELECT *
                FROM languages
                WHERE short = :short;";

        $query = $this->db->prepare($sql);
        $query->execute( array(':short' => $short) );

        if( $query->rowCount() > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategoryTranslation($categoryId, $lang) {
        $categoryId = strip_tags($categoryId);

        $sql = "SELECT ct.id, ct.name, l.short FROM category_translation ct
                INNER JOIN languages l ON l.id = ct.languages_id
                WHERE ct.categories_id = :catId AND l.short = :lang;";

        $query = $this->db->prepare($sql);
        $query->execute( array(':catId' => $categoryId, ':lang' => $lang) );
        $res = $query->fetch();

        if ( isset($res->name) ) {
            return $res->name;
        } else {
            return "";
        }
       
    }

    private function hasCategoryTranslation($catId, $langId) {
        $catId = strip_tags($catId);
        $langId = strip_tags($langId);

        $sql = "SELECT * FROM category_translation ct
                INNER JOIN languages l ON l.id = ct.languages_id
                WHERE ct.categories_id = :catId AND l.id = :langId;";

        $query = $this->db->prepare($sql);
        $query->execute( array(':catId' => $catId, ':langId' => $langId) );
        
        if( $query->rowCount() > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public function setCategoryTranslation($translation, $catId, $langId){  
        $translation = strip_tags($translation);
        $catId = strip_tags($catId);
        $langId = strip_tags($langId);

        if ( $this->hasCategoryTranslation($catId, $langId) ) {
            $sql = "UPDATE `category_translation`
                    SET `name` = :name
                    WHERE `languages_id` = :langId 
                    AND `categories_id` = :catId;";
        } else {
            $sql = "INSERT INTO `category_translation`
                    (`id`, `name`, `languages_id`, `categories_id`)
                    VALUES (null, :name, :langId, :catId);";
        }

        $query = $this->db->prepare($sql);
        return $query->execute( array(':name' => $translation, ':catId' => $catId, ':langId' => $langId) );
    }

}
