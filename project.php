<?php
require_once 'config/database.php';
require_once 'generate_doc.php';

if (!isset($_GET['id']) || !is_numeric($_GET['id'])) {
    header("Location: index.php");
    exit();
}
$projectId = (int)$_GET['id'];

$conn = connectDB();
$stmt = $conn->prepare("SELECT id, title, description, folder_path FROM projects WHERE id = ?");
$stmt->bind_param("i", $projectId);
$stmt->execute();
$project = $stmt->get_result()->fetch_assoc();
$stmt->close();
$conn->close();

if (!$project) {
    header("Location: index.php");
    exit();
}

include 'templates/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-3">
    <div>
        <a href="index.php" class="text-decoration-none text-muted">&laquo; Back to projects</a>
        <h1 class="h2 mt-1"><?php echo htmlspecialchars($project['title']); ?></h1>
    </div>
    <div>
        <a href="edit.php?id=<?php echo $project['id']; ?>" class="btn btn-secondary">Edit</a>
        <a href="export_pdf.php?id=<?php echo $project['id']; ?>" class="btn btn-dark">Export as PDF</a>
    </div>
</div>

<div class="card mb-4">
    <div class="card-header">
        Project Description
    </div>
    <div class="card-body">
        <p><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
        <p class="mb-0"><strong>Local Path:</strong> <code><?php echo htmlspecialchars($project['folder_path']); ?></code></p>
    </div>
</div>

<div class="card">
    <div class="card-header">
        Source Code Documentation
    </div>
    <div class="card-body documentation-content">
        <?php echo generateProjectDocumentation($project['folder_path']); ?>
    </div>
</div>

<?php include 'templates/footer.php'; ?>