<?php
// Client header now delegates to the shared header component
$context = 'client';
require dirname(__DIR__, 2) . '/includes/header.shared.php';
?>
<script src="/client/js/user_profile.js"></script>