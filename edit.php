<?php
require 'Contact.php';
require 'ContactManager.php';

$contactManager = new ContactManager('contacts.json');
$index = $_GET['index'];
$contact = $contactManager->getContact($index);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $phone = $_POST['phone'];
    $category = $_POST['category'];
    $image = $contact->getImage();

    // Handle image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imagePath = 'uploads/' . basename($_FILES['image']['name']);
        move_uploaded_file($_FILES['image']['tmp_name'], $imagePath);
        $image = $imagePath;
    }

    $contact->setName($name);
    $contact->setPhone($phone);
    $contact->setCategory($category);
    $contact->setImage($image);

    $contactManager->updateContact($index, $contact);

    header('Location: details.php?index=' . $index);
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Contact</title>
    <link rel="stylesheet" type="text/css" href="StyleSheets/create.css">
</head>
<body>
    <h1>Edit Contact</h1>
    <?php if ($contact): ?>
        <form method="POST" enctype="multipart/form-data">
            <label>Name: <input type="text" name="name" value="<?php echo $contact->getName(); ?>" required></label><br>
            <label>Phone: <input type="text" name="phone" value="<?php echo $contact->getPhone(); ?>" required></label><br>
            <label>Category: <br>
                <select name="category">
                    <option value="family" <?php echo $contact->getCategory() === 'family' ? 'selected' : ''; ?>>Family</option>
                    <option value="friends" <?php echo $contact->getCategory() === 'friends' ? 'selected' : ''; ?>>Friends</option>
                    <option value="business" <?php echo $contact->getCategory() === 'business' ? 'selected' : ''; ?>>Business</option>
                </select>
            </label><br>
            <label>Image: <input type="file" name="image"></label><br><br>
            <button type="submit">Save Changes</button>
        </form>
    <?php else: ?>
        <p>Contact not found.</p>
    <?php endif; ?> <br><br>
    <a href="index.php">Back to Contact List</a>
</body>
</html>
