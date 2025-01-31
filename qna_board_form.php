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

<!-- 로그인 안하고 쪽지 메뉴 탭했을 경우 -->
<?php
    if (!$uid) {
        echo("<script>
				alert('로그인 후 이용해주세요!');
				history.go(-1);
				</script>
			");
        // exit 써도 좋고 안써도 괜찮다
        exit;
    }
?>

<section>
	<div id="main_img_bar">
        <img src="./img/terarosa9.jpg">
    </div>
   	<div id="board_box">
	    <h3 id="board_title">
	    		게시판 > 글 쓰기
		</h3>
	    <form  name="board_form" method="post" action="qna_board_insert.php" enctype="multipart/form-data">
	    	 <ul id="board_form">
				<li>
					<span class="col1">이름 : </span>
					<span class="col2"><?=$username?></span>
          <input type="hidden" name="uname" value="<?=$username?>">
				</li>
	    		<li>
	    			<span class="col1">제목 : </span>
	    			<span class="col2"><input name="subject" type="text"></span>
	    		</li>
	    		<li id="text_area">
	    			<span class="col1">내용 : </span>
	    			<span class="col2">
	    				<textarea name="content"></textarea>
	    			</span>
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
