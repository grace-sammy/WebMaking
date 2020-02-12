<meta charset="utf-8">
<?php
date_default_timezone_set('Asia/Seoul');
    session_start();
    if (isset($_SESSION["uid"])) {
        $uid = $_SESSION["uid"];
    } else {
        $uid = "";
    }
    if (isset($_POST["uname"])) {
        $uname = $_POST["uname"];
    } else {
        $uname = "";
    }

    $subject = $_POST["subject"];
    $content = $_POST["content"];

    $subject = htmlspecialchars($subject, ENT_QUOTES); // mysql_real_escape_string 이걸로 변경하기
    $content = htmlspecialchars($content, ENT_QUOTES);

    $regist_day = date("Y-m-d (H:i)");  // 현재의 '년-월-일-시-분'을 저장

    $con = mysqli_connect("localhost", "root", "123456", "samlpe");

    //그룹번호, 들여쓰기 기본값
    $group_num = 0;
    $depth=0;
    $ord=0;

    $sql="INSERT INTO qna VALUES (null,$group_num,$depth,$ord,'$uid','$uname','$subject','$content','$regist_day',0);";
    $result=mysqli_query($con, $sql);  // $sql 에 저장된 명령 실행
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }
    //현재 최대큰번호를 가져와서 그룹번호로 저장하기
    $sql="SELECT max(num) from qna;";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }

    $row=mysqli_fetch_array($result);
    $max_num=$row['max(num)'];
    
    $sql="UPDATE qna SET group_num= $max_num WHERE num=$max_num;";
    $result = mysqli_query($con, $sql);
    if (!$result) {
        die('Error: ' . mysqli_error($con));
    }


    mysqli_close($con);                // DB 연결 끊기

    echo "
	   <script>
	    location.href = 'qna_board_list.php';
	   </script>
	";
?>
