<?php

require 'Contact.php';

class ContactManager{
    private $file;

    public function __construct($file) {
        $this->file = $file;
    }

    // Load contacts from the JSON file
    public function loadContacts() {
        if (file_exists($this->file)) {
            $json = file_get_contents($this->file);
            $contactsArray = json_decode($json, true);
            $contacts = [];

            foreach ($contactsArray as $contactData) {
                $contacts[] = new Contact(
                    $contactData['name'],
                    $contactData['phone'],
                    $contactData['email'],
                    $contactData['category'],
                    $contactData['image']
                );
            }

            return $contacts;
        }

        return [];
    }

    // Save contacts to the JSON file
    public function saveContacts($contacts) {
        $contactsArray = array_map(function($contact) {
            return $contact->toArray();
        }, $contacts);

        file_put_contents($this->file, json_encode($contactsArray, JSON_PRETTY_PRINT));
    }

    // Add a new contact
    public function addContact($contact) {
        $contacts = $this->loadContacts();
        $contacts[] = $contact;
        $this->saveContacts($contacts);
    }

    // Update an existing contact
    public function updateContact($index, $contact) {
        $contacts = $this->loadContacts();
        if (isset($contacts[$index])) {
            $contacts[$index] = $contact;
            $this->saveContacts($contacts);
        }
    }

    // Delete a contact
    public function deleteContact($index) {
        $contacts = $this->loadContacts();
        if (isset($contacts[$index])) {
            unset($contacts[$index]);
            $this->saveContacts(array_values($contacts));
        }
    }

    // Get a single contact by index
    public function getContact($index) {
        $contacts = $this->loadContacts();
        return isset($contacts[$index]) ? $contacts[$index] : null;
    }
}
?>
