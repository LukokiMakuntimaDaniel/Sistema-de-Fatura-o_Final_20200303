<?php
class Customer {
    private $customerId;
    private $address;
    private $city;
    private $phoneNumber;
    private $email;

    public function __construct($address, $city, $phoneNumber, $email) {
        $this->address = $address;
        $this->city = $city;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
    }

    // Getters and Setters

    public function getCustomerId() {
        return $this->customerId;
    }

    public function getAddress() {
        return $this->address;
    }

    public function setAddress($address) {
        $this->address = $address;
    }

    public function getCity() {
        return $this->city;
    }

    public function setCity($city) {
        $this->city = $city;
    }

    public function getPhoneNumber() {
        return $this->phoneNumber;
    }

    public function setPhoneNumber($phoneNumber) {
        $this->phoneNumber = $phoneNumber;
    }

    public function getEmail() {
        return $this->email;
    }

    public function setEmail($email) {
        $this->email = $email;
    }
}
?>
