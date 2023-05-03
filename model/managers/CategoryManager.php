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

        public function findOneByName($data){

            $sql = "SELECT name
            FROM ".$this->tableName." u
            WHERE name = :name";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['name' => $data], false), 
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

        
    }