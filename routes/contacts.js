const express = require('express');
const router = express.Router();

let contacts = []; // In-memory array to store contacts

// Display Contact List (GET)
router.get('/', (req, res) => {
    res.render('contactList', { contacts });  // Make sure the view file is named 'contactList.ejs'
});

// Show form to add a new contact (GET)
router.get('/new', (req, res) => {
    res.render('addContact');  // Ensure 'addContact.ejs' exists
});

// Handle form submission for adding a new contact (POST)
router.post('/', (req, res) => {
    const { name, phone, email } = req.body;
    const newContact = { id: Date.now().toString(), name, phone, email };
    contacts.push(newContact);  // Add new contact to the in-memory array
    res.redirect('/contacts');
});

// Show contact details (GET)
router.get('/:id', (req, res) => {
    const contact = contacts.find(c => c.id === req.params.id);  // Find contact by id
    if (contact) {
        res.render('contactDetails', { contact });  // Render 'contactDetails.ejs'
    } else {
        res.status(404).send('Contact not found');
    }
});

// Show form to edit a contact (GET)
router.get('/:id/edit', (req, res) => {
    const contact = contacts.find(c => c.id === req.params.id);  // Find contact by id
    if (contact) {
        res.render('editContact', { contact });  // Render 'editContact.ejs'
    } else {
        res.status(404).send('Contact not found');
    }
});

// Handle form submission for editing a contact (POST)
router.post('/:id/edit', (req, res) => {
    const contact = contacts.find(c => c.id === req.params.id);  // Find contact by id
    if (contact) {
        contact.name = req.body.name;  // Update contact info
        contact.phone = req.body.phone;
        contact.email = req.body.email;
        res.redirect(`/contacts/${contact.id}`);
    } else {
        res.status(404).send('Contact not found');
    }
});

// Handle contact deletion (POST)
router.post('/:id/delete', (req, res) => {
    contacts = contacts.filter(c => c.id !== req.params.id);  // Remove contact from array
    res.redirect('/contacts');
});

module.exports = router;
