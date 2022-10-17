<?php
$servername = "localhost";
$username = "nhunglt";
$password = "123456";

try {
    $conn = new PDO("mysql:host=$servername;dbname=quanlysinhvien", $username, $password);
    // Thiết lập lỗi PDO thành ngoại lệ
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Connected successfully";

    // sql to create table
    $sql = "CREATE TABLE IF NOT EXISTS students (
        ID INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
        NAME_STUDENT VARCHAR(255),
        AGE INT(11),
        AVATAR VARCHAR(255),
        DESCRIPTION_STUDENT TEXT,
        CREATED_AT TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP)";  

    // use exec() because no results are returned
    $conn->exec($sql);
    echo "Table students created successfully";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
// ~s/6i>x|\U%lXko~
// 7pbTJqQpXatIpT0SvS
