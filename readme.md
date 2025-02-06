This project is a Manager Dashboard . It allows managers to oversee and manage teams, assign leaders, track tasks, and handle various administrative functions. The system is built using PHP and follows an organized directory structure for easy maintenance and scalability.

Project Structure
MANAGER_DASHBOARD/
│── actions/ # Contains all action-based scripts (e.g., add, update, delete)
│── config/ # Configuration files, including database connection
│ ├── db.php # Database connection script
│── includes/ # Common UI components
│ ├── header.php # Header template
│ ├── sidebar.php # Sidebar template
│── pages/ # Dashboard pages for different functionalities
│ ├── add_team.php # Add new team members to a project functionality
│ ├── assign_leader.php # Assign leaders to teams
│ ├── assign_users.php # Assign users to different teams
│ ├── dashboard.php # Main dashboard page
│ ├── edit_user.php # Edit user details
│ ├── knowledge.php # Knowledge management page
│ ├── notifications.php # Notification management
│ ├── projects.php # Project management
│ ├── skills.php # Skill management
│ ├── tags.php # Tagging system
│ ├── tasks.php # Task management
│ ├── todo.php # To-Do list feature
│ ├── users.php # User management
│── public/ # Publicly accessible scripts
│ ├── login.php # Login script
│ ├── register_user.php # User registration script
│── team020.sql # Database schema and seed data

Tags Management (Admin Integration)

tags.php: Displays all tags in the admin panel. It includes db.php, header.php, and sidebar.php but should be customized based on the admin panel integration.
add_tag.php (inside actions/): Adds new tags to the database.
update_tag.php (inside actions/): Updates existing tags.
delete_tag.php (inside actions/): Deletes tags from the database.

This project was developed using WampServer 3.3.2 - 64bit with the following stack:

- Apache 2.4.58

- PHP 8.2.13

- MySQL 8.2.0

- MariaDB 11.2.2

🛠️ Setup Instructions

1️⃣ Database Configuration

Import the team020.sql file into your MySQL database.

Modify config/db.php with your database credentials.

2️⃣ Admin Login Credentials

The default admin credentials are pre-inserted into the database.

Email

Password

admin1@make-it-all.com

password

admin2@make-it-all.com

password

admin3@make-it-all.com

password

admin4@make-it-all.com

password

admin5@make-it-all.com

password

admin6@make-it-all.com

password

⚠ Passwords are stored securely using bcrypt hashing. If you need to change them, update the hashed password directly in the database.

3️⃣ Running the Project

Ensure your web server (Apache/Nginx) and MySQL database are running.

Place the project inside your server's root directory (htdocs for XAMPP, www for WAMP, etc.).

Access the dashboard via http://localhost/MANAGER_DASHBOARD/public/login.php.

🔧 Key Features

✅ User Management - Assign and manage users .
✅ Task Tracking - Keep track of ongoing projects and tasks.
✅ Notifications - Integrated notification system for important updates.
✅ Secure Authentication - Passwords hashed using bcrypt with a cost factor of 10.
