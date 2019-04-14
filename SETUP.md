# Setup Instructions

Here are some instructions for setting up this repository to run locally. Hopefully these are helpful.

1. Install PHP, MySQL, and a web server
    - the easiest/most common way to do this is using [XAMPP](https://www.apachefriends.org/index.html)
    - personally I use something called [DevilBox](http://devilbox.org/) but that's more complicated to set up
1. Set up the database tables
    - there is a `tables.sql` file in the repository that you should be able to run to create all of the tables this project expects to exist
1. Copy/Move the files into the directory the web server will look for them in
    - Find where that folder is on your computer and put the repo files in there
      - if you aren't sure check the documentation for XAMPP (or whatever you're using)
    - Make sure that index.php is directly inside the `htdocs` folder and not buried another folder
      - I renamed the `framed-website` folder to `htdocs` to avoid this issue
1. Set the configuration variables
    - this project is expecting some configuration variables to be set with info about the database you are using in a file called `env.php` which I didn't include in this repo for security reasons
    - create a new file called `env.php` in the folder called `partials` and copy the following into it and change the strings to match your database settings:
    ``` php
    <?php
      $_ENV['SERVER_ROOT'] = ""; // you can leave this empty unless the project is being hosted from a subfolder of the server
      $_ENV['DB_HOSTNAME'] = "localhost"; // set this string to the hostname or location of you database, if you are running it locally it will probably be "localhost"
      $_ENV['DB_USERNAME'] = ""; // this is the username for the database account
      $_ENV['DB_PASSWORD'] = ""; // this is the password for the database account
      $_ENV['DB_DATABASE'] = ""; // this is the name of the database you are using
    ?>
    ```
5. Run the server
    - start the server and navigate to the server in your browser
      - probably http://localhost unless your server is running on a different port
1. Create an account for yourself
    - click the Register button in the menu bar
    - fill out all the fields to make yourself an account
1. Make your account an Administrator
    - making yourself an Administrator allows you to access the Admin panel where you can:
      - add and edit store items
      - view orders made by other users
    - to do this you have to manually change your account's `role` in the MySQL database
      - Find your account in the `FramedUsers` table and change the *role* value from `User` to `Admin`
    - you should now have access to the admin panel which should show up in the dropdown when you click on your username in the menu bar
1. Add some items to the store
    - go to the admin panel (/admin/ or click Admin in dropdown in the menu bar)
    - click the pencil icon to go to the page to create and edit items
    - click the green + to add an item
    - fill out all the item info
      - for *Image URL* you can either use an image from a website like [Unsplash](https://source.unsplash.com/), or put your own images into a folder on the server and put the link to that image in the box
        - if the image is linked correctly a preview should appear when you hover over the *Image URL* field
        - *there is no way to directly upload an image from here and the images are not directly stored in the database*
