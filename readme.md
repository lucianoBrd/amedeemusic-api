# Generating a Password for the Admin User

We won't develop a dedicated system to create admin accounts. Again, we will only ever have one admin. The login will be admin and we need to generate the password hash.

Select App\Entity\Admin and then choose whatever you like as a password and run the following command to generate the password hash:
``` symfony console security:hash-password ```

Example:
```
Symfony Password Hash Utility
=============================

 Type in your password to be hashed:
 >

 ------------------ ---------------------------------------------------------------------------------------------------
  Key                Value
 ------------------ ---------------------------------------------------------------------------------------------------
  Hasher used        Symfony\Component\PasswordHasher\Hasher\MigratingPasswordHasher
  Password hash      $2y$13$VYJTCiNGgoZbWgI0fB7HUeug6TSroYEGqXoLUqfzqqfcSxC63MY0.
 ------------------ ---------------------------------------------------------------------------------------------------

 ! [NOTE] Self-salting hasher used: the hasher generated its own built-in salt.


 [OK] Password hashing succeeded
```

# Creating an Admin
Insert the admin user via an SQL statement:
```
INSERT INTO admin (username, roles, password) VALUES ('admin', '[\"ROLE_ADMIN\"]', '\$2y\$13\$VYJTCiNGgoZbWgI0fB7HUeug6TSroYEGqXoLUqfzqqfcSxC63MY0.')
```