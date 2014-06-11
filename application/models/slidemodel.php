<?php

class SlideModel
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

    public function insertSlide($order, $content, $presentId) {
        $order = strip_tags($order);
        $presentId = strip_tags($presentId);

        $sql = "INSERT INTO `slides` (`id`, `order`, `content`, `presentations_id`)
                VALUES (null, :order, :content, :presentId);";

        $query = $this->db->prepare($sql);
        
        return $query->execute( array(':order' => $order,':content' => $content,':presentId' => $presentId) );
    }

    public function updateSlide($order, $content, $id) {
        $order = strip_tags($order);
        $id = strip_tags($id);

        $sql = "UPDATE `slides` SET `order` = :order, `content` = :content WHERE `id` = :id;";

        $query = $this->db->prepare($sql);
        
        return $query->execute( array(':order' => $order,':content' => $content,':id' => $id) );
    }

    public function deleteSlide($id) {
        $id = strip_tags($id);

        $sql = "SELECT presentations_id FROM slides WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute( array(':id' => $id) );
        $presId = $query->fetch()->presentations_id;

        $sql = "DELETE FROM slides WHERE id = :id";
        $query = $this->db->prepare($sql);
        $query->execute( array(':id' => $id) );
        
        return $presId;
    }

    public function getSlides($presentId) {
       $presentId = strip_tags($presentId);

       $sql = "SELECT * FROM slides WHERE presentations_id = :presentId ORDER BY slides.order;";

        $query = $this->db->prepare($sql);
        
        $query->execute( array(':presentId' => $presentId) );

        return $query->fetchAll();
    }


    public function getSlide($id) {
        $id = strip_tags($id);

        $sql = "SELECT * FROM slides WHERE id = :id;";

        $query = $this->db->prepare($sql);
        
        $query->execute( array(':id' => $id) );

        return $query->fetch();
    }
}
