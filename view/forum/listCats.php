<?php

$cats = $result["data"]['cats'];

?>
<h1 style="text-align: center; color: white; margin-bottom: 30px">Listes des catégories</h1>


<div class="container" style="display: flex;flex-wrap: wrap;">

<?php foreach($cats as $cat){ ?>

  <div class="card" style="background-image: url('https://i.pinimg.com/originals/c9/6d/09/c96d09dd9e2ac87f10301cb40f94e8d3.jpg'); width: 29%; margin: 25px; ">
    <img src="/public/img<?=$cat->getImg()?>" class="card-img-top">
    <div class="card-body">
      <h5 class="card-title" style ="text-align: center; color: white;">catégorie</h5>
      <h3 class="card-text" style="text-align: center; "><a style="color: white;" href="index.php?ctrl=forum&action=viewCatByTopic&id=<?=$cat->getId()?>"><?=$cat->getName()?></a><br></h3>
    </div>
  </div>

<?php
}
?>