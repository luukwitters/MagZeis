<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 19-4-2021
 * Time: 20:53
 */

class Categorie {

    private $id;
    private $name;

    /**
     * EntCategorie constructor.
     * @param $id
     * @param $name
     */
    public function __construct($id, $name) {
        $this->id = $id;
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getId() {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id): void {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName() {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void {
        $this->name = $name;
    }
}