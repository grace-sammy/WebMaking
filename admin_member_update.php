<?php
    session_start();
    if (isset($_SESSION["userlevel"])) {
        $userlevel = $_SESSION["userlevel"];
    } else {
        $userlevel = "";
    }

    if ($userlevel != 1) {
        echo("
            <script>
            alert('관리자가 아닙니다! 회원정보 수정은 관리자만 가능합니다!');
            history.go(-1)
            </script>
        ");
        exit;
    }

    $id   = $_GET["id"];
    $ulevel = $_POST["ulevel"];
    $upoint = $_POST["upoint"];

    //echo "<script>alert('userlevel: {$ulevel}, userpoint: {$upoint}');</script>";

    $con = mysqli_connect("localhost", "root", "123456", "samlpe");
    $sql = "update members set userlevel='$ulevel', userpoint='$upoint' where uid='$id'";
    mysqli_query($con, $sql);

    mysqli_close($con);

    //header('Location: admin.php');
    //exit;

    echo "
         <script>
             location.href = 'admin.php';
         </script>
       ";

       ?>
