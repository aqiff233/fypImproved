version: '3.8'

services:
  php:
    build: .
    ports:
      - "8000:80"
    volumes:
      - .:/var/www/html
    depends_on:
      - db
    environment:
      - DB_HOST=db
      - DB_USER=root  # Or a different user if you create one
      - DB_PASSWORD=password # Use environment variable for password
      - DB_NAME=possiddiqie

  db:
    image: mariadb:10.4.28  # Use MariaDB 10.4.28 image
    command: --default-authentication-plugin=mysql_native_password
    restart: always
    environment:
      MARIADB_ROOT_PASSWORD: password  # Set root password for MariaDB
      MARIADB_DATABASE: possiddiqie            # Creates the database
      # MARIADB_USER: your_app_user            # Optional: Create a non-root user
      # MARIADB_PASSWORD: your_app_password    # Optional: Password for non-root user
    ports:
      - "3306:3306"
    volumes:
      - db_data:/var/lib/mysql
      - ./init.sql:/docker-entrypoint-initdb.d/init.sql

volumes:
  db_data: