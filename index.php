<?php
require "sql.php";
$query = "SELECT * FROM students";
$result = $conn->query($query)->fetchAll();
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
            width: 1100px;
            margin: 0 auto;
            font-family: 'Lucida Sans', 'Lucida Sans Regular', 'Lucida Grande', 'Lucida Sans Unicode', Geneva, Verdana, sans-serif;
        }

        #index_students {
            box-shadow: 0px 0px 10px 5px rgb(0, 0, 0, 0.1);
            padding: 40px;
            margin-top: 20px;
        }

        .index_title {
            text-align: center;
            margin-bottom: 30px;
        }

        .index_title h2 {
            margin-top: 0px;
        }

        .btn_edit,
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

        .btn_edit:hover,
        a:hover {
            background-color: #44cdc7;
            border: 1px solid #44cdc7;
            color: white;
        }

        td {
            min-width: 100px;
            text-align: center;

        }

        img {
            width: 50%;
        }

        .title_table {
            height: 50px;
        }
    </style>
</head>

<body>
    <div id="index_students">
        <div class="index_title">
            <h2>Danh sách sinh viên</h2>
            <a href="create.php">Thêm mới</a>
        </div>

        <table border="1">
            <tr class="title_table">
                <td>ID</td>
                <td>Tên</td>
                <td>Tuổi</td>
                <td>Ảnh đại diện</td>
                <td>Mô tả</td>
                <td>Ngày tạo</td>
                <td>Action</td>
                <td>Action</td>
            </tr>
            <?php
            foreach ($result as $key => $value) {
            ?>
                <tr>
                    <td><?php echo $value["ID"] ?></td>
                    <td><?php echo $value["NAME_STUDENT"] ?></td>
                    <td><?php echo $value["AGE"] ?></td>
                    <td><img src="uploads/<?php echo $value['AVATAR'] ?>"></td>
                    <td><?php echo $value["DESCRIPTION_STUDENT"] ?></td>
                    <td><?php echo $value["CREATED_AT"] ?></td>

                    <td><button class="btn_edit" type="button" onclick="location.href='edit.php?id=<?php echo $value['ID']; ?>'">Sửa</button></td>

                    <td><a href="javascript: confirmDelete('delete.php?id=<?php echo $value['ID'] ?>')">Xoá</a></td>

                </tr>
            <?php } ?>
        </table>
    </div>
</body>

<script>
    function confirmDelete(deleUrl) {
        if (confirm("Bạn có muốn xoá sinh viên không?")) {
            document.location = deleUrl;
        }
    }
</script>

</html>