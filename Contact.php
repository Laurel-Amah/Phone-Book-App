<?php
class Contact{
    private $name;
    private $phone;
    private $email;
    private $category;
    private $image;

    public function __construct($name, $phone, $email, $category, $image) {
        $this->name = $name;
        $this->phone = $phone;
        $this->email = $email;
        $this->category = $category;
        $this->image = $image;
    }

    // Getters
    public function getName() {
        return $this->name;
    }

    public function getPhone() {
        return $this->phone;
    }

    public function getEmail(){
        return $this->email;
    }

    public function getCategory() {
        return $this->category;
    }

    public function getImage() {
        return $this->image;
    }

    // Setters
    public function setName($name) {
        $this->name = $name;
    }

    public function setPhone($phone) {
        $this->phone = $phone;
    }
    
    public function setEmail($email) {
        $this->email = $email;
    }

    public function setCategory($category) {
        $this->category = $category;
    }

    public function setImage($image) {
        $this->image = $image;
    }

    // Convert contact data to an associative array for JSON storage
    public function toArray() {
        return [
            'name' => $this->name,
            'phone' => $this->phone,
            'email' => $this->email,
            'category' => $this->category,
            'image' => $this->image
        ];
    }
}
?>
