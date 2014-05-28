<?php

class HomeModel
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
     * Gets the homepage content for selected language
     * @param string $uri Language uri
     */
    public function getHomePage($lang)
    {

        $sql = "SELECT p.`name`, p.content FROM pages p
                LEFT OUTER JOIN languages l ON p.languages_id = l.id
                WHERE p.`first` = true AND l.short = :lang";

        $query = $this->db->prepare($sql);
        
        $query->execute(array(':lang' => $lang));

        return $query->fetchAll();
    }

}
