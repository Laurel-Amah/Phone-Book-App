<?php 
    require_once 'ContactManager.php';
    require_once 'scripts/imageUpload.php';

    if (isset($_GET['id'])) {
    $contactId = $_GET['id'];
    $contactManager = new ContactManager();
    $contact = $contactManager->getContactById($contactId);


        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $contact_Name = $_POST['contact_Name'];
            $phone = $_POST['phone'];
            $email = $_POST['email'];
            $category = $_POST['category'];
            $contact_Image = '';

            // Handling Image uploads
            if (isset($_FILES['contact_Image']) && $_FILES['contact_Image']['error'] === UPLOAD_ERR_OK) {
                $contact_Image = imageUpload();
            }

            $contactManager->editContact($contactId, $contact_Name, $phone, $email, $category, $contact_Image);
       
        }      
       // header('Location: index.php');
        //exit;
        
    } else {
        echo "No contact ID provided!";
    }
?>

<?php include 'partials/header.php'?>

<section>
<h2>Add New Contact</h2>
    <form action="edit.php?id=<?php echo $contactId; ?>" method="post" enctype="multipart/form-data" class="contact-form">
            
        <label for="contact_Name">Name: </label>
        <input type="text" id="contact_Name" name="contact_Name" value="<?php echo htmlspecialchars($contact['contact_Name']); ?>" />

        <label for="phone">Phone Number: </label>
        <input type="tel" id="phone" name="phone" value ="<?php echo htmlspecialchars($contact['phone']); ?>" />
        <span id="phoneError" class="error"></span><br><br>

        <label for="email">Email: </label>
        <input type="email" id="email" name="email" value ="<?php echo htmlspecialchars($contact['email']); ?>"/>
        <span id="emailError" class="error"></span><br><br>

        <label for="category">Category: </label>
        <select id="category" name="category" required>
            <option value="family" <?php if($contact['category'] == 'family') echo 'selected'; ?>>Family</option>
            <option value="friends" <?php if($contact['category'] == 'friends') echo 'selected'; ?>>Friends</option>
            <option value="business" <?php if($contact['category'] == 'business') echo 'selected'; ?>>Business</option>
        </select>

        <label for="contact_Image">Photo </label>
        <input type="file" id="contact_Image" name="contact_Image" accept="image/*" onchange="previewImage(event)" /> <br><br>

        <img id="imagePreview" class="preview" alt="Image Preview"><br>

        <div class="form-actions">
            <button type="submit" class="button">Update Contact</button>
            <a href="index.php" class="button">Cancel</a>
        </div>

    </form>

    <script src="scripts/validate.js"></script>
    <script src="scripts/image_preview.js"></script>

</section>

<?php include 'partials/footer.php'; ?>