<?php require_once "../templates/header.php" ?>

<?php

if (!isset($_SESSION['user_id'])) {
    header('Location:' . siteURL() . 'login');
    exit();
}

if(isset($_POST['update'])){
    
    $pdo = db();

    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $pagecount = $_POST['pagecount'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "UPDATE books SET title=?, author=?, pagecount=?, status=?, description=?, image=? WHERE id=?";
    $statement= $pdo->prepare($sql);
    $statement->execute([$title, $author, $pagecount, $status, $description, $image, $id]);

    if($statement){
        $url =  siteURL() . "/book.php?book={$id}"; 
        header('Location: ' . $url);
    }
}

$id = $_GET['book'];

$pdo = db();

$sql = 'SELECT *
		FROM books
        WHERE id = :id';

$statement = $pdo->prepare($sql);
$statement->bindParam(':id', $id, PDO::PARAM_INT);
$statement->execute();
$book = $statement->fetch(PDO::FETCH_ASSOC);

$status = array("Reading", "Completed", "On-Hold", "Dropped", "Plan to Read");

?>

<div id="container" class="container mt-sm-5">

    <?php if ($book) { ?>
        <form method="post" action="update.php">
            <div id="book_form">
                <input type="hidden" name="id" value='<?php echo $book['id'] ?>'>
                <div>
                    <label for="title" class="required">Title</label>
                    <input type="text" id="title" name="title" required="required" placeholder="Enter title..." class="form-control mb-2" autocomplete="off" value='<?php echo $book['title'] ?>'>
                </div>
                <div>
                    <label for="author" class="required">Author</label>
                    <input type="text" id="author" name="author" required="required" placeholder="Enter author..." class="form-control mb-2" value='<?php echo $book['author'] ?>'>
                </div>
                <div>
                    <label for="pagecount" class="required">Pagecount</label><input type="number" id="pagecount" name="pagecount" required="required" placeholder="Enter number of pages..." class="form-control mb-2" value=<?php echo $book['pagecount'] ?>>
                </div>
                <div>
                    <label for="status" class="required">Status</label>
                    <select id="status" name="status" placeholder="Pick status..." class="form-control mb-2">
                        <?php
                        foreach ($status as $value) {
                            echo "<option value='{$value}'";
                            if ($value === $book['status']) {
                                echo 'selected';
                            }
                            echo ">{$value}</option>";
                        }
                        ?>
                    </select>
                </div>
                <div>
                    <label for="description" class="required">Description</label><textarea id="description" name="description" required="required" placeholder="Enter description..." class="form-control mb-2"><?php echo $book['description'] ?>
                    </textarea>
                </div>
                <div>
                    <label for="image" class="required">Image</label><input type="text" id="image" name="image" required="required" placeholder="Enter image link..." class="form-control mb-2" autocomplete="off" value=<?php echo $book['image'] ?>>
                </div>
            </div>
            <input type="submit" name="update" class="btn btn-primary mt-2" value="Submit">
        </form>
    <?php } else { ?>
        <h3>No Results Found</h3>
        <p>Unfortunately no books were found.</p>
    <?php } ?>
</div>

<?php require_once "../templates/footer.php" ?>