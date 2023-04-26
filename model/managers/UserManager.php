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

        public function listUser(){

            $sql = "SELECT u.nickname, u.mail, u.dateregis
                    FROM user u";

            return $this->getMultipleResults(
                DAO::select($sql), 
                $this->className
            );
        }
    }