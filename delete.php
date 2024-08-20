<?php
require 'Contact.php';
require 'ContactManager.php';

$contactManager = new ContactManager('contacts.json');
$index = $_GET['index'];

$contactManager->deleteContact($index);

header('Location: index.php');
exit;
?>
