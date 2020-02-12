        <div class="slideshow">
          <div class="slideshow_slides">
            <a href="#"><img src="./img/terarosa4.jpg" alt="slide1"> </a>
            <a href="#"><img src="./img/terarosa2.jpg" alt="slide2"> </a>
            <a href="#"><img src="./img/terarosa3.jpg" alt="slide3"> </a>
            <a href="#"><img src="./img/terarosa1.jpg" alt="slide4"> </a>
            <a href="#"><img src="./img/terarosa5.jpg" alt="slide4"> </a>
            <a href="#"><img src="./img/terarosa6.jpg" alt="slide4"> </a>
          </div>
          <div class="slideshow_nav">
            <a href="#" class="prev">prev</a>
            <a href="#" class="next">next</a>
          </div>
          <div class="slideshow_indicator">
            <a href="#">&nbsp;</a>
            <a href="#">&nbsp;</a>
            <a href="#">&nbsp;</a>
            <a href="#">&nbsp;</a>
            <a href="#">&nbsp;</a>
            <a href="#">&nbsp;</a>
          </div>
        </div>
        <div id="main_content">
            <div id="latest">
                <h4>P O S T</h4>
                <ul>
          <!-- 최근 게시 글 DB에서 불러오기 -->
          <?php
              $con = mysqli_connect("localhost", "root", "123456", "samlpe");
              $sql = "select * from board order by num desc limit 5";
              $result = mysqli_query($con, $sql);

              if (!$result) {
                  echo "게시판 DB 테이블(board)이 생성 전이거나 아직 게시글이 없습니다!";
              } else {
                  while ($row = mysqli_fetch_array($result)) {
                      $regist_day = substr($row["regist_day"], 0, 10); ?>
                          <li>
                              <span><?=$row["subject"]?></span>
                              <span><?=$row["name"]?></span>
                              <span><?=$regist_day?></span>
                          </li>
          <?php
                  }
              }
          ?>
            </div>
            <div id="point_rank">
                <h4>POINT RANKING</h4>
                <ul>
<!-- 포인트 랭킹 표시하기 -->
<?php
    $rank = 1;
    $sql = "select * from members order by userpoint desc limit 5";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        echo "회원 DB 테이블(members)이 생성 전이거나 아직 가입된 회원이 없습니다!";
    } else {
        while ($row = mysqli_fetch_array($result)) {
            $name  = $row["uname"];
            $id    = $row["uid"];
            $point = $row["userpoint"];
            $name = mb_substr($name, 0, 1)." * ".mb_substr($name, 2, 1); ?>
                <li>
                    <span><?=$rank?></span>
                    <span><?=$name?></span>
                    <span><?=$id?></span>
                    <span><?=$point?></span>
                </li>
<?php
            $rank++;
        }
    }

    mysqli_close($con);
?>
                </ul>
            </div>
        </div>
