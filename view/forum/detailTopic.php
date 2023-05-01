<?php

$posts = $result["data"]['posts'];
// $topics = $result["data"]['topics'];

?>

<h1 style="text-align: center; color: white; margin-bottom: 30px">Listes des posts</h1>

<button class="btn btn-dark" style="display: flex;justify-content: center; margin: auto; margin-bottom: 30px;"><a style="color: white;" href="index.php?action=addPost">New Post</a></button>

<?php foreach($posts as $post){
// var_dump($posts);
    ?>


<div class="container" style="display: flex;flex-wrap: wrap; margin: 20px;">
    <div class="card">
    <div class="card-header">
        Message
    </div>
        <div class="card-body">
            <blockquote class="blockquote mb-0">
            <p><?=$post->getText()?></p>
            <footer class="blockquote-footer"><?=$post->getdatecreate()?><cite title="Source Title"><br><?=$post->getUser()->getNickname()?></cite>
            </footer>
            </blockquote>
        </div>
    </div>
</div>

<?php
}
?>