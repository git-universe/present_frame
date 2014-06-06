<?php

class PageModel
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
    public function getPages()
    {

        $sql = "SELECT coalesce(p.id, 0) AS id, 
                    coalesce(p.name, 'N/A') AS page_name,
                    coalesce(p.content, 'No page yet created...') AS content,
                    l.name AS lang_name,
                    l.short
                FROM languages l
                LEFT OUTER JOIN pages p ON p.languages_id = l.id;";

        $query = $this->db->prepare($sql);
        
        $query->execute();

        return $query->fetchAll();
    }

    public function getPage($id)
    {

        $sql = "SELECT p.id, 
                    p.name,
                    p.content,
                    l.name AS lang_name,
                    l.short
                FROM languages l
                LEFT OUTER JOIN pages p ON p.languages_id = l.id
                WHERE p.id= :id;";

        $query = $this->db->prepare($sql);
        
        $query->execute( array(':id' => $id) );

        return $query->fetch();
    }

    public function setPage($id, $title, $content){
        $id = strip_tags($id);
        $title = strip_tags($title);


        $sql = "UPDATE `pages`
                SET `name` = :title, `content` = :content
                WHERE `id` = :id ;";

        $query = $this->db->prepare($sql);
        return $query->execute( array(':title' => $title, ':content' => $content, ':id' => $id) );
    }

    public function newPage($title, $content, $lang){
        $title = strip_tags($title);

        $sql = "INSERT INTO `pages` (`id`, `name`, `content`, `first`, `languages_id`, `pages_id`)
                VALUES (null, :name, :content, true, (SELECT id FROM languages WHERE short = :short), 1);";

        $query = $this->db->prepare($sql);
        return $query->execute( array(':name' => $title, ':content' => $content, ':short' => $lang) );
    }

}
