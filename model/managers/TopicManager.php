<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\TopicManager;

    class TopicManager extends Manager {

        protected $className = "Model\Entities\Topic";
        protected $tableName = "topic";


        public function __construct(){
            parent::connect();
        }

        public function listTopicByUser(){

            $sql = "SELECT t.title, t.creationdate, t.user_id
                    FROM topic t
                    INNER JOIN user u ON t.user_id = u.id_user";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        

        public function findTopicByCat($id){

            $sql = "SELECT *
                    FROM topic t 
                    WHERE category_id = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

    }

