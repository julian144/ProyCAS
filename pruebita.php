<?php
  $page_title = 'Agregar ganado';
  require_once('includes/load.php');
  require_once('login.php');
  // Checkin What level user has permission to view this page
  page_require_level(2);
  $all_categories = find_all('categories');
  $all_photo = find_all('media');
  $userid = $_SESSION['userSession'];
?>
<?php echo "$userid"?>