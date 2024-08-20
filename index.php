<?php
require 'Contact.php';
require 'ContactManager.php';

$contactManager = new ContactManager('contacts.json');
$contacts = $contactManager->loadContacts();
?>

<!DOCTYPE html>
<html>
<head>
    <link rel="stylesheet" type="text/css" href="StyleSheets/create.css">
    <title>Contact List</title>
</head>
<body>
    <h1>Contacts</h1>
    <a href="create.php">Add New Contact</a>
    <ul>
        <?php foreach ($contacts as $index => $contact): ?>
            <li>
                <?php echo $contact->getName(); ?> --- <?php echo $contact->getPhone(); ?><br>

                <a href="details.php?index=1" class="btn-link">View Details</a>
                <a href="edit.php?index=1" class="btn-link">Edit Contact</a>
                <a href="delete.php?index=1" class="btn-link">Delete Contact</a> <br><br>

        <?php endforeach; ?>
    </ul>
</body>
</html>
