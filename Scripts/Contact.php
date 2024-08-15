<?php

class Contact {
    private $id;
    private $name;
    private $phone;
    private $category;
    private $photo;

    public function __construct($id, $name, $phone, $category, $photo) {
        $this->id = $id;
        $this->name = $name;
        $this->phone = $phone;
        $this->category = $category;
        $this->photo = $photo;
    }

    public function getId() {
        return $this->id;
    }

    public function getName() {
        return $this->name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getphoto() {
        return $this->photo;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setPhoto($photo) {
        $this->photo = $photo;
    }
}
?>
