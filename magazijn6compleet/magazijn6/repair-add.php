<?php
    /**
     * Created by PhpStorm.
     * User: visse
     * Date: 20-4-2021
     * Time: 17:29
     */

    require_once "classes/controller/RepairController.php";
    require_once "classes/controller/ProductController.php";
    require_once "classes/model/EntCategorie.php";
    require_once "classes/model/EntProduct.php";
    require_once "classes/model/EntUser.php";
    require_once "classes/model/EntRepair.php";

    // Making an instace of the controllers
    $repairCtrl = new RepairController();
    $productCtrl = new ProductController();

    if (isset($_POST['btnSubmit'])) {
        // Getting the values from the input
        $productId = htmlspecialchars($_POST['cbxProduct']);
        $status = htmlspecialchars($_POST['cbxStatus']);

        // Filling the product and repair objects
        $product = new Product($productId, null, null, null);
        $repair = new Repair(null, $product, $status, null);

        // Sending the repair object to the add function
        $repairCtrl->add($repair);
    }
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

        <!-- Linking to icons -->
        <script src="https://kit.fontawesome.com/a076d05399.js"></script>

        <title>Toevoegen | Magazijn6</title>
    </head>

    <body>
        <main class="main add">
            <div class="title add_title">Reparatie toevoegen</div>

            <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" class="form">
                <div class="form__row">
                    <div class="form__column">
                        <label class="form__label" for="product">Product</label>
                    </div>

                    <div class="form__column">
                        <select name="cbxProduct" class="form__input" id="product" onkeyup="" required>
                            <?php
                                // Getting the products
                                $listProducts = $productCtrl->overview();

                                // Looping through the products and adding them to the select
                                foreach ($listProducts as $product) {
                                    ?>
                                    <option value="<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></option>
                                    <?php
                                }
                            ?>
                            <option value="" selected="selected">---</option>
                        </select>
                        <span class="form__feedback" id="productFeedback"></span>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__column">
                        <label class="form__label" for="status">Status</label>
                    </div>

                    <div class="form__column">
                        <select name="cbxStatus" class="form__input" id="status" onkeyup="" required>
                            <option value="Coming" selected="selected">Coming soon</option>
                            <option value="Active">Active</option>
                        </select>
                        <span class="form__feedback" id="statusFeedback"></span>
                    </div>
                </div>

                <div class="form__row">
                    <input type="submit" name="btnSubmit" id="submit" value="Toevoegen" class="form__button">
                </div>
            </form>
        </main>
    </body>
</html>
