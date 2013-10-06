<?php

require 'Slim/Slim.php';
\Slim\Slim::registerAutoloader();

$app = new \Slim\Slim();

$app->get('/books', 'getAllBooks');
$app->get('/books/:id',	'getBook');
$app->put('/books/:id', 'updateBook');
$app->delete('/books/:id',	'deleteBook');

$app->run();

function getAllBooks() {
	$sql = "select * FROM book";
	try {
		$db = getConnection();
		$stmt = $db->query($sql);  
		$wines = $stmt->fetchAll(PDO::FETCH_OBJ);
		$db = null;
		echo json_encode($wines);
	} catch(PDOException $e) {
		echo '{"error":{"text":'. $e->getMessage() .'}}'; 
	}
}

function getBook($id) {
	$sql = "SELECT * FROM book WHERE id=:id";
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

function updateBook($id) {
	$request = \Slim\Slim::getInstance()->request();
	$body = $request->getBody();
	$book = json_decode($body);
	$sql = "UPDATE book SET title=:title, category=:category, author=:author, publisher=:publisher, language=:language, publication_date=:publication_date, description=:description WHERE id=:id";
	try {
		$db = getConnection();
		$stmt = $db->prepare($sql);  
		$stmt->bindParam("title", $book->title);
		$stmt->bindParam("category", $book->category);
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
	$sql = "DELETE FROM book WHERE id=:id";
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