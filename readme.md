# Subscription project

## Herd installation
For installation and exposure I used Laravel's Herd application
- Install Laravel Herd
- Pick your stack versions, I used the following
  - PHP 8.4.17
  - Node 22.22.0

Note: Laravel Herd does not include MySQL, please install it separately.

## Pull in the GIT repository
Find the public repository at https://github.com/RoelvanLierop/subservice, this will have all the files you need.
The process described is for OSX. If you use windows, please follow your usual workflow for cloning git projects.

- Start terminal (OSX)
- Navigate to Herd's project directory
- use GIT Clone to get the project files:
  - *git clone https://github.com/RoelvanLierop/subservice.git*
  - Check out the dev branch by using the following command: *git checkout dev*.  
If you are already on dev, this will throw a error, that's fine!

## Check Herd
At this point it's a good idea to check if Herd saw the project.  
From the top bar, click on the Herd logo and navigate to "Sites".  
This will show you the Sites, their URL (in my case *subservice.test*) and the configuration used.  
If not configure yet, you can set the PHP and Node versions to the available (or needed) ones.

## Laravel time!
I use PHPStorm for the rest of the process but you can use any editor and a terminal window.  
In the terminal, navigate to your project's base directory
- *cd ~/Herd/subservice*

As you might suspect (and any good Laravel dev will), the .env file is missing, please use the one provided by the project's author.

Start the MySQL server, this may be different from your own environment, in Terminal:
- */usr/local/mysql/support-files/mysql.server start*

Create a Schema called "subservice", and add a user to it
- *CREATE SCHEMA subservice;*
- *CREATE USER ss_administrator@localhost IDENTIFIED BY 'qcz654bHEr5G48WS';*
- _GRANT ALL PRIVILEGES ON subservice.* TO 'ss_administrator'@'localhost' IDENTIFIED BY 'qcz654bHEr5G48WS' WITH GRANT OPTION;_

Ofcourse you can do this just as easily in your own UI.

From there, run the following:
- *composer install*
- *npm -i*
- *php artisan key:generate*

Congratulations, your project should be accessible by browser at http://subservice.test/

---
# Cashier

Publish the Cashier Migrations and Config
- *php artisan vendor:publish --tag="cashier-migrations"*
- *php artisan vendor:publish --tag="cashier-config"*

Link it together by running the migrations
- *php artisan migrate*

(optional) Preferably we rebuild the config cache now
- *php artisan config:cache*
