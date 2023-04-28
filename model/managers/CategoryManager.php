<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\CategoryManager;

    class CategoryManager extends Manager{

        protected $className = "Model\Entities\Category";
        protected $tableName = "category";


        public function __construct(){
            parent::connect();
        }

        public function listCats(){

            $sql = "SELECT *
                    FROM category c";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        public function findCatTopic($id){

            $sql = "SELECT *
                    FROM category c 
                    INNER JOIN topic t ON c.id_category = t.category_id
                    WHERE id_category = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function addCat(){

            $sql = " INSERT INTO 
            ";
        }
    }