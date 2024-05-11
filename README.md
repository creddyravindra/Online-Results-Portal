
Online Results Portal

Introduction
------------

This project is an online results portal developed using PHP, MySQL, and Python. It provides a platform for students and faculty to access and manage academic results conveniently.

Setup Instructions
------------------

To run this project locally, follow these steps:

1. **Requirements**:
   - [XAMPP](https://www.apachefriends.org/index.html): Install XAMPP to set up the local Apache web server and MySQL database.
   - [PyCharm](https://www.jetbrains.com/pycharm/): Install PyCharm or any other Python IDE to run the Python script.

2. **Clone Repository**:
   Clone this repository to your local machine.
   git clone https://github.com/your-username/online-results-portal.git

3. **Start Servers**:
- Start Apache and MySQL servers from the XAMPP Control Panel.
- Run the Python script `app.py` using PyCharm or any other Python IDE.

4. **Database Setup**:
- Open a web browser and navigate to `http://localhost/phpmyadmin`.
- Import the database schema by running `functions.php` from the `demo` folder i.e `http://localhost/demo/functions.php`.

5. **Access Portal**:
- Open a web browser and go to `http://localhost/demo/ksrm.html`.
- Click on "Login" to access the login page.

Usage
-----

### Admin Login
- **Username**: ADMIN
- **Password**: 00000000

### Student Login
- **Username**: rollnum
- **Password**: dateofbirth

### Faculty Login
- **Username**: faculty
- **Password**: 00000000

Features
--------

- **Secure Authentication**: Users can log in securely using their credentials.
- **Role-based Access**: Different access levels for students, faculty, and admin.
- **File Upload**: Users can upload input files for result processing.
- **Data Management**: Efficient management of academic records and results.
- **Responsive Design**: User-friendly interface accessible across devices.

Contributing
------------
Contributions are welcome! Fork this repository, make your changes, and submit a pull request.

License
-------
This project is licensed under the [MIT License](LICENSE).

