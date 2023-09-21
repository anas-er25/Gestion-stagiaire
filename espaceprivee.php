<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: authentifier.php');
}
include('config/connexion.php');
if (isset($_GET['idStg'])) {
    $stg = $_GET['idStg'];
    $stmt = $db->prepare('DELETE FROM stagiaire WHERE idStagiaire=?');
    $exec = $stmt->execute([$stg]);
    if ($exec) {
        header('Location:./espaceprivee.php');
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show auto-close-alert' role='alert'>
    <strong>Une erreur est servenue!!!</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion stagiaire</title>
    <!-- MDB icon -->
    <link rel="icon" href="img/logo.png" type="image/x-icon" />
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="./js/scripts.js"></script>
    <link rel="stylesheet" href="./css/styletab.css">

    <link href='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/css/bootstrap.min.css' rel='stylesheet'>
    <link href='https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css' rel='stylesheet'>
    <script type='text/javascript' src=''></script>
    <script type='text/javascript' src='https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js'></script>
    <script type='text/javascript' src='https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-alpha1/js/bootstrap.min.js'></script>
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        function suppstgconfirm(idstg) {
            if (confirm("Vous êtes sûr de supprimer le stagiaire?!")) {
                window.location = 'espaceprivee.php?idStg=' + idstg + ';'
            };
        }
    </script>
</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">

            <a class="navbar-brand">
                <img src="img/logo.png" alt="Bootstrap" width="30" height="24"> Espace privé
            </a>
            <a class="btn btn-outline-danger" href="./config/logout.php" name="logout">Se deconnecter</a>
        </div>
    </nav>
    <?php
    $heure = date("H");

    if ($heure - 1 < 18) {
        echo "<div class ='text-center mt-3' ><h3>Bonjour " . $_SESSION['user'] . "</h3></div>";
    } else {
        echo "<div class ='text-center mt-3' ><h3>Bonsoir " . $_SESSION['user'] . "</h3></div>";
    }
    ?>

    <div class="container rounded mt-5 bg-white p-md-5">
        <div class="h2 font-weight-bold">
            <a class="btn btn-success" type="submit" href="InsererStagiaire.php">Ajouter</a>
        </div>
        <div class="table-responsive" data-aos="fade-up">
            <table class="table" >
                <thead>
                    <tr>
                        <th scope="col">Photo Profil</th>
                        <th scope="col">Nom</th>
                        <th scope="col">Prenom</th>
                        <th scope="col">Date de Naissance</th>
                        <th scope="col">Filiere</th>
                        <th scope="col">Modifier</th>
                        <th scope="col">Supprimer</th>
                    </tr>
                </thead>
                <tbody>

                    <?php
                    $sql = 'SELECT * FROM stagiaire';
                    $requete = $db->prepare($sql);
                    $requete->execute();
                    $stagiaires = $requete->fetchAll(PDO::FETCH_ASSOC);
                    $db = null;
                    $tableau = '';
                    foreach ($stagiaires as $stagiaire) {
                        $tableau .= '<tr class="bg-blue">';
                        $tableau .= '<td class="pt-2"><img src="' . $stagiaire['photoProfil'] . '" class="rounded-circle" alt=""></td>';
                        $tableau .= '<td class="pt-3">' . $stagiaire['nom'] . '</td>';
                        $tableau .= '<td class="pt-3">' . $stagiaire['prenom'] . '</td>';
                        $tableau .= '<td class="pt-3 mt-1">' . $stagiaire['dateNaissance'] . '</td>';
                        $tableau .= '<td class="pt-3">' . $stagiaire['idFiliere'] . '</td>';
                        $tableau .= '<td class="pt-3"><a class="fa fa-pencil pl-3" href="ModifierStagiaire.php?idStagiaire=' . $stagiaire['idStagiaire'] . '"></a></td>';
                        $tableau .= '<td class="pt-3"><button type="button" class="fa fa-trash pl-3" onClick="suppstgconfirm(' . $stagiaire['idStagiaire'] . ')" name="idStg" value="' . $stagiaire['idStagiaire'] . '"></button></td>';
                        $tableau .= '</tr>';
                        $tableau .= '<tr id="spacing-row"><td></td></tr>';
                    }
                    echo $tableau;
                    ?>

                </tbody>
            </table>
        </div>
    </div>
    <script type='text/javascript'></script>
    <script>
        AOS.init();
    </script>
</body>

</html>
