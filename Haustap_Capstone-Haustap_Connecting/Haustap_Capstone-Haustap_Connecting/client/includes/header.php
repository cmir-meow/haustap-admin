<?php
// Client header now delegates to the shared header component
$context = 'client';
require dirname(__DIR__, 2) . '/includes/header.shared.php';
?>
<script>
  // Default socket URL for notifications/chat if not set elsewhere
  window.SOCKET_URL = window.SOCKET_URL || 'http://localhost:3000';
</script>
<script src="https://cdn.socket.io/4.7.5/socket.io.min.js"></script>
<script src="/client/js/notify.js" defer></script>
<script src="/client/js/toast.js" defer></script>
<script src="/client/js/notify-ui.js" defer></script>
<script src="/js/lazy-images.js" defer></script>
<script src="/client/js/user_profile.js"></script>
<script src="/client/js/service-price-capture.js" defer></script>
