ZIMCRAFT - STUDENT PROJECT STARTER
=================================

WHAT YOU NEED
- XAMPP (Apache and MySQL)
- Visual Studio Code
- A web browser (Chrome, Edge or Firefox)

PROJECT FEATURES
1. Home page introducing Zimbabwean handmade crafts.
2. Discover page showing craft-market listings from MySQL.
3. Filters for city and craft type.
4. Market profile page with description, location and opening-hour information.
5. About page explaining the problem and proposed solution.
6. Responsive layout for phones and computers.

INSTALLATION
1. Start XAMPP.
2. Click Start next to Apache and MySQL.
3. Copy the whole "zimcraft_project" folder into:
   C:\xampp\htdocs\
4. Open phpMyAdmin in your browser:
   http://localhost/phpmyadmin
5. Click Import, choose database.sql from this project, then click Import/Go.
6. Open the project in VS Code:
   C:\xampp\htdocs\zimcraft_project
7. Visit:
   http://localhost/zimcraft_project/

DATABASE SETTINGS
The default settings are in includes/db.php:
host = localhost
database = zimcraft_db
username = root
password = blank

If you set a MySQL password in XAMPP, update the password in includes/db.php.

IMPORTANT ABOUT SAMPLE DATA
The market records are demonstration/sample listings for the student prototype.
Before presenting them as verified real-world information, visit/contact the markets
and confirm exact stall locations, opening hours and contact details. Replace sample
records in phpMyAdmin with verified information.

HOW TO ADD A MARKET
1. Open http://localhost/phpmyadmin
2. Select zimcraft_db, then markets.
3. Click Insert.
4. Fill in name, city, craft_type, description, location, opening_hours, contact, icon.
5. Click Go. The new record will appear on discover.php.

HOW THE SYSTEM WORKS (SIMPLE)
- The browser requests a PHP page from Apache.
- PHP connects to MySQL through includes/db.php using PDO.
- The discover page reads market records from the markets table.
- When a visitor chooses a city or craft, PHP uses a prepared SQL query to filter results.
- The visitor clicks a market card and market.php displays that record using its ID.

PAGES
index.php     Home page
discover.php  Database listing and filters
market.php    Single market profile
about.php     Project explanation
includes/     Shared database connection, header and footer
assets/       CSS design and JavaScript

