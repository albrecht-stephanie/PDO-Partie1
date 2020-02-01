<!DOCTYPE html>
<html lang="fr" dir="ltr">
<head>
  <meta charset="utf-8">
  <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <title>Exercice 7</title>
</head>
<body>
<div class="container">
    <div class="row">
        <div class="card col-5 offset-3 bg-light shadow ">
            <div class="card-body text-center ">
                <h1>Tous nos clients</h1>
    <?php
    function connectDb() {
        require_once 'params.php';

        $dsn = 'mysql:dbname=' . DB . ';host=' . HOST;

        try {
            $db = new PDO($dsn, USER, PASSWD);
            return $db;
        } catch (Exception $ex) {
            die('La connexion à la bdd a échoué !');
        }
    }
    $db = connectDb();
    $db->exec("SET CHARACTER SET utf8");
    $query = 'SELECT `lastName`, `firstName`, DATE_FORMAT(`birthDate`, \'%d/%m/%Y\') `birthDate`, `card`, `cardNumber` FROM `clients`';
    $usersQueryStat = $db->query($query);
    $usersList = $usersQueryStat->fetchAll(PDO::FETCH_ASSOC);
    foreach ($usersList AS $user){?>
        <p><?= 'Nom : ' .$user['lastName']. '<br>Prénom : ' .$user['firstName']. '<br>Date de Naissance : ' .$user['birthDate']?></p> 
        <?php if ($user['card'] === '1'){?>
            <p>Carte de fidélité : OUI<br>Numéro de carte : <?= $user['cardNumber']?></p>
        <?php } 
        else{?>
            <p>Carte de fidélité : NON</p>
        <?php }
    }
    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
