<?php

$topics = $result["data"]['topics'];
    
?>

<h1>liste topics</h1>

<?php
foreach($topics as $topic ){
// var_dump($topic);
    ?>
    <p><?=$topic->getTitle(), $topic->getCreationdate(), $topic->getUser()->getNickname()?></p>
    <?php
}


  
