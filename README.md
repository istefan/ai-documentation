# AI Code Documentation Generator

**Current Version: 1.2**

A simple PHP & MySQL application designed to help developers generate comprehensive PDF documentation from a project's source code. The primary goal is to create a single, well-structured document that can be easily uploaded to AI models like Google AI Studio for analysis, code review, refactoring suggestions, and more.

![Application Screenshot](assets/images/screenshot.png)

### Core Features

*   **Project Management**: Easily add, edit, and delete projects from a clean web interface.
*   **Automatic Code Scanning**: Traverses a specified project directory and reads the content of all relevant files.
*   **Intelligent Ignoring**: Automatically ignores common directories (`.git`, `node_modules`) and binary file types to keep the documentation clean.
*   **README.md Integration**: If a `README.md` file exists in the project root, its content is displayed prominently.
*   **Vendor/Composer Summary**: Summarizes Composer dependencies from `composer.json` and lists installed packages in the `vendor` directory without including their full source code.
*   **PDF Export**: Generates a single, well-formatted PDF document containing the project structure and all file contents, ready for analysis.
*   **Easy Navigation**: Includes a link to the GitHub repository in the header for quick access.

## Getting Started: A Beginner's Guide

This guide will walk you through every step to get the application running on your Windows machine using XAMPP.

### Step 1: Install Your Local Server (XAMPP)

1.  **Download XAMPP**: Go to the official [Apache Friends website](https://www.apachefriends.org/index.html).
2.  **Run the Installer**: Follow the on-screen instructions. It's recommended to install it in the default path: `C:\xampp`.
3.  **Start Your Server**: Open the **XAMPP Control Panel** and start the **Apache** and **MySQL** services.

### Step 2: Install Composer (The PHP Package Manager)

1.  **Download Composer**: Go to the official [download page](https://getcomposer.org/download/).
2.  **Run the Installer**: Open `Composer-Setup.exe` and follow the steps. It should automatically find your PHP installation inside XAMPP.

### Step 3: Get the Application Code

1.  **Download the Code**: Go to the GitHub repository page, click the green **"<> Code"** button, and choose **"Download ZIP"**.
2.  **Unzip the File**: Extract the contents of the ZIP file.
3.  **Rename and Move**:
    *   **Important**: Rename the extracted folder from `Code-to-PDF-for-AI-main` to `ai-documentation`.
    *   Move this `ai-documentation` folder inside XAMPP's web directory: `C:\xampp\htdocs\`.
    *   Your final project path should be `C:\xampp\htdocs\ai-documentation`.

### Step 4: Install Project Dependencies

1.  **Open Command Prompt (CMD)** in your project folder (`C:\xampp\htdocs\ai-documentation`).
2.  **Run Composer**: In the command prompt, type:
    ```bash
    composer install
    ```

### Step 5: Set Up the Database

1.  **Open phpMyAdmin**: Go to `http://localhost/phpmyadmin` in your browser.
2.  **Create Database**: Click **"New"**, enter the name `ai_documentation`, choose `utf8mb4_unicode_ci` as collation, and click **"Create"**.
3.  **Import the Table**: Select the new database in the left sidebar, go to the **"Import"** tab, click **"Choose File"**, select `database.sql` from your project folder, and click **"Go"**.

## How to Use the Application

1.  **Access the Tool**: Go to `http://localhost/ai-documentation/`.
2.  **Add a Project**: Click **"New Project"**, fill in the title, description, and the full absolute path to the project folder.
3.  **Generate the PDF**: Click on a project's title, then click **"Export as PDF"**.

## Using the Generated PDF with an AI

Upload the generated PDF to an AI model like Google AI Studio or ChatGPT-4 and use detailed prompts to analyze your code. The quality of your prompt directly influences the quality of the analysis. A good prompt usually specifies a **persona**, provides **context**, defines a clear **task**, and requests a specific **format** for the output.

### Example Prompts

#### Code Quality & Security

*   **For Security Analysis:**
    > Act as a senior security analyst. Based on the provided project documentation for a PHP & MySQL application, perform a thorough security audit. Identify any potential vulnerabilities (like SQL Injection, XSS, CSRF, insecure file handling, etc.). For each vulnerability, specify the file and line number, explain the risk, and provide a corrected code snippet.

*   **For Code Refactoring:**
    > Act as a senior PHP developer specializing in clean code and SOLID principles. Analyze the provided codebase. Identify the top 3 areas that would benefit most from refactoring for better readability, performance, or maintainability. For each area, suggest specific code changes, mentioning the file and function, and explain why your suggestion improves the code.

*   **For Database Optimization:**
    > Act as a database administrator (DBA). Analyze the `database.sql` file and the queries in `actions.php`. Suggest optimizations for the `projects` table schema. Are there any indexes that could be added to improve performance on common queries? Is the data type for each column optimal?

#### Feature Development & Planning

*   **For Implementing a New Feature:**
    > I want to add a new feature to this application: the ability to categorize projects (e.g., 'Work', 'Personal'). Act as a full-stack developer. Based on the existing code, provide a step-by-step plan for implementation:
    > 1. The necessary SQL `ALTER TABLE` statement for the `projects` table.
    > 2. Modifications to the backend PHP code (`actions.php`) to handle creating and updating the category.
    > 3. Changes to the frontend files (`add.php`, `edit.php`, `index.php`) to add a dropdown/input for the category.
    > Provide specific code snippets for each step.

*   **For UI/UX Improvements:**
    > Act as a UI/UX designer. Based on the PHP files in the `templates` folder and the main pages (`index.php`, `add.php`), suggest three improvements to the user interface to make it more intuitive and user-friendly. For each suggestion, explain the problem it solves and how it could be implemented using Bootstrap 5 classes.

#### Documentation & Understanding

*   **For Adding Documentation and Comments:**
    > Act as a technical writer tasked with improving code documentation. Scan the entire project and identify functions or complex code blocks that lack sufficient comments or PHPDoc blocks. Generate clear, concise PHPDoc blocks for at least three critical functions, explaining what the function does, its parameters (`@param`), and what it returns (`@return`).

*   **For Understanding the Codebase:**
    > Explain the data flow for the "Update an Existing Project" feature. Start from the moment a user clicks the "Edit" button on `index.php`. Trace the process through loading the data in `edit.php`, submitting the form to `actions.php`, the validation and database update logic, and the final redirection. Mention the key files, PHP variables, and SQL queries involved.

#### Deployment & Operations

*   **For Creating a Deployment Checklist:**
    > Act as a DevOps engineer. I need to deploy this application on a production server. Create a checklist of security and configuration steps I should take. Include things like changing database credentials, setting correct file permissions, disabling error reporting, and any other best practices for a live PHP application.

*   **For Writing a Test Plan:**
    > Act as a Quality Assurance (QA) engineer. Write a simple test plan for this application. Identify the key user flows (e.g., adding a project, editing a project, deleting a project, generating a PDF). For each flow, describe the steps to test and the expected outcome. Include edge cases, like submitting a form with empty fields or trying to access a project with an invalid ID.

## Author

*   **Stefan Iftimie**
*   **Company:** [Ahoi Digital SRL](https://www.ahoi.ro/)
*   **GitHub:** [@istefan](https://github.com/istefan)

## License

This project is licensed under the MIT License - see the `LICENSE` file for details.