<?php

class CommentModel
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

    public function getComments($presentationId) {

        $sql = "SELECT c.*, u.id AS user_id, u.username, u.admin, u.disabled FROM comments c
                INNER JOIN users u ON u.id = c.users_id
                WHERE c.presentations_id = :presentationId
                ORDER BY c.posted DESC";

        $query = $this->db->prepare($sql);
        
        $query->execute(array(':presentationId' => $presentationId));

        return $query->fetchAll();
    }

    public function newComment($userId, $presentationId, $comment) {
        $userId = strip_tags($userId);
        $presentationId = strip_tags($presentationId);
        $comment = strip_tags($comment);

        $sql = "INSERT INTO `present_frame`.`comments`
            (`id`, `comment`, `posted`, `users_id`, `presentations_id`) VALUES
            (NULL, :comment, NOW(), :userId, :presentationId);";

        $query = $this->db->prepare($sql);
        
        if ( $query->execute( array(':comment' => $comment, ':userId' => $userId, ':presentationId' => $presentationId) ) )
        {
            return $this->db->lastInsertId();
        } else {
            return false;
        }
    }

    public function setComment($commentId, $comment) {
        $presentationId = strip_tags($commentId);
        $comment = strip_tags($comment);

        $sql = "UPDATE comments SET comment = :comment WHERE id = :commentId;";

        $query = $this->db->prepare($sql);
        
        return $query->execute( array(':comment' => $comment, ':commentId' => $commentId) );
    }

     public function deleteComment($commentId) {
        $presentationId = strip_tags($commentId);

        $sql = "DELETE FROM comments WHERE id = :commentId;";

        $query = $this->db->prepare($sql);
        
        return $query->execute( array(':commentId' => $commentId) );
    }
}
