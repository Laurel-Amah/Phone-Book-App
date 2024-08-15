<?php

class ContactManager {
    private $contacts = [];
    private $filePath = 'contacts.json';

    public function __construct() {
        $this->loadContacts();
    }

    private function loadContacts() {
        if (file_exists($this->filePath)) {
            $data = json_decode(file_get_contents($this->filePath), true);
            foreach ($data as $item) {
                $this->contacts[] = new Contact($item['id'], $item['name'], $item['phone'], $item['category'], $item['image']);
            }
        }
    }

    public function getAllContacts() {
        return $this->contacts;
    }

    public function getContactById($id) {
        foreach ($this->contacts as $contact) {
            if ($contact->getId() == $id) {
                return $contact;
            }
        }
        return null;
    }

    public function saveContact(Contact $contact) {
        if ($contact->getId() === null) {
            $contactId = end($this->contacts) ? end($this->contacts)->getId() + 1 : 1;
            $contact = new Contact($contactId, $contact->getName(), $contact->getPhone(), $contact->getCategory(), $contact->getPhoto());
            $this->contacts[] = $contact;
        } else {
            foreach ($this->contacts as &$c) {
                if ($c->getId() == $contact->getId()) {
                    $c->setName($contact->getName());
                    $c->setPhone($contact->getPhone());
                    $c->setCategory($contact->getCategory());
                    $c->setPhoto($contact->getPhoto());
                }
            }
        }
        $this->saveContactsToFile();
    }

    public function deleteContact($id) {
        $this->contacts = array_filter($this->contacts, function($contact) use ($id) {
            return $contact->getId() != $id;
        });
        $this->saveContactsToFile();
    }

    private function saveContactsToFile() {
        $data = array_map(function($contact) {
            return [
                'id' => $contact->getId(),
                'name' => $contact->getName(),
                'phone' => $contact->getPhone(),
                'category' => $contact->getCategory(),
                'photo' => $contact->getphoto(),
            ];
        }, $this->contacts);
        file_put_contents($this->filePath, json_encode($data));
    }
}
?>
