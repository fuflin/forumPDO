<?php
    namespace Model\Managers;
    
    use App\Manager;
    use App\DAO;
    // use Model\Managers\UserManager;

    class UserManager extends Manager{

        protected $className = "Model\Entities\User";
        protected $tableName = "user";


        public function __construct(){
            parent::connect();
        }

        public function findOneByNickname($data){

            $sql = "SELECT *
            FROM ".$this->tableName." u
            WHERE u.nickname = :nickname";

            return $this->getOneOrNullResult(
                DAO::select($sql, ['nickname' => $data], false), 
                $this->className
            );
        }

        public function listUser(){

            $sql = "SELECT *
                    FROM user u";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        } 

        public function check($nickname){

            $sql = "SELECT u.user_id, u.nickname, u.password, u.role
            FROM user u
            WHERE u.nickname = '$nickname' ";
    // var_dump($sql);
            return $this->getOneOrNullResult(
                DAO::select($sql, null, false), 
                $this->className
            );
        }
    }