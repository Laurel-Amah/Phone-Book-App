<?php 

    require_once 'ContactManager.php';

    include 'partials/header.php';
 
    if(isset($_GET['id'])) {
        $contactManager = new ContactManager();
        $contactID = $_GET['id'];
        $contactManager->deleteContact($contactID);
    }

    echo "<a href='index.php' class='create-link'>Back to Contact List<br><br></a>";

    include 'partials/footer.php';

    //header('Location: index.php');
?>