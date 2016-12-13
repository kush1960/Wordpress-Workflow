<!doctype html>
<html class="no-js" lang="">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title></title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width, initial-scale=1">


<script src="jquery-3.1.1.min.js"></script>
        <script src="clipboard.min.js"></script>
        <script src="styleguide.js"></script>

        <link rel="stylesheet" href="<?php bloginfo('stylesheet_url'); ?>">
        <link rel="stylesheet" href="styleguide.css">
    </head>
    <body>
        <!--[if lte IE 9]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
        <![endif]-->

    
    <ul class="sgSideMenu">

        <li class="sgText sgTitle">
            <?php echo get_bloginfo( 'name' ); ?> Styleguide <br>
            by <a href='http://cite.co.uk'>Cite</a>
            
            <li class="sgSideMenuItem"><a class="sgText sgSideMenuActive" href="#colours">Colours</a></li>
            <li class="sgSideMenuItem"><a class="sgText" href="#typography">Typography</a></li>
            <?php 
                // add menu itemes
                foreach ($components as &$component) {
                    echo '<li class="sgSideMenuItem"><a class="sgText" href="#' . $component . '">' . $component . '</a></li>';
                }
            ?>
        </li>

    </ul>
