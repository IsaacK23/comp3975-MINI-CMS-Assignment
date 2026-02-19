# comp3975-MINI-CMS-Assignment

## 1. Setup

Run the server first by entering these commands in the terminal:

### 1. Start the database

Create and start a MariaDB container in docker.

    docker run -d \
    --name mariadb \
    -p 3333:3306 \
    -e MYSQL_ROOT_PASSWORD=secret \
    -e MYSQL_DATABASE=CMSDB \
    mariadb:10.7.3

NOTE: if a container is already running on mariadb then remove the old container with the command: 

    docker rm -f mariadb

Then run the commands again from the first part. 

### 2. Seed the database

After it has successfully started, set up the database by running the setup.php file

    php src/setup.php


### 3. Start a local instance

Start your localhost from the src/ file.

    php -S localhost:8888 -t src/

### 4. Open the app

Visit: http://localhost:8888 in your browser.

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
