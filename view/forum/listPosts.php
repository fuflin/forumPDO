<?php

$posts = $result["data"]['topics'];
    
?>

<h1>liste posts</h1>

<?php
foreach($posts as $post ){
// var_dump($post);
    ?>
    <p><?=$post->getText(). "<br>" .$post->getdatecreate(). " écrit par " .$post->getUser()->getNickname()?></p>
    <?php
}

