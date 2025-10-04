<?php

/**
 * Main function that generates the complete HTML documentation for a project.
 */
function generateProjectDocumentation(string $projectPath): string {
    if (!is_dir($projectPath) || !is_readable($projectPath)) {
        // Translated error message
        return '<div class="error-box"><strong>Error:</strong> The specified path is not a valid or readable directory: <code>' . htmlspecialchars($projectPath) . '</code></div>';
    }

    $output = '';

    // Part 1: Project Structure (Translated)
    $output .= '<h3>Project Structure</h3>';
    $output .= '<pre class="directory-tree">';
    $output .= htmlspecialchars(basename($projectPath)) . "/\n";
    $output .= generateTreeStructureHtml($projectPath);
    $output .= '</pre>';

    // Part 2: File Contents (Translated)
    $output .= '<h3 style="margin-top: 30px;">File Contents</h3>';
    $output .= generateFileContentsHtml($projectPath, $projectPath);

    return $output;
}

/**
 * Generates the tree structure of the project in text format.
 */
function generateTreeStructureHtml(string $dir): string {
    return buildTreeRecursive($dir);
}

/**
 * Recursive helper function to build the tree.
 */
function buildTreeRecursive(string $dir, string $prefix = ''): string {
    $treeString = '';
    $items = array_diff(scandir($dir), ['.', '..']);
    $items = array_values($items);

    $totalItems = count($items);
    foreach ($items as $key => $item) {
        $isLast = ($key === $totalItems - 1);
        $connector = $isLast ? '└── ' : '├── ';
        $treeString .= htmlspecialchars($prefix . $connector . $item) . "\n";

        $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
        if (is_dir($fullPath) && $item !== 'vendor') {
            $newPrefix = $prefix . ($isLast ? '    ' : '│   ');
            $treeString .= buildTreeRecursive($fullPath, $newPrefix);
        }
    }
    return $treeString;
}

/**
 * Generates the HTML with the file contents.
 */
function generateFileContentsHtml(string $dir, string $basePath): string {
    $htmlOutput = '';
    $items = array_diff(scandir($dir), ['.', '..']);

    foreach ($items as $item) {
        $fullPath = $dir . DIRECTORY_SEPARATOR . $item;
        $relativePath = str_replace($basePath . DIRECTORY_SEPARATOR, '', $fullPath);

        if (is_dir($fullPath)) {
            if (basename($fullPath) === 'vendor') {
                $htmlOutput .= '<div class="folder-structure folder-vendor">';
                // Translated label
                $htmlOutput .= '<h4>Folder: ' . htmlspecialchars($relativePath) . ' (Composer Libraries)</h4>';
                $htmlOutput .= listVendorLibraries($fullPath);
                $htmlOutput .= '</div>';
            } else {
                $htmlOutput .= '<div class="folder-structure">';
                $htmlOutput .= '<h4>Folder: ' . htmlspecialchars($relativePath) . '</h4>';
                $htmlOutput .= generateFileContentsHtml($fullPath, $basePath);
                $htmlOutput .= '</div>';
            }
        } else {
            $htmlOutput .= '<div class="file-content">';
            // Translated label
            $htmlOutput .= '<h5>File: <code>' . htmlspecialchars($relativePath) . '</code></h5>';
            
            $content = file_get_contents($fullPath);
            if ($content === false) {
                // Translated error
                $content = "Error: Could not read file content.";
            }

            $htmlOutput .= '<div class="code-block">' . htmlspecialchars($content) . '</div>';
            $htmlOutput .= '</div>';
        }
    }
    return $htmlOutput;
}

/**
 * Helper function to list libraries from the 'vendor' folder.
 */
function listVendorLibraries(string $vendorPath): string {
    // Translated text
    $html = '<p>Contains the following packages (shallow listing):</p><ul>';
    $items = array_diff(scandir($vendorPath), ['.', '..', 'composer', 'autoload.php']);
    foreach ($items as $item) {
        if (is_dir($vendorPath . DIRECTORY_SEPARATOR . $item)) {
            $html .= '<li>' . htmlspecialchars($item) . '</li>';
        }
    }
    // Translated text
    $html .= '</ul><p><i>Detailed content of these packages has been omitted.</i></p>';
    return $html;
}
?>