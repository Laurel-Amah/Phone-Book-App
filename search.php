<?php 
    require_once 'ContactManager.php';

    if (isset($_GET['query'])) {
        $query = $_GET['query'];
        $contactManager = new ContactManager();
        $contacts = $contactManager->searchContacts($query);
    } else {
        echo "No search query provided!";
        exit;
    }

    include 'partials/header.php'
?>

<section>
    <h2>Search Results for "<?php echo htmlspecialchars($query); ?>"</h2>

    <?php if (empty($contacts)): ?>
        <p> No contacts Found. </p>
    <?php else: ?>
        <ul>
        <?php foreach ($contacts as $contact): ?>
                <li>
                    <a href="view_details.php?id=<?php echo $contact['id']; ?>">
                        <?php echo htmlspecialchars($contact['contact_Name']); ?>
                    </a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</section>

<?php include 'partials/footer.php'; ?>
</section>