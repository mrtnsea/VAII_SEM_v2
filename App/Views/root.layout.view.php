<?php

/** @var string $contentHTML */
/** @var \App\Core\IAuthenticator $auth */
/** @var \App\Core\LinkGenerator $link */
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>
    <title>Trailblazers</title>
    <link rel="icon" href="../../public/images/logo.webp">
    <link rel="stylesheet" href="/public/css/stylMain.css">
    <link rel="stylesheet" href="/public/css/stylShared.css">
    <link rel="stylesheet" href="/public/css/stylGuide.css">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="/public/js/hideEmpty.js"></script>
</head>
<body>
    <nav class="navbar navbar-dark bg-dark navbar-expand-lg" id="sticky-navbar">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">
                <img src="../../public/images/logo.webp" alt="icon" class="iconWeb">
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="<?= $link->url("home.index") ?>">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="<?= $link->url("home.index") ?> #guides">Guides</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="optimizer.html">Optimizer</a>
                    </li>
                </ul>
                <form class="ms-auto d-flex" role="search">
                    <input class="form-control me-2" type="email" placeholder="Username" aria-label="Username">
                    <input class="form-control me-2" type="password" placeholder="Password" aria-label="Password">
                    <button class="btn btn-outline-success" type="submit">Log In</button>
                </form>
            </div>
        </div>
    </nav>

    <?= $contentHTML ?>

    <footer class="footer mt-auto py-3 bg-body-tertiary">
        <div>
            <h5 class="aboutUs">About us</h5>
            <div class="container footerCon">
                <span class="text-body-secondary">
                    This page was created by ordinary fan of the game that likes
                    to theorycraft video games for the purpose of sharing their
                    discoveries and helping other players to build their characters
                    properly. This is not official Mihoyo page!
                </span>
            </div>
        </div>
    </footer>
</body>
</html>
