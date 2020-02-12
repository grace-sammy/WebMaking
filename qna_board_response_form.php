<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
<title>Sammy's cafe</title>
<link rel="stylesheet" type="text/css" href="./css/common.css">
<link rel="stylesheet" type="text/css" href="./css/board.css">
<script>
  function check_input() {
      if (!document.board_form.subject.value)
      {
          alert("제목을 입력하세요!");
          document.board_form.subject.focus();
          return;
      }
      if (!document.board_form.content.value)
      {
          alert("내용을 입력하세요!");
          document.board_form.content.focus();
          return;
      }
      document.board_form.submit();
   }
</script>
</head>
<body>
<header>
    <?php include "header.php";?>
</header>
<section>
	<div id="main_img_bar">
        <img src="./img/terarosa8.jpg">
    </div>
   	<div id="board_box">
	    <h3 id="board_title">
	    		게시판 > 답글 쓰기
		</h3>
<?php
    $num  = $_GET["num"];
    $page = $_GET["page"];

//  echo "<script>alert('{$num}');</script>";
//  echo "<script>alert('{$page}');</script>";

    $con = mysqli_connect("localhost", "root", "123456", "samlpe");
    $sql = "select * from qna where num=$num";
    $result = mysqli_query($con, $sql);
    $row = mysqli_fetch_array($result);
    $name       = $username;
    $subject    = $row["subject"];
    $content    = $row["content"];
    $depth=(int)$row['depth'];//공간을 몆칸을 띄어야할지 결정하는 숫자임
    $space="";
            for ($j=0;$j<$depth;$j++) {
                $space="&nbsp;&nbsp;".$space;
            }
?>
	    <form  name="board_form" method="post" action="qna_board_response.php?num=<?=$num?>&page=<?=$page?>" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$name?></span>
				</li>
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text" value="[RE]<?=$subject?>"></span>
	    		</li>
	    		<li id="text_area">
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content">[RE]<?=$content?></textarea>
	    			</span>
	    		</li>
	    	    </ul>
	    	<ul class="buttons">
				<li><button type="button" onclick="check_input()">완료</button></li>
				<li><button type="button" onclick="location.href='qna_board_list.php'">목록</button></li>
			</ul>
	    </form>
	</div> <!-- board_box -->
</section>
<footer>
    <?php include "footer.php";?>
</footer>
</body>
</html>
