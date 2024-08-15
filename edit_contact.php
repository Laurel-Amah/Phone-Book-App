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
    <title>Edit Contact</title>
    <link rel="stylesheet" href="StyleSheets/style1.css">
</head>
<body>
    <h1>Edit Contact</h1>
    <form action="save_contact.php" method="POST" enctype="multipart/form-data">
        <input type="hidden" name="id" value="<?= $contact->getId() ?>">
        <input type="text" name="name" placeholder="Name" value="<?= $contact->getName() ?>" required>
        <input type="text" name="phone" placeholder="Phone Number" value="<?= $contact->getPhone() ?>" required>
        <select name="category">
            <option value="family" <?= $contact->getCategory() == 'family' ? 'selected' : '' ?>>Family</option>
            <option value="friends" <?= $contact->getCategory() == 'friends' ? 'selected' : '' ?>>Friends</option>
            <option value="business" <?= $contact->getCategory() == 'business' ? 'selected' : '' ?>>Business</option>
        </select>
        <input type="file" name="image">
        <button type="submit">Save</button>
    </form>
    <a href="list_contact.php">Back to List</a>
</body>
</html>
