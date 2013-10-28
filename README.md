Skully MVC

This is a very simple php MVC framework.

There are already quite a number of frameworks out there. I myself have worked with Zend, Code Igniter, Rails, and Yii frameworks. So why another php framework?

1. Due to the code size of these framework, it was not easy to find out how to do things directly from the code.
2. Searching on forums for solutions was also getting harder especially in the case of Rails, since each update broke its previous versions.
3. Convenient tools in Rails are not readily integrated in other (php) frameworks. For example database migration scripts was not available in Yii, at least at the time I decided to start developing this framework. The same with javascript and css compressor.
4. Curiosity to what caused some performance bottlenecks in the frameworks I have used. By having full control of the entire code I now at least know which part of code may cause them.
5. In the case of Rails, mobility of the app is really low. You cannot expect things to just work simply by copy-pasting the code.

Features:

1. ActiveRecord pattern for models.
2. Javascript compressing tool.
3. Sass / Scss
4. Templating system supported by Smarty. Templates are also completely separated from rest of the project's code. This allows for work division between client and server developers.
5. Support for multiple websites in one project. Configuration files are kept within a shared directory.

Development roadmap:

1. Mocha for Integration testing.
2. PHPUnit for Unit and Functional testing.
3. Documentation tools, perhaps using API Gen.

-----------------------
Documentation & How-Tos
-----------------------

---Cron---
Opens a file that lists all cron jobs, which you can use to create, edit, and delete crons:
crontab -e

Running the cron every 3 minutes:
*/3 * * * * php /basePath/app/crons/base.php siteName.com

base.php will run other crons.

---PHPUnit---
To run php unit via terminal, simply browse to /tests directory, then run:
./phpunit.phar unit/YourTest.php

---JS Packer---
This tool is used to pack your javascsripts into one large compressed file. This is really useful to optimize the speed
of your site.
To use this, open the terminal app, then browse to /tools/jspacker and run:
./pack /YOUR_THEME/packjs.txt
For example: ./pack /default/packjs.txt
Figure out how to pack by looking at that file, it's easy!

---SCSS---
SCSS is basically a CSS syntax on Steroids. You can do some logic, nesting, variables, and inclusion in your css
just like any programming language with this.
To use this, first you need to install compass (gem install compass),
then browse to /themes/YOUR_THEME/resources/scss and run:
compass watch
Then anything you write on site.scss will be converted to css file to use on your site.

---Database Migration / Ruckus---
Database migration tool similar to rails.
To use this, first configure it by editing /tools/configure.php
In that file, change 'online/path' to a path available on your server.
Read ruckusing documentation.

-----------------------
FAQs
-----------------------

---Why does the config stored inside shared/ dir?---
The original idea of this MVC is to allow multiple app with same configurations,
but somehow along the way it deviates from that.
The idea is to have app/, anotherApp/, etc. directories all accessing the shared directory.