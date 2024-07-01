<?php
class Company {
    private $companyId;
    private $companyName;
    private $address;
    private $city;
    private $phoneNumber;
    private $email;

    public function __construct($companyName, $address, $city, $phoneNumber, $email) {
        $this->companyName = $companyName;
        $this->address = $address;
        $this->city = $city;
        $this->phoneNumber = $phoneNumber;
        $this->email = $email;
    }

    // Getters and Setters

    public function getCompanyId() {
        return $this->companyId;
    }

    public function getCompanyName() {
        return $this->companyName;
    }

    public function setCompanyName($companyName) {
        $this->companyName = $companyName;
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