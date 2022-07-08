<!DOCTYPE html>
<html>

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width" />
  <link href="https://fonts.googleapis.com/css?family=Roboto:400,400i,700" rel="stylesheet" />
  <link rel="stylesheet" href="styles.css" />

  <title>Upload documents</title>
</head>

<body>
  <div class="container">
    <h1 style="text-align: center;">Upload documents here</h1>
    <div class="form">
      <form action="./insert.php" method="post" enctype="multipart/form-data">
        <div>
          <input type="text" name="file_title" placeholder="Enter the file title" class="text" id="" required>
        </div>
        <div class="drop-area-container" style="text-align: center;">
          <label for="uploader" class="drop_area">
            drop file here <br />or click to choose files
          </label>
          <div class="preview"></div>
        </div>
        <div class="input">
          <input type="file" style="display: none" multiple id="uploader" name="file[]" accept=".pdf" />
        </div>
        <button type="submit" name="submit_btn" class="submit">Save and Upload</button>
      </form>
    </div>
    <?php
    include "./config.php";

    $sql = "SELECT * FROM file order by id desc";
    $res = $conn->query($sql);
    if ($res->num_rows > 0) {
    ?>
      <div class="files">
        <?php
        while ($row = $res->fetch_assoc()) {
        ?>
          <div class="file">
            <div class="thumb">
              <div class="img">
                <img src="./images/pdf-logo.jpg" alt="PDF">
              </div>
            </div>
            <div class="desc">
              <div>
                <a href="./uploads/<?= $row["file_name"] ?>" title="<?= $row['file_name'] ?>"><?= $row["file_title"] ?></a>
                &nbsp;
                <a href="./uploads/<?= $row["file_name"] ?>" download>Download</a>
              </div>
            </div>
            <a href="delete.php?file_id=<?= $row["id"] ?>&action=delete" class="close-btn">&times;</a>
          </div>
        <?php
        }
        ?>
      </div>
    <?php
    }
    ?>
  </div>
  <script src="./script.js"></script>



</body>

</html>