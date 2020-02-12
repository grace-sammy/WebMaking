create table members (
    uid char(30) not null,
    upw char(30) not null,
    umail char(40),
    uname char(20),
    unum1 char(20),
    byear char(20),
    bmonth char(20),
    bday char(20),
    self char(50),
    userlevel char(10),
    userpoint char(10),
    primary key(uid)
);
