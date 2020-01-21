<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>

    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,700,700i&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <title>DCRYPT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css"/>
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
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
                <li><a href="#">Redirection</a></li>
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
                        <li><a href="signup.php">Inscription</a></li>
                    </ul>
                    <div class="connected">
                        <a class="connect" href="login.php">Connexion</a>
                        <?php } ?>
                        <nav role='navigation'>
                            <div id="menuToggle">
                                <input type="checkbox"/>
                                <span></span>
                                <span></span>
                                <span></span>
                                <ul id="menu">
                                    <li><a href="index.php">Accueil</a></li>
                                    <li><a href="#">Redirection</a></li>
                                    <li><a href="about.php">About us</a></li>
                                    <li><a href="contact.php">Contact</a></li>
                                    <li><a href="signup.php">Inscription</a></li>
                                </ul>
                            </div>
                        </nav>
                    </div>
                </nav>
                <div class="clear"></div>
    </header>
</div>
