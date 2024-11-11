<?php

session_start();

require_once '../config/connect.php';
require_once '../libs/helpers.php';

?>

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="robots" content="noindex">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $title ?? 'Home' ?></title>
    <link rel="icon" href="data:image/svg+xml,<svg xmlns=%22http://www.w3.org/2000/svg%22 viewBox=%220 0 128 128%22><text y=%221.2em%22 font-size=%2296%22>⚫️</text></svg>">
    <!-- CSS only -->
    <link href=" https://cdn.jsdelivr.net/npm/bootswatch@5.3.2/dist/darkly/bootstrap.min.css " rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">
</head>

<body>
    <nav class="navbar navbar-expand bg-primary navbar-dark ps-5">
        <a href=<?php echo siteURL() ?> class="text-decoration-none"><span class="navbar-brand">MyBooksList</span></a>
        <ul class="navbar-nav">
            <div class="collapse navbar-collapse" id="navbarNavDarkDropdown">
                <ul class="navbar-nav">
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" id="navbarDarkDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Books
                        </a>
                        <ul class="dropdown-menu dropdown-menu-dark" aria-labelledby="navbarDarkDropdownMenuLink">
                            <li class="dropdown-item">
                                <a class="nav-link" href=<?php echo siteURL() ?>>Index</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href=<?php echo siteURL() . '/reading' ?>>Reading</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href=<?php echo siteURL() . '/completed' ?>>Completed</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href=<?php echo siteURL() . '/on-hold' ?>>On-Hold</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href=<?php echo siteURL() . '/dropped' ?>>Dropped</a>
                            </li>
                            <li class="dropdown-item">
                                <a class="nav-link" href=<?php echo siteURL() . '/plan-to-read' ?>>Plan to Read</a>
                            </li>
                            <?php if (isset($_SESSION['user_id'])) { ?>
                                <li class="dropdown-item">
                                    <a class="nav-link" href=<?php echo siteURL() . '/create' ?>>New Book</a>
                                </li>
                            <?php } ?>
                        </ul>
                    </li>
                </ul>
            </div>
            <?php if (isset($_SESSION['user_id'])) { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href=<?php echo siteURL() . '/logout' ?>>Logout</a>
                </li>
            <?php } else { ?>
                <li class="nav-item dropdown">
                    <a class="nav-link" href=<?php echo siteURL() . '/login' ?>>Login</a>
                </li>
            <?php } ?>
        </ul>
    </nav>