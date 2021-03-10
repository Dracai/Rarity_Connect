<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.css">
        <link rel="stylesheet" href="/assets/css/style.css">
        
        <title>Rarity Connect</title>
    </head>
    <body>

    <?php 
        $uri = service('uri');
    ?>

    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class='container'>
        <a class="navbar-brand" href="/">Rarity Connect</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <?php if (session()->get('isLoggedInUser')):?>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" <?= ($uri->getSegment(1) == 'dashbaord' ? 'active' : null)?>>
                    <a class="nav-link" href="dashboard">Dashboard</a>
                </li>
                <li class="nav-item" <?= ($uri->getSegment(1) == 'aboutUs' ? 'active' : null)?>>
                    <a class="nav-link" href="/aboutUs">About Us</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a href="/logout" class="btn btn-danger">Logout</a>
                </li>
            </ul>
        </div>

        <?php else: ?>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item" <?= ($uri->getSegment(1) == 'home' ? 'active' : null)?>>
                    <a class="nav-link" href="/">Home</a>
                </li>
                <li class="nav-item" <?= ($uri->getSegment(1) == 'aboutUs' ? 'active' : null)?>>
                    <a class="nav-link" href="/aboutUs">About Us</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-1">
            <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                <a href="/login"><button type="button" class="btn btn-success">Login</button></a>
                <div class="btn-group" role="group">
                    <button id="btnGroupDrop2" type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"></button>
                <div class="dropdown-menu" aria-labelledby="btnGroupDrop2">
                    <a class="dropdown-item" href="#">Moderator</a>
                    <a class="dropdown-item" href="#">Admin</a>
                </div>
                </div>
            </div>
            </ul>
            <ul class="navbar-nav mr-1">
                <li class="nav-item">
                    <a href="/register" class="btn btn-info">Register</a>
                </li>
            </ul>
        </div>

        <?php endif; ?>
        </div>
    </nav>