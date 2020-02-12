<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sammy's cafe</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
</head>
<body>
<header>
    <?php include "header.php";?>
</header>
<section>
	<div id="main_img_bar">
        <img src="./img/terarosa7.jpg">
    </div>
   	<div id="board_box">
	    <h3 class="title">
			게시판 > QnA 내용보기
		</h3>
<?php
    $num  = $_GET["num"];
    $page  = $_GET["page"];

    $con = mysqli_connect("localhost", "root", "123456", "samlpe");
    $sql = "select * from qna where num=$num";
    $result = mysqli_query($con, $sql);

    $row = mysqli_fetch_array($result);
    $id      = $row["id"];
    $name      = $row["name"];
    $regist_day = $row["regist_day"];
    $subject    = $row["subject"];
    $content    = $row["content"];
    $hit          = $row["hit"];

    $content = str_replace(" ", "&nbsp;", $content);
    $content = str_replace("\n", "<br>", $content);

    $new_hit = $hit + 1;
    $sql = "update qna set hit=$new_hit where num=$num";
    mysqli_query($con, $sql);
?>
	    <ul id="view_content">
			<li>
				<span class="col1"><b>제목 :</b> <?=$subject?></span>
				<span class="col2"><?=$name?> | <?=$regist_day?></span>
			</li>
			<li>
				<?=$content?>
			</li>
	    </ul>
	    <ul class="buttons">
				<li><button onclick="location.href='qna_board_list.php?page=<?=$page?>'">목록</button></li>
        <li><button onclick="location.href='qna_board_response_form.php?num=<?=$num?>&page=<?=$page?>'">답변</button></li>

        <?php
        if ($uid === $id) {
            echo "<li><button onclick=\"location.href='qna_board_modify_form.php?num=$num&page=$page'\">수정</button></li>";
            echo "&nbsp";
            echo "<li><button onclick=\"location.href='qna_board_delete.php?num=$num&page=$page'\">삭제</button></li>";

        }?>

				<li><button onclick="location.href='qna_board_form.php'">글쓰기</button></li>
		</ul>
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
