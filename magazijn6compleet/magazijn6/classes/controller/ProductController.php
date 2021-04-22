<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 20-4-2021
 * Time: 15:31
 */

require_once "classes/datamapper/ProductMapper.php";
require_once "classes/helper/Validation.php";
require_once "classes/helper/CrudInterface.php";

class ProductController implements CrudInterface {

    private $productMapper;
    private $validate;

    /**
     * ProductController constructor.
     * @param $validate
     */
    public function __construct() {
        $this->productMapper = new ProductMapper();
        $this->validate = new Validation();
    }

    /**
     * Get an overview
     *
     * @return array with the overview
     */
    public function overview(): array {
        return $this->productMapper->overview();
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