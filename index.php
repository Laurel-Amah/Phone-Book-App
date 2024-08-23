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
        <h1>Your Contacts</h1>
        <a href="create.php" class="btn-link">Add New Contact</a>
        <ul>
            <?php foreach ($contacts as $index => $contact): ?>
                <li>
                    <?php echo $contact->getName(); ?> --- <?php echo $contact->getPhone(); ?><br>
                    <br><br>
                    <a href="details.php?index=<?php echo $index; ?>" class="btn-link">View Details</a>
                    <a href="edit.php?index=<?php echo $index; ?>" class="btn-link"> Edit Contact</a>
                    <a href="delete.php?index=<?php echo $index; ?>" class="btn-link" onclick=""> Delete Contact</a> <br><br>

            <?php endforeach; ?>
        </ul>
</body>
</html>
