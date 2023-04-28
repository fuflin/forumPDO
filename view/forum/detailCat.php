<?php

$topics = $result["data"]['topics'];
// $cats = $result["data"]['cats'];


?>

<h1 style="text-align: center; color: white; margin-bottom: 30px">Listes des topics</h1>
  
<div class="" style="display: flex;flex-wrap: wrap;">
    <?php foreach($topics as $topic){
        $topicId= $topic->getId();

// var_dump($topic);
// var_dump($topicId);
?>

  <div class="col-sm-5" >
    <div class="card">
      <div class="card-body" style="background-image: url('https://i.pinimg.com/originals/c9/6d/09/c96d09dd9e2ac87f10301cb40f94e8d3.jpg');">
        <h3 class="card-title" style = "text-align: center; color: white;"><?=$topic->getTitle()?></h3>
        <p style = "text-align: center; color: white;"><?=$topic->getCreationdate()." ".$topic->getUser()->getNickname()?></p>
        <a href="index.php?ctrl=forum&action=viewPostFromTopic&id=<?=$topic->getId()?>" class="btn btn-primary" style="display: flex;justify-content: center; margin: 0 20px;">Aller vers les posts</a>
      </div>
    </div>
  </div>
</div>

<?php
}
?>