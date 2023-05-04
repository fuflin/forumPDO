<?php 
$post = $result['data']['post'];
?>

<h1 style="text-align: center; color: black; margin-bottom: 30px;">Bienvenue sur la page modify </h1>



<h2 style="text-align: center; color: black; margin-bottom: 30px;">modifier le post</h2>

<form action="index.php?ctrl=forum&action=modifyPost&id=<?= $post->getId() ?>" method="post">
    
    <textarea name="text" placeholder="New post" required><?= $post->getText() ?></textarea>

    <button type="submit" name="submit">Confirm</button>

</form>