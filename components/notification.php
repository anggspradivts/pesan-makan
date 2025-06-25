<?php $message = $_SESSION["error_message"] || $_SESSION["success_message"] ?>
<div class="absolute top-1 left-1 p-5 bg-white text-black">
    <?php echo $message ?>
</div><?php
        $success = $_SESSION["success_message"] ?? null;
        $error = $_SESSION["error_message"] ?? null;
        $message = $success ?? $error;
        $type = $success ? 'success' : ($error ? 'error' : null);
        ?>

<?php if ($message): ?>
    <div id="notification"
        class="fixed top-5 left-5 z-[999999] px-6 py-3 rounded shadow-md text-white 
              transition-all duration-500 ease-out opacity-0 scale-90
              <?= $type === 'success' ? 'bg-green-600' : 'bg-red-600' ?>">
        <?= htmlspecialchars($message) ?>
    </div>

    <script>
        const notif = document.getElementById('notification');
        if (notif) {
            // Show with animation
            setTimeout(() => {
                notif.classList.remove('opacity-0', 'scale-90');
                notif.classList.add('opacity-100', 'scale-100');
            }, 100); // slight delay so transition triggers

            // Hide after 4 seconds
            setTimeout(() => {
                notif.classList.remove('opacity-100', 'scale-100');
                notif.classList.add('opacity-0', 'scale-90');
            }, 4000);

            // Optional: completely remove after fade out
            setTimeout(() => {
                notif.remove();
            }, 4500);
        }
    </script>

    <?php unset($_SESSION["success_message"], $_SESSION["error_message"]); ?>
<?php endif; ?>