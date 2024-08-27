<?php
require_once 'ContactManager.php';
$contactManager = new ContactManager();
$result = $contactManager->getAll();

$i = 1;

include 'partials/header.php';

if ($result->num_rows > 0) {
    echo "<div class='top'>";
    echo "<h2>Contact List</h2>";
    echo "<a href='create.php' class='create-link'>Create a New Contact</a>";
    echo "</div>";
    echo "<form action='search.php' method='get' class='search-form'>
                <input type='text' name='query' placeholder='Search Contacts ...' required>
                <button type='submit' class='search'> Search </button>
            </form>";
    echo "<table border='1'>
                <tr>
                    <th>ID</th>
                    <th>Username</th>
                    <th>Phone</th>
                    <th> </th>
                    <th> </th>
                </tr>";
    // Output data of each row
    while ($row = $result->fetch_assoc()) {
        $id = $row["id"];  // Assuming 'id' is the correct column name for the primary key in your database
        echo "<tr>
                    <td>" . $i . "</td>
                    <td><a href='view_details.php?id=" . $id . "' class='name-link'>". $row["contact_Name"] . "</a> </td>
                    <td>" . $row["phone"] . "</td>
                    <td><a href='edit.php?id=" . $id . "' class='btn-link'>Edit</a></td>
                    <td><a href='delete.php?id=" . $id . "' class='btn-link' onclick='return confirm(\"Are you sure you want to delete this contact?\");'>Delete</a></td>
                  </tr>";
        $i++;
    }
    echo "</table>";
} else {
    echo "No results!";
}
include 'partials/footer.php';
