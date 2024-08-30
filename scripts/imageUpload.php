<?php 

    function imageUpload ()  {

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
            
        return $contact_Image;
    }
?>