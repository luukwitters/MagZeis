<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 20-4-2021
 * Time: 15:35
 */

require_once "classes/datamapper/database.php";
require_once "classes/helper/CrudInterface.php";

class RepairMapper extends Database implements CrudInterface {

    private $conn;
    private $validate;

    /**
     * RepairMapper constructor.
     */
    public function __construct() {
        // Get the database connection
        $this->conn = $this->getConnection();
        $this->validate = new Validation();
    }

    /**
     * Get an overview
     *
     * @return array with the overview
     */
    public function overview(): array {
        // Creating the array to fill it later
        $repairList = array();

        try {
            // Query to get all items from the database
            $query = "SELECT rp.id AS 'repair_id', rp.active, u.id AS 'user_id', u.name AS 'user_name', pr.id AS 'product_id', pr.name AS 'product_name', pr.price, ct.id AS 'categorie_id', ct.name AS 'categorie_name'
                      FROM repair rp
                      INNER JOIN user u ON rp.fixed_by = u.id
                      INNER JOIN product pr ON rp.product_id = pr.id
                      INNER JOIN categorie ct ON pr.categorie_id = ct.id
                      ORDER BY rp.id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            // Getting the result
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            // Loopting through the result and adding them to the repairList
            foreach ($result as $repair) {
                // Filling the categorie entity and adding it to the Product
                $categorie = new Categorie($repair->categorie_id, $repair->categorie_name);

                // Filling the product entity and adding it to the repair
                $product = new Product($repair->product_id, $repair->product_name, $categorie, $repair->price);

                // Filling the user entity and adding it to the repair
                $user = new User($repair->user_id, $repair->user_name, null, null);

                // Filling the repair entity and adding it to the repair
                $repair = new Repair($repair->repair_id, $product, $repair->active, $user);

                array_push($repairList, $repair);
            }
        } catch (PDOException $exception) {
            echo "Error when trying to get overview: " . $exception;
        }

        return $repairList;
    }

    /**
     * Get details
     *
     * @param int the id of the item
     *
     * @return mixed object with details
     */
    public function view(int $id) {
        // Creating a query to get the details of a repair
        try {
            // Query to get all items from the database
            $query = "SELECT rp.id AS 'repair_id', rp.active, u.id AS 'user_id', u.name AS 'user_name', pr.id AS 'product_id', pr.name AS 'product_name', pr.price, ct.id AS 'categorie_id', ct.name AS 'categorie_name'
                      FROM repair rp
                      INNER JOIN user u ON rp.fixed_by = u.id
                      INNER JOIN product pr ON rp.product_id = pr.id
                      INNER JOIN categorie ct ON pr.categorie_id = ct.id
                      WHERE rp.id = ?
                      ORDER BY rp.id DESC";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();

            // Getting the result
            $result = $stmt->fetch(PDO::FETCH_OBJ);

            // Filling the categorie entity and adding it to the Product
            $categorie = new Categorie($result->categorie_id, $result->categorie_name);

            // Filling the product entity and adding it to the repair
            $product = new Product($result->product_id, $result->product_name, $categorie, $result->price);

            // Filling the user entity and adding it to the repair
            $user = new User($result->user_id, $result->user_name, null, null);

            // Filling the repair entity and returning it
            return new Repair($result->repair_id, $product, $result->active, $user);
        } catch (PDOException $exception) {
            echo "Error when trying to get view: " . $exception;
        }
    }

    /**
     * Add item
     *
     * @param $model mixed the object class
     *
     * @return bool if items is added or not
     */
    public function add($model): bool {
        try {
            // Creating variables to use in the query
            $productId = $model->getProduct()->getId();
            $status = $model->getActive();
            $userId = 3;

            // Creating a query to add a repair to the database
            $query = "INSERT INTO repair(product_id, active, fixed_by) VALUES (?, ?, ?)";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $productId);
            $stmt->bindParam(2, $status);
            $stmt->bindParam(3, $userId);
            $stmt->execute();

            return true;
        } catch (PDOException $exception) {
            echo $exception;
            return false;
        }
    }

    /**
     * Function to update an item
     *
     * @param $model mixed the object class
     *
     * @return mixed if the item is updated
     */
    public function update($model): bool {
        try {
            // Creating variables to use in the query
            $repairId = $model->getId();
            $productId = $model->getProduct()->getId();
            $status = $model->getActive();
            $userId = $model->getUser()->getId();

            // Creating a query to add a repair to the database
            $query = "UPDATE repair SET product_id = ?, active = ?, fixed_by = ? WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $productId);
            $stmt->bindParam(2, $status);
            $stmt->bindParam(3, $userId);
            $stmt->bindParam(4, $repairId);
            $stmt->execute();

            return true;
        } catch (PDOException $exception) {
            echo $exception;
            return false;
        }
    }

    /**
     * Function to delete an item
     *
     * @param $id int the id of the item
     *
     * @return bool if the item is deleted
     */
    public function delete(int $id): bool {
        try {
            // Creating a query to delete the repair
            $query = "DELETE FROM repair WHERE id = ?";
            $stmt = $this->conn->prepare($query);
            $stmt->bindParam(1, $id);
            $stmt->execute();
            return true;
        } catch (PDOException $e) {
            echo "Repair could not be deleted: " . $e;
            return false;
        }
    }
}