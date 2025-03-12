<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <title>Task manager UI</title>
  <link rel="stylesheet" href="./assets/css/style.css">

</head>

<body>
  <!-- partial:index.partial.html -->
  <div class="page">
    <div class="pageHeader">
      <div class="title">Dashboard</div>
      <div class="userPanel">
        <a href="<?= siteUrl("?logout=1") ?>">
          <i class="fa fa-sign-out"></i>
        </a>
        <span class="username"><?= $user->name ?? "Unknown" ?> </span>
        <img src="https://s3.amazonaws.com/uifaces/faces/twitter/kolage/73.jpg" width="40" height="40" />
      </div>
    </div>
    <div class="main">
      <div class="nav">
        <div class="searchbox">
          <div><i class="fa fa-search"></i>
            <input type="search" placeholder="Search" />
          </div>
        </div>
        <div class="menu">
          <div class="title">folders</div>
          <ul class="folders-list">
            <li class="<?= (!isset($_GET['folder_id'])) ? "active" : "" ?>">
              <a href="<?= siteUrl() ?>">
                <i class="fa fa-folder"></i>
                All
              </a>
            </li>
            <?php foreach ($folders as $folder): ?>
              <li class="<?= (isset($_GET['folder_id']) && $_GET['folder_id'] == $folder->id) ? "active" : "" ?>">
                <a href="?folder_id=<?= $folder->id ?>"><i class="fa fa-folder"></i><?= $folder->name ?></a>
                <a href="?delete_folder=<?= $folder->id ?>" onclick="return confirm('Are you sure to delete this item?');"><i class="fa fa-times remove"></i></a>
              </li>
            <?php endforeach; ?>
          </ul>
        </div>
        <div>
          <input type="text" placeholder="Add new Folder" id="addNewFolder" />
          <button id="addNewFolderBtn" class="btn clickable">+</button>
        </div>
      </div>
      <div class="view">
        <div class="viewHeader">
          <div class="title" style="width: 40%;">
            <input type="text" placeholder="Add new task"
              style="width: 100%;margin-left: 3%;line-height: 30px;"
              id="addNewTask" />
          </div>
          <div class="functions">
            <div class="button active">Add New Task</div>
            <div class="button">Completed</div>

          </div>
        </div>
        <div class="content">
          <div class="list">
            <div class="title">Today </div>
            <ul>
              <?php if (sizeof($tasks) > 0): ?>

                <?php
                foreach ($tasks as $task): ?>
                  <li class="<?= $task->status ? "checked" : "" ?> ">
                    <i data-taskId="<?= $task->id ?>" class="isDone clickable <?= $task->status ? "fa fa-check-square-o" : "fa fa-square-o" ?>"></i>
                    <span><?= $task->title ?></span>
                    <div class="info">
                      <span class="created-at">Created At <?= $task->created_at ?></span>
                      <a href="?delete_task=<?= $task->id ?>" onclick="return confirm('Are you sure to delete this item? \n <?= $task->title ?>');"><i class="fa fa-trash-o"></i></a>
                    </div>
                  </li>

                <?php endforeach; ?>

              <?php else: ?>
                <li>No Task Here .. </li>
              <?php endif; ?>
            </ul>
          </div>

        </div>
      </div>
    </div>
  </div>
  <!-- partial -->
  <script src='//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src=".assets/js/script.js"></script>

  <script>
    $(document).ready(function() {
      $('#addNewFolderBtn').click(function(e) {

        var input = $('input#addNewFolder');

        $.ajax({
          url: "process/ajaxHandler.php",
          method: "post",
          data: {
            action: "addFolder",
            folderName: input.val()
          },
          success: function(response) {
            if (response == 1) {

              $(`<li>
                <a href="?folder_id=<?= $folder->id ?>"><i class="fa fa-folder"></i>` + input.val() + `</a>
                <a href="?delete_folder=<?= $folder->id ?>"><i class="fa fa-times remove"></i></a>
              </li>`).appendTo("ul.folders-list")

            } else {
              alert(response)
            }

          },
        })

      })

      $('input#addNewTask').on('keypress', function(e) {

        if (e.which == 13) {

          $.ajax({
            url: "process/ajaxHandler.php",
            method: "post",
            data: {
              action: "addTask",
              folderId: `<?= $_GET['folder_id'] ?? 0 ?>`,
              taskTitle: $('input#addNewTask').val(),
            },
            success: function(response) {

              if (response == 1) {

                location.reload()

              } else {

                alert(response)
              }

            },
          })

        };
      });

      $('#addNewTask').focus()


      $('.isDone').click(function(e) {
        var taskId = $(this).attr('data-taskId');

        $.ajax({
          url: "process/ajaxHandler.php",
          method: "post",
          data: {
            action: "doneToggle",
            taskId: taskId,
          },
          success: function(response) {
            location.reload()
          },
        })
      })


    })
  </script>

</body>

</html>