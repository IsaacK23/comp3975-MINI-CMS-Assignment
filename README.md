# comp3975-MINI-CMS-Assignment

Run the server first by entering these commands in the terminal.

docker run -d \
  --name mariadb \
  -p 3333:3306 \
  -e MYSQL_ROOT_PASSWORD=secret \
  -e MYSQL_DATABASE=CMSDB \
  mariadb:10.7.3

NOTE: if a container is already running on mariadb then remove the old container with the command: 

docker rm -f mariadb

Then run the commands again from the first part. 

After it has successfully started, you will enter this into terminal: 
php -S localhost:8888 

## 1. Project Title
**Comp3975 Assignment**

## 2. Project Description

## 3. Technologies Used

### Front-End
- React  

### Back-End
