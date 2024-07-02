<?php
class Product {
    private $productId;
    private $productName;
    private $description;
    private $prince;
    private $amount;
    private $category;
    private $image;

    public function __construct($productName, $description, $prince, $amount, $category, $image) {
        $this->productName = $productName;
        $this->description = $description;
        $this->prince = $prince;
        $this->amount = $amount;
        $this->category = $category;
        $this->image = $image;
    }

    // Getters and Setters

    public function getProductId() {
        return $this->productId;
    }

    public function getProductName() {
        return $this->productName;
    }

    public function setProductName($productName) {
        $this->productName = $productName;
    }

    public function getDescription() {
        return $this->description;
    }

    public function setDescription($description) {
        $this->description = $description;
    }

    public function getprince() {
        return $this->prince;
    }

    public function setprince($prince) {
        $this->prince = $prince;
    }

    public function getAmount() {
        return $this->amount;
    }

    public function setAmount($amount) {
        $this->amount = $amount;
    }

    public function getCategory() {
        return $this->category;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function getImage() {
        return $this->image;
    }

    public function setImage($image) {
        $this->image = $image;
    }
}
?>