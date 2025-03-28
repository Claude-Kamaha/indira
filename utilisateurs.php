<?php include "sidebar.php"; ?>
<?php
$host = 'localhost';      // Nom d'hôte, souvent 'localhost' ou '127.0.0.1'
$dbname = 'gestionstock';      // Nom de ta base de données
$username = 'root';       // Ton nom d'utilisateur pour la base de données (souvent 'root' pour XAMPP)
$password = '';           // Ton mot de passe pour la base de données (vide par défaut pour XAMPP)

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    echo "Connexion réussie!";
} catch (PDOException $e) {
    echo "Échec de la connexion : " . $e->getMessage();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Users</title>
    <link rel="stylesheet" href="utlisateurs.css 2">
</head>
<body>
     
<div class="main-content">
<h2>Liste des Utilisateurs</h2>
<table>
    <thead>
        <tr>
            <th>ID</th>
            <th>Nom</th>
            <th>Email</th>
            <th>Rôle</th>
            <th>Active</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        <?php
        $stmt = $conn->prepare("SELECT * FROM Utilisateurs");
        $stmt->execute();
        $utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);

        foreach ($utilisateurs as $utilisateur) {
            echo "<tr>";
            echo "<td>" . $utilisateur['id'] . "</td>";
            echo "<td>" . $utilisateur['nom'] . "</td>";
            echo "<td>" . $utilisateur['email'] . "</td>";
            echo "<td>" . $utilisateur['role'] . "</td>";
            echo "<td>" . ($utilisateur['active'] ? 'Oui' : 'Non') . "</td>";
            echo "<td><a href='modifier_utilisateur.php?id=" . $utilisateur['id'] . "'>Modifier</a></td>";
            echo "</tr>";
        }
        ?>
    </tbody>
</table>
</div>
<!-- <body>

    <h2>Liste des Utilisateurs</h2>

    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Nom</th>
                <th>Email</th>
                <th>Rôle</th>
                <th>Active</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td>1</td>
                <td>Kamdem naomie</td>
                <td>Kamdemnaomie@email.com</td>
                <td>Admin</td>
                <td>
                    <button class="btn btn-oui">Oui</button>
                    <button class="btn btn-non">Non</button>
                </td>
            </tr>
            <tr>
                <td>2</td>
                <td>Waffo Claude</td>
                <td>waffoclaude@email.com</td>
                <td>Magasinier</td>
                <td>
                    <button class="btn btn-oui">Oui</button>
                    <button class="btn btn-non">Non</button>
                </td>
            </tr>
           
           
        </tbody>
    </table> -->
</body>
</html>