<?php
    /**
     * Created by PhpStorm.
     * User: visse
     * Date: 20-4-2021
     * Time: 17:29
     */

    require_once "classes/controller/RepairController.php";
    require_once "classes/controller/ProductController.php";
    require_once "classes/controller/UserController.php";
    require_once "classes/model/EntCategorie.php";
    require_once "classes/model/EntProduct.php";
    require_once "classes/model/EntUser.php";
    require_once "classes/model/EntRepair.php";

    // Making an instace of the controllers
    $repairCtrl = new RepairController();
    $productCtrl = new ProductController();
    $userCtrl = new UserController();

    $repair = null;

    if (isset($_POST['btnSubmit'])) {
        // Getting the values from the input
        $repairId = htmlspecialchars($_POST['txtRepairId']);
        $productId = htmlspecialchars($_POST['cbxProduct']);
        $status = htmlspecialchars($_POST['cbxStatus']);
        $user = htmlspecialchars($_POST['cbxUser']);

        // Filling the product and repair objects
        $product = new Product($productId, null, null, null);
        $user = new User($user, null, null, null);
        $newRepair = new Repair($repairId, $product, $status, $user);

        // Sending the repair object to the add function
        $repairCtrl->update($newRepair);
    }

    // Checking if id is set in the url
    if (!isset($_GET['id'])) {
        echo "<script>window.location.replace('index')</script>";
    } else {
        // Getting the information of the id
        $repair = $repairCtrl->view($_GET['id']);
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

        <title>Wijzigen | Magazijn6</title>
    </head>

    <body>
        <main class="main add">
            <div class="title add_title">Reparatie wijzigen</div>

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
                                if ($repair->getProduct()->getId() == $product->getId()) {
                                    ?>
                                    <option value="<?php echo $product->getId(); ?>" selected="selected"><?php echo $product->getName(); ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $product->getId(); ?>"><?php echo $product->getName(); ?></option>
                                    <?php
                                }
                            }
                            ?>
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
                            <?php
                                $listStatusses = array('Active', 'Coming', 'Archived');

                                foreach ($listStatusses as $status) {
                                    // Checking if the status is the same as the status of the repair
                                    if (strcmp($repair->getActive(), $status) == 0) {
                                        ?>
                                        <option value="<?php echo $status; ?>" selected="selected"><?php echo $status; ?></option>
                                        <?php
                                    } else {
                                        ?>
                                        <option value="<?php echo $status; ?>"><?php echo $status; ?></option>
                                        <?php
                                    }
                                }
                            ?>
                        </select>
                        <span class="form__feedback" id="statusFeedback"></span>
                    </div>
                </div>

                <div class="form__row">
                    <div class="form__column">
                        <label class="form__label" for="product">User</label>
                    </div>

                    <div class="form__column">
                        <select name="cbxUser" class="form__input" id="user" onkeyup="" required>
                            <?php
                            // Getting the products
                            $listUsers = $userCtrl->overview();

                            // Looping through the products and adding them to the select
                            foreach ($listUsers as $user) {
                                if ($repair->getUser()->getId() == $user->getId()) {
                                    ?>
                                    <option value="<?php echo $user->getId(); ?>" selected="selected"><?php echo $user->getName(); ?></option>
                                    <?php
                                } else {
                                    ?>
                                    <option value="<?php echo $user->getId(); ?>"><?php echo $user->getName(); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <span class="form__feedback" id="productFeedback"></span>
                    </div>
                </div>

                <div class="form__row">
                    <input type="hidden" name="txtRepairId" id="repairId" value="<?php echo $repair->getId(); ?>">
                    <input type="submit" name="btnSubmit" id="submit" value="Aanpassen" class="form__button">
                </div>
            </form>
        </main>
    </body>
</html>
