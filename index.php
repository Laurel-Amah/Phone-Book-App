<?php
require 'Contact.php';
require 'ContactManager.php';

$contactManager = new ContactManager('contacts.json');
$contacts = $contactManager->loadContacts();
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact List</title>
</head>
<body>
    <h1>Contacts</h1>
    <a href="create.php">Add New Contact</a>
    <ul>
        <?php foreach ($contacts as $index => $contact): ?>
            <li>
                <a href="details.php?index=<?php echo $index; ?>">
                    <?php echo $contact->getName(); ?> - <?php echo $contact->getPhone(); ?>
                </a>
                <a href="edit.php?index=<?php echo $index; ?>">Edit</a>
                <a href="delete.php?index=<?php echo $index; ?>">Delete</a>
            </li>
        <?php endforeach; ?>
    </ul>
</body>
</html>
