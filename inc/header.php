<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, user-scalable=no">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>DCRYPT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>

<div class="wrap">
    <header id="header">
        <?php if (is_logged()) { ?>
        <nav id="nav" class="nav">
            <div class="logo">
                <a href="index.php"><img src="assets/img/logo.png" alt=""></a>
            </div>
            <ul>
                <li><a href="index.php">Accueil</a></li>
                <li><a href="trame.php">Lecture trame</a></li>
                <li><a href="contact.php">Contact</a></li>
                <?php if (is_admin()) { ?>
                    <li><a href="back/admin.php">Administration</a></li>
                <?php } else { ?>
                    <li><a href="travail.php">Objectifs</a></li>
                <?php } ?>
            </ul>
            <div class="connected">
                <a class="connect" href="deconnexion.php">Deconnexion</a>
                <?php } else { ?>
                <nav id="nav" class="nav">
                    <div class="logo">
                        <a href="index.php"><img src="assets/img/logo.png" alt=""></a>
                    </div>
                    <ul>
                        <li><a href="index.php">Accueil</a></li>
                        <li><a href="travail.php">objectifs</a></li>
                        <li><a href="about.php">About us</a></li>
                        <li><a href="contact.php">Contact</a></li>

                    </ul>



                    <div class="unconnected">
                        <a class="inscr" href="signup.php">Inscription</a>
                        <a class="connect" href="login.php">Connexion</a>
                        <?php } ?>
                    </div>


                        <div class="mobile-container">
                            <div class="topnav">
                                <div id="myLinks">
                                    <?php if (is_logged()) {?>
                                    <a href="index.php">Accueil</a>
                                    <a href="about.php">About us</a>
                                    <a href="contact.php">Contact</a>
                                    <a href="travail.php">Objectifs</a>
                                    <?php if (is_admin()) { ?>
                                    <a href="back/admin.php">Administration</a>
                                    <?php } ?>
                                    <a href="login.php">Deconnexion</a>
                                    <?php } else { ?>
                                    <a href="index.php">Accueil</a>
                                    <a href="about.php">About us</a>
                                    <a href="contact.php">Contact</a>
                                    <a href="travail.php">Objectifs</a>
                                    <a href="signup.php">Inscription</a>
                                    <a href="login.php">Connexion</a>
                                    <?php } ?>
                                </div>
                                <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                                <i class="fa fa-bars"></i>
                                </a>
                            </div>
                        </div>

                </nav>



                <div class="clear"></div>
    </header>

