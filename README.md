# A Simple Calendar App

A basic full-stack calendar application built with PHP, MySQL, HTML, CSS and JavaScript. It provides CRUD operations for calendar events and is designed to run on a local LAMP (Windows/XAMPP) or similar environment.

<img width="1920" height="1080" alt="calendar_mockup" src="https://github.com/user-attachments/assets/cc0d8ec3-e095-4fea-89b9-1385fc685ac0" />

**Features**
- Add, edit and delete calendar events
- Persist events in MySQL database
- Dynamic, responsive calendar UI powered by JavaScript
- Minimal, easy-to-read PHP backend for actions and data access

**Tech Stack**
- Backend: PHP
- Database: MySQL
- Frontend: HTML, CSS (Tailwind CSS 4 + daisyUI 5), JavaScript
- Tested on: XAMPP (Apache + MySQL)

**Repository Structure**
- `actions/` : PHP endpoints (`add_action.php`, `edit_action.php`, `delete_action.php`, `calendar_data.php`)
- `assets/` : Frontend assets (`script.js`, `style.css`, images)
- `database/` : Database schema (`calendar_db.sql`) and (`db_connection.php`)
- `public/` : Public-facing page (`calendar.php`)
- `README.md` : This file

**Installation**
1. Install XAMPP (or other PHP + MySQL environment) and start Apache + MySQL.
2. Place the project folder in your web root (for XAMPP: `c:\xampp\htdocs\`).
3. Create the database:
	- Import `database/calendar_db.sql` into MySQL (using phpMyAdmin or the `mysql` CLI).
4. Update DB connection:
	- Edit `database/db_connection.php` with your MySQL credentials (host, username, password, database).
5. Open the application in your browser:
	- Visit `http://localhost/A_Full_Stack_Calendar_App/public/calendar.php`

**Usage**
- Add events using the calendar UI. Events are stored in the MySQL database and can be edited or removed.
- The frontend calls the PHP endpoints in `actions/` to perform CRUD operations.

**Developing & Testing**
- Modify frontend files in `assets/` and server logic in `actions/`.
- CSS uses Tailwind + daisyUI. Edit `assets/input.css`, then build:
  - `npm install` (first time only)
  - `npm run build:css` (compile to `assets/style.css`)
  - `npm run watch:css` (rebuild on save while developing)
- To reset sample data, re-import `database/calendar_db.sql`.

**Notes**
- Ensure `db_connection.php` credentials match your environment.
- Make sure Apache has write/read access if you store uploads or images.

**License**
- This project is released under the MIT License. Modify as needed.
