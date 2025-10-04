<?php
require_once 'config/database.php';

// Only process POST requests
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['action'])) {
    $conn = connectDB();

    switch ($_POST['action']) {
        // --- ADD A NEW PROJECT ---
        case 'add':
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $folder_path = trim($_POST['folder_path']);

            if (!empty($title) && !empty($folder_path)) {
                $stmt = $conn->prepare("INSERT INTO projects (title, description, folder_path) VALUES (?, ?, ?)");
                $stmt->bind_param("sss", $title, $description, $folder_path);
                if ($stmt->execute()) {
                    header("Location: index.php?status=success_add");
                } else {
                    header("Location: index.php?status=error");
                }
                $stmt->close();
            }
            break;

        // --- UPDATE AN EXISTING PROJECT ---
        case 'update':
            $id = $_POST['id'];
            $title = trim($_POST['title']);
            $description = trim($_POST['description']);
            $folder_path = trim($_POST['folder_path']);

            if (!empty($id) && !empty($title) && !empty($folder_path)) {
                $stmt = $conn->prepare("UPDATE projects SET title = ?, description = ?, folder_path = ? WHERE id = ?");
                $stmt->bind_param("sssi", $title, $description, $folder_path, $id);
                if ($stmt->execute()) {
                    header("Location: index.php?status=success_update");
                } else {
                    header("Location: edit.php?id=" . $id . "&status=error");
                }
                $stmt->close();
            }
            break;

        // --- DELETE A PROJECT ---
        case 'delete':
            $id = $_POST['id'];
            if (!empty($id)) {
                $stmt = $conn->prepare("DELETE FROM projects WHERE id = ?");
                $stmt->bind_param("i", $id);
                if ($stmt->execute()) {
                    header("Location: index.php?status=success_delete");
                } else {
                    header("Location: index.php?status=error");
                }
                $stmt->close();
            }
            break;
    }
    $conn->close();
} else {
    // Redirect if accessed directly
    header("Location: index.php");
}
exit();
?>