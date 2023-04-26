<?php

$users = $result["data"]['users'];
    
?>

<h1>liste users</h1>

<?php
foreach($users as $user ){
// var_dump($user);
    ?>
    <p><?=$user->getNickname()." ".$user->getMail()." ".$user->getdateregis()?></p>
    <?php
}

