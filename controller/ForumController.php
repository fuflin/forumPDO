<?php

    namespace Controller;

    use App\Session;
    use App\AbstractController;
    use App\ControllerInterface;
    use Model\Managers\TopicManager;
    use Model\Managers\PostManager;
    use Model\Managers\UserManager;
    use Model\Managers\CategoryManager;
    
    
    class ForumController extends AbstractController implements ControllerInterface{

        public function index(){
          
           $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/listTopics.php",
                "data" => [
                    "topics" => $topicManager->findAll()
                ]
            ];
        
        }

        public function viewAllPost(){

            $postManager = new PostManager();

            return [
                "view" => VIEW_DIR."forum/listPosts.php",
                "data" => [
                    "posts" => $postManager->listPostFromUser()
                ]
            ];
        }

        public function viewAllUser(){

            $userManager = new UserManager();

            return [
                "view" => VIEW_DIR."forum/listUsers.php",
                "data" => [
                    "users" => $userManager->listUser()
                ]
            ];
        }

        public function viewCat(){

            $catManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/listCats.php",
                "data" => [
                    "cats" => $catManager->listCats()
                ]
            ];
        }

        public function viewCatByTopic($id){

            $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/detailCat.php",
                "data" => [
                    "topics" => $topicManager->findTopicByCat($id)
                ]
            ];
        }

        public function viewPostFromTopic($id){

            $postManager = new PostManager();
            $topic = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => [
                    "topic" => $topic->findOneById($id),
                    "posts" => $postManager->findPostByTopicId($id)
                ]
            ];
        }

        public function viewAddCat(){

            return [
                "view" => VIEW_DIR."forum/addCat.php"
            ];
        }

        public function addCat(){

            if(!empty($_POST)){

                $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $img = filter_input(INPUT_POST, 'img', FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                if($name && $img){

                    $category = new CategoryManager();
                    $cat = $category->findOneByName($name);

                    if(!$cat){

                        $category->add([
                            "name" => $name, 
                            "img" => $img
                        ]);
                    }
                }

            } 
            return [
                "view" => VIEW_DIR."/forum/addCat.php"
            ];
        }

        public function addTopic($id){

            if (!empty($_POST)){

                $title = filter_input(INPUT_POST,"title", FILTER_SANITIZE_FULL_SPECIAL_CHARS);
                $text = filter_input(INPUT_POST,"text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $cat_id = $_GET['id'];
                $user_id = Session::getUser()->getId();

                if($title){

                    $topic = new TopicManager();
                    $post = new PostManager();

                        $id = $topic->add([
                            "title" => $title, 
                            "category_id" => $cat_id,
                            "user_id" => $user_id
                        ]);

                        $post->add([
                            "text" => $text,
                            "user_id" => $user_id,
                            "topic_id" =>$id
                        ]);

                     
                }
            }
            $this->redirectTo("forum", "viewPostFromTopic", $id);
        }

        public function addPost($id){

            if (!empty($_POST)){

                $text = filter_input(INPUT_POST,"text", FILTER_SANITIZE_FULL_SPECIAL_CHARS);

                $id = $_GET['id'];
                $user_id = Session::getUser()->getId();

                if($text){

                    $addPost = new PostManager();
                    $topic = new TopicManager();

                        $addPost->add([
                            "text" => $text, 
                            "topic_id" => $id,
                            "user_id" => $user_id
                        ]);
                     
                }
            } 
            $this->redirectTo("forum", "viewPostFromTopic", $id);
        }

        
        
    }
