<?php
require_once 'Scripts/ContactManager.php';

$manager = new ContactManager();
$contact = $manager->getContactById($_GET['id']);
if (!$contact) {
    die('Contact not found');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Details</title>
    <link rel="stylesheet" href="StyleSheets/style1.css">
</head>
<body>
    <h1>Contact Details</h1>
    <div id="contact-details">
        <img src="<?= $contact->getImage() ?>" alt="<?= $contact->getName() ?>" width="100">
        <p>Name: <?= $contact->getName() ?></p>
        <p>Phone: <?= $contact->getPhone() ?></p>
        <p>Category: <?= $contact->getCategory() ?></p>
    </div>
    <a href="edit_contact.php?id=<?= $contact->getId() ?>">Edit</a>
    <a href="delete_contact.php?id=<?= $contact->getId() ?>" onclick="return confirm('Are you sure you want to delete this contact?')">Delete</a>
    <a href="list_contact.php">Back to List</a>
</body>
</html>
