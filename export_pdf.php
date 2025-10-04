<?php
set_time_limit(300);

require_once 'config/database.php';
require_once 'generate_doc.php';
require_once 'vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    // Translated error
    die("Invalid project ID.");
}
$projectId = (int)$_GET['id'];

$conn = connectDB();
$stmt = $conn->prepare("SELECT title, description, folder_path FROM projects WHERE id = ?");
$stmt->bind_param("i", $projectId);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

if (!$project) {
    // Translated error
    die("Project not found.");
}

$documentationContent = generateProjectDocumentation($project['folder_path']);

// ---- Build the HTML for the PDF ----
$html = '
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Documentation: ' . htmlspecialchars($project['title']) . '</title>
    <style>
        body { font-family: DejaVu Sans, sans-serif; font-size: 12px; }
        h1, h2, h3, h4, h5 { color: #2c3e50; }
        h1 { font-size: 24px; text-align: center; margin-bottom: 30px; }
        .project-description { background-color: #f4f7f9; padding: 15px; border-radius: 5px; margin-bottom: 20px; }
        pre.directory-tree, code { font-family: "DejaVu Sans Mono", monospace; }
        .directory-tree {
            background-color: #ecf0f1; color: #2c3e50; padding: 15px; border-radius: 5px;
            border: 1px solid #bdc3c7; white-space: pre; line-height: 1.5; font-size: 11px;
        }
        .code-block {
            font-family: "DejaVu Sans Mono", monospace; background-color: #f6f8fa; color: #24292e;
            border: 1px solid #dfe2e5; padding: 10px; border-radius: 4px; font-size: 8.5px;
            line-height: 1.3; white-space: pre-wrap; word-break: break-all;
        }
    </style>
</head>
<body>
    <h1>Documentation for Project: ' . htmlspecialchars($project['title']) . '</h1>
    
    <div class="project-description">
        <h2>Description</h2>
        <p>' . nl2br(htmlspecialchars($project['description'])) . '</p>
        <p><strong>Local Path:</strong> <code>' . htmlspecialchars($project['folder_path']) . '</code></p>
    </div>

    ' . $documentationContent . '
</body>
</html>';

// ---- Configure and generate the PDF ----
$options = new Options();
$options->set('isRemoteEnabled', true);
$options->set('defaultFont', 'DejaVu Sans');

$dompdf = new Dompdf($options);
$dompdf->loadHtml($html);
$dompdf->setPaper('A4', 'portrait');
$dompdf->render();

// Translated filename
$fileName = 'documentation-' . strtolower(preg_replace('/[^a-zA-Z0-9-]+/', '-', $project['title'])) . '.pdf';
$dompdf->stream($fileName, ['Attachment' => true]);

exit();
?>