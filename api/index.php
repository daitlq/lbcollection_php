<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/books', 'getAllBooks');
$app->get('/books/:id',	'getBook');
$app->get('/books/search/:query', 'findByTitle');
$app->post('/books', 'addBook');
$app->put('/books/:id', 'updateBook');
$app->delete('/books/:id',	'deleteBook');

$app->get('/tags', 'getAllTags');

$app->get('/booktag', 'getAllBookTag');
$app->get('/booktag/:id', 'getBookTag');
$app->post('/booktag', 'addBookTag');
$app->put('/booktag/:id', 'updateBookTag');
$app->delete('/booktag/:id', 'deleteBookTag');
$app->get('/booktag/searchByBook/:id', 'findTagsByBook');
//$app->get('/tagsofbook/:id', 'getTagsOfBook');

$app->run();

function getAllBooks() {
	$sql = "select * FROM bok_Book";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$books = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($books);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getBook($id) {
	$sql = "SELECT * FROM bok_Book WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$book = $stmt->fetchObject();
		$db = null;
		echo json_encode($book); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function findByTitle($query) {
	$sql = "SELECT * FROM bok_Book WHERE UPPER(title) LIKE :query ORDER BY title";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);
		$query = "%".$query."%";  
		$stmt->bindParam("query", $query);
		$stmt->execute();
		$books = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($books);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addBook() {
	//error_log('addBook\n', 3, '/var/tmp/php.log');
	$request = \Slim\Slim::getInstance()->request();
	$book = json_decode($request->getBody());
	$sql = "INSERT INTO bok_Book (title, author, publisher, language, publication_date, description) VALUES (:title, :author, :publisher, :language, :publication_date, :description)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("title", $book->title);
		$stmt->bindParam("author", $book->author);
		$stmt->bindParam("publisher", $book->publisher);
		$stmt->bindParam("language", $book->language);
		$stmt->bindParam("publication_date", $book->publication_date);
		$stmt->bindParam("description", $book->description);
		$stmt->execute();
		$book->id = $db->lastInsertId();
		$db = null;
		echo json_encode($book); 
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function updateBook($id) {
	$request = \Slim\Slim::getInstance()->request();
	$book = json_decode($request->getBody());
	$sql = "UPDATE bok_Book SET title=:title, author=:author, publisher=:publisher, language=:language, publication_date=:publication_date, description=:description WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("title", $book->title);
		$stmt->bindParam("author", $book->author);
		$stmt->bindParam("publisher", $book->publisher);
		$stmt->bindParam("language", $book->language);
		$stmt->bindParam("publication_date", $book->publication_date);
		$stmt->bindParam("description", $book->description);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($book); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteBook($id) {
	$sql = "DELETE FROM bok_Book WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo '{"success":{"id":'. $id .'}}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function getAllTags() {
	$sql = "select * FROM bok_Tag";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$tags = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($tags);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getAllBookTag() {
	$sql = "select bt.id, b.title, t.name FROM bok_Book b, bok_Tag t, bok_BookTag bt WHERE bt.tag_id = t.id AND bt.book_id = b.id";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$bookTag = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($bookTag);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getBookTag($id) {
	$sql = "SELECT * FROM bok_BookTag WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$bookTag = $stmt->fetchObject();
		$db = null;
		echo json_encode($bookTag); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function addBookTag() {
	//error_log('addBook\n', 3, '/var/tmp/php.log');
	$request = \Slim\Slim::getInstance()->request();
	$bookTag = json_decode($request->getBody());
	$sql = "INSERT INTO bok_BookTag (book_id, tag_id) VALUES (:book_id, :tag_id)";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("book_id", $bookTag->book_id);
		$stmt->bindParam("tag_id", $bookTag->tag_id);
		$stmt->execute();
		$bookTag->id = $db->lastInsertId();
		$db = null;
		echo json_encode($bookTag); 
	} catch(PDOException $e) {
		//error_log($e->getMessage(), 3, '/var/tmp/php.log');
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function updateBookTag($id) {
	$request = \Slim\Slim::getInstance()->request();
	$bookTag = json_decode($request->getBody());
	$sql = "UPDATE bok_BookTag SET book_id=:book_id, tag_id=:tag_id WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("book_id", $bookTag->book_id);
		$stmt->bindParam("tag_id", $bookTag->tag_id);
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo json_encode($bookTag); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function deleteBookTag($id) {
	$sql = "DELETE FROM bok_BookTag WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$db = null;
		echo '{"success":{"id":'. $id .'}}';
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}';
	}
}

function findTagsByBook($id) {
	$sql = "SELECT bt.id, bt.tag_id, b.title, t.name FROM bok_Book b, bok_Tag t, bok_BookTag bt WHERE bt.book_id=:id AND bt.tag_id = t.id AND bt.book_id = b.id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("id", $id);
		$stmt->execute();
		$bookTags = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($bookTags); 
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getConnection() {
	$dbhost="127.0.0.1";
	$dbuser="root";
	$dbpass="";
	$dbname="lucbinh_collection";
	$dbh = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
	$dbh -> exec("set names utf8");
	$dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	return $dbh;
}

?>