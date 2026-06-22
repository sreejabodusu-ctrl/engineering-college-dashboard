# 🎓 Engineering College Management System

A web-based Student Management System developed using **PHP, MySQL, HTML, CSS, and XAMPP**. This application helps manage student records through a centralized dashboard with features for adding, searching, viewing, and deleting student information.

---

## 📌 Project Overview

The Engineering College Management System is designed to simplify student data management in educational institutions. The system provides an easy-to-use dashboard where administrators can efficiently manage student records.

---

## 🚀 Features

### Student Management

* Add new student records
* Store student details including:

  * Student Name
  * Gender
  * Branch
  * Year of Study
  * Email Address
  * Phone Number

### Search Functionality

* Search students by name
* Display matching student records instantly

### View Students

* View all student records
* Toggle button to show/hide student data

### Delete Records

* Delete student records
* Confirmation prompt before deletion

### Dashboard

* User-friendly interface
* Responsive layout
* Clean and organized design

---

## 🛠️ Technologies Used

| Technology | Purpose                  |
| ---------- | ------------------------ |
| PHP        | Backend Development      |
| MySQL      | Database Management      |
| HTML       | Structure                |
| CSS        | Styling                  |
| XAMPP      | Local Server Environment |
| phpMyAdmin | Database Administration  |
| VS Code    | Development Environment  |

---

## 📂 Project Structure

```text
engineering_app/
│
├── dashboard.php
├── db_connect.php
├── style.css
├── database.sql
└── README.md
```

---

## 🗄️ Database Schema

### Student Table

| Column Name   | Data Type         |
| ------------- | ----------------- |
| student_id    | INT (Primary Key) |
| student_name  | VARCHAR(100)      |
| gender        | VARCHAR(20)       |
| branch        | VARCHAR(50)       |
| year_of_study | INT               |
| email         | VARCHAR(100)      |
| phone         | VARCHAR(15)       |

---

## ⚙️ Installation Guide

### Step 1: Install XAMPP

Download and install XAMPP.

### Step 2: Start Services

Open XAMPP Control Panel and start:

* Apache
* MySQL

### Step 3: Create Database

Open phpMyAdmin and create:

```sql
CREATE DATABASE engineering_college;
```

### Step 4: Create Student Table

```sql
CREATE TABLE Student (
    student_id INT AUTO_INCREMENT PRIMARY KEY,
    student_name VARCHAR(100),
    gender VARCHAR(20),
    branch VARCHAR(50),
    year_of_study INT,
    email VARCHAR(100),
    phone VARCHAR(15)
);
```

### Step 5: Place Project Files

Copy the project folder into:

```text
C:\xampp\htdocs\engineering_app
```

### Step 6: Run Application

Open your browser and visit:

```text
http://localhost/engineering_app/dashboard.php
```

---

## 📸 System Modules

### Add Student

Add student information into the database.

### Search Student

Search student records by student name.

### View All Students

Display all records stored in the database.

### Hide Student Records

Hide records using the toggle button.

### Delete Student

Remove student records with confirmation.

---

## 🔒 Security Features

* Prepared Statements
* Input Validation
* SQL Injection Prevention
* Confirmation Before Deletion

---

## 📈 Future Enhancements

* Faculty Management Module
* Course Management Module
* Attendance Tracking
* Placement Management
* Admin Authentication
* Student Login Portal
* Streamlit Analytics Dashboard
* Data Visualization Reports
* Export Data to Excel/PDF

---

## 🎯 Learning Outcomes

This project demonstrates:

* Database Design
* CRUD Operations
* PHP-MySQL Integration
* Dashboard Development
* Data Management Techniques
* Web Application Development

---

## 👩‍💻 Author

**Sreeja Bodusu**

Diploma in ECE → B.Tech (CSM)

Interested in Data Analytics, UI/UX Design, and IT Solutions.

---

⭐ If you found this project useful, consider giving it a star on GitHub!
