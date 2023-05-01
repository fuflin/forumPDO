<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\UserManager;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    
    class SecurityController extends AbstractController implements ControllerInterface{

        public function index(){
            
           
        }

        public function registerForm(){

            return [
                "view"=> VIEW_DIR."/security/register.php",
                "data" => null,
            ];
        }
            
        public function register(){

            if(!empty($_POST)){

                $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, array(
                    "options" => array("regexp" => '/[A-Za-z0-9]{12,32}/')
                ));
                $confimrPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);

                if($nickname && $password && $mail){

                    if(($password == $confimrPassword) and strlen($password) >= 12){

                        $manager = new UserManager();
                        $user = $manager->findOneByNickname($nickname);

                        if(!$user){

                            $hash = password_hash($password, PASSWORD_DEFAULT);

                            if($manager->add([
                                "nickname" => $nickname,
                                "mail" => $mail, 
                                "password" => $hash,
                            ]));
                        }
                    }
                }
            } return [
                "view" => VIEW_DIR."security/register.php"
            ];
        }

        public function login(){

            if(!empty($_POST)){

                $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($nickname && $password){

                    $manager = new UserManager();
                    $user = $manager->log(
                        $nickname,
                        $password
                    );

                    if(!$user){

                        echo "identifiant incorrect";
                    } else {

                        echo "connexion réussie";
                    }
                    
                }

            } return [
                "view" => VIEW_DIR."security/login.php"
            ];
        }

        public function logout(){


        }
    }