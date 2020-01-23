<?php
require_once ('function/functions.php');
include 'inc/header.php';
include 'function/debug.php';
include 'inc/pdo.php';
include 'inc/signup.inc.php';

?>
<section id="background2">

<h1 class="signup_title">Inscrivez- vous & lisez votre trame !</h1>
<div class="barre"></div>
<div id="form-inscription" class="form">
    <form action="#" class="signup" method="post">
        <div class="surname">
            <label for="surname"></label>
            <input type="text" name="surname" id="surname" placeholder="Votre nom*" value="<?php if (!empty
            ($_POST['surname'])){echo $_POST['surname'];} ?>">
            <?php spanErr($errors, 'surname'); ?>
        </div>
        <div class="name">
            <label for="name"></label>
            <input type="text" name="name" id="name" placeholder="Votre prenom*" value="<?php if (!empty
            ($_POST['name'])){echo $_POST['name'];} ?>">
            <?php spanErr($errors, 'name'); ?>
        </div>
        <div class="mail">
            <label for="mail"></label>
            <input type="email" name="mail" id="mail" placeholder="Votre mail*" <?php if (!empty
            ($_POST['mail'])){echo $_POST['mail'];} ?>>
            <?php spanErr($errors, 'mail'); ?>
        </div>
        <div class="password">
            <label for="password"></label>
            <input type="password" name="password" id="password" placeholder="Votre password*">
            <?php spanErr($errors, 'password'); ?>
        </div>
        <div class="cfrmPassword">
            <label for="cfrmPassword"></label>
            <input type="password" name="cfrmPassword" id="cfrmPassword" placeholder="Confirmez votre mdp*">
            <?php spanErr($errors, 'cfrmPassword'); ?>
        </div>
        <input type="checkbox" name="checklog" id="checklog" value="">
        <p class="accept">J'accepte les <a class="checklink" href="cgu.php">CGU</a> ainsi que les <br><a
        class="checklink" href="mentions-legales.php">mentions légales</a>*</p>
        <p class="need">* Champs obligatoires</p>
        <?php spanErr($errors, 'checklogErr'); ?>
        <input id="submit_signup" type="submit" name="submitted" value="Envoyer">
    </form>
</div>
</section>

<?php require_once "inc/footer.php";


