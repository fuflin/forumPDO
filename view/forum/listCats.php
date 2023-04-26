<?php

$cats = $result["data"]['cats'];
    
?>

<h1>liste cats</h1>

<?php
foreach($cats as $cat){
// var_dump($cat);
    ?>
    <p><?=$cat->getName()?></p>
    <?php
}

