## Customer Registration

* Personal Information = tbl_customer_general_info
* Account Information = tbl_account
* Tax Information = tbl_customer_tax


Transaction


beginTransaction()

insert into tbl_customer_general_info  = done
insert into tbl_account - error
insert into tbl_customer_tax

commit();

rollback()


```php

    $connection = new Database();

    $connection->beginTransaction();

    try {

        insert into tbl_customer_general_info  = done
        insert into tbl_account - error
        insert into tbl_customer_tax

    $connection->commit();

    }
    catch(){
        $connection->rollback();
    }
```


## ACID

ACID is all about transaction

* A = Atomicity
* C = Consistency
* I = Isolation
* D = Durability


Balance = 500;

```php
    $con->beginTransaction();
    $debit = 300;
    $credit = 400;
    $con->commit();
```


## Project User Table

* Customer Account
    - id
    - name
    - email
    - password
    - created_at
    - status
* Admin Account
    - id
    - name
    - email
    - password
    - created_at
    - status

* `tbl_users`
    - id - int(10) PK Auto Increment
    - name - varchar(100)
    - email - varchar(50) unique
    - password - varchar(150)
    - user_type enum(Admin,Customer)  default Customer
    - is_superadmin boolean default false
    - status enum(active,inactive) default active
    - created_at Timestamp default CURRENT_TIMESTAMP
    - updated_at Timestamp null on update CURRENT_TIMESTAMP


```sql
    CREATE TABLE IF NOT EXISTS `users`(
    `id` int(10) NOT NULL AUTO_INCREMENT,
    `name` varchar(100) NOT NULL,
    `email` varchar(50) NOT NULL,
    `password` varchar(150) NOT NULL,
    `user_type` enum('ADMIN','CUSTOMER') DEFAULT 'CUSTOMER',
    `is_superadmin` boolean DEFAULT FALSE,
    `status` enum('ACTIVE','INACTIVE') DEFAULT 'ACTIVE',
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP NULL ON UPDATE CURRENT_TIMESTAMP,

    PRIMARY KEY (`id`),
    UNIQUE KEY `users_email_uk` (`email`)
);
```

