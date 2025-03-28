<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestion de Stock</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <!-- Include Sidebar -->
    <?php include 'sidebar.php'; ?>

    <!-- Main Content -->
    <div class="main-content">
        <?php if (isset($message)): ?>
        <div class="message success"><?php echo $message; ?></div>
        <?php endif; ?>
        
        <?php if (isset($error)): ?>
        <div class="message error"><?php echo $error; ?></div>
        <?php endif; ?>

        <!-- Include different sections -->
        <?php 
        $section = $_GET['section'] ?? 'dashboard';
        switch($section) {
            case 'dashboard':
                include 'sections/dashboard.php';
                break;
            case 'fournisseurs':
                include 'sections/fournisseurs.php';
                break;
            case 'categories':
                include 'sections/categories.php';
                break;
                case 'liste-produits':
                    include 'sections/liste-produits.php';
                    break;
                    case 'ajouter-produits':
                        include 'sections/ajouter-produits.php';
                        break;
            default:
                include 'sections/dashboard.php';
        }
        ?>
    </div>



    <script src="script.js"></script>
</body>
</html>