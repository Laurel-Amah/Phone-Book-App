<?php 
    require_once 'ContactManager.php';
    require_once 'scripts/imageUpload.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $contact_Name = trim($_POST['contact_Name']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $category = $_POST['category'];
        $contact_Image = '';

        // Handling Image uploads
        if (isset($_FILES['contact_Image']) && $_FILES['contact_Image']['error'] === UPLOAD_ERR_OK) {
            $contact_Image = imageUpload();  
        }

        $contactManager = new ContactManager();
        $contactManager->createContact($contact_Name, $phone, $email, $category, $contact_Image);
     
        header('Location: index.php');
        exit;
    }
?>

<?php include 'partials/header.php'?>

<section>
<h2>Add New Contact</h2>
    <form method="post" enctype="multipart/form-data" class="contact-form">
            
        <label for="contact_Name">Name </label>
        <input type="text" id="contact_Name" name="contact_Name" placeholder="e.g. John Doe" required />

        <label for="phone">Phone Number </label>
        <input type="tel" id="phone" name="phone" placeholder="e.g. +123 456-789-101" required/>
        <span id="phoneError" class="error"></span><br><br>
    
        <label for="email">Email </label>
        <input type="email" id="email" name="email" placeholder="e.g. johndoe@example.com" required/>
        <span id="emailError" class="error"></span><br><br>
        
        <label for="category">Category </label>
        <select id="category" name="category" required>
            <option value="family">Family</option>
            <option value="friends">Friends</option>
            <option value="business">Business</option>
        </select>

        <label for="contact_Image">Photo </label>
        <input type="file" id="contact_Image" name="contact_Image" accept="image/*" onchange="previewImage(event)" /> <br><br>

        <img id="imagePreview" class="preview" alt="Image Preview"><br>

        <div class="form-actions">
            <button type="submit" class="button">Save Contact</button>
            <a href="index.php" class="button">Cancel</a>
        </div>

    </form>

    <script src="scripts/validate.js"></script>
    <script src="scripts/image_preview.js"></script>

</section>

<?php include 'partials/footer.php'; ?>