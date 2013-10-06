DROP TABLE IF EXISTS book;
CREATE TABLE book (
	id INT(11) NOT NULL AUTO_INCREMENT,
	title VARCHAR(50) NOT NULL,
	category VARCHAR(20) NOT NULL,
	author VARCHAR(100) DEFAULT NULL,
	publisher VARCHAR(50) DEFAULT NULL,
	language VARCHAR(20) DEFAULT NULL,
	publication_date DATE DEFAULT NULL,
	description BLOB DEFAULT NULL,
	PRIMARY KEY (id)
) ENGINE=InnoDB AUTO_INCREMENT=53 DEFAULT CHARSET=utf8;

--
-- Dumping data for table book
--

LOCK TABLES book WRITE;
INSERT INTO book VALUES (1,'Tu thu','Triet','Doan Trung Con','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO book VALUES (2,'Dao Duc Kinh','Triet','Nguyen Hien Le','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO book VALUES (3,'Chu Dich','Triet','Nguyen Van Tho','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO book VALUES (4,'Co So Ngu Van Han Nom','Han-Nom','Le Tri Vien','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO book VALUES (5,'Viet Nam Su Luoc','Lich Su','Tran Trong Kim','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO book VALUES (6,'Khổng Học Đăng','Triet','Phan Bội Châu','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
INSERT INTO book VALUES (7,'Nho Giáo','Triet','Trần Trọng Kim','NXB Van Hoa','Viet Nam','2009-10-10','Dai Hoc - Trung Dung - Luan Ngu - Manh Tu');
UNLOCK TABLES;
-- Dump completed
