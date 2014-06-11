<?php

class PresentationModel
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

    public function insertPresentation($name, $descr, $order, $langId, $catId){
        $name = strip_tags($name);
        $descr = strip_tags($descr);
        $order = strip_tags($order);
        $langId = strip_tags($langId);
        $catId = strip_tags($catId);

        if($presentId == 0) $presentId = null; 

        $sql = "INSERT INTO `present_frame`.`presentations`
                (`id`, `name`, `desc`, `order`, `languages_id`, `categories_id`)
                VALUES (null, :name, :descr, :order, :langId, :catId);";

        $query = $this->db->prepare($sql);
        
        $succ = $query->execute( array(':name' => $name, ':descr' => $descr, ':order' => $order, ':langId' => $langId, ':catId' => $catId) );

        try {
            if ( $succ ) {
                return $this->db->lastInsertId();
            } else {
                return false;
            }
        }
        catch (Exception $e)
        {
         return false;
        }
    }

     public function updatePresentation($id, $name, $descr, $order, $langId, $catId){
        $id = strip_tags($id);
        $name = strip_tags($name);
        $descr = strip_tags($descr);
        $order = strip_tags($order);
        $langId = strip_tags($langId);
        $catId = strip_tags($catId);

        if($presentId == 0) $presentId = null; 

        $sql = "UPDATE `presentations` SET 
                `name` = :name,
                `desc` = :descr,
                `order` = :order,
                `languages_id` = :langId,
                `categories_id` = :catId
                WHERE `id` = :id";

        $query = $this->db->prepare($sql);
        
        return $query->execute( array(':name' => $name, ':descr' => $descr, ':order' => $order, ':langId' => $langId, ':catId' => $catId, ':id' => $id) );
    }

    public function deletePresentation($id){
        $id = strip_tags($id);

        $sql = "DELETE FROM slides WHERE presentations_id = :id;
                DELETE FROM presentations WHERE id = :id;";
        $query = $this->db->prepare($sql);
        $query->execute( array(':id' => $id, ':id' => $id) );
    }

    public function isPresentation($id) {
        $id = strip_tags($id);

        $sql = "SELECT *
                FROM presentations
                WHERE id = :id;";

        $query = $this->db->prepare($sql);
        $query->execute( array(':id' => $id) );

        if( $query->rowCount() > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public function getDetails($id) {
        $id = strip_tags($id);

        $sql = "SELECT *
                FROM presentations
                WHERE id = :id;";

        $query = $this->db->prepare($sql);
        $query->execute( array(':id' => $id) );
        return $query->fetch();
    }

    public function getPresentations($catId, $langId = null) {
        $catId = strip_tags($catId);
        $langId = strip_tags($langId);

        $sql = "SELECT *
                FROM presentations
                WHERE categories_id = :catId";

        if($langId != null) $sql = $sql . " AND languages_id = :langId";

        $query = $this->db->prepare($sql);

        if($langId != null) {
            $query->execute( array(':catId' => $catId, ':langId' => $langId) );
        } else {
            $query->execute( array(':catId' => $catId) );
        }
        return $query->fetchAll();
    }
}
