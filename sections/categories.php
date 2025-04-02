<?php
include './db.php';

try {
   
    // Vérifier si la table Categories existe, sinon la créer
    $stmt = $conn->query("SHOW TABLES LIKE 'Categories'");
    if ($stmt->rowCount() == 0) {
        $sql = "CREATE TABLE Categories (
            id INT AUTO_INCREMENT PRIMARY KEY,
            nom VARCHAR(100) NOT NULL,
            description TEXT
        )";
        $conn->exec($sql);
        
        // Ajouter quelques catégories par défaut
        $conn->exec("INSERT INTO Categories (nom, description) VALUES 
            ('Informatique', 'Matériel informatique, périphériques et accessoires'),
            ('Bureautique', 'Fournitures de bureau et papeterie'),
            ('Mobilier', 'Mobilier de bureau et aménagement')
        ");
    }
    function e($string) {
    return htmlspecialchars($string, ENT_QUOTES, 'UTF-8');
}

    // Vérifier si la colonne categorie_id existe dans la table Produits, sinon l'ajouter
    $stmt = $conn->query("SHOW COLUMNS FROM Produits LIKE 'categorie_id'");
    if ($stmt->rowCount() == 0) {
        $sql = "ALTER TABLE Produits ADD COLUMN categorie_id INT, ADD FOREIGN KEY (categorie_id) REFERENCES Categories(id)";
        $conn->exec($sql);
    }
    
    // Vérifier si les colonnes quantite_theorique et ecart existent dans la table Inventaires, sinon les ajouter
    $stmt = $conn->query("SHOW COLUMNS FROM Inventaires LIKE 'quantite_theorique'");
    if ($stmt->rowCount() == 0) {
        $sql = "ALTER TABLE Inventaires ADD COLUMN quantite_theorique INT AFTER quantite";
        $conn->exec($sql);
    }
    
    $stmt = $conn->query("SHOW COLUMNS FROM Inventaires LIKE 'ecart'");
    if ($stmt->rowCount() == 0) {
        $sql = "ALTER TABLE Inventaires ADD COLUMN ecart INT AFTER quantite_theorique";
        $conn->exec($sql);
    }
    
} catch(PDOException $e) {
    echo "Erreur de connexion ou d'initialisation: " . $e->getMessage();
    die();
}
if (isset($_POST['submit_categorie'])) {
    try {
        $stmt = $conn->prepare("INSERT INTO Categories (nom, description) VALUES (?, ?)");
        $stmt->execute([
            $_POST['nom_categorie'],
            $_POST['description_categorie']
        ]);
        $message = "Catégorie ajoutée avec succès!";
    } catch(PDOException $e) {
        $error = "Erreur: " . $e->getMessage();
    }
}

// Modifier une catégorie
if (isset($_POST['update_categorie'])) {
    try {
        $stmt = $conn->prepare("UPDATE Categories SET nom = ?, description = ? WHERE id = ?");
        $stmt->execute([
            $_POST['nom_categorie'],
            $_POST['description_categorie'],
            $_POST['categorie_id']
        ]);
        $message = "Catégorie mise à jour avec succès!";
    } catch(PDOException $e) {
        $error = "Erreur: " . $e->getMessage();
    }
}

// Supprimer une catégorie
if (isset($_POST['delete_categorie'])) {
    try {
        // Vérifier si des produits sont associés à cette catégorie
        $stmt = $conn->prepare("SELECT COUNT(*) as count FROM Produits WHERE categorie_id = ?");
        $stmt->execute([$_POST['categorie_id']]);
        $count = $stmt->fetch(PDO::FETCH_ASSOC)['count'];
        
        if ($count > 0) {
            $error = "Impossible de supprimer cette catégorie car des produits y sont associés.";
        } else {
            $stmt = $conn->prepare("DELETE FROM Categories WHERE id = ?");
            $stmt->execute([$_POST['categorie_id']]);
            $message = "Catégorie supprimée avec succès!";
        }
    } catch(PDOException $e) {
        $error = "Erreur: " . $e->getMessage();
    }
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
     <script src="./script.js"></script>
</head>
<body>
    

<div class="content-section" id="categories">
            <div class="dashboard-header">
                <h1>Gestion des Catégories</h1>
            </div>
            
            <div class="dashboard-card">
                <h2 class="card-title">Ajouter une Catégorie</h2>
                <div class="card-content">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="nom_categorie">Nom</label>
                            <input type="text" id="nom_categorie" name="nom_categorie" required>
                        </div>
                        <div class="form-group">
                            <label for="description_categorie">Description</label>
                            <textarea id="description_categorie" name="description_categorie" rows="3"></textarea>
                        </div>
                        <button type="submit" name="submit_categorie">Enregistrer</button>
                    </form>
                </div>
            </div>
            
            <div class="dashboard-card">
                <h2 class="card-title">Liste des Catégories</h2>
                <div class="card-content">
                    <table id="liste-categories">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                            try {
                                $stmt = $conn->query("SELECT * FROM Categories ORDER BY nom");
                                $categories_liste = $stmt->fetchAll(PDO::FETCH_ASSOC);
                                
                                if (count($categories_liste) > 0) {
                                    foreach($categories_liste as $categorie) {
                                        $categorie_id = $categorie['id'];
                                        
                                        echo "<tr id='categorie-row-{$categorie_id}' class='data-row'>";
                                        echo "<td>" . e($categorie['id']) . "</td>";
                                        echo "<td>" . e($categorie['nom']) . "</td>";
                                        echo "<td>" . e($categorie['description']) . "</td>";
                                        echo "<td>";
                                        echo "<button type='button' class='btn-edit' data-id='{$categorie_id}' data-type='categorie'>Modifier</button> ";
                                        echo "<button type='button' class='btn-delete' onclick=\"confirmerSuppression('categorie_id', {$categorie_id}, 'delete_categorie')\">Supprimer</button>";
                                        echo "</td>";
                                        echo "</tr>";
                                        
                                        // Formulaire d'édition (caché par défaut)
                                        echo "<tr id='edit-form-categorie-{$categorie_id}' class='edit-row'>";
                                        echo "<td colspan='4'>";
                                        echo "<div class='form-editer'>";
                                        echo "<form method='POST' action=''>";
                                        echo "<input type='hidden' name='categorie_id' value='{$categorie_id}'>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='nom_categorie_{$categorie_id}'>Nom</label>";
                                        echo "<input type='text' id='nom_categorie_{$categorie_id}' name='nom_categorie' value='" . e($categorie['nom']) . "' required>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-group'>";
                                        echo "<label for='description_categorie_{$categorie_id}'>Description</label>";
                                        echo "<textarea id='description_categorie_{$categorie_id}' name='description_categorie' rows='3'>" . e($categorie['description']) . "</textarea>";
                                        echo "</div>";
                                        
                                        echo "<div class='form-actions'>";
                                        echo "<button type='button' class='btn-cancel' data-id='{$categorie_id}' data-type='categorie'>Annuler</button>";
                                        echo "<button type='submit' name='update_categorie'>Enregistrer</button>";
                                        echo "</div>";
                                        
                                        echo "</form>";
                                        echo "</div>";
                                        echo "</td>";
                                        echo "</tr>";
                                    }
                                } else {
                                    echo "<tr><td colspan='4' style='text-align: center;'>Aucune catégorie trouvée</td></tr>";
                                }
                            } catch(PDOException $e) {
                                echo "<tr><td colspan='4' style='text-align: center;'>Erreur: " . $e->getMessage() . "</td></tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        </body>
                        
    <!-- <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Handle menu clicks
            const menuItems = document.querySelectorAll('.menu-item, .submenu-item');
            
            menuItems.forEach(item => {
                item.addEventListener('click', function() {
                    // Handle submenu toggling
                    if (this.dataset.target) {
                        this.classList.toggle('active');
                        return;
                    }
                    
                    // Handle section navigation
                    if (this.dataset.section) {
                        // Remove active class from all menu items
                        menuItems.forEach(mi => mi.classList.remove('active'));
                        
                        // Add active class to clicked menu item
                        this.classList.add('active');
                        
                        // Hide all sections
                        document.querySelectorAll('.content-section').forEach(section => {
                            section.classList.remove('active');
                        });
                        
                        // Show selected section
                        const targetSection = document.getElementById(this.dataset.section);
                        if (targetSection) {
                            targetSection.classList.add('active');
                        }
                    }
                });
            });
            
            // Handle tab clicks
            const tabs = document.querySelectorAll('.tab');
            
            tabs.forEach(tab => {
                tab.addEventListener('click', function() {
                    // Remove active class from all tabs
                    tabs.forEach(t => t.classList.remove('active'));
                    
                    // Add active class to clicked tab
                    this.classList.add('active');
                    
                    // Hide all tab content
                    document.querySelectorAll('.tab-content').forEach(content => {
                        content.classList.remove('active');
                    });
                    
                    // Show selected tab content
                    const targetContent = document.getElementById(this.dataset.tab);
                    if (targetContent) {
                        targetContent.classList.add('active');
                    }
                });
            });
            
            // Open products submenu by default
            const productsMenuItem = document.querySelector('[data-target="produits-submenu"]');
            productsMenuItem.classList.add('active');
            
            // Gestion des boutons Modifier
            document.querySelectorAll('.btn-edit').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const type = this.getAttribute('data-type');
                    toggleEditForm(id, type);
                });
            });
            
            // Gestion des boutons Annuler dans les formulaires
            document.querySelectorAll('.btn-cancel').forEach(button => {
                button.addEventListener('click', function() {
                    const id = this.getAttribute('data-id');
                    const type = this.getAttribute('data-type');
                    toggleEditForm(id, type);
                });
            });
            
            // Configuration du formulaire de suppression
            document.getElementById('cancel-delete').addEventListener('click', function() {
                hideConfirmation();
            });
            
            document.getElementById('confirmation-overlay').addEventListener('click', function() {
                hideConfirmation();
            });
            
            document.getElementById('confirm-delete').addEventListener('click', function() {
                const deleteForm = document.getElementById('delete-form');
                deleteForm.submit();
            });
        });
        
        // Fonction pour afficher/masquer les formulaires d'édition
        function toggleEditForm(id, type) {
            // Fermer tous les formulaires ouverts d'abord
            document.querySelectorAll('.edit-row').forEach(row => {
                row.style.display = 'none';
            });
            
            document.querySelectorAll('.data-row').forEach(row => {
                row.classList.remove('ligne-edit');
            });
            
            // Afficher ou masquer le formulaire sélectionné
            const formRow = document.getElementById(`edit-form-${type}-${id}`);
            const dataRow = document.getElementById(`${type}-row-${id}`);
            
            if (formRow && dataRow) {
                // Si le formulaire est déjà visible, le masquer
                if (formRow.style.display === 'table-row') {
                    formRow.style.display = 'none';
                    dataRow.classList.remove('ligne-edit');
                } else {
                    // Sinon, l'afficher
                    formRow.style.display = 'table-row';
                    dataRow.classList.add('ligne-edit');
                    
                    // S'assurer que le formulaire à l'intérieur est visible
                    const formElement = formRow.querySelector('.form-editer');
                    if (formElement) {
                        formElement.style.display = 'block';
                    }
                }
            }
        }
        
        // Fonctions pour la confirmation de suppression
        function confirmerSuppression(idField, id, submitName) {
            // Préparer le formulaire de suppression
            const deleteForm = document.getElementById('delete-form');
            
            // Vider le formulaire
            while (deleteForm.firstChild) {
                deleteForm.removeChild(deleteForm.firstChild);
            }
            
            // Ajouter le champ ID
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = idField;
            idInput.value = id;
            deleteForm.appendChild(idInput);
            
            // Ajouter le bouton de soumission
            const submitInput = document.createElement('input');
            submitInput.type = 'hidden';
            submitInput.name = submitName;
            submitInput.value = '1';
            deleteForm.appendChild(submitInput);
            
            // Afficher la confirmation
            document.getElementById('confirmation-overlay').style.display = 'block';
            document.getElementById('confirmation-box').style.display = 'block';
        }
        
        function hideConfirmation() {
            document.getElementById('confirmation-overlay').style.display = 'none';
            document.getElementById('confirmation-box').style.display = 'none';
        }
    </script> -->
        </html>