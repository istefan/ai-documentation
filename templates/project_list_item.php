<div class="project-item">
    <h3><?php echo htmlspecialchars($project['title']); ?></h3>
    
    <?php if (!empty($project['description'])): ?>
        <p><?php echo nl2br(htmlspecialchars($project['description'])); ?></p>
    <?php endif; ?>

    <small>Cale: <code><?php echo htmlspecialchars($project['folder_path']); ?></code></small>
    
    <div class="project-actions">
        <a href="project.php?id=<?php echo $project['id']; ?>" class="btn">Vezi Documentația</a>
        
        <form action="actions.php" method="POST" onsubmit="return confirm('Ești sigur că vrei să ștergi acest proiect?');" style="margin: 0;">
            <input type="hidden" name="action" value="delete">
            <input type="hidden" name="id" value="<?php echo $project['id']; ?>">
            <button type="submit" class="btn btn-danger">Șterge</button>
        </form>
    </div>
</div>