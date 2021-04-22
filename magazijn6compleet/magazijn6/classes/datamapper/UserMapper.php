<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 20-4-2021
 * Time: 15:35
 */

require_once "classes/datamapper/database.php";
require_once "classes/helper/CrudInterface.php";

class UserMapper extends Database implements CrudInterface {

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
        $userList = array();

        try {
            // Query to get all items from the database
            $query = "SELECT * FROM user";
            $stmt = $this->conn->prepare($query);
            $stmt->execute();

            // Getting the result
            $result = $stmt->fetchAll(PDO::FETCH_OBJ);
            // Loopting through the result and adding them to the repairList
            foreach ($result as $user) {
                // Filling the user entity and adding it to the repair
                $user = new User($user->id, $user->name, $user->email, $user->password);

                array_push($userList, $user);
            }
        } catch (PDOException $exception) {
            echo "Error when trying to get overview: " . $exception;
        }

        return $userList;
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