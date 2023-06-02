<?php
include "koneksi.php";
//proses insert data ke database
if (isset($_POST['add'])) {
  $task = $_POST['task'];
  $q_insert = "INSERT INTO tb_task(task_label,task_status) VALUES (
    '" . $task . "',
    'open'
  )";
  $run_q_insert = mysqli_query($conn, $q_insert);
  if ($run_q_insert) {
    header('Refresh:0; url=index.php');
  }
}

//proses delete
if (isset($_GET['delete'])) {
  $q_delete = "DELETE FROM tb_task WHERE task_id = '" . $_GET['delete'] . "'";
  $run_q_delete = mysqli_query($conn, $q_delete);
  header('Refresh:0; url=index.php');
}

//proses update close or open
if (isset($_GET['done'])) {
  $status = "close";
  if ($_GET['status'] == 'open') {
    $status = "close";
  } else {
    $status = "open";
  }
  $q_update = "UPDATE tb_task SET task_status = '" . $status . "' WHERE task_id = '" . $_GET['done'] . "'";
  $run_q_update = mysqli_query($conn, $q_update);
  header('Refresh:0; url=index.php');
}
//proses show data
$q_select = "SELECT * FROM tb_task ORDER BY created_at ASC";
$run_q_select = mysqli_query($conn, $q_select);
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
        <i class="bx bx-sun"></i>
        <span>To Do List</span>
      </div>
      <div class="description">
        <?= date("l, d M Y"); ?>
      </div>
    </div>
    <div class="content">
      <div class="card">
        <form action="" method="POST">
          <input type="text" name="task" class="input-control" placeholder="Add task">
          <div class="text-right">
            <button type="submit" name="add">Add</button>
          </div>
        </form>
      </div>
      <?php
      if (mysqli_num_rows($run_q_select) > 0) {
        while ($d = mysqli_fetch_array($run_q_select)) {
      ?>
          <div class="card">
            <div class="task-item <?= $d['task_status'] == 'close' ? 'done' : '' ?>">
              <div>
                <input type="checkbox" onclick="window.location.href='?done=<?= $d['task_id']; ?> & status=<?= $d['task_status']; ?>'" <?= $d['task_status'] == 'close' ? 'checked' : '' ?>>
                <span><?= $d['task_label']; ?></span>
              </div>
              <div>
                <a href="edit.php?id=<?= $d['task_id']; ?>" class="text-orange" title="Edit"><i class="bx bx-edit"></i></a>
                <a href="?delete=<?= $d['task_id']; ?>" onclick="return confirm('Are You Sure ?')" class="text-red" title="Remove"><i class="bx bx-trash"></i></a>
              </div>
            </div>
          </div>
        <?php }
      } else { ?>
        <div>Belum ada task</div>
      <?php } ?>
    </div>
  </div>
</body>

</html>