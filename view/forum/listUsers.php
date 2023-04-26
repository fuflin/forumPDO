<?php

$users = $result["data"]['topics'];
    
?>

<h1>liste users</h1>

<?php
foreach($users as $user ){
// var_dump($user);
    ?>
    <p><?=$user->getText()." ".$user->getdatecreate()." ".$user->getNickname()?></p>
    <?php
}

