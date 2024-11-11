<?php require_once "../templates/header.php" ?>

<?php

$id = $_GET['book'];

$pdo = db();

$sql = 'SELECT *
		FROM books
        WHERE id = :id';

$statement = $pdo->prepare($sql);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();
$book = $statement->fetch(PDO::FETCH_ASSOC);

?>



<div id="container" class="container mt-sm-5">
    <div class="container">
        <div class="row">
            <?php if ($book) { ?>
                <div class="col-sm-4 d-flex justify-content-sm-center book-image-container">
                    <img style="width: 14rem;" class="card-img-top" src=<?php echo $book['image'] ?> alt=<?php echo $book['title'] ?>>
                </div>
                <div class="col-sm-6 book-description-container">
                    <h3><?php echo $book['title'] ?></h3>
                    <div>
                        <span class="fw-bold">Author:</span>
                        <span><?php echo $book['author'] ?></span>
                        <br>
                        <span class="fw-bold">Pages:</span>
                        <span><?php echo $book['pagecount'] ?></span>
                        <br>
                        <span class="fw-bold">Status:</span>
                        <span><?php echo $book['status'] ?></span>
                        <br>
                        <?php if (isset($_SESSION['user_id'])) { ?>
                            <span class="fw-bold">Actions:</span>
                            <span><a href=<?php echo siteURL() . "/update?book={$book['id']}" ?>>edit</a></span> |
                            <span><a href=<?php echo siteURL() . "/delete?book={$book['id']}" ?>>delete</a></span>
                            <br>
                        <?php } ?>
                        <span class="fw-bold">Description:</span>
                        <br>
                        <span><?php echo $book['description'] ?></span>
                    </div>
                </div>
            <?php } else { ?>
                <h3>No Results Found</h3>
                <p>Unfortunately no books were found.</p>
            <?php } ?>
        </div>
    </div>
</div>

<?php require_once "../templates/footer.php" ?>