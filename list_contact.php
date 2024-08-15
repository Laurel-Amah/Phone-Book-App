<?php
    require_once 'Scripts/ContactFunctions.php';

    $manager = new ContactManager();
    $contacts = $manager->getAllContacts();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="StyleSheets/style1.css">
    <title>Contact List</title>
</head>
<body>
    <h3>
        Your contacts
    </h3>
    <div id="contact-list">
        <?php foreach ($contacts as $contact): ?>
            <div>
                <img src="<?= $contact->getPhoto() ?>" alt="<?= $contact->getName() ?>" width="50">
                <p><a href="contact_details.php?id=<?= $contact->getId() ?>"><?= $contact->getName() ?></a></p>
                <p><?= $contact->getPhone() ?></p>
                <p><?= $contact->getCategory() ?></p>
            </div>
        <?php endforeach; ?>
    </div>
</body>
</html>
