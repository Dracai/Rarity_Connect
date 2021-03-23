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
        
        <?php if (session()->get('isLoggedInUser')):?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class='container'>
                <a class="navbar-brand" href="<?php echo base_url();?>/dashboard">Rarity Connect</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>#">UnderConstruction</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>#">UnderConstruction</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item" style="margin-right: 1em;">
                    <a class="nav-link" href="<?php echo base_url();?>#">UnderConstruction</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url();?>/logout" class="btn btn-danger">Logout</a>
                </li>
            </ul>
        </div>

        <?php elseif (session()->get('isLoggedInAdmin')):?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class='container'>
                <a class="navbar-brand" href="<?php echo base_url();?>/dashboard">Rarity Connect</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

            <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">

                <li class="nav-item" >
                    <a class="nav-link " href="<?php echo base_url();?>/dashboard">Dashboard</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>/admin_functions_page">Admin Functions</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>#">UnderConstruction</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>/logout" class="btn btn-danger">Logout</a>
                </li>
            </ul>
        </div>

        <?php else: ?>
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class='container'>
                <a class="navbar-brand" href="<?php echo base_url();?>/">Rarity Connect</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>/aboutus">About Us</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-1">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>/login" class="btn btn-success">Login</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-1">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>/register" class="btn btn-info">Register</a>
                </li>
            </ul>
        </div>

        <?php endif; ?>
        </div>
    </nav>