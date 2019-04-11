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
    ```php
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
