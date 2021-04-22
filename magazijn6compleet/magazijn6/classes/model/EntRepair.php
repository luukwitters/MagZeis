<?php
/**
 * Created by PhpStorm.
 * User: visse
 * Date: 20-4-2021
 * Time: 10:37
 */

class Repair {

    private $id;
    private $product;
    private $active;
    private $user;

    /**
     * EntRepair constructor.
     * @param $id int The repair id
     * @param $product Product The repaired product
     * @param $active string The status of the repair
     * @param $user User The user that repairs it
     */
    public function __construct($id, $product, $active, $user) {
        $this->id = $id;
        $this->product = $product;
        $this->active = $active;
        $this->user = $user;
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
     * @return Product
     */
    public function getProduct(): Product {
        return $this->product;
    }

    /**
     * @param Product $product
     */
    public function setProduct(Product $product): void {
        $this->product = $product;
    }

    /**
     * @return string
     */
    public function getActive(): string {
        return $this->active;
    }

    /**
     * @param string $active
     */
    public function setActive(string $active): void {
        $this->active = $active;
    }

    /**
     * @return User
     */
    public function getUser(): User {
        return $this->user;
    }

    /**
     * @param User $user
     */
    public function setUser(User $user): void {
        $this->user = $user;
    }
}