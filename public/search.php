<?php

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $rawData = file_get_contents("php://input");

    $postData = json_decode($rawData, true);

    $searchInput = $postData['searchInput'];

    $statusFilters = $postData['statusFilters'];

    $titleFilters = $postData['titleFilters'];

    $authorFilters = $postData['authorFilters'];

    require_once '../config/connect.php';

    $pdo = db();

    $input = "%$searchInput%";

    $author = "%$authorFilters%";

    $filters = ["Completed", "Reading", "Plan to Read", "On-Hold", "Dropped"];

    if (in_array($statusFilters, $filters, true)) {

        $statement = $pdo->prepare("SELECT * FROM books 
        WHERE title LIKE :title
        AND author LIKE :author
        AND status = :status
        ORDER BY 
        CASE WHEN :sort_direction = 'asc' THEN title END ASC,
        CASE WHEN :sort_direction = 'desc' THEN title END DESC;");
        $statement->bindParam(':title', $input, PDO::PARAM_STR);
        $statement->bindParam(':author', $author, PDO::PARAM_STR);
        $statement->bindParam(':status', $statusFilters, PDO::PARAM_STR);
        $statement->bindParam(':sort_direction', $titleFilters, PDO::PARAM_STR);
        $statement->execute();

        $books = $statement->fetchAll(PDO::FETCH_ASSOC);
    } else {

        $statement = $pdo->prepare("SELECT * FROM books 
        WHERE title LIKE :title
        AND author LIKE :author
        ORDER BY 
        CASE WHEN :sort_direction = 'asc' THEN title END ASC,
        CASE WHEN :sort_direction = 'desc' THEN title END DESC;");
        $statement->bindParam(':title', $input, PDO::PARAM_STR);
        $statement->bindParam(':author', $author, PDO::PARAM_STR);
        $statement->bindParam(':sort_direction', $titleFilters, PDO::PARAM_STR);
        $statement->execute();

        $books = $statement->fetchAll(PDO::FETCH_ASSOC);
    }


    echo json_encode(['message' => 'Data received successfully', 'postData' => $books]);

} else if ($_SERVER['REQUEST_METHOD'] === 'GET') {

    require_once '../config/connect.php';

    $pdo = db();

    $sql = 'SELECT * FROM books';
    $statement = $pdo->query($sql);
    $books = $statement->fetchAll(PDO::FETCH_ASSOC);

    echo json_encode(['message' => 'Data received successfully', 'postData' => $books]);
} else {
    header("HTTP/1.1 405 Method Not Allowed");
    echo json_encode(['error' => 'Method Not Allowed']);
}
