<?php
include "./config.php";

if (isset($_GET['action']) && $_GET['action'] === "delete") {
    $file_id = $conn->real_escape_string($_GET["file_id"]);

    $sql = "DELETE from file where id= $file_id";
    $res = $conn->query($sql);

    if ($res) {
        header("location:index.php");
        // unlink();
    } else {
        echo Show_alert("There was an error while trying to delete this file <br />" . $conn->error);
    }
}

function show_alert($message, $type = "error")
{
    $style = "background-color: #b52419";
    if ($type == "success") {
        $style = "background-color: #1fab21";
    }

    return "
    <div style='display: flex;'>
        <a href='./index.php' style='padding: 10px; border-radius: 10px; background-color: #42379e; color: #fff'>go Back</a>
        <div style='padding: 10px 30px; margin: 0 10px; color: #ffffff; border-radius: 10px; $style'>
            $message
        </div>
    </div>
    ";
}
