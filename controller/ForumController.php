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
                    "topics" => $topicManager->listTopicByUser()
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
            // $catManager = new CategoryManager();

            return [
                "view" => VIEW_DIR."forum/detailCat.php",
                "data" => [
                    "topics" => $topicManager->findTopicByCat($id),
                    // "cats" => $catManager->findCatTopic($id)
                ]
            ];
        }

        public function viewPostFromTopic($id){

            $postManager = new PostManager();
            
            // $topicManager = new TopicManager();

            return [
                "view" => VIEW_DIR."forum/detailTopic.php",
                "data" => [
                    "posts" => $postManager->findPostByTopicId($id),
                    // "topics" => $topicManager->findTopicCat($id)
                ]
            ];
        }

        public function viewaddPost(){

            

        }
    }
