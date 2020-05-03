=================================
Following tables need to be created:

create table users(
    Name varchar(40) NOT NULL, 
    Password varchar(40) NOT NULL, 
    userType ENUM('admin','user'), 
    PRIMARY KEY(Name,Password)
    )

CREATE TABLE shoppingcart(
    ID int AUTO_INCREMENT PRIMARY KEY, 
    Name varchar(50) NOT NULL, 
    Image varchar(50) NOT NULL, 
    Price int NOT NULL
    itemType ENUM('Wired', 'Wireless', 'Accessories') NOT NULL
    )

CREATE TABLE Transactions(
userName varchar(50),
purchaseData varchar(1000),
purchaseDate datetime
)

===============================================================================================
In home.php your images will not load if you decide to break the current folder hierarchy
you might need to replace the following line appropriately in line number 76:
http://localhost/sal/cart/assests/img/ 
===============================================================================================
Create an admin account from phpmysql in order to be able to create admin access

Admin access account cannot be registered like user account

In order to login to admin access to upload image:
go to following link:
http://localhost/sal/cart/admin.php
=============================================


