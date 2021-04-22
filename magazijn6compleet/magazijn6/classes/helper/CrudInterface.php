<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 19-4-2021
 * Time: 20:21
 */

interface CrudInterface {

    /**
     * Get an overview
     *
     * @return array with the overview
     */
    public function overview() :array;

    /**
     * Get details
     *
     * @param int the id of the item
     *
     * @return mixed object with details
     */
    public function view(int $id);

    /**
     * Add item
     *
     * @param $model mixed the object class
     *
     * @return bool if items is added or not
     */
    public function add($model) :bool;

    /**
     * Function to update an item
     *
     * @param $model mixed the object class
     *
     * @return mixed if the item is updated
     */
    public function update($model) :bool;

    /**
     * Function to delete an item
     *
     * @param $id int the id of the item
     *
     * @return bool if the item is deleted
     */
    public function delete(int $id) :bool;
}