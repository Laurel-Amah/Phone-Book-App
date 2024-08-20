<?php
require 'Contact.php';
require 'ContactManager.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $image = '';

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        $image = $imagePath;
    }

    $contact = new Contact($name, $phone, $category, $image);
    $contactManager = new ContactManager('contacts.json');
    $contactManager->addContact($contact);

    header('Location: index.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="StyleSheets/create.css">
    <title>Create Contact</title>
</head>
<body>
    <h1>Create New Contact</h1>
    <form method="POST" enctype="multipart/form-data">
        <label>Name: <input type="text" name="name" required></label><br>
        <label>Phone: <input type="text" name="phone" required></label><br>
        <label>Category: 
            <select name="category">
                <option value="family">Family</option>
                <option value="friends">Friends</option>
                <option value="business">Business</option>
            </select>
        </label><br>
        <label>Image: <input type="file" name="image"></label><br>
        <button type="submit">Save Contact</button>
    </form>
</body>
</html>
