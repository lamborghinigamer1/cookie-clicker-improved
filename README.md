# Cookie clicker improved

It's just cookie clicker with accounts and a database. That's it.

# How do I host this?

You need Apache, PHP and MariaDB(Or any database software that supports PDO).

First you put all the files in the root of your website.

Then you import from the folder ```database/import.sql``` inside of MariaDB.

Next you make an account in Mariadb and an password and edit the file connect.php to match your credentials.

Make sure to edit your host like this: ```mysql:host=yourURL;```.

And then you should be able to make an account and host cookie clicker improved!
