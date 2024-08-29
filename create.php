<?php 
    require_once 'ContactManager.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $contact_Name = trim($_POST['contact_Name']);
        $phone = trim($_POST['phone']);
        $email = trim($_POST['email']);
        $category = $_POST['category'];
        $contact_Image = '';

        // Handling Image uploads
        if (isset($_FILES['contact_Image']) && $_FILES['contact_Image']['error'] === UPLOAD_ERR_OK) {

            $uploadDir = 'uploads/';

            // Create an upload directory if there is none
            if (!is_dir($uploadDir)) {
                mkdir($uploadDir, 0755, true);
            }
            $fileTmpPath = $_FILES['contact_Image']['tmp_name'];
            // Extract original file name of uploaded file
            $fileName = basename($_FILES['contact_Image']['name']);
            // Store file size in bytes
            $fileSize = $_FILES['contact_Image']['size'];
            // Store MIME type - format of the file
            $fileType = $_FILES['contact_Image']['type'];
            // Extract file extension and convert it to lowercase
            $fileExtension = strtolower(pathinfo($fileName, PATHINFO_EXTENSION));
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif'];

            // Check if extension is in array of allowed extensions
            if (in_array($fileExtension, $allowedExtensions)) {
                // Generate a unique filename for uploaded file and append file extension
                $newFileName = uniqid('contact_', true) . '.' . $fileExtension;
                // Construct final destination for uploaded file.
                $destPath = $uploadDir . $newFileName;
                
                // Move uploaded file from temporary location to destination path
                if (move_uploaded_file($fileTmpPath, $destPath)) {
                    $contact_Image = $destPath;
                } else {
                    $error = 'Error moving the uploaded file.';
                }
            } else {
                $error = 'Invalid file type. Allowed types: ' . implode(', ', $allowedExtensions);
            }
        }
        //$phone = validatePhone($phone1);
        //$email = validateEmail($email2);

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
        <input type="file" id="contact_Image" name="contact_Image" accept="image/*" />

        <div class="form-actions">
            <button type="submit" class="button">Save Contact</button>
            <a href="index.php" class="button">Cancel</a>
        </div>

    </form>

    <script src="validate.js"></script>

</section>

<?php include 'partials/footer.php'; ?>