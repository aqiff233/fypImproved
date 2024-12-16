<?php
// Expire the cookies by setting their expiration time in the past
setcookie('user_id', '', time() - 3600, '/'); // Expire the user_id cookie
setcookie('username', '', time() - 3600, '/'); // Expire the username cookie
setcookie('role', '', time() - 3600, '/'); // Expire the role cookie

// Redirect to the login page
header("Location: login.php");
exit();
?>