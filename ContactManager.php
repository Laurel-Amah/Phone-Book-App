<?php
    require_once 'Contact.php';
    require_once 'database.php';

    class ContactManager {
        private $conn;
        //public $result;

        public function __construct()
        {
            $this->connect_Database();
        }

        private function connect_Database() {
            $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASSWORD, DB_NAME);
            
            if ($this->conn->connect_error) {
                die("Connection Failed!". $this->conn->connect_error);
            }
        }

        public function createContact($contact_Name, $phone, $email, $category, $contact_Image) {
            $stmt = $this->conn->prepare("INSERT INTO Contacts (contact_Name, phone, email, category, contact_Image) VALUES (?, ?, ?, ?, ?)");
            $stmt->bind_param('sssss', $contact_Name, $phone, $email, $category, $contact_Image);

           // $stmt->execute();

            if (!$stmt->execute()) {
                die("Contact NOT created!" . $stmt->error);
            } else {
                echo "Contact created Successfully";
            }
            $stmt->close();
        }

        public function getContactById($id) {
           /* $contact_Name = '';
            $phone ='';
            $email = '';
            $category = '';
            $contact_Image = ''; */

            $stmt = $this->conn->prepare("SELECT * FROM Contacts WHERE id = ? ");
            $stmt->bind_param('i', $id);
            
            $stmt->execute();

            // Binding the resulting variables
            $result = $stmt->get_result();
            $contact = $result->fetch_assoc();
            $stmt->close();

            return $contact;
        }

        public function getAll() {
           /* $contact_Name = '';
            $phone =''; */

            $stmt = $this->conn->prepare("SELECT id, contact_Name, phone FROM Contacts  ORDER BY contact_Name ASC");
            $stmt->execute();

            $result = $stmt->get_result();
            
            return $result;
        }

        public function editContact($id, $contact_Name, $phone, $email, $category, $contact_Image) {
            // First, check if $contact_Image is empty. If it is, retain the old image.
            if (empty($contact_Image)) {
                // Retrieve the current image from the database
                $stmt = $this->conn->prepare("SELECT contact_Image FROM Contacts WHERE id = ?");
                $stmt->bind_param('i', $id);
                $stmt->execute();
                $result = $stmt->get_result();
                $row = $result->fetch_assoc();
                $contact_Image = $row['contact_Image']; // Retain the existing image
                $stmt->close();
            }
        
            // Prepare the update statement
            $stmt = $this->conn->prepare("UPDATE Contacts SET contact_Name = ?, phone = ?, email = ?, category = ?, contact_Image = ? WHERE id = ?");
            $stmt->bind_param('sssssi', $contact_Name, $phone, $email, $category, $contact_Image, $id);
        
            // Execute the statement
            if ($stmt->execute()) {
                echo "Contact edited Successfully";
                // Redirect to view_details page after successful update
                header("Location: view_details.php?id=" . $id);
                exit(); // Ensure the script stops executing after the redirect

            } else {
                // To handle errors more gracefully
                error_log("Failed to edit contact: " . $stmt->error);
                echo "An error occurred while editing the contact. Please try again later.";
            }
        
            // Close the statement
            $stmt->close();
        }
        

        public function deleteContact($id){
            $stmt = $this->conn->prepare("DELETE FROM Contacts WHERE id = ?");
            $stmt->bind_param('i', $id);

            $stmt->execute();

            if (!$stmt->execute()) {
                die("Contact NOT Deleted" . $stmt->error);
            } else {
                echo "Contact Deleted Successfully ! <br><br><br>";
            }
            $stmt->close();
        }

        public function searchContacts($query) {
            // Preparing query for search
            $query = "%". $query . "%";
            $stmt = $this->conn->prepare("SELECT * FROM Contacts WHERE contact_Name LIKE ? OR phone LIKE ? OR email LIKE ?");
            $stmt->bind_param("sss", $query, $query, $query);
            $stmt->execute();
            $result = $stmt->get_result();

            $contacts = [];
            while ($row = $result->fetch_assoc()) {
                $contacts[] = $row;
            }

            $stmt->close();
            return $contacts;
        }

        public function __destruct()
        {
           $this->conn->close(); 
        }
    }
?>