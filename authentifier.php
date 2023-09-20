<?php
session_start();
include('config/connexion.php');
if(isset($_SESSION['user'])){
    header('Location: espaceprivee.php');
    exit;
}
if (isset($_POST['login'])) {
    if (empty($_POST['email']) || empty($_POST['password'])) {
        echo "<div class='alert alert-danger alert-dismissible fade show auto-close-alert' role='alert'>
    <strong>les données d'authentification sont obligatoires!!!</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
        exit;
    } else {
        $email = trim($_POST['email']);
        $password = trim($_POST['password']);
        $query = $db->prepare("select * from compteadministrateur where loginAdmin=? AND motPasse=?");
        $query->execute([$email, $password]);
        $con = $query->fetch(PDO::FETCH_BOTH);
        if ($con > 0) {
            $nom = $con['nom'];
            $prenom=$con['prenom'];
            $_SESSION["user"] = $nom.' '.$prenom;
            header('Location: espaceprivee.php');
            exit;
        } else {
            echo "<div class='alert alert-danger alert-dismissible fade show auto-close-alert' role='alert'>
  <strong>les données d'authentification sont incorrects!!!</strong>
  <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta http-equiv="x-ua-compatible" content="ie=edge" />
    <title>Authentifier</title>
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <!-- MDB icon -->
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.2/css/all.css" />
    <!-- Google Fonts Roboto -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700;900&display=swap" />
    <!-- MDB -->
    <link rel="stylesheet" href="css/bootstrap-login-form.min.css" />
    <script src="./js/scripts.js"></script>

</head>

<body>
    <!-- Start your project here-->

    <style>
        .divider:after,
        .divider:before {
            content: "";
            flex: 1;
            height: 1px;
            background: #eee;
        }

        .h-custom {
            height: calc(100% - 73px);
        }

        @media (max-width: 450px) {
            .h-custom {
                height: 100%;
            }
        }
    </style>
    <section class="vh-100">
        <div class="container-fluid h-custom">
            <div class="row d-flex justify-content-center align-items-center h-100">
                <div class="col-md-9 col-lg-6 col-xl-5">
                    <img src="img/draw2.webp" class="img-fluid" alt="Sample image">
                </div>
                <div class="col-md-8 col-lg-6 col-xl-4 offset-xl-1">
                    <form method="post">
                        <div class="d-flex flex-row align-items-center justify-content-center justify-content-lg-start">
                            <p class="lead fw-normal mb-0 me-3">Se connecter avec</p>
                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-facebook-f"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-twitter"></i>
                            </button>

                            <button type="button" class="btn btn-primary btn-floating mx-1">
                                <i class="fab fa-linkedin-in"></i>
                            </button>
                        </div>

                        <div class="divider d-flex align-items-center my-4">
                            <p class="text-center fw-bold mx-3 mb-0">Ou</p>
                        </div>


                        <div class="form-outline mb-4">
                            <input type="text" id="form3Example3" name="email" class="form-control form-control-lg" placeholder="Entrez une adresse mail valide" />
                            <label class="form-label" for="form3Example3">adresse e-mail</label>
                        </div>

                        <div class="form-outline mb-3">
                            <input type="password" id="form3Example4" name="password" class="form-control form-control-lg" placeholder="Entrer le mot de passe" />
                            <label class="form-label" for="form3Example4">Mot de passe</label>
                        </div>



                        <div class="text-center text-lg-start mt-4 pt-2">
                            <button type="submit" class="btn btn-primary btn-lg" name="login" style="padding-left: 2.5rem; padding-right: 2.5rem;">Se connecter</button>
                            <p class="small fw-bold mt-2 pt-1 mb-0">Vous n'avez pas de compte ? <a href="#!" class="link-danger">Registre</a></p>
                        </div>

                    </form>
                </div>
            </div>
        </div>
        <div class="d-flex flex-column flex-md-row text-center text-md-start justify-content-between py-4 px-4 px-xl-5 bg-primary">
            <div class="text-white mb-3 mb-md-0">
                Copyright © 2023. Tous droits réservés.
            </div>
            <div>
                <a href="https://web.facebook.com/taner.olmez.160" class="text-white me-4">
                    <i class="fab fa-facebook-f"></i>
                </a>
                <a href="https://www.instagram.com/anas_errakibi/" class="text-white me-4">
                    <i class="fab fa-instagram"></i>
                </a>
                <a href="mailto:errakibianas8@gmail.com" class="text-white me-4">
                    <i class="fab fa-google"></i>
                </a>
                <a href="https://www.linkedin.com/in/anas-er-rakibi/" class="text-white">
                    <i class="fab fa-linkedin-in"></i>
                </a>
            </div>
        </div>
    </section>
    <!-- MDB -->
    <script type="text/javascript" src="js/mdb.min.js"></script>
    <!-- Custom scripts -->
    <script type="text/javascript"></script>
</body>

</html>