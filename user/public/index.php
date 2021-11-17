<?php
    session_start();
    include '../vendor/autoload.php';

    use App\Connection;

    $db = App\Connection::getConnect();

    $page = scandir('../include/pages/');

    if(isset($_SESSION['iduser']) && !empty($_SESSION['iduser']))
{
    $iduser = $_SESSION['iduser'];
    $userinfos = \App\Personne::getUserInfo($db, $iduser);
    // if(!empty($_GET['go'])) {
    //     $page = $_GET['go'];
    // }
    // else
    // {
    //     $page = 'home';
    // }
    if (isset($_GET['go']) && !empty($_GET['go']))
    {
        if (in_array($_GET['go'] . '.php', $page))
        {
            $page = $_GET['go'];
        }
        else
        {
            $page = '404';
        }
    }
    else
    {
        $page = 'home';
    }
}
    else if (isset($_GET['go']) && !empty($_GET['go']))
    {
        if (in_array($_GET['go'] . '.php', $page))
        {
            $page = $_GET['go'];
        }
        else
        {
            $page = '404';
        }
    }
    else
    {
        $page = 'home';
    }

    //Search
    if (isset($_POST['search'])) {
        if (!empty($_POST['q'])) {
            header('Location:index.php?go=services&q=' . $_POST['q']);
        }
    }
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <link rel="shortcut icon" href="img/logo1.png" type="image/x-icon">
        <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700%7CRoboto%7CJosefin+Sans:100,300,400,500"
         rel="stylesheet" type="text/css">
        <link rel="stylesheet" href="css/font-awesome.min.css">
        <link rel="stylesheet" href="css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/linearicons-v1.0.0/icon-font.min.css">
        <!-- <link rel="stylesheet" href="css/aos.css"> -->
        <link rel="stylesheet" href="css/style.css">
        <script src="js/jquery.js"></script>
        <script src="js/jqueryslimscroll.js"></script>
        <script src="js/bootstrap.min.js"></script>
        <script src="js/script.js"></script>
        <title>Reservation</title>
    </head>
    <body>
        <nav class=" border-bottom navbar navbar-expand-lg navbar-dark bg-light fixed-top" style="background-color: #2c3e50 !important; color: #fff">
            <div class="container-fluid">
                <a class="navbar-brand" href="index.php">RESERVATION
                    <!----<img src="img/logo1.png" alt="logo" width='40' />--->
                </a>

                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <!-- justify-content-end -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <div class="col-md-4 col-sm-8 col-xm-hiden ml-auto">
                        <form action="" method="POST" class="d-flex">
                            <input class="form-control m-auto text-center" id="q" name="q" type="search" placeholder="De quoi as-tu besoin ?" aria-label="Search">
                            <button class="btn btn-outline-success" type="submit" id="btn_search" name="search"><i class="zmdi zmdi-search"></i></button>
                        </form>
                    </div>
                    <ul class="navbar-nav ml-auto">
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php">Accueil <span class="sr-only">(current)</span></a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?go=blog">Reservation </a>
                        </li>
                        <?php if(isset($_SESSION['iduser']) && !empty($_SESSION['iduser'])): ?>
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php?go=chat">En cours <span class="sr-only">(current)</span></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php?go=history">Historique</a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php?go=dashboard"><img src="upload/<?= $userinfos->photo; ?>" class="rounded-circle img-thumbnail" width="30px" height="30px"></a>
                            </li>
                            <li class="nav-item active">
                                <a class="nav-link" href="index.php?go=logout">Déconnexion</a>
                            </li>
                        <?php endif; if(empty($_SESSION['iduser'])): ?>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?go=signin">Se connecter</a>
                        </li>
                        <li class="nav-item active">
                            <a class="nav-link" href="index.php?go=signup">Créer un compte</a>
                        </li>
                        <?php endif;?>
                    </ul>
                </div>
            </div>
        </nav>

        <?php 
            if (isset($_SESSION['idvend']) && !empty($_SESSION['idvend'])) : ?>
                <div class="container-fluid page">
            <div class="row">
                <div class="col-md-2">
                    <div class="container text-center">
                        <div class="col-md-2 sidebar">
                            <P style="font-size: 16px; font-weight: bold">Menu </P>
                            <hr>
                            <div class="main-categ scrollable-menu" role="menu">
                                <p style="margin: 5px; text-align: left">
                                    <a href="index.php?go=service" style="color: #0c5460; text-decoration: none">Service</a>
                                </p>
                                <p style="margin: 5px; text-align: left">
                                    <a href="index.php?go=service" style="color: #0c5460; text-decoration: none">Demande </a>
                                </p>
                                <p style="margin: 5px; text-align: left">
                                    <a href="index.php?go=seller" style="color: #0c5460; text-decoration: none">Créer un blog</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="container-fluid">
                    <?php
                        if(isset($page ))
                        {
                            include ('../include/pages/'.$page.'.php');
                        }
                    ?>
                </div>
        </div>
        <?php    
            endif;
            if (empty($_SESSION['idvend']) || empty($_SESSION['iduser'])) :
                ?>
                <div class="container-fluid">
                        <?php
                            if(isset($page ))
                            {
                                include ('../include/pages/'.$page.'.php');
                            }
                        ?>
                    </div>
                <?php
            endif;
        ?>
    </body>
</html>


