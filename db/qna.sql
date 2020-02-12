create table qna (
  num int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  group_num int UNSIGNED NOT NULL,
  depth int UNSIGNED NOT NULL,
  ord int UNSIGNED NOT NULL,
  id char(15) NOT NULL,
  name char(10) NOT NULL,
  subject varchar(100) NOT NULL,
  content text NOT NULL,
  regist_day char(20) DEFAULT NULL,
  hit TINYINT UNSIGNED  DEFAULT 0,
  PRIMARY KEY (num)
);
