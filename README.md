Skully MVC

This is a php MVC framework I have developed myself.

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
