<?php include 'templates/header.php'; ?>

<h1 class="mb-4">Add New Project</h1>

<div class="card">
    <div class="card-body">
        <form action="actions.php" method="POST">
            <input type="hidden" name="action" value="add">

            <div class="mb-3">
                <label for="title" class="form-label">Project Title</label>
                <input type="text" class="form-control" id="title" name="title" required>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label">Project Description</label>
                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
            </div>

            <div class="mb-3">
                <label for="folder_path" class="form-label">Project Folder Path</label>
                <input type="text" class="form-control" id="folder_path" name="folder_path" placeholder="Example: C:\xampp\htdocs\my-project" required>
            </div>

            <button type="submit" class="btn btn-dark">Add Project</button>
            <a href="index.php" class="btn btn-secondary">Cancel</a>
        </form>
    </div>
</div>

<?php include 'templates/footer.php'; ?>