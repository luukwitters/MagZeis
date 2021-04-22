<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 20-4-2021
 * Time: 10:39
 */

class Product {

    private $id;
    private $name;
    private $categorie;
    private $price;

    /**
     * EntProduct constructor.
     * @param $id int The id of the product
     * @param $name string The name of the product
     * @param $categorie Categorie The categorie of the product
     * @param $price double The price of the product
     */
    public function __construct($id, $name, $categorie, $price) {
        $this->id = $id;
        $this->name = $name;
        $this->categorie = $categorie;
        $this->price = $price;
    }

    /**
     * @return int
     */
    public function getId(): int {
        return $this->id;
    }

    /**
     * @param int $id
     */
    public function setId(int $id): void {
        $this->id = $id;
    }

    /**
     * @return string
     */
    public function getName(): string {
        return $this->name;
    }

    /**
     * @param string $name
     */
    public function setName(string $name): void {
        $this->name = $name;
    }

    /**
     * @return Categorie
     */
    public function getCategorie(): Categorie {
        return $this->categorie;
    }

    /**
     * @param Categorie $categorie
     */
    public function setCategorie(Categorie $categorie): void {
        $this->categorie = $categorie;
    }

    /**
     * @return float
     */
    public function getPrice(): float {
        return $this->price;
    }

    /**
     * @param float $price
     */
    public function setPrice(float $price): void {
        $this->price = $price;
    }
}