<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 20-4-2021
 * Time: 10:33
 */

require_once "classes/datamapper/RepairMapper.php";
require_once "classes/helper/Validation.php";
require_once "classes/helper/CrudInterface.php";

class RepairController implements CrudInterface {

    private $repairMapper;
    private $validate;

    /**
     * RepairController constructor.
     *
     * @param $validate Validation class
     */
    public function __construct() {
        $this->repairMapper = new RepairMapper();
        $this->validate = new Validation();
    }

    /**
     * Get an overview
     *
     * @return array with the overview
     */
    public function overview(): array {
        // Getting the overview from the database and returning it
        return $this->repairMapper->overview();
    }

    /**
     * Get details
     *
     * @param int the id of the item
     *
     * @return mixed object with details
     */
    public function view(int $id) {
        // Getting the object from the database
        return $this->repairMapper->view($id);
    }

    /**
     * Add item
     *
     * @param $model mixed the object class
     *
     * @return bool if items is added or not
     */
    public function add($model): bool {
        // Checking if the input is valid
        if ($this->validate->validateString($model->getActive(), 1, 25) && $this->validate->validateInt($model->getProduct()->getId(), 1, 25)) {
            // Sending the model to the datamapper
            if(!$this->repairMapper->add($model)) {
                // Showing an error
                echo "<script>alert('Kon de reparatie niet toevoegen. ')</script>";
            } else {
                // Redirecting the user to the overview
                echo "<script>window.location.replace('../magazijn6');</script>";
            }
        } else {
            echo "<script>alert('Vieze flikker kan niet eens 2 variabale goed meesturen')</script>";
            return false;
        }

        return true;
    }

    /**
     * Function to update an item
     *
     * @param $model mixed the object class
     *
     * @return mixed if the item is updated
     */
    public function update($model): bool {
        // Checking if the input is valid
        $validateActive = $this->validate->validateString($model->getActive(), 1, 25);
        $validateProductId = $this->validate->validateInt($model->getProduct()->getId(), 1, 11);
        $validateUserId = $this->validate->validateInt($model->getUser()->getId(), 1, 11);

        if ($validateActive && $validateProductId && $validateUserId) {
            // Sending the model to the datamapper
            if(!$this->repairMapper->update($model)) {
                // Showing an error
                echo "<script>alert('Kon de reparatie niet wijzigen. ')</script>";
            } else {
                // Redirecting the user to the overview
                echo "<script>window.location.replace('../magazijn6');</script>";
            }
        } else {
            echo "<script>alert('Vieze flikker kan niet eens 3 variabale goed meesturen')</script>";
            return false;
        }

        return true;
    }

    /**
     * Function to delete an item
     *
     * @param $id int the id of the item
     *
     * @return bool if the item is deleted
     */
    public function delete(int $id): bool {
        // Checking if the id is valid
        if ($this->validate->validateInt($id, 1, 11)) {
            // Sending the id to the mapper
            if (!$this->repairMapper->delete($id)) {
                // Could not delete
                echo "<script>alert('Repair could not be deleted');</script>";
                return false;
            }

            return true;
        }
    }
}