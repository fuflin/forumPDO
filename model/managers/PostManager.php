<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\PostManager;

    class PostManager extends Manager{

        protected $className = "Model\Entities\Post";
        protected $tableName = "post";


        public function __construct(){
            parent::connect();
        }

        public function listPostUser(){

            $sql = "SELECT p.text, p.datecreate, p.user_id
                    FROM post p
                    INNER JOIN user u ON p.user_id = u.id_user";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

    }