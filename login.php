<?php
require ('inc/login.inc.php');

require_once ('inc/header.php');
?>

    <section id="background3">

<h1 class="login_title">Qui êtes-vous ?</h1>
<div class="barre"></div>

<div class="login">
    <form action="#" method="post">
        <div class="login">
            <label for="mail"></label>
            <input type="email" name="mail" id="mail_log" placeholder="Votre mail">
            <?php spanErr($errors, 'login'); ?>
        </div>
        <div class="password">
            <label for="password"></label>
            <input type="password" name="password" id="password_log" placeholder="Votre mot de passe">
            <?php spanErr($errors, 'password'); ?>
            <div class="forgot">
            <a id="forgot_link" href="forgot_password.php">Mot de passe oublié ?</a>
            </div>
        </div>
        <input id="submit_log" type="submit" name="submitted" value="Login">
    </form>

</div>

    </section>

<?php require_once ('inc/footer.php');
?>