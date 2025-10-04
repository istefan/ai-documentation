<?php
require_once 'config/database.php';
$conn = connectDB();
$sql = "SELECT id, title, description FROM projects ORDER BY updated_at DESC";
$result = $conn->query($sql);

$status_message = '';
// Mesajele de status raman la fel, Bootstrap le va stila corespunzator

include 'templates/header.php';
?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Projects</h1>
    <!-- Buton principal stilizat monocrom -->
    <a href="add.php" class="btn btn-dark">
        <i class="bi bi-plus-circle me-1"></i> New Project
    </a>
</div>

<?php echo $status_message; // Afiseaza mesajele de status ?>

<div class="project-list">
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($project = $result->fetch_assoc()): ?>
            <div class="project-item card mb-3">
                <div class="card-body">
                    <!-- Randul de sus: Titlu si Butoane -->
                    <div class="d-flex justify-content-between align-items-start">
                        
                        <!-- MODIFICAREA 1: Titlu evidentiat cu icoana si culoare -->
                        <h5 class="card-title mb-1">
                            <a href="project.php?id=<?php echo $project['id']; ?>" class="text-decoration-none fw-semibold">
                                <i class="bi bi-journal me-2"></i><?php echo htmlspecialchars($project['title']); ?>
                            </a>
                        </h5>
                        
                        <!-- MODIFICAREA 2: Aliniere corecta si stilul dorit pentru butoane -->
                        <div class="d-flex gap-2 align-items-baseline">
                            <a href="edit.php?id=<?php echo $project['id']; ?>" class="btn btn-outline-secondary btn-sm">Edit</a>
                            <form action="actions.php" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this project?');">
                                <input type="hidden" name="action" value="delete">
                                <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
                                <button type="submit" class="btn btn-outline-danger btn-sm">Delete</button>
                            </form>
                        </div>
                    </div>
                    
                    <!-- Descrierea -->
                    <p class="card-text text-muted mt-2 mb-0">
                        <?php echo htmlspecialchars($project['description']); ?>
                    </p>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="card card-body text-center">
            <p class="mb-0">No projects found. Add your first one!</p>
        </div>
    <?php endif; ?>
</div>

<?php
$conn->close();
include 'templates/footer.php';
?>