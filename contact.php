<?php

include('inc/function.php');
include('inc/pdo.php');



$errors = array();
$success = false;

if (!empty($_POST['submitted'])) {
    $email = clean($_POST['email']);
    $object = clean($_POST['objet']);
    $text = clean($_POST['message']);

    $errors = textValid($errors, $text, 'message', 5, 2000);
    $errors = emailValid($errors, $email, 'email');

    if(count($errors) == 0) {
        $sql = "INSERT INTO contact VALUES (NULL,:email,:message, NOW())";
        $query = $pdo->prepare($sql);
        $query->bindValue(':email',   $email,PDO::PARAM_STR);
        $query->bindValue('':)
        $query->bindValue(':message', $text,PDO::PARAM_STR);
        $query->execute();
        $success = true;
    }
}


require_once ("inc/header.php");?>

<div class="wrap3">

    <form action="" method="post">

        <input type="text" id="email" name="email" placeholder="Votre email" value="<?php if (!empty($_POST['email'])) {echo $_POST['email'];} ?>">
        <p class="error error1"> <?php if(!empty($errors['email'])) {echo $errors['email'];} ?></p>
        
        <input type="text" id="object" name="object" value="<?php if (!empty($_POST['object'])) {echo $_POST['object'];} ?>">
        <p class="error error2"><?php if(!empty($_POST['object'])) {echo $errors['object'];}?></p>


        <textarea id="message" placeholder="Votre message" name="message"><?php if (!empty($_POST['message'])) {echo $_POST['message'];} ?></textarea>
        <p class="error error3"><?php if(!empty($errors['message'])) {echo $errors['message'];} ?></p>

        <input type="submit" name="submitted" value="Envoyer">

    </form>

</div>



<?php require_once("inc/footer.php");?>
