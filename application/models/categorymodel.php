<?php

class CategoryModel
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

    public function getCategories($lang = 'en')
    {

        $sql = "SELECT c.id, c.parent_id, ct.name, l.short
                FROM categories c
                INNER JOIN category_translation ct ON c.id = ct.categories_id
                INNER JOIN languages l ON l.id = ct.languages_id
                WHERE l.short = :lang
                ORDER BY c.priority;";

        $query = $this->db->prepare($sql);
        
        $query->execute(array(':lang' => $lang));

        return $query->fetchAll();
    }

    public function getMainCategories() {
        $sql = "SELECT c.id, ct.name,
                (SELECT IF(COUNT(id) > 0, true, false) FROM presentations WHERE categories_id = c.id) AS has_presentations 
                FROM categories c
                INNER JOIN category_translation ct ON ct.categories_id = c.id
                WHERE c.parent_id IS NULL AND ct.languages_id = 1
                ORDER BY priority;";

        $query = $this->db->prepare($sql);
        
        $query->execute();

        return $query->fetchAll();
    }

    public function getEmptyMainCategories() {
        $sql = "SELECT c.id, ct.name FROM categories c
                INNER JOIN category_translation ct ON ct.categories_id = c.id
                WHERE c.parent_id IS NULL AND ct.languages_id = 1 AND (SELECT IF(COUNT(id) > 0,false,true) FROM presentations WHERE categories_id = c.id)
                ORDER BY priority;";

        $query = $this->db->prepare($sql);
        
        $query->execute();

        return $query->fetchAll();
    }

    public function isCategory($id) {
        $id = strip_tags($id);

        $sql = "SELECT *
                FROM categories
                WHERE id = :id;";

        $query = $this->db->prepare($sql);
        $query->execute( array(':id' => $id) );

        if( $query->rowCount() > 0 ) {
            return true;
        } else {
            return false;
        }
    }

    public function getCategory($id) {
        $sql = "SELECT * FROM categories c
                WHERE c.id = :id;";

        $query = $this->db->prepare($sql);
        
        $query->execute(array(':id' => $id));

        return $query->fetch();
    }

    public function insertCategory($sys_name, $priority, $parent_id) {
        $sys_name = strip_tags($sys_name);
        $priority = strip_tags($priority);
        $parent_id = strip_tags($parent_id);

        if ($parent_id == 0) $parent_id = null;

        $sql = "INSERT INTO `categories`
                (`id`, `sys_name`, `priority`, `parent_id`)
                VALUES (null, :sys_name, :priority, :parent_id);";

        $query = $this->db->prepare($sql);
        
        try {
            if ( $query->execute( array(':sys_name' => $sys_name,':priority' => $priority,':parent_id' => $parent_id) ) ) {
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

    public function updateCategory($id, $sys_name, $priority, $parent_id) {
        $id = strip_tags($id);
        $sys_name = strip_tags($sys_name);
        $priority = strip_tags($priority);
        $parent_id = strip_tags($parent_id);

        if($parent_id == 0) $parent_id = null;


        $sql = "UPDATE `categories` SET
                `sys_name` = :sys_name,
                `priority` = :priority,
                `parent_id` = :parent_id
                WHERE `id` = :id;";

        $query = $this->db->prepare($sql);
        return $query->execute( array(':sys_name' => $sys_name, ':priority' => $priority,':parent_id' => $parent_id, ':id' => $id) );
    }

    public function canBeDeleted($id) {
        $id = strip_tags($id);


        $sql = "SELECT * FROM categories WHERE parent_id = :id;";

        $query = $this->db->prepare($sql);
        $query->execute( array(':id' => $id) );

        if( $query->rowCount() > 0 ) {
            return false;
        }

        $sql = "SELECT * FROM presentations WHERE categories_id = :id;";
        $query = $this->db->prepare($sql);
        $query->execute( array(':id' => $id) );

        if( $query->rowCount() > 0 ) {
            return false;
        }

        return true;
    }

    public function deleteCategory($id) {
        $id = strip_tags($id);

        $sql = "DELETE FROM category_translation WHERE categories_id = :id;";
        $query = $this->db->prepare($sql);
        $query->execute( array(':id' => $id) );

        $sql = "DELETE FROM categories WHERE id = :id;";
        $query = $this->db->prepare($sql);
        return $query->execute( array(':id' => $id) );
    }

    public function getInsertableCategories() {
        $sql = "SELECT c.id, ct.name
                FROM categories c
                INNER JOIN category_translation ct ON c.id = ct.categories_id
                INNER JOIN languages l ON l.id = ct.languages_id
                WHERE l.short = 'en' AND c.id NOT IN (SELECT parent_id FROM categories WHERE parent_id IS NOT NULL)
                ORDER BY c.priority;";
        $query = $this->db->prepare($sql);
        $query->execute();
        return $query->fetchAll();
    }

    public function getCategoryTranslations($id, $lang = null){
        $id = strip_tags($id);
        $lang = strip_tags($lang);

        $sql = "SELECT c.id, c.parent_id, ct.name, l.short
                FROM categories c
                INNER JOIN category_translation ct ON c.id = ct.categories_id
                INNER JOIN languages l ON l.id = ct.languages_id
                WHERE c.id = :id";

        if($lang != null) $sql .= ' AND l.short = :lang';

        $query = $this->db->prepare($sql);
        if($lang != null) $query->execute( array(':id' => $id, ':lang' => $lang) );
        else $query->execute( array(':id' => $id) );
        return $query->fetchAll();
    }

    public function getMenuCategories($lang) {
        $lang = strip_tags($lang);

        $sql = "SELECT c.id, c.parent_id, ct.name
                FROM categories c
                INNER JOIN category_translation ct ON c.id = ct.categories_id
                INNER JOIN languages l ON l.id = ct.languages_id
                WHERE l.short = :lang AND c.parent_id IS NULL
                AND ( (SELECT IF(COUNT(id) > 0,true,false) FROM presentations WHERE categories_id = c.id) 
                    OR (SELECT IF(COUNT(id) > 0,true,false) FROM categories WHERE parent_id = c.id) )
                ORDER BY priority;";

        $query = $this->db->prepare($sql);
        $query->execute( array(':lang' => $lang) );
        return $query->fetchAll();
    }
}