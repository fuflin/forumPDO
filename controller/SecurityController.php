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
            
        public function register(){ //fonction pour s'inscrire

            if(!empty($_POST)){

                $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // on filtre les données récupérer par le formulaire
                $password = filter_input(INPUT_POST, 'password', FILTER_VALIDATE_REGEXP, array(
                    "options" => array("regexp" => '/[A-Za-z0-9]{4,32}/')));
                // ici on filtre les données en utilisant une regex (expliquer plus loin)
                $confimrPassword = filter_input(INPUT_POST, 'confirmPassword', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                // toujours de la filtration pour le champ confirmation mdp
                $mail = filter_input(INPUT_POST, 'mail', FILTER_SANITIZE_FULL_SPECIAL_CHARS, FILTER_VALIDATE_EMAIL);
                // et enfin on filtre l'email entré dans le formulaire

                if($nickname && $password && $mail){ // si les infos ont été confirmer correctement

                    if(($password == $confimrPassword) and strlen($password) >= 4){
                    // cette condition nous dit que si les données saisie dans le champ password sont identique au champ confirm 
                    // et que la longueur correspont alors

                        $manager = new UserManager();
                        $user = $manager->findOneByNickname($nickname);

                        if(!$user){

                            $hash = password_hash($password, PASSWORD_DEFAULT);
                            // ici on utilise une fonction pour "hasher" le mot de passe

                            if($manager->add([
                                "nickname" => $nickname,
                                "mail" => $mail, 
                                "password" => $hash]))
                                {
                                    header('Location:index.php?ctrl=home');
                                }
                                return [
                                "view" => VIEW_DIR."security/login.php", 
                                ]; 
                            }
                        }
                    }else{
                        echo "Erreur : tous les champs sont requis.";
                    }
                }else {
                    echo "Le formulaire n'a pas été soumis.";
                }
        }

        public function loginForm(){

            return [
                "view" => VIEW_DIR."security/login.php", 
                "data" => null,
            ]; 
        }

        public function login(){ // fonction pour se connecter à la session

            if(!empty($_POST)){

                // on filtre les données saisies dans les formulaires
                $nickname = filter_input(INPUT_POST, 'nickname', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $password = filter_input(INPUT_POST, 'password', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                

                if($nickname && $password){
                    
                    $manager= new UserManager();
                    $user = $manager ->findOneByNickname($nickname);
    
                    if ($user){
    
                        if(password_verify($password, $user->getPassword())){
    
                            SESSION::setUser($user); 
                            
                            SESSION::addFlash("success", "connected"); 
                            $this->redirectTo("home", "home");                            
                                
                        }else {
    
                            SESSION::addFlash("success", "username or password incorrect"); 
                                
                            return [
                                "view" => VIEW_DIR . "security/login.php",
                                "data" => null,
                            ];
                        }
    
                    }
                }
            }
        }

        public function logout(){

            session_destroy();
            // unset($_SESSION['user']);
            
            $this->redirectTo("view", "index");
        }
    }