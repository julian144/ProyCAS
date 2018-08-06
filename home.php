<?php
session_start();
  $page_title = 'Home Page';
  require_once('includes/load.php');
  if (isset($_SESSION['userSession'])!="") {
 header("Location: index.php");
 exit;
}
if (isset($_POST['btn-login'])) {
    $email = strip_tags($_POST['username']);
    $password = strip_tags($_POST['password']);
    $username = $DBcon->real_escape_string($username);
    $password = $DBcon->real_escape_string($password);
    $query = $DBcon->query("SELECT id, username, password FROM users WHERE username='$username'");
    $row=$query->fetch_array();
    $count = $query->num_rows; // if email/password are correct returns must be 1 row
    if (password_verify($password, $row['password']) && $count==1) {
        $_SESSION['userSession'] = $row['id'];
        header("Location: index.php");
    } else {
        $msg = "<div class='alert alert-danger'>
        <span class='glyphicon glyphicon-info-sign'></span> &nbsp; DATOS INCORRECTOS
        </div>";
    }
    $DBcon->close();
}
?>
<?php include_once('layouts/header.php'); ?>
<div class="row">
  <div class="col-md-12">
    <?php echo display_msg($msg); ?>
  </div>
 <div class="col-md-12">
    <div class="panel">
      <div class="jumbotron text-center">
         <h1>Esta es su nueva página de inicio</h1>
     
      </div>
    </div>
 </div>
</div>
<?php include_once('layouts/footer.php'); ?>
