<div class="content-section" id="ajouter-produit">
            <div class="dashboard-header">
                <h1>Ajouter un Produit</h1>
            </div>
            
            <div class="dashboard-card">
                <h2 class="card-title">Informations du Produit</h2>
                <div class="card-content">
                    <form method="POST" action="">
                        <div class="form-group">
                            <label for="nom_produit">Nom</label>
                            <input type="text" id="nom_produit" name="nom_produit" required>
                        </div>
                        <div class="form-group">
                            <label for="description_produit">Description</label>
                            <textarea id="description_produit" name="description_produit" rows="3"></textarea>
                        </div>
                        <div class="form-group">
                            <label for="quantite_produit">Quantité initiale</label>
                            <input type="number" id="quantite_produit" name="quantite_produit" min="0" value="0">
                        </div>
                        <div class="form-group">
                            <label for="prix_produit">Prix</label>
                            <input type="number" id="prix_produit" name="prix_produit" min="0" step="0.01" required>
                        </div>
                        <div class="form-group">
                            <label for="marque_produit">Marque</label>
                            <input type="text" id="marque_produit" name="marque_produit">
                        </div>
                        <div class="form-group">
                            <label for="categorie_produit">Catégorie</label>
                            <select id="categorie_produit" name="categorie_produit">
                                <option value="">Sélectionner une catégorie</option>
                                <?php foreach($categories as $categorie): ?>
                                <option value="<?php echo $categorie['id']; ?>"><?php echo e($categorie['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="fournisseur_produit">Fournisseur</label>
                            <select id="fournisseur_produit" name="fournisseur_produit">
                                <option value="">Sélectionner un fournisseur</option>
                                <?php foreach($fournisseurs as $fournisseur): ?>
                                <option value="<?php echo $fournisseur['id']; ?>"><?php echo e($fournisseur['nom']); ?></option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                        <button type="submit" name="submit_produit">Enregistrer le Produit</button>
                    </form>
                </div>
            </div>
        </div>