<?php require_once "../templates/header.php" ?>

<?php

$pdo = db();

$status = "On-Hold";

$statement = $pdo->prepare("SELECT * FROM books WHERE status=?");

$statement->execute([$status]);

$books =  $statement->fetchAll(PDO::FETCH_ASSOC);

?>

<div id="container" class="container mt-sm-5">
    <table class="table table-striped-bordered">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"></th>
                <th scope="col"></th>
            </tr>
        </thead>
        <tbody>
            <?php
            if ($books) {
                foreach ($books as $book) {
                    echo "<tr>";
                    echo "<td><img style='width: 4rem;' class='card-img-top' src='{$book['image']}' alt='{$book['title']}'></td>";
                    echo "<td><a class='text-decoration-none' href='" . siteURL() . "/book?book={$book['id']}" . "'><h6>{$book['title']}</h6></a></td>";
                    echo " <td><button class='status btn btn-outline-info'>{$book['status']}</button></td>";
                    echo "</tr>";
                }
            } else {
                echo "<h3>No Results Found</h3>";
                echo "<p>Unfortunately no books were found.</p>";
            }
            ?>
        </tbody>
    </table>
</div>

<?php require_once "../templates/footer.php" ?>