<?php
$host = "localhost";
$dbname = "gestionstock";
$username = "root"; 
$password = ""; 

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

//formulaire de connexion
// session_start();
// require 'utilisateurs'; // Connexion à la base de données

// if ($_SERVER["REQUEST_METHOD"] == "POST") {
//     $email = $_POST['Tchassem.indira@email.com'];
//     $password_hash($_POST['shola 1234']); // ⚠️ 
        
//     // Vérification des identifiants
//     $query = $conn->prepare("SELECT * FROM utilisateurs WHERE email = Tchassem.indira@email.com AND password = shola1234");
//     $query->execute([$email, $password]);
//     $user = $query->fetch();

//     if ($user) {
//         if ($user['role'] == 'administrateur') {
//             $_SESSION['utilisateurs'] = $utilisateurs['Tchassem.indira@email.com'];
//             $_SESSION['role'] = $utilisateurs['administrateur'];
//             header("Location: admin.php"); // Redirige vers l'interface admin
//             exit();
//         } else {
//             $error = "Accès refusé : Vous n'êtes pas administrateur.";
//         }
//     } else {
//         $error = "Email ou mot de passe incorrect.";
//     }
// }


// if (!isset($_SESSION['utilisateurs']) || $_SESSION['role'] != 'administrateur') {
    // header("Location: admin.php");
    // exit();
// }


session_start();


if (isset($_POST['submit_connexion'])) {
    $email = $_POST['email'];
    $password = $_POST['mot_de_passe'];

    // Vérification si l'utilisateur existe
    $query = $conn->prepare("SELECT * FROM utilisateurs WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch();
    // error_log("Message de debug PHP", $user, "logs.txt");

    if ($user && $password === $user['mot_de_passe']) {
        if($user['active']===0){
            echo "<script>alert('Compte non active contacter un adminstrateur!');</script>";
        }
        else{
        
        // ⚠️ Remplace par password_verify() si tu hashes
        $_SESSION['user'] = $user['email'];
        header("Location: admin.php"); // Redirige vers l'application
        exit();
    }} else {
        echo "<script>alert('Email ou mot de passe incorrect !');</script>";

    }

}

?>
 <!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- <h1>Bienvenue, <?php echo $_SESSION['utilisateurs']; ?> (Administrateur)</h1> 
    <a href="logout.php">Déconnexion</a>-->
    

    <link rel="stylesheet" href="ENREGISTREMENT.CSS">
</head>
<body>
      <section class="image">
        <header class="barenav">
            <nav class="contenair">
                <!-- <div class="logo"><img src="logo/gg.png" alt="" class="logoimage"></div> 
                <ul>
                    <li><a href="badji.html">HOME</a></li>
                    <li class="ENRE"><a href="" >ENREGISTREMENT</a></li>
                    <li><a href="DEPARTEMENT.HTML">DEPARTEMENT</a></li>
                    <li><a href="CONTACT.HTML">CONTACT</a></li>
                </ul> 
                <div class="barerecherche">
                    <table class="elementbarerecherche">
                        <tr>
                            <td><input type="text" class="input"></td>
                            <td><img src="ICONES/search_16dp_0000F5.png" alt="" class="boutonsearch"></td>
                        </tr>-->
                    </table>
                </div>
            </nav>
    </header>
    <div class="body">
         <div class="container">
           <div class="form">
           <center><img src="logosae.png" alt=""></center>
            <H2>SE CONNECTER</H2>
            
            <form method="POST" action="">
            <div class="box">
                <input type="text" id="email" name="email" placeholder="email">
            </div>
            <div class="box">
                <input type="password" id="mot_de_passe" name="mot_de_passe" placeholder="Mot de passe">
            </div>
            
            <div class="box">
            <button type="submit" name="submit_connexion">Connexion</button>
            <a href="inscription.php">Inscription</a>
            </div>
</form>
           </div>
         </div>
    </div>
</section>
    
</body>
</html>