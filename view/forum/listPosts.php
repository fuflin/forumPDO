<?php

$posts = $result["data"]['posts'];
    
?>

<h1 style="text-align: center; color: white; margin-bottom: 30px">Listes des posts</h1>



<?php foreach($posts as $post ){
            // var_dump($post);?>
<div class="container" style="display: flex;flex-wrap: wrap; margin: auto;">
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