<?php 
    require_once 'ContactManager.php';

    if (isset($_GET['id'])) {
        $contactId = $_GET['id'];
        $contactManager = new ContactManager();
        $contact = $contactManager->getContactById($contactId);

        if ($contact) {
            include 'partials/header.php';

            echo "<h2>Contact Details</h2>";
                echo "<div class='view'>";  
                echo "<div></div>";
                echo "<div>";           
                    echo "<img id ='img' src = ' ". $contact['contact_Image'] . " '> <br>";
                    echo "<p><b>Name: </b>" . $contact['contact_Name'] . "</p><br>";
                    echo "<p><b>Phone: </b> " . $contact['phone'] . "</p><br>";
                    echo "<p><b>Email: </b> " . $contact['email'] . "</p><br>";
                    echo "<p><b>Category: </b>" . $contact['category'] . "</p><br>";
                echo "</div>";
            echo "</div>";
        } else {
            echo "Contact not Found!";
        }
    } else {
        echo "No contact ID provided!";
    }

    echo " <div class='form-actions'>";
    echo " <a href='index.php' class='button'>Contact List</a>";
    echo " <a href='edit.php?id=" . $contactId . "' class='button'>Edit Contact</a>";
    echo "</div>";

    include 'partials/footer.php';
?>