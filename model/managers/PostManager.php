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

        public function listPostFromUser(){

            $sql = "SELECT *
                    FROM post p
                    INNER JOIN user u ON p.user_id = u.id_user";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }

        public function findPostById($id){

            $sql = "SELECT *
                    FROM post p
                    INNER JOIN topic t ON t.id_topic = p.topic_id
                    WHERE p.id_post = :id
                    ";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['id' => $id], false), 
                $this->className
            );
        }

        public function findPostByTopicId($id){

            $sql = "SELECT *
                    FROM post p
                    WHERE topic_id = :id";

            return $this->getMultipleResults(
                DAO::select($sql, ['id' => $id], true), 
                $this->className
            );
        }

        public function updatePost($text, $id){

            $sql = "UPDATE post p
                    SET p.text = :text
                    WHERE p.id_post = :id";

            return DAO::update($sql, ['text' => $text ,'id' => $id]);
        }

    }