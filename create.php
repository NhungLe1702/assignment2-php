<?php
    require "sql.php";

    $error = [];
    

    if(isset($_POST["btn_save"])) {
        $name = $_POST["name"];
        $age = $_POST["age"];
        $img = $_FILES["file_upload"]["name"];
        $descrip = $_POST["description"];

        $target_dir = "uploads/";
        $target_file = $target_dir.$_FILES["file_upload"]["name"];
        $img_Type = pathinfo($target_file, PATHINFO_EXTENSION);
        echo $img_Type;
        $allowUpload = true;
        $allowtype = ["jpg","png","jpeg","gif"];

        if(empty($name)) {
            $error['name_empty'] = "Vui lòng nhập tên";
        }

        if(empty($age)) {
            $error['age_empty'] = "Vui lòng nhập tuổi";
        }

        // if(empty($img)) {
        //     $error['img_empty'] = "Vui lòng chọn ảnh";
        // }

        

        if(isset($_FILES["file_upload"])) {

            $target_dir = "uploads/";
            $name_img = $_FILES["file_upload"]["name"];
            $target_file = $target_dir.$name_img;
            $allowUpload = true;

            $img_Type = pathinfo($target_file, PATHINFO_EXTENSION);
            
           
            $allowtype = ["jpg","png","jpeg","gif"];

            if(!in_array($img_Type, $allowtype)) {
               $error['img_error'] = "Không được upload những ảnh có định dạng khác jpg, png, jprg,gif<br>";
               $allowUpload = false;
            }

            if($allowUpload == true) {
                move_uploaded_file($_FILES["file_upload"]["tmp_name"], $target_file);
            }
        }

        if(!$error) {
            $sql = "INSERT INTO students(NAME_STUDENT, AGE, AVATAR, DESCRIPTION_STUDENT) VALUES('$name', $age, '$img', '$descrip')";
            $conn -> exec($sql);
            // echo "<br>Thêm sinh viên thành công";
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
        body{
            width: 420px;
            margin: 0 auto;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        #add_students {
            box-shadow: 0px 0px 10px 5px rgb(0, 0, 0 ,0.1);
            padding: 10px;
            margin-top: 20px;
        }

        h2 {
            margin: 20px;
        }

        .add_title {
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

        .form_div input {
            flex: 2;
            height: 30px;
        }

        .form_btn {
            text-align: center;
            margin-top: 20px;
        }

        .form_btn input {
            width: 60px;
            border: 1px solid #ccc;
            height: 25px;
            border-radius: 5px;
        }

        /* .form_btn .save {
            background-color: #0090c7;
            border: 1px solid #0090c7;
            color: white;
        } */

        .add_title a {
            text-decoration: none;
            color: black;
            padding: 8px 15px;
            border-radius: 15px;
            border: 1px solid #ccc;
            font-size: 13px;
            

        }
      
        .add_title a:hover {
            background-color: #44cdc7;
            border: 1px solid #44cdc7;
            color: white;
        }
        
    </style>
</head>
<body>
    <div id="add_students">
        <div class="add_title">
            <h2>Thêm mới sinh viên</h2>
            <a class="link" href="index.php">Về trang danh sách</a>
        </div>
        
        <form action="" method="POST" enctype="multipart/form-data">
            <div class="form_div">
                <label>Họ tên</label>
                <input type="text" value="" name="name">
                
            </div>

            <?php
                echo "<br>";
                echo isset($error['name_empty']) ? $error['name_empty'] : "";
            ?>
           
            <div class="form_div">
                <label>Tuổi</label>
                <input type="number" value="" name="age">
                
            </div>

            <?php
                echo "<br>";
                echo isset($error['age_empty']) ? $error['age_empty'] : "";
            ?>
            

            <div class="form_div">
                <label>Ảnh đại diện</label>
                <input type="file" name="file_upload">
            </div>
            <?php
                echo "<br>";
                // echo isset($error['img_empty']) ? $error['img_empty'] : "";
                echo isset($error['img_error']) ? $error['img_error'] : "";
            ?>
            

            <div class="form_div">
                <label>Mô tả sinh viên</label>
                <textarea name="description" id="" cols="30" rows="5"></textarea>
            </div>
            

            <div class="form_btn">
                <input class="save" type="submit" name="btn_save" value="Save">
                <input type="reset" name="btn_reset" value="Reset">
            </div>
            
        </form>
    </div>
</body>
</html>