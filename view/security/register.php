
<h1>form register</h1>

<form action="index.php?ctrl=security&action=register" method="post" enctype="multipart/form-data">
    
    <input type="text" name="nickname" placeholder="nickname" required>

    <input type="email" name="mail" placeholder="email" required>

    <input type="password" name="password" placeholder="password" required>

    <input type="password" name="confirmPassword" placeholder="Confirm password" required>

    <button type="submit">Register</button>

</form>