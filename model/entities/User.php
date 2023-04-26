<?php
    namespace Model\Entities;

    use App\Entity;

    final class User extends Entity{

        private $id;
        private $nickname;
        private $mail;
        private $password;
        private $user;
        private $dateregis;
        private $closed;

        public function __construct($data){         
            $this->hydrate($data);        
        }

        /**
         * Get the value of nickname
         */ 
        public function getNickname()
        {
                return $this->nickname;
        }

        /**
         * Set the value of nickname
         *
         * @return  self
         */ 
        public function setNickname($nickname)
        {
                $this->nickname = $nickname;

                return $this;
        }

        public function getdateregis(){
            $formattedDate = $this->dateregis->format("d/m/Y, H:i:s");
            return $formattedDate;
        }

        public function setdateregis($date){
            $this->dateregis = new \DateTime($date);
            return $this;
        }

        /**
         * Get the value of mail
         */ 
        public function getMail()
        {
                return $this->mail;
        }

        /**
         * Set the value of mail
         *
         * @return  self
         */ 
        public function setMail($mail)
        {
                $this->mail = $mail;

                return $this;
        }
    }