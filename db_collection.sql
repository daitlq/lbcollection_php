DROP TABLE IF EXISTS bok_Book;
CREATE TABLE bok_Book (
	id INT(10) NOT NULL AUTO_INCREMENT,
	title VARCHAR(50) NOT NULL,
	author VARCHAR(100) DEFAULT NULL,
	publisher VARCHAR(50) DEFAULT NULL,
	language VARCHAR(20) DEFAULT NULL,
	publication_date DATE DEFAULT NULL,
	description BLOB DEFAULT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS bok_Tag;
CREATE TABLE bok_Tag (
	id INT(10) NOT NULL AUTO_INCREMENT,
	name VARCHAR(20) NOT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

DROP TABLE IF EXISTS bok_BookTag;
CREATE TABLE bok_BookTag (
	id INT(10) NOT NULL AUTO_INCREMENT,
	book_id INT(10) NOT NULL,
	tag_id	INT(10) NOT NULL,
	PRIMARY KEY (id),
	CONSTRAINT Constr_BookTag_Book_fk
		FOREIGN KEY book_fk (book_id) REFERENCES bok_Book (id)
		ON DELETE CASCADE ON UPDATE CASCADE,
	CONSTRAINT Constr_BookTag_Tag_fk
		FOREIGN KEY tag_fk (tag_id) REFERENCES bok_Tag (id)
		ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table bok_Book
--
LOCK TABLES bok_Book WRITE;
INSERT INTO bok_Book VALUES (1,'Tu thu','Doan Trung Con','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO bok_Book VALUES (2,'Dao Duc Kinh','Nguyen Hien Le','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO bok_Book VALUES (3,'Chu Dich','Nguyen Van Tho','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO bok_Book VALUES (4,'Co So Ngu Van Han Nom','Le Tri Vien','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO bok_Book VALUES (5,'Viet Nam Su Luoc','Tran Trong Kim','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO bok_Book VALUES (6,'Khổng Học Đăng','Phan Bội Châu','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO bok_Book VALUES (7,'Nho Giáo','Trần Trọng Kim','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
UNLOCK TABLES;
-- Dump completed

--
-- Dumping data for table bok_Tag
--
LOCK TABLES bok_Tag WRITE;
INSERT INTO bok_Tag VALUES (1, 'Triết học');
INSERT INTO bok_Tag VALUES (2, 'Văn học');
INSERT INTO bok_Tag VALUES (3, 'Lịch sử');
INSERT INTO bok_Tag VALUES (4, 'Tôn giáo');
INSERT INTO bok_Tag VALUES (5, 'Huyền môn');
INSERT INTO bok_Tag VALUES (6, 'Chu Dịch');
INSERT INTO bok_Tag VALUES (7, 'Văn hóa - Giáo dục');
INSERT INTO bok_Tag VALUES (8, 'Báo - Tạp chí');
INSERT INTO bok_Tag VALUES (9, 'Từ điển');
INSERT INTO bok_Tag VALUES (10, 'Giáo khoa');
INSERT INTO bok_Tag VALUES (11, 'Kinh tế');
INSERT INTO bok_Tag VALUES (12, 'Hán Nôm');
UNLOCK TABLES;
-- Dump completed

--
-- Dumping data for table bok_Tag
--
LOCK TABLES bok_BookTag WRITE;
INSERT INTO bok_BookTag VALUES (1, 1, 1);
INSERT INTO bok_BookTag VALUES (2, 2, 1);
INSERT INTO bok_BookTag VALUES (3, 3, 1);
INSERT INTO bok_BookTag VALUES (4, 3, 6);
INSERT INTO bok_BookTag VALUES (5, 4, 2);
INSERT INTO bok_BookTag VALUES (6, 4, 12);
INSERT INTO bok_BookTag VALUES (7, 5, 3);
INSERT INTO bok_BookTag VALUES (8, 6, 1);
INSERT INTO bok_BookTag VALUES (9, 7, 1);
UNLOCK TABLES;
-- Dump completed