// app.js
const express = require('express');
const path = require('path');
const app = express();
const contactsRouter = require('./routes/contacts');

// Middleware
app.use(express.urlencoded({ extended: true }));
app.use(express.json());
app.use(express.static(path.join(__dirname, 'public')));

// Set up EJS as the template engine
app.set('view engine', 'ejs');
app.set('views', path.join(__dirname, 'views'));

// Default route
app.get('/', (req, res) => {
    res.render('index');
});

// Use the contacts routes
app.use('/contacts', contactsRouter);

// Start the server
const PORT = process.env.PORT || 3000;
app.listen(PORT, () => {
    console.log(`Server is running on port ${PORT}`);
});
