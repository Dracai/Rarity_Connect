<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <link href="/assets/css/style.css" rel="stylesheet">
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
        <link rel="stylesheet" href="https://bootswatch.com/4/pulse/bootstrap.css">

        <title>Rarity Connect</title>
    </head>
    <body>

    <?php 
        $uri = service('uri');
    ?>
        
        <?php if (session()->get('isLoggedInAdmin')):?>
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
                    <a class="nav-link" href="<?php echo base_url();?>/forum/postsPage">View Posts</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>/logout" class="btn btn-danger" style="border-radius: 4px;">Logout</a>
                </li>
            </ul>
        </div>

        <?php elseif (session()->get('isLoggedInMod')):?>
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
                    <a class="nav-link" href="<?php echo base_url();?>/forum/postsPage">View Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>#">Moderator Functions</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item" style="margin-right: 1em;">
                    <a class="nav-link" href="<?php echo base_url();?>#">UnderConstruction</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url();?>/logout" class="btn btn-danger" style="border-radius:4px;">Logout</a>
                </li>
            </ul>
        </div>

        <?php elseif (session()->get('isLoggedInUser')):?>
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
                    <a class="nav-link" href="<?php echo base_url();?>/forum/postsPage">View Posts</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?php echo base_url();?>#">UnderConstruction</a>
                </li>
            </ul>
            <ul class="navbar-nav my-2 my-lg-0">
                <li class="nav-item" style="margin-right: 1em;">
                    <a class="nav-link" href="<?php echo base_url();?>/profile">Profile</a>
                </li>
                <li class="nav-item">
                    <a href="<?php echo base_url();?>/logout" class="btn btn-danger" style="border-radius:4px;">Logout</a>
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
                    <a href="<?php echo base_url();?>/login" class="btn btn-success" style="border-radius:4px;">Login</a>
                </li>
            </ul>
            <ul class="navbar-nav mr-1">
                <li class="nav-item">
                    <a href="<?php echo base_url();?>/register" class="btn btn-info" style="border-radius:4px;">Register</a>
                </li>
            </ul>
        </div>

        <?php endif; ?>
        </div>
    </nav>