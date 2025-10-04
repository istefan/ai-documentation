<?php
require_once 'config/database.php';

// Check for project ID
if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php?status=error");
    exit();
}
$projectId = (int)$_GET['id'];

// Fetch project data
$conn = connectDB();
$stmt = $conn->prepare("SELECT id, title, description, folder_path FROM projects WHERE id = ?");
$stmt->bind_param("i", $projectId);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

if (!$project) {
    header("Location: index.php?status=error");
    exit();
}

include 'templates/header.php';
?>

<h1 class="mb-4">Edit Project</h1>

<div class="card">
    <div class="card-body">
        <form action="actions.php" method="POST">
            <input type="hidden" name="action" value="update">
            <input type="hidden" name="id" value="<?php echo $project['id']; ?>">

            <div class="mb-3">
                <label for="title" class="form-label">Project Title</label>
                <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($project['title']); ?>" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Project Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"><?php echo htmlspecialchars($project['description']); ?></textarea>
            </div>

            <div class="mb-3">
                <label for="folder_path" class="form-label">Project Folder Path</label>
                <input type="text" class="form-control" id="folder_path" name="folder_path" value="<?php echo htmlspecialchars($project['folder_path']); ?>" required>
            </div>

            <button type="submit" class="btn btn-dark">Update Project</button>
            <a href="project.php?id=<?php echo $project['id']; ?>" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include 'templates/footer.php'; ?>