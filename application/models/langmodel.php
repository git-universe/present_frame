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
            $sql = "SELECT t.translation
                    FROM translations t
                    JOIN languages l ON t.languages_id = l.id
                    LEFT OUTER JOIN translations tr ON tr.id = t.translations_id
                    WHERE tr.translation = :expr AND l.short = :lang";
            $query = $this->db->prepare($sql);
            $query->execute( array(':expr' => $expression, ':lang' => $_SESSION['lang']) );
            return $query->fetch()->translation;
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

}
