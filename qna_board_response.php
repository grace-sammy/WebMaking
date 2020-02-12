<?php
date_default_timezone_set('Asia/Seoul');
session_start();
    $num = $_GET["num"];
    $page = $_GET["page"];

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $con = mysqli_connect("localhost", "root", "123456", "samlpe");
    //악성사용자로부터 injection공격 방어
    $subject = mysqli_real_escape_string($con, $subject);
    $content = mysqli_real_escape_string($con, $content);

    $subject = htmlspecialchars($subject, ENT_QUOTES);
    $content = htmlspecialchars($content, ENT_QUOTES);

    $sql="SELECT * from qna where num =$num;";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }
    $row=mysqli_fetch_array($result);

    $userid=$_SESSION["uid"];

    $regist_day =date("Y-m-d (H:i)");
    $hit =0;

    //현재 그룹넘버값을 가져와서 저장한다.
    $group_num=(int)$row['group_num'];
    //현재 들여쓰기값을 가져와서 증가한후 저장한다.
    $depth=(int)$row['depth'] + 1;
    //현재 순서값을 가져와서 증가한후 저장한다.
    $ord=(int)$row['ord'] + 1;

    //현재 그룹넘버가 같은 모든 레코드를 찾아서 현재 $ord값보다 같거나 큰 레코드에 $ord 값을 1을 증가시켜 저장한다.
    $sql="UPDATE qna SET ord=ord+1 WHERE group_num = $group_num and ord >= $ord";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    $sql="INSERT INTO qna VALUES (null,$group_num,$depth,$ord,
        '$userid','$username', '$subject','$content','$regist_day',$hit);";
        $result = mysqli_query($con, $sql);
        if (!$result) {
            die('Error: ' . mysqli_error($con));
        }

    $sql="SELECT max(num) from qna;";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }
    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];


    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'qna_board_list.php?page=$page';
	      </script>
	  ";
