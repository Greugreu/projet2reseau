<?php
session_start();
include 'function/debug.php';
require ("function/functions.php");



require_once ("inc/header.php"); ?>

<section id="section">

    <div class="wrap2">

        <h2 id="h2"><img src="assets/img/logo_main.png" alt=""></h2>
        <div class="boxleft">
            <p><a class="btn btnl" href="trame.php">Lisez votre trame</a></p>
        </div>
        <?php if (is_logged()) { ?>
        <div class="boxright">
            <p><a class="btn btnr" href="travail.php">Que permettons-nous ?</a></p>
        </div>
        <?php } else { ?>
        <div class="boxright">
        <p><a class="btn btnr" href="signup.php">Inscrivez-vous</a></p>
        </div>
        <?php } ?>
        <div class="clear"></div>
    </div>

</section>

<?php require_once ("inc/footer.php");






