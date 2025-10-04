# AI Code Documentation Generator

A simple PHP & MySQL application designed to help developers generate comprehensive PDF documentation from a project's source code. The primary goal is to create a single, well-structured document that can be easily uploaded to AI models like **Google AI Studio** for analysis, code review, refactoring suggestions, and more.

## About The Project

Preparing a large codebase for analysis by an AI can be tedious. You often need to copy-paste dozens of files, losing the project's structure in the process. This tool solves that problem by automatically scanning a project directory and compiling everything into a single, clean PDF.

**Key Features:**
*   **Project Management**: Add, edit, and manage multiple projects from a clean web interface.
*   **Automatic Scanning**: Scans the entire directory structure and reads the content of each file.
*   **Intelligent `vendor` Handling**: Ignores the content of PHP `vendor` folders, simply listing the included libraries to keep the documentation concise.
*   **Structured Output**: The generated document includes:
    1.  Project Title & Description.
    2.  A visual tree of the folder structure.
    3.  The complete source code from every file.
*   **PDF Export**: Exports the complete documentation into a single PDF file, ready for AI upload.

## Supported Technologies

At its core, this tool is a text file reader. This means it is **language-agnostic** and can generate documentation for a wide variety of project types, including but not limited to:
*   **Web Development**: PHP, HTML, CSS, JavaScript, Node.js, Python (Django, Flask).
*   **Mobile Development**: Java/Kotlin (Android Studio), Swift (iOS).
*   **Desktop Development**: C# (.NET), C++, Java.
*   Any other project that is based on text-based source code files.

## Getting Started

Follow these steps to set up the application on your local machine.

### Prerequisites

You will need a local server environment with PHP and MySQL. **XAMPP** is a popular choice for Windows, but you can also use WAMP, MAMP (for macOS), or any other environment.
*   **XAMPP**: [Download here](https://www.apachefriends.org/index.html)
*   **Composer**: This is required to install the PDF generation library. [Download here](https://getcomposer.org/download/)

### Installation on Windows with XAMPP

1.  **Clone the Repository**
    Open a terminal (like Git Bash) and run:
    ```bash
    git clone https://github.com/istefan/ai-documentation.git
    ```

2.  **Install XAMPP**
    *   Download and run the XAMPP installer.
    *   Install it in a location like `C:\xampp`.
    *   Move the cloned project folder (`ai-documentation`) inside the web root, which is `C:\xampp\htdocs\`. Your project path should be `C:\xampp\htdocs\ai-documentation`.

3.  **Start Services**
    *   Open the **XAMPP Control Panel**.
    *   Start the **Apache** and **MySQL** services.

4.  **Install Dependencies**
    *   Open a terminal directly inside the project folder: `C:\xampp\htdocs\ai-documentation`.
    *   Run the Composer install command. This will download `dompdf` and create the `vendor` folder.
    ```bash
    composer install
    ```

5.  **Set Up the Database**
    *   Open your web browser and navigate to `http://localhost/phpmyadmin`.
    *   Click on the **"Import"** tab at the top.
    *   Under "File to import", click **"Choose File"** and select the `database.sql` file located in your project folder.
    *   Leave all other options as they are and click the **"Go"** button at the bottom.
    *   You will see a success message. The database `ai_documentation` and the `projects` table are now ready.

6.  **Done!**
    You can now access the application by navigating to `http://localhost/ai-documentation/` in your web browser.

## Usage

1.  **Add a Project**
    *   Click the **"New Project"** button.
    *   **Project Title**: Give your project a recognizable name (e.g., "My Android App").
    *   **Project Description**: Add a short description of what the project does.
    *   **Project Folder Path**: This is the most important field. You must provide the **full, absolute path** to the project's root folder on your computer.
        *   *Windows Example:* `C:\Users\YourName\Documents\Projects\MyWebApp`
        *   *macOS/Linux Example:* `/Users/YourName/Projects/MyWebApp`

2.  **View Documentation**
    *   From the main list, click on a project's title.
    *   You will see the project details, the folder tree structure, and the content of all its files.

3.  **Export to PDF**
    *   On the project's documentation page, click the **"Export as PDF"** button.
    *   A PDF file containing the complete documentation will be generated and downloaded.
    *   You can now upload this PDF to your preferred AI tool for analysis.