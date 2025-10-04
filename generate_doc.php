<?php

// --- CONFIGURATION ---
// Directories to completely ignore (tree and content)
const IGNORED_DIRECTORIES = ['.git', 'node_modules'];
// Files to mention but skip their content
const FILES_TO_SUMMARIZE = ['composer.lock', 'LICENSE', 'README.md', '.gitignore'];
// File extensions to treat as binary/unimportant and skip their content
const EXTENSIONS_TO_SUMMARIZE = [
    'png', 'jpg', 'jpeg', 'gif', 'svg', 'webp', 'ico', // Images
    'woff', 'woff2', 'ttf', 'eot',                  // Fonts
    'zip', 'rar', 'tar', 'gz',                       // Archives
    'pdf', 'doc', 'docx', 'xls', 'xlsx',             // Documents
    'mp4', 'mov', 'mp3', 'wav'                      // Media
];

/**
 * Main function that generates the complete HTML documentation for a project.
 */
function generateProjectDocumentation(string $projectPath): string {
    if (!is_dir($projectPath) || !is_readable($projectPath)) {
        return '<div class="error-box"><strong>Error:</strong> The specified path is not a valid or readable directory: <code>' . htmlspecialchars($projectPath) . '</code></div>';
    }
    $output = '<h3>Project Structure</h3><pre class="directory-tree">' . htmlspecialchars(basename($projectPath)) . "/\n" . generateTreeStructureHtml($projectPath) . '</pre>';
    $output .= '<h3 style="margin-top: 30px;">File Contents</h3>' . generateFileContentsHtml($projectPath, $projectPath);
    return $output;
}

/**
 * Generates the tree structure, ignoring only specified directories.
 * It will now list ALL files.
 */
function generateTreeStructureHtml(string $dir): string {
    return buildTreeRecursive($dir);
}

/**
 * Recursive helper function to build the directory tree.
 * This version ONLY ignores directories from the IGNORED_DIRECTORIES list.
 */
function buildTreeRecursive(string $dir, string $prefix = ''): string {
    $treeString = '';
    // Filter out only '.' and '..' initially
    $items = array_diff(scandir($dir), ['.', '..']);

    // Create a new list that respects the ignore rules for filtering
    $filteredItems = [];
    foreach ($items as $item) {
        if (is_dir($dir . DIRECTORY_SEPARATOR . $item) && in_array($item, IGNORED_DIRECTORIES)) {
            continue; // Skip this directory entirely
        }
        $filteredItems[] = $item;
    }
    
    $itemCount = count($filteredItems);
    foreach ($filteredItems as $key => $item) {
        $isLast = ($key === $itemCount - 1);
        $connector = $isLast ? '└── ' : '├── ';
        $treeString .= htmlspecialchars($prefix . $connector . $item) . "\n";

        $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($fullPath) && !in_array($item, IGNORED_DIRECTORIES)) {
            $newPrefix = $prefix . ($isLast ? '    ' : '│   ');
            // Check if the directory is 'vendor' before recursing
            if (basename($fullPath) !== 'vendor') {
                $treeString .= buildTreeRecursive($fullPath, $newPrefix);
            }
        }
    }
    return $treeString;
}


/**
 * Generates the HTML with file contents, applying ignore and summary rules.
 */
function generateFileContentsHtml(string $dir, string $basePath): string {
    $htmlOutput = '';
    $items = array_diff(scandir($dir), ['.', '..']);

    foreach ($items as $item) {
        $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
        $fileName = basename($fullPath);

        // Rule: Completely ignore directories from the list
        if (is_dir($fullPath) && in_array($fileName, IGNORED_DIRECTORIES)) continue;

        if (is_dir($fullPath)) {
            if ($fileName === 'vendor') {
                $htmlOutput .= '<div class="folder-structure folder-vendor"><h4>Folder: ' . htmlspecialchars(str_replace($basePath . DIRECTORY_SEPARATOR, '', $fullPath)) . ' (Composer Libraries)</h4>' . listVendorLibraries($fullPath) . '</div>';
            } else {
                $htmlOutput .= generateFileContentsHtml($fullPath, $basePath);
            }
        } else {
            $relativePath = str_replace($basePath . DIRECTORY_SEPARATOR, '', $fullPath);
            $htmlOutput .= '<div class="file-content"><h5>File: <code>' . htmlspecialchars($relativePath) . '</code></h5>';
            
            $extension = pathinfo($fileName, PATHINFO_EXTENSION);

            // Rule: Special handling for composer.json
            if ($fileName === 'composer.json') {
                $htmlOutput .= summarizeComposerJson($fullPath);
            } 
            // Rule: Summarize files from the list OR with a specific extension
            elseif (in_array($fileName, FILES_TO_SUMMARIZE) || in_array($extension, EXTENSIONS_TO_SUMMARIZE)) {
                $htmlOutput .= '<div class="code-block" style="background-color: #fffbe6; color: #664d03;"><i>Content of ' . htmlspecialchars($fileName) . ' has been omitted for brevity.</i></div>';
            } 
            // Default: Show full content
            else {
                $content = file_get_contents($fullPath);
                if ($content === false) {
                    $content = "Error: Could not read file content.";
                }
                $htmlOutput .= '<div class="code-block">' . htmlspecialchars($content) . '</div>';
            }
            $htmlOutput .= '</div>';
        }
    }
    return $htmlOutput;
}

// ... restul functiilor (summarizeComposerJson, listVendorLibraries) raman la fel
function summarizeComposerJson(string $filePath): string {
    $content = file_get_contents($filePath);
    $json = json_decode($content, true);
    if (json_last_error() === JSON_ERROR_NONE && isset($json['require'])) {
        $summary = "This project requires the following packages:\n\n";
        foreach ($json['require'] as $package => $version) {
            $summary .= "- " . $package . ": " . $version . "\n";
        }
        return '<div class="code-block">' . htmlspecialchars($summary) . '</div>';
    }
    return '<div class="code-block" style="background-color: #fffbe6; color: #664d03;"><i>Content of composer.json has been omitted.</i></div>';
}

function listVendorLibraries(string $vendorPath): string {
    $html = '<p>Contains the following packages (shallow listing):</p><ul>';
    $items = array_diff(scandir($vendorPath), ['.', '..', 'composer', 'autoload.php']);
    foreach ($items as $item) {
        if (is_dir($vendorPath . DIRECTORY_SEPARATOR . $item)) {
            $html .= '<li>' . htmlspecialchars($item) . '</li>';
        }
    }
    $html .= '</ul><p><i>Detailed content of these packages has been omitted.</i></p>';
    return $html;
}
?>