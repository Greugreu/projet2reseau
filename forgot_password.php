<?php

include 'inc/forgot_password.inc.php';
include 'inc/header.php'; ?>

    <h4 class="forgot_p">Mot de passe oublié</h4>

    <form action="" method="post">
        <label for="mail">Votre email</label>
        <input type="email" name="mail" id="mail" placeholder="email" value="<?php if (!empty($_POST['mail'])) { echo
        $_POST['mail'];}
        ?>">
        <p class="error"><?php if (!empty($errors['mail'])) {echo $errors['mail'];} ?></p>

        <input type="submit" name="submitted" value="Modifier mote de passe">
    </form>

<?php include 'inc/footer.php';
