**Phone Book Application**

This project is a simple PHP-based phone book web application that allows users to manage their contacts. The app utilizes JSON files for data storage and is built using Object-Oriented Programming (OOP) principles in PHP.

**Features**

Create Contact: Add a new contact with a name, phone number, category (Family, Friends, Business), and an image.
View Contacts: See a list of all contacts with basic details.
Contact Details: View detailed information about a specific contact.
Edit Contact: Update the details of an existing contact.
Delete Contact: Remove a contact from the phone book.

**Project Structure**

/

├── index.php       &emsp; &emsp;      # Landing page displaying the list of contacts

├── create.php    &emsp; &emsp;         # Page for creating a new contact

├── edit.php       &emsp; &emsp;        # Page for editing an existing contact

├── details.php     &emsp; &emsp;       # Page for viewing details of a contact

├── delete.php     &emsp; &emsp;        # Script to handle contact deletion

├── Contact.php     &emsp; &emsp;       # Contact class definition

├── ContactManager.php  &emsp; &emsp;   # Class for managing contacts (CRUD operations)

├── contacts.json    &emsp; &emsp;      # JSON file storing contacts data

├── StyleSheets

&emsp; &emsp; └── styles.css     &emsp; &emsp;         # Stylesheet
 
├── uploads/		&emsp; &emsp; 		# Folder to store uploaded Images

└── README.md        &emsp; &emsp;      # Project documentation

**Assumptions**

The app assumes that each contact will have a unique combination of name and phone number.
The images uploaded by users are stored directly in the uploads/ directory. No further image processing or validation is done beyond file upload.
