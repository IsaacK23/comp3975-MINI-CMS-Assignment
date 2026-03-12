# comp3975-MINI-CMS-Assignment

## 1. Setup

Start the full app with Docker Compose:

    docker compose up --build

Then open:

    http://localhost:8888

The PHP app and MariaDB database are both started by Compose. The app creates the database tables automatically on first load.

#### Default credentials:

    Username: a@a.a
    Password: P@$$w0rd

## 2. Project Description
An article hosting app with a PHP backend using MariaDB as storage.

## 3. Technologies Used

### Front-End  

### Back-End
- PHP
- MYSQL

### Other Tech Tools
- Quill


## 4. Project Structure
```
MINI-CMS/
├── docker-compose.yml
├── README.md
└── src
    ├── css 
        ├── style.css
    ├── crud
    │   ├── create
    │   │   ├── create.php
    │   │   └── process_create.php
    │   ├── delete
    │   │   ├── delete.php
    │   │   └── process_delete.php
    │   ├── display
    │   │   └── display.php
    │   └── update
    │       ├── process_update.php
    │       └── update.php
    ├── index_db_params.php
    ├── index.php
    ├── login_process.php
    ├── login.php
    ├── setup.php
    └── utils.php
```
