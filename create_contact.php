
<?php

require 'Scripts/ContactFunctions.php';

// Initialize variables
$uploadDir = "uploads/";
$uploadFile = null;
$uploadOk = 1;
$imageFileType = "";

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $email = $_POST['email'];
    $category = $_POST['category'];

    // Check if file was uploaded and is an image
    if (isset($_FILES["fileToUpload"]) && $_FILES["fileToUpload"]["error"] === UPLOAD_ERR_OK) {
        $uploadFile = $uploadDir . basename($_FILES["fileToUpload"]["name"]);
        $imageFileType = strtolower(pathinfo($uploadFile, PATHINFO_EXTENSION));
        
        $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
        if ($check !== false) {
            echo "File is an image - " . $check["mime"] . ".";
            $uploadOk = 1;
        } else {
            echo "File is not an image.";
            $uploadOk = 0;
        }

        // Check if $uploadOk is set to 0 by an error
        if ($uploadOk == 0) {
            echo "Sorry, your file was not uploaded.";
        } else {
            // Try to upload the file
            if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $uploadFile)) {
                echo "The file " . htmlspecialchars(basename($_FILES["fileToUpload"]["name"])) . " has been uploaded.";
            } else {
                echo "Sorry, there was an error uploading your file.";
                $uploadFile = null; // Set photo to null if upload fails
            }
        }
    } else {
        echo "No file uploaded or an error occurred.";
    }

    // Create a new Contact object
    $contact = new Contact($name, $phone, $email, $category, $uploadFile);

    // Save the contact using ContactFunctions
    $contactManager = new ContactManager();
    $contactManager->saveContact($contact);

    header("Location: list_contact.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="StyleSheets/create.css">
    <title>Add Contact</title>
</head>

<body>
    <div class="main">
        <div class="Login-container" id="slide">
            <h2>Create a new contact</h2>
            <form action="create_contact.php" method="post" enctype="multipart/form-data">
                <label for="name">Name:</label>
                <br>
                <input type="text" id="name" name="name" placeholder="John" required>
                <br><br>
                <label for="phone">Phone Number:</label>
                <br>
                <input type="tel" id="phone" name="phone" placeholder="123456789" required>
                <br><br>
                <label for="email">E-mail:</label>
                <br>
                <input type="email" id="email" name="email" placeholder="johndoe@example.com" required>
                <br><br>
                <label for="category">Category:</label>
                <br>
                <input type="text" id="category" name="category" placeholder="e.g Family/Friends">
                <label for="fileToUpload">Contact Image:</label>
                <br>
                <input type="file" id="fileToUpload" name="fileToUpload" accept="image/*">
                <br><br>
                <div class="button">
                    <button type="submit">Create New Contact</button>
                </div>
            </form>
            <div class="image" id="slide"></div>
        </div>
    </div>
</body>

</html>
