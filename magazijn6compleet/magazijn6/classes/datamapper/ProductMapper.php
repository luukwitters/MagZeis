<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 20-4-2021
 * Time: 15:33
 */

class ProductMapper extends Database implements CrudInterface {

    private $conn;
    private $validate;

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
        $productList = array();

        try {
            // Query to get all items from the database
            $query = "SELECT pr.id AS 'product_id', pr.name AS 'product_name', pr.price, ct.id AS'categorie_id', ct.name 
                      FROM product pr
                      INNER JOIN categorie ct ON pr.categorie_id = ct.id";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            // Getting the result
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            // Loopting through the result and adding them to the productList
            foreach ($result as $product) {
                // Filling the categorie entity and adding it to the productList
                $categorie = new Categorie($product->categorie_id, $product->name);

                // Filling the product entity and adding it to the productList
                $product = new Product($product->product_id, $product->product_name, $categorie, $product->price);

                array_push($productList, $product);
            }
        } catch (PDOException $exception) {
            echo "Error when trying to get overview: " . $exception;
        }

        return $productList;
    }

    /**
     * Get details
     *
     * @param int the id of the item
     *
     * @return mixed object with details
     */
    public function view(int $id) {
        // TODO: Implement view() method.
    }

    /**
     * Add item
     *
     * @param $model mixed the object class
     *
     * @return bool if items is added or not
     */
    public function add($model): bool {
        // TODO: Implement add() method.
    }

    /**
     * Function to update an item
     *
     * @param $model mixed the object class
     *
     * @return mixed if the item is updated
     */
    public function update($model): bool {
        // TODO: Implement update() method.
    }

    /**
     * Function to delete an item
     *
     * @param $id int the id of the item
     *
     * @return bool if the item is deleted
     */
    public function delete(int $id): bool {
        // TODO: Implement delete() method.
    }
}