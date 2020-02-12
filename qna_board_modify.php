<?php
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

    $sql="UPDATE qna SET subject='$subject', content='$content' WHERE num=$num;";
    mysqli_query($con, $sql);

    mysqli_close($con);

    echo "
	      <script>
	          location.href = 'qna_board_list.php?page=$page';
	      </script>
	  ";
