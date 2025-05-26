# Online Quiz System

A comprehensive web-based examination system built with PHP and MySQL that allows administrators to create and manage exams while users can enroll, take exams, and view their results.

## Table of Contents

1. [Project Overview](#project-overview)
2. [System Architecture](#system-architecture)
3. [Database Structure](#database-structure)
4. [Key Features](#key-features)
5. [User Roles and Permissions](#user-roles-and-permissions)
6. [Application Flow](#application-flow)
7. [Component Breakdown](#component-breakdown)
8. [Technical Implementation](#technical-implementation)

## Project Overview

The Online Quiz System is a web application designed to facilitate online examinations. It provides a platform for administrators to create exams with multiple-choice questions, manage users, and view results. Users can register, enroll in available exams, take the exams within specified time limits, and view their performance results.

## System Architecture

The application follows the Model-View-Controller (MVC) architectural pattern:

- **Models**: Handle database interactions and data manipulation
- **Views**: Present the user interface and display data
- **Controllers**: Process user input, interact with models, and determine which views to render

### Directory Structure

```
├── Assets/               # Static resources
│   ├── CSS/             # Stylesheets
│   ├── images/          # Image files
│   └── js/              # JavaScript files
├── Controllers/         # Application logic
│   ├── Exam.php         # Exam management
│   ├── Questions.php    # Question management
│   └── User.php         # User management
├── Models/              # Database interactions
│   ├── Database.php     # Database connection
│   └── exam_system.sql  # Database schema
├── View/                # User interface files
│   ├── login.php        # Login page
│   ├── register.php     # Registration page
│   ├── exam.php         # Exam management (admin)
│   ├── view_exam.php    # Exam list (user)
│   └── process_exam.php # Exam taking interface
└── inc/                 # Includes
    ├── container.php    # Page container
    ├── header.php       # Page header
    └── footer.php       # Page footer
```

## Database Structure

The application uses a MySQL database with the following tables:

### online_exam_user

Stores user information including authentication details and role.

- **id**: Primary key
- **first_name**: User's first name
- **last_name**: User's last name
- **gender**: User's gender
- **email**: User's email (used for login)
- **password**: Hashed password
- **mobile**: Mobile number
- **address**: User's address
- **created**: Account creation timestamp
- **role**: User role (admin/user)

### online_exam_exams

Stores information about available exams.

- **id**: Primary key
- **exam_title**: Title of the exam
- **duration**: Duration in minutes
- **total_question**: Number of questions in the exam
- **marks_per_right_answer**: Points awarded for correct answers
- **marks_per_wrong_answer**: Points deducted for incorrect answers
- **status**: Exam status (active/inactive)
- **created**: Exam creation timestamp
- **updated**: Last update timestamp

### online_exam_question

Stores questions associated with exams.

- **question_id**: Primary key
- **exam_id**: Foreign key referencing online_exam_exams
- **question**: The question text
- **answer**: The correct answer option

### online_exam_option

Stores options for each question.

- **option_id**: Primary key
- **question_id**: Foreign key referencing online_exam_question
- **option**: Option number (1-4)
- **title**: Option text

### online_exam_enroll

Tracks user enrollment in exams.

- **id**: Primary key
- **user_id**: Foreign key referencing online_exam_user
- **exam_id**: Foreign key referencing online_exam_exams
- **enrolled_date**: Enrollment date

### online_exam_process

Tracks exam progress and results.

- **process_id**: Primary key
- **user_id**: Foreign key referencing online_exam_user
- **exam_id**: Foreign key referencing online_exam_exams
- **question_id**: Foreign key referencing online_exam_question
- **user_answer_option**: User's selected answer
- **marks**: Marks awarded for the answer
- **start_time**: Exam start time

## Key Features

### User Management

- User registration with personal details
- Secure login with email and password
- Role-based access control (admin/user)
- User profile management

### Exam Management (Admin)

- Create, edit, and delete exams
- Set exam parameters (duration, marks, etc.)
- Add, edit, and delete questions and options
- View enrolled users and their results

### Exam Taking (User)

- View available exams
- Enroll in exams
- Take exams with timer functionality
- Navigate between questions
- Submit answers and view results

## User Roles and Permissions

### Administrator

- Manage exams (create, edit, delete)
- Manage questions (add, edit, delete)
- View all users and their exam results
- Monitor exam enrollments

### User

- Register and login
- View available exams
- Enroll in exams
- Take exams
- View personal exam results

## Application Flow

### Authentication Flow

1. User visits the login page
2. User enters credentials (email, password, and role)
3. System validates credentials
4. If valid, user is redirected to appropriate dashboard based on role
5. If invalid, error message is displayed

### Exam Creation Flow (Admin)

1. Admin logs in and navigates to Exam management
2. Admin creates a new exam with title, duration, and scoring parameters
3. Admin adds questions and multiple-choice options
4. Admin sets the correct answer for each question
5. Admin activates the exam for users to enroll

### Exam Taking Flow (User)

1. User logs in and views available exams
2. User enrolls in an exam
3. User starts the exam, triggering the timer
4. User answers questions and navigates between them
5. User submits the exam or time expires
6. System calculates the score based on correct and incorrect answers
7. User views the exam results

## Component Breakdown

### Controllers

#### User.php

Handles user authentication, registration, and management:

- `login()`: Authenticates users
- `loggedIn()`: Checks if a user is logged in
- `listUsers()`: Retrieves all users (admin only)
- `getUserDetails()`: Gets details of a specific user
- `insert()`: Creates a new user
- `update()`: Updates user information

#### Exam.php

Manages exam creation, retrieval, and processing:

- `listExam()`: Lists all exams
- `getExam()`: Gets details of a specific exam
- `getExamInfo()`: Gets comprehensive exam information
- `insert()`: Creates a new exam
- `update()`: Updates exam information
- `delete()`: Deletes an exam
- `getExamResults()`: Retrieves exam results
- `examProcessUpdate()`: Updates exam progress

#### Questions.php

Handles question and option management:

- `listQuestions()`: Lists questions for an exam
- `getQuestion()`: Gets details of a specific question
- `getQuestionOptions()`: Gets options for a question
- `insert()`: Creates a new question
- `update()`: Updates question information
- `delete()`: Deletes a question

### Models

#### Database.php

Provides database connectivity:

- `getConnection()`: Establishes and returns a database connection

### Views

#### Authentication Views

- `login.php`: Login form
- `register.php`: Registration form

#### Admin Views

- `exam.php`: Exam management interface
- `questions.php`: Question management interface
- `user.php`: User management interface
- `enroll.php`: View enrolled users for an exam

#### User Views

- `view_exam.php`: List of available exams
- `enroll_exam.php`: Interface to enroll in exams
- `process_exam.php`: Interface to take an exam
- `view_result.php`: Interface to view exam results

## Technical Implementation

### Authentication

The system uses PHP sessions for authentication. Passwords are hashed using PHP's `password_hash()` function with the BCRYPT algorithm for security.

### Database Interaction

The application uses MySQLi for database operations. Prepared statements are used to prevent SQL injection attacks.

### Client-Side Functionality

JavaScript and jQuery are used for client-side functionality:

- DataTables for tabular data display
- AJAX for asynchronous data loading
- TimeCircles for exam timer functionality

### Exam Timer

The exam timer is implemented using JavaScript. When an exam starts, the system records the start time and calculates the end time based on the exam duration. The timer is displayed using the TimeCircles library and automatically submits the exam when time expires.

### Question Navigation

Users can navigate between questions during an exam using the question navigation area. The system keeps track of answered and unanswered questions, allowing users to revisit questions before final submission.

### Result Calculation

When an exam is submitted, the system calculates the score based on the marks per right answer and marks per wrong answer parameters. The results are stored in the database and displayed to the user.

---

This Online Quiz System provides a comprehensive solution for conducting online examinations with features for both administrators and users. The modular architecture allows for easy maintenance and future enhancements.