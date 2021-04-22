<?php
    require("classes/controller/CategorieController.php");
    require("classes/model/EntCategorie.php");

    // Making an instace of the CategorieController
    $categorieCtrl = new CategorieController();
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <!-- Meta tags for browser information -->
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Preloading all important things -->
        <link rel="preload" href="assets/styling/main.css" as="style">

        <!-- Linking to own CSS -->
        <link rel="stylesheet" href="assets/styling/main.css">

        <!-- Linking to icons -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

        <title>Overzicht | Magazijn6</title>
    </head>

    <body>
        <main class="overview">
            <div class="overview__options">

            </div>

            <table class="overview__table">
                <thead>
                    <tr> <th>Id</th> <th>Name</th> <th>Options</th> </tr>
                </thead>

                <tbody>
                    <?php
                        // Getting the categories
                        $categorieList = $categorieCtrl->overview();

                        // Looping throug the categories
                        foreach ($categorieList as $categorie) {
                            ?>
                            <tr>
                                <td><?php echo $categorie->getId(); ?></td>
                                <td><?php echo $categorie->getName(); ?></td>
                                <td>Komt straks wel</td>
                            </tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </main>
    </body>
</html>
