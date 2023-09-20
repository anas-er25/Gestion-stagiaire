<?php
session_start();
if (!isset($_SESSION['user'])) {
    header('Location: authentifier.php');
}
include('config/connexion.php');
if (isset($_POST['update'])) {
    $id = $_GET['idStagiaire'];
    $photo = $_FILES['photo']['name'];
    $fileTmpNmae = $_FILES['photo']['tmp_name'];
    $destination = 'img/stagiaires/' . $photo;
    move_uploaded_file($fileTmpNmae, $destination);

    $name = $_POST['name'];
    $lastname = $_POST['lastname'];
    $datenaissance = $_POST['datenaissance'];
    $filiere = $_POST['filiere'];

    $stmt = $db->prepare('UPDATE stagiaire SET nom=?, prenom=?, dateNaissance=?, photoProfil=?, idFiliere=? WHERE idStagiaire=?');
    $exec = $stmt->execute([$name, $lastname, $datenaissance, $destination, $filiere, $id]);
    if ($exec) {
        echo "<div class='alert alert-success alert-dismissible fade show auto-close-alert' role='alert'>
    <strong>Modifier avec succee</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
        header('Location:./espaceprivee.php');
    } else {
        echo "<div class='alert alert-danger alert-dismissible fade show auto-close-alert' role='alert'>
    <strong>Une erreur est servenue!!!</strong>
    <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
</div>";
        exit;
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modifier stagiaire</title>
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

</head>

<body>
    <nav class="navbar bg-body-tertiary">
        <div class="container-fluid">

            <a class="navbar-brand" href="espaceprivee.php">
                <img src="img/logo.png" alt="Bootstrap" width="30" height="24"> Retour
            </a>
            <a class="btn btn-outline-danger" href="./config/logout.php" name="logout">Se deconnecter</a>
        </div>
    </nav>

    <div class="container">
        <?php
        if(isset($_GET['idStagiaire'])){
            $id= $_GET['idStagiaire'];
            $stgmod = 'SELECT * FROM stagiaire WHERE idStagiaire=?';
            $requete = $db->prepare($stgmod);
            $requete->execute([$id]);
            $stagiaires = $requete->fetchAll(PDO::FETCH_ASSOC);
            foreach ($stagiaires as $row) {        
        ?>
        <form class="was-validated" method="post" enctype="multipart/form-data">
            <div class="mb-3">
                <label for="validationNom" class="form-label">Nom</label>
                <input type="text" value="<?= $row['nom']?>" class="form-control" name="name" id="validation" placeholder="Saisir le nom" required></input>

            </div>
            <div class="mb-3">
                <label for="validationPrenom" class="form-label">Prenom</label>
                <input type="text" value="<?= $row['prenom']?>" class="form-control" name="lastname" id="validation" placeholder="Saisir le prenom" required></input>

            </div>
            <div class="mb-3">
                <label for="validationDateNaissance" class="form-label">Date de Naissance</label>
                <input type="date" value="<?= $row['dateNaissance']?>" class="form-control" name="datenaissance" id="validation" placeholder="Saisir la date de naissance" required></input>

            </div>
            <div class="mb-3">
                <label for="validationPhotoProfil" class="form-label">Photo Profil</label>
                <input type="file" class="form-control" name="photo" required>
            </div>
            <div class="mb-3">
                <label for="validationFiliere" class="form-label">Filiere</label>

                <select name="filiere" class="form-select" required aria-label="select">
                    <option value="">Selectionner la filiere</option>
                    <?php
                    $sql = "SELECT idFiliere, intitule FROM filiere";
                    $stmt = $db->prepare($sql);
                    $stmt->execute();

                    if ($stmt->rowCount() > 0) {
                        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
                            echo "<option value='" . $row["idFiliere"] . "'>" . $row["intitule"] . "</option>";
                        }
                    }
                    ?>
                </select>

            </div>
            <div class="mb-3">
                <button class="btn btn-success" type="submit" name="update">Modifier</button>
            </div>
        </form>
        <?php
        }
    }
        ?>
    </div>
    <script type='text/javascript'></script>
</body>

</html>