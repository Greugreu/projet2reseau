<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>

    <meta charset="utf-8">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,300i,400,400i,700,700i&display=swap" rel="stylesheet">
    <title>DCRYPT</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-modal/0.9.1/jquery.modal.min.css" />
    <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>

<div class="wrap">
    <header id="header">
        <nav id="nav" class="nav">
            <div class="logo">
                <a href="index.php"><img src="assets/img/logo.png" alt=""></a>
            </div>
            <ul>
                <li><a href="#">Redirection</a></li>
                <li><a href="#">Redirection</a></li>
                <li><a href="#">Redirection</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="trame.php">Lecture trame</a></li>
            </ul>
            <div class="connected">
                <?php if (empty($_SESSION)) { ?>
                <a class="connect" id="manual-ajax" href="login.php">Connexion</a>
                <?php } else { ?>
                <a class="connect" id="manual-ajax" href="deconnexion.php">Deconnexion</a>
                <?php }?>
                <nav role='navigation'>
                    <div id="menuToggle">
                        <input type="checkbox"/>
                        <span></span>
                        <span></span>
                        <span></span>
                        <ul id="menu">
                            <a href="#">
                                <li>Home</li>
                            </a>
                            <a href="#">
                                <li>About</li>
                            </a>
                            <a href="#">
                                <li>Info</li>
                            </a>
                            <a href="contact.php">
                                <li>Contact</li>
                            </a>
                        </ul>
                    </div>
                </nav>
            </div>
        </nav>
    <div class="clear"></div>
</header>
</div>
