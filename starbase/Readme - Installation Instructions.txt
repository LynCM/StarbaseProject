Greetings! Welcome to the Project Starbase Installation Instructions. This will be divided into a number of steps:

Step 1:
	Install the Appserv system from https://www.appserv.org/en/. 
	Make sure to utilize the following:
	Apache HTTP Server Information:
		Server Name: localhost
		Apache HTTP Port: 80
		Root password: pancakes
	Else the program will not work!
	
Step 2:
	Install MySQLFront from http://www.mysqlfront.de/ for ease of installing the database DDL.

Step 3: 
	Using MySQLFront (http://www.mysqlfront.de/), do the following:  
	In the open connection box, hit new connection.
	Use the following information:
		Name: localhost
		Host: localhost
		Port: 3306
		Connection Type: Built-In
		User: root
		Password: pancakes
		Database: "starbase" (if avaliable, if not, leave it blank for now)
	Click on 'localhost' in the left bar
	Go to file -> import -> import SQL file
	Select the starbasedata.sql file provided with this software. 
	It should load in now.
	
Step 4: Copy the provided starbase files to your Appserv/www/ folder.
	From the windows search bar, type in MySQL Run. You should be able to run MySQL in this fashion, booting up the database.
	From an internet browser, type in localhost/starbase/login.php to run the application. That's it!
	
We hope you have a great time with the Project Starbase system!