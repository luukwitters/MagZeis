<?php
    require_once "classes/controller/RepairController.php";
    require_once "classes/model/EntCategorie.php";
    require_once "classes/model/EntProduct.php";
    require_once "classes/model/EntUser.php";
    require_once "classes/model/EntRepair.php";

    // Making an instace of the RepairController
    $repairCtrl = new RepairController();
?>

<!DOCTYPE html>
<html lang="nl">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--Preloading all important things-->
        <link rel="preload" href="assets/styling/main.css" as="style">

        <!-- Linking to own CSS -->
        <link rel="stylesheet" href="assets/styling/main.css">

        <!-- Linking to own JavaScript -->
        <script src="assets/script/main.js"></script>

        <!-- Linking to icons -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

        <title>Overzicht | Magazijn6</title>
    </head>

    <body>
        <main class="main overview">
            <div class="title overview__title">Reparatie overzicht</div>

            <div class="overview__options">
                <a href="repair-add" class="overview__link overview__add"><i class="fas fa-plus link__icon"></i> Toevoegen</a>
            </div>

            <table class="overview__table">
                <thead>
                <tr> <th>Id</th> <th>Product</th> <th>Product id</th> <th>Product prijs</th> <th>Gemaakt door</th> <th class="table__options">Opties</th> </tr>
                </thead>

                <tbody>
                    <?php
                        // Getting the repairs
                        $repairList = $repairCtrl->overview();

                        // Checking if there are records to show, else show empty text
                        if (count($repairList) != 0) {
                            // Looping through the categories
                            foreach ($repairList as $repair) {
                                ?>
                                <tr>
                                    <td id="repair<?php echo $repair->getId(); ?>"><?php echo $repair->getId(); ?></td>
                                    <td><?php echo $repair->getProduct()->getName(); ?></td>
                                    <td><?php echo $repair->getProduct()->getId(); ?></td>
                                    <td><?php echo $repair->getProduct()->getPrice(); ?></td>
                                    <td><?php echo $repair->getUser()->getName(); ?></td>
                                    <td class="table__options"><a href="repair-update?id=<?php echo $repair->getId(); ?>" class="overview__link overview__change">Aanpassen</a>
                                        <a href="javascript:void(0)" class="overview__link overview__delete" onclick="openModal('<?php echo $repair->getId(); ?>')">Verwijderen</a></td>
                                </tr>
                                <?php
                            }
                        } else {
                            ?>
                            <tr><td colspan="6" class="overview__empty">No records found</td></tr>
                            <?php
                        }
                    ?>
                </tbody>
            </table>
        </main>

        <?php
            require_once "repair-delete.php";
        ?>
    </body>
</html>
