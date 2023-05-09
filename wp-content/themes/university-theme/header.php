<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <?php wp_head() ?>
</head>

<body>

    <header class="site-header">
        <div class="container">
            <h1 class="school-logo-text float-left">
                <a href="<?php echo site_url() ?>"><strong>Fictional</strong> University</a>
            </h1>
            <span class="js-search-trigger site-header__search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
            <i class="site-header__menu-trigger fa fa-bars" aria-hidden="true"></i>
            <div class="site-header__menu group">
                <nav class="main-navigation">
                    <ul>
                        <li><a href="<?php echo site_url("simple-page") ?>">Sample </a></li>
                        <li><a href="<?php echo site_url("programs") ?>">Programs</a></li>
                        <li><a href="<?php echo site_url("events")  ?>">Events</a></li>
                        <li><a href="#">Campuses</a></li>
                        <li><a href="<?php echo site_url("blogs")  ?>">Blog</a></li>
                    </ul>
                </nav>
                <div class="site-header__util">
                    <?php

                    if (is_user_logged_in()) {
                        ?>
                         <a href="<?php echo site_url("note") ?>" class="btn btn--small btn--dark-orange float-left mr-2">Notes</a>
                        <a href="<?php echo wp_logout_url() ?>" class="btn btn--small btn--dark-orange float-left">logout</a>
                        <?php
                    } else {
                    ?>
                        <a href="<?php echo wp_login_url() ?>" class="btn btn--small btn--orange float-left push-right">Login</a>
                        <a href="<?php echo wp_registration_url() ?>" class="btn btn--small btn--dark-orange float-left">Sign Up</a>
                    <?php
                    }

                    ?>

                    <span class="search-trigger js-search-trigger"><i class="fa fa-search" aria-hidden="true"></i></span>
                </div>
            </div>
        </div>
    </header>