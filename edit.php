<?php
require "sql.php";
$id = $_GET["id"];
$sql = "SELECT * FROM students WHERE ID = '$id' ";
$row = $conn->query($sql)->fetch();

$error = [];

if (isset($_POST["btn_edit"])) {
    $name = $_POST["name"];
    $age = $_POST["age"];
    $img = $_FILES["file_upload"];
    $des = $_POST["description"];

    $target_dir = "uploads/";
    $target_file = $target_dir . $_FILES["file_upload"]["name"];
    $img_Type = pathinfo($target_file, PATHINFO_EXTENSION);

    $allowUpload = true;
    $allowtype = ["jpg", "png", "jpeg", "gif"];

    if (empty($name)) {
        $error['name_empty'] = "Vui lòng nhập tên";
    }

    if (empty($age)) {
        $error['age_empty'] = "Vui lòng nhập tuổi";
    }

    if (isset($_FILES["file_upload"])) {

        $target_dir = "uploads/";
        $name_img = $_FILES["file_upload"]["name"];
        $target_file = $target_dir . $name_img;
        $allowUpload = true;

        $img_Type = pathinfo($target_file, PATHINFO_EXTENSION);

        $allowtype = ["jpg", "png", "jpeg", "gif"];

        if (!in_array($img_Type, $allowtype)) {
            $error['img_error'] = "Không được upload những ảnh có định dạng khác jpg, png, jprg,gif<br>";
            $allowUpload = false;
        }

        if ($allowUpload == true) {
            move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file);
        }
    }

    if (!$error) {
        $sql_update = "UPDATE students SET NAME_STUDENT = '$name', AGE = $age, AVATAR = '$name_img' , DESCRIPTION_STUDENT = '$des' WHERE ID = '$id')";
        $conn->exec($sql_update);
        header("location: index.php");
    }
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <style>
        body {
            width: 420px;
            margin: 0 auto;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        #edit_students {
            box-shadow: 0px 0px 10px 5px rgb(0, 0, 0, 0.1);
            padding: 10px;
            margin-top: 20px;
        }

        h2 {
            margin: 20px;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .form_div {
            display: flex;
            justify-content: space-between;
            margin-top: 20px;
        }

        .form_div label {
            flex: 1;
        }

        .form_div .form_input {
            flex: 2;
            height: 30px;
        }

        .form_div img {
            width: 50%;
        }

        .form_div .form--img {
            min-height: 150px;
        }

        .form_btn {
            text-align: center;
            margin-top: 20px;
        }



        .form_btn input {
            width: 60px;
            height: 30px;
            background-color: white;
            border: 1px solid #ccc;
            border-radius: 20px;
        }

        a {
            text-decoration: none;
            color: black;
            padding: 8px 15px;
            border-radius: 15px;
            border: 1px solid #ccc;
            font-size: 13px;
            font-weight: bold;
            background: white;

        }

        a:hover {
            background-color: #44cdc7;
            border: 1px solid #44cdc7;
            color: white;
        }

        .btn_edit:hover {
            background-color: #44cdc7;
            color: white;
            border: 1px solid #44cdc7;
            font-weight: bold;
        }

        .btn_reset:hover {
            border: 1px solid #ccc;
            background-color: rgb(162, 161, 161);
            color: white;
            font-weight: bold;
        }
    </style>
</head>

<body>
    <div id="edit_students">
        <div class="title">
            <h2>Sửa sinh viên</h2>
            <a class="link" href="index.php">Về trang danh sách</a>
        </div>

        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form_div">
                <label>Họ tên</label>
                <input class="form_input" type="text" value="<?php echo $row['NAME_STUDENT'] ?>" name="name">
            </div>

            <?php
            echo "<br>";
            echo isset($error['name_empty']) ? $error['name_empty'] : "";
            ?>

            <div class="form_div">
                <label>Tuổi</label>
                <input class="form_input" type="text" value="<?php echo $row['AGE'] ?>" name="age">
            </div>

            <?php
            echo "<br>";
            echo isset($error['age_empty']) ? $error['age_empty'] : "";
            ?>

            <div class="form_div">
                <label>Ảnh đại diện</label>
                <input class="form_input" type="file" name="file_upload"><br>

            </div>

            <?php
            echo "<br>";
            echo isset($error['img_error']) ? $error['img_error'] : "";
            ?>

            <div class="form_div">
                <label for="Ảnh"></label>
                <div class="form_input form--img">
                    <img src="uploads/<?php echo $row['AVATAR'] ?>" alt="">
                </div>

            </div>

            <div class="form_div">
                <label>Mô tả sinh viên</label>
                <textarea name="description" cols="30" rows="5"><?php echo $row['DESCRIPTION_STUDENT'] ?></textarea>
            </div>

            <div class="form_btn">
                <input class="btn_edit" type="submit" name="btn_edit" value="Edit">
                <input class="btn_reset" type="reset" name="btn_reset" value="Reset">
            </div>

        </form>
    </div>
</body>

</html>