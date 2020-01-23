<?php

include 'inc/forgot_password.inc.php';
include 'inc/header.php'; ?>
<section id="background_ultime">
    <div class="wrap10">
    <h4 class="forgot_p">Mot de passe oublié</h4>
    <div class="barre"></div>
    <form id="form_forgot" action="" method="post">
        <input type="email" name="mail" id="mail" placeholder="Email" value="<?php if (!empty($_POST['mail'])) { echo
        $_POST['mail'];}
        ?>">
        <p class="error"><?php if (!empty($errors['mail'])) {echo $errors['mail'];} ?></p>

        <input id="submit_forgot" type="submit" name="submitted" value="Modifier">
    </form>
    </div>
</section>
<?php include 'inc/footer.php';
