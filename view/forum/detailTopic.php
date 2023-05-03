<?php
$topic = $result["data"]["topic"];
$posts = $result["data"]['posts'];

?>

<h1 style="text-align: center; color: black; margin-bottom: 30px">Sujet : <?=$topic->getTitle()?></h1>

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
        <button class="btn btn-dark" style="display: flex;justify-content: center; margin: auto; margin-bottom: 30px;"><a style="color: white;" href="index.php?action=addPost">Delete</a></button>
    </div>
</div>

<?php
}
if(App\Session::getUser()){
?>
    
<form action="index.php?ctrl=forum&action=addPost&id=<?=$topic->getId()?>" method="post" enctype="multipart/form-data">
  
    <textarea name="text" placeholder="New post" required></textarea>
    
    <button type="submit">ADD</button>
    
</form>
    
<?php
}
?>
