# AI Code Documentation Generator

A simple PHP & MySQL application designed to help developers generate comprehensive PDF documentation from a project's source code. The primary goal is to create a single, well-structured document that can be easily uploaded to AI models like **Google AI Studio** for analysis, code review, refactoring suggestions, and more.

![Application Screenshot](assets/images/screenshot.png)

## The Problem It Solves

Preparing a large codebase for analysis by an AI can be tedious. You often need to copy-paste dozens of files, losing the project's structure and context in the process. This tool automates that entire workflow by scanning a project directory and compiling everything into a single, clean, and context-rich PDF.

---

## Getting Started: A Beginner's Guide

This guide is for anyone, even if you have never used a local server before. We will walk through every step to get the application running on your Windows machine.

### Step 1: Install Your Local Server (XAMPP)

To run a PHP application, you need a program that acts like a web server on your computer. XAMPP is the most popular choice for this.

1.  **Download XAMPP**: Go to the official Apache Friends website and download the installer for Windows:
    *   [https://www.apachefriends.org/index.html](https://www.apachefriends.org/index.html)

2.  **Run the Installer**:
    *   Open the downloaded file. You might see a warning about User Account Control (UAC); it's safe to click "OK".
    *   In the "Select Components" screen, you can leave the default options checked. The essential ones are **Apache**, **MySQL**, and **PHP**.
    *   For the "Installation folder", it's highly recommended to use the default path: `C:\xampp`.
    *   Continue through the next steps to complete the installation.

3.  **Start Your Server**:
    *   After installation, open the **XAMPP Control Panel**.
    *   You will see a list of services. Click the **"Start"** button next to **Apache** and **MySQL**.
    *   They should turn green, indicating that your local server is now running!

### Step 2: Install Composer (The PHP Package Manager)

Composer is a tool that helps PHP projects manage their libraries (like the one we use for PDF generation).

1.  **Download Composer**: Go to the official Composer download page:
    *   [https://getcomposer.org/download/](https://getcomposer.org/download/)
2.  **Run the Installer**:
    *   Open the `Composer-Setup.exe` file.
    *   It will automatically detect where you installed PHP (inside your XAMPP folder). Simply click "Next" through the installation steps.

### Step 3: Get the Application Code

1.  **Download the Code**: Go to the GitHub repository page and click the green **"<> Code"** button, then choose **"Download ZIP"**.
2.  **Unzip the File**: Extract the contents of the ZIP file on your computer. You will get a folder named `Code-to-PDF-for-AI-main`.
3.  **Rename and Move**: 
    *   **Important**: Rename this folder from `Code-to-PDF-for-AI-main` to `ai-documentation`.
    *   Move the entire `ai-documentation` folder inside XAMPP's web directory, which is typically `C:\xampp\htdocs\`.
    *   Your final project path should be `C:\xampp\htdocs\ai-documentation`. This ensures that the URL we use later will work correctly.

### Step 4: Install Project Dependencies

1.  **Open Command Prompt (CMD)**: Navigate to your new project folder `C:\xampp\htdocs\ai-documentation`. The easiest way is to click on the address bar in File Explorer, type `cmd`, and press Enter.
2.  **Run Composer**: In the command prompt window that opens, type the following command and press Enter. This will read the `composer.json` file and download the necessary libraries into a new `vendor` folder.
    ```bash
    composer install
    ```

### Step 5: Set Up the Database

This is a two-part process to avoid permission errors.

**Part A: Create the Database Manually**
1.  **Open phpMyAdmin**: Open your web browser and go to `http://localhost/phpmyadmin`.
2.  **Create Database**:
    *   Click on **"New"** in the left sidebar.
    *   For the **Database name**, enter exactly `ai_documentation`.
    *   For the **Collation**, find and select `utf8mb4_unicode_ci` from the dropdown list.
    *   Click **"Create"**. The database is now empty and ready.

**Part B: Import the Table**
1.  **Select the Database**: After creating it, click on the name `ai_documentation` in the left sidebar to make sure it's active.
2.  **Import the SQL File**:
    *   Click on the **"Import"** tab at the top of the page.
    *   Under the "File to import" section, click **"Choose File"**.
    *   Navigate to your project folder (`C:\xampp\htdocs\ai-documentation`) and select the `database.sql` file.
    *   Scroll to the bottom of the page and click **"Go"**.

You will see a green success message. The `projects` table has been created, and your application is now fully configured!

---

## How to Use the Application

### 1. Access the Tool
Open your web browser and go to: `http://localhost/ai-documentation/`

### 2. Add Your First Project
*   Click the **"New Project"** button.
*   **Project Title & Description**: This is crucial! Give the project a clear title and a good description. The AI will use this information as the primary context to understand your code's purpose. Think of it as the introduction you would give a human colleague.
*   **Project Folder Path**: Provide the **full, absolute path** to the project's root folder on your computer (e.g., `C:\Users\YourName\Documents\MyWebApp`).

### 3. Generate the PDF
*   From the main list, click on a project's title to see a preview of the documentation.
*   Click the **"Export as PDF"** button. A PDF file containing the complete documentation will be generated and downloaded.

---

## Using the Generated PDF with an AI (e.g., Google AI Studio)

The generated PDF is more than just a collection of code—it's a context-rich document designed for Large Language Models.

1.  **Go to Google AI Studio**: `https://aistudio.google.com/`
2.  **Create a New Prompt**: Choose "New freeform prompt".
3.  **Upload the PDF**: On the right side, you will see an input area where you can add examples. Click the **"File"** icon and upload the PDF you just generated. The AI will now have full access to your project's context and code.
4.  **Write Your Prompt**: Now you can ask the AI to perform tasks.

#### Example Prompts

Here are some examples of what you can ask the AI to do with the uploaded document.

**For a Security Analysis:**
> Act as a senior security analyst. Based on the provided project documentation (title, description, and full source code), perform a thorough security audit. Identify any potential vulnerabilities, such as SQL injection, Cross-Site Scripting (XSS), insecure file handling, or improper data validation. For each vulnerability found, please specify the file, the line number, and provide a corrected code snippet.

**For Code Refactoring:**
> Act as a senior PHP developer specializing in clean code and modern practices. Analyze the provided codebase. Suggest refactoring improvements to enhance readability, performance, and maintainability. Focus on SOLID principles, DRY (Don't Repeat Yourself), and simplifying complex functions.

**For Onboarding a New Developer:**
> Based on the uploaded documentation, generate a technical onboarding guide for a new developer. Explain the project's architecture, the role of each key file, and the overall data flow.

---

## License

This project is licensed under the MIT License - see the `LICENSE` file for details.