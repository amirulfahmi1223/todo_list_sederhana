<?php
include "koneksi.php";
//proses update close or open
if (isset($_POST['edit'])) {
  $q_update = "UPDATE tb_task SET task_label = '" . $_POST['task'] . "' WHERE task_id = '" . $_GET['id'] . "'";
  $run_q_update = mysqli_query($conn, $q_update);
  header('Refresh:0; url=index.php');
}
//proses show data
$q_select = "SELECT * FROM tb_task WHERE task_id = '" . $_GET['id'] . "' ORDER BY created_at ASC";
$run_q_select = mysqli_query($conn, $q_select);
$d = mysqli_fetch_array($run_q_select);
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Todo-List</title>
  <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <div class="container">
    <div class="header">
      <div class="title">
        <a href="index.php">
          <i class="bx bx-chevron-left"></i>
          <span>Back</span>
        </a>
      </div>
      <div class="description">
        <?= date("l, d M Y"); ?>
      </div>
    </div>
    <div class="content">
      <div class="card">
        <form action="" method="POST">
          <input type="text" name="task" class="input-control" placeholder="Edit task" value="<?= $d['task_label']; ?>">
          <div class="text-right">
            <button type="submit" name="edit">Edit</button>
          </div>
        </form>
      </div>
</body>

</html>