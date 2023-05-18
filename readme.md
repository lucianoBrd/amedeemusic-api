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

# Deploy app
```
cd ~
git clone git@github.com:lucianoBrd/amedeemusic-api.git
cd amedeemusic-api
touch .env.local
nano .env.local
    APP_ENV=prod
    APP_SECRET=1cb2df40a8863fc2b3f538ca9ca88ee2
    MAILER_DSN=gmail://USERNAME:PASSWORD@default
    RECAPTCHA_PRIVATE_KEY='6LfeQhwmAAAAAGr3-kAmtNJioxzF4GHdxrpiajJY'
    DATABASE_URL=mysql://amedeeapi:@amedeenapi.mysql.db:3306/amedeeapi?serverVersion=5.7
    CORS_ALLOW_ORIGIN='^https?://(www.amedeemusic.com|amedeemusic.com)?$'
composer install --no-dev --optimize-autoloader
php bin/console doctrine:migrations:migrate
```