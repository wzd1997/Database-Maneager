SET NAMES UTF8;
DROP DATABASE IF EXISTS stu;
CREATE DATABASE stu CHARSET=UTF8;
USE stu;
CREATE TABLE stu_message(
    sid INT PRIMARY KEY AUTO_INCREMENT,
    stu_id INT(64),
    stu_name VARCHAR(16),
    stu_sex VARCHAR(16),
    stu_email VARCHAR(64),
    stu_year VARCHAR(16),
    stu_phone VARCHAR(11),
    stu_addr VARCHAR(64)
);
INSERT INTO stu_message VALUES (
    null,
    1501050319,
    '周杰伦',
    '男',
    '904283224@qq.com',
    '1997-10',
    '13684505671',
    '哈尔滨市道外区'
);
INSERT INTO stu_message VALUES (
    null,
    150119,
    '邓紫棋',
    '女',
    '904283224@qq.com',
    '1997-10',
    '13684505671',
    '哈尔滨市道外区'
);
SELECT * FROM stu_message;