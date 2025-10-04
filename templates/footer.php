</main> <!-- end .container -->

<?php
// Include app configuration to get the version number
require_once __DIR__ . '/../config/app.php';
?>

<footer class="text-center text-muted py-4 mt-5">
    <p class="mb-1">&copy; <?php echo date('Y'); ?> - AI Documentation Tool | Version <?php echo APP_VERSION; ?></p>
    <p class="mb-0 small">Developed by Stefan Iftimie, <a href="https://www.ahoi.ro/" target="_blank" class="text-muted">Ahoi Digital SRL</a></p>
</footer>

<!-- Bootstrap JS Bundle -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>