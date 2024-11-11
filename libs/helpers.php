<?php

function siteURL()
{
    $protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https' : 'http';
    $domain = $_SERVER['HTTP_HOST'];
    $currentURL = $protocol . '://' . $domain . '/mybookslist';

    return $currentURL;
}

function login()
{

    $username = $_POST['username'];
    $password = $_POST['password'];

    $pdo = db();

    $statement = $pdo->prepare("SELECT * FROM users WHERE username=? AND password = ?");
    $statement->execute([$username, sha1($password)]);
    $data = $statement->fetch();

    if ($data) {
        session_start();
        $_SESSION['user_id'] = $data['id'];
        $_SESSION['username'] = $username;
        header('Location:' . siteURL());
    } else {
        header('Location:' . siteURL() . '/login?msg');
    }
}

// function logout()
// {
//     session_start();
//     session_destroy();
//     header('Location: http://localhost/mybookslist/login');
// }


function create()
{
    $pdo = db();

    $title = $_POST['title'];
    $author = $_POST['author'];
    $pagecount = $_POST['pagecount'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $image = $_POST['image'];


    $sql = "INSERT INTO books (title, author, pagecount, status, description, image) VALUES (?,?,?,?,?,?)";
    $statement = $pdo->prepare($sql);
    $statement->execute([$title, $author, $pagecount, $status, $description, $image]);

    if ($statement) {
        header('Location:' . siteURL());
    }
}

function update()
{
    $pdo = db();

    $id = $_POST['id'];
    $title = $_POST['title'];
    $author = $_POST['author'];
    $pagecount = $_POST['pagecount'];
    $status = $_POST['status'];
    $description = $_POST['description'];
    $image = $_POST['image'];

    $sql = "UPDATE books SET title=?, author=?, pagecount=?, status=?, description=?, image=? WHERE id=?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$title, $author, $pagecount, $status, $description, $image, $id]);

    if ($statement) {
        $url = siteURL() . "/book.php?book={$id}";
        header('Location: ' . $url);
    }
}


function delete()
{

    $pdo = db();

    $id = $_GET['book'];

    $sql = "DELETE FROM books WHERE id=?";
    $statement = $pdo->prepare($sql);
    $statement->execute([$id]);

    if ($statement) {
        $url = siteURL();
        header('Location: ' . $url);
    }
}

function isAvailable()
{
    var_dump("helpers.php is available!");
    die();
}
