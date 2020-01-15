<?php
require ('inc/login.inc.php');
?>

<div class="login">
    <form action="#" method="post">
        <div class="login">
            <label for="mail"></label>
            <input type="email" name="mail" id="mail" placeholder="Votre mail">
            <?php spanErr($errors, 'login'); ?>
        </div>
        <div class="password">
            <label for="password"></label>
            <input type="password" name="password" id="password" placeholder="Votre mot de passe">
            <?php spanErr($errors, 'password'); ?>
        </div>
        <input type="submit" name="submitted" value="Login">
    </form>
    <a href="forgot_password.php">Mot de passe oublié</a>
</div>
