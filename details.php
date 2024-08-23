<?php
require 'Contact.php';
require 'ContactManager.php';

$contactManager = new ContactManager('contacts.json');
$index = $_GET['index'];
$contact = $contactManager->getContact($index);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Contact Details</title>
    <link rel="stylesheet" type="text/css" href="StyleSheets/create.css">
</head>
<body>
    <div class="detail">
        <h1>Contact Details</h1>
        <?php if ($contact): ?>
            <p>Name: <?php echo $contact->getName(); ?></p>
            <p>Phone: <?php echo $contact->getPhone(); ?></p>
            <p>Email: <?php echo $contact->getEmail(); ?></p>
            <p>Category: <?php echo $contact->getCategory(); ?></p>
            <p><img src="<?php echo $contact->getImage(); ?>" alt="Contact Image" width="150"></p>
        <?php else: ?>
            <p>Contact not found.</p>
        <?php endif; ?><br><br>
        <a href="index.php" class="btn-link">Back to Contact List</a>
    </div>
</body>
</html>
