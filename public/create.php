<?php 

require_once "../templates/header.php" 

?>

<?php 

if (!isset($_SESSION['user_id'])) {
    header('Location:' . siteURL() . '/login');
    exit();
}

if(isset($_POST['create'])){
    create();
}

?>

<div id="container" class="container mt-sm-5">
    <form method="post" action="create.php">
        <div id="book_form">
            <div>
                <label for="title" class="required">Title</label>
                <input type="text" id="title" name="title" required="required" placeholder="Enter title..." class="form-control mb-2" autocomplete="off">
            </div>
            <div>
                <label for="author" class="required">Author</label><input type="text" id="author" name="author" required="required" placeholder="Enter author..." class="form-control mb-2">
            </div>
            <div>
                <label for="pagecount" class="required">Pagecount</label><input type="number" id="pagecount" name="pagecount" required="required" placeholder="Enter number of pages..." class="form-control mb-2">
            </div>
            <div>
                <label for="status" class="required">Status</label><select id="book_form_status" name="status" placeholder="Pick status..." class="form-control mb-2">
                    <option value="Reading">Reading</option>
                    <option value="Completed">Completed</option>
                    <option value="On-Hold">On-Hold</option>
                    <option value="Dropped">Dropped</option>
                    <option value="Plan to Read">Plan to Read</option>
                </select>
            </div>
            <div>
                <label for="description" class="required">Description</label><textarea id="description" name="description" required="required" placeholder="Enter description..." class="form-control mb-2"></textarea>
            </div>
            <div>
                <label for="image" class="required">Image</label><input type="text" id="image" name="image" required="required" placeholder="Enter image link..." class="form-control mb-2" autocomplete="off">
            </div>
        </div>
        <input type="submit" name="create" class="btn btn-primary mt-2" value="Submit">
    </form>
</div>

<?php require_once "../templates/footer.php" ?>