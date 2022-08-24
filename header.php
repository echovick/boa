<!DOCTYPE html>
<html lang="en">
    <?php
        while(have_posts()):the_post();
            $page_title = get_the_title();
        endwhile;
    ?>
    <head>
        <meta charset="UTF-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <title><?php echo get_bloginfo('name') . ' - ' . $page_title?></title>
        <?php wp_head()?>
        <link rel="shortcut icon" href="<?php echo get_theme_file_uri('assets/imgs/logos/BoA Logo 1.png')?>" type="image/x-icon">
    </head>
    <body>
        <nav class="row w-100 desktop">
            <div class="col-lg-3 col-md-3">
                <div class="d-flex justify-content-left nav-logo">
                    <a href="<?php echo site_url()?>"><img src="<?php echo get_theme_file_uri('assets/imgs/logos/BoA Logo 1.png')?>" class="mr-3" alt=""></a>
                    <img src="<?php echo get_theme_file_uri('assets/imgs/logos/PSAG-Logo only 1.png')?>" alt="">
                </div>
            </div>
            <div class="col-lg-9 col-md-9">
                <div class="d-flex nav-main">
                    <a href="<?php echo site_url('agenda')?>" class="nav-item">  
                        <div class="row title txt-md mb-5">Agenda</div>
                        <div class="row text txt-sm">3 days of impactful sessions</div>
                    </a>
                    <a href="<?php echo site_url('experts')?>" class="nav-item">
                        <div class="row title txt-md mb-5">Speakers</div>
                        <div class="row text txt-sm">Learn from practitioners in the industry</div>
                    </a>
                    <a href="<?php echo site_url('sessions')?>" class="nav-item">
                        <div class="row title txt-md mb-5">Sessions</div>
                        <div class="row text txt-sm">Explore what will be covered in each session</div>
                    </a>
                    <a href="<?php echo site_url('ask-a-question')?>" class="nav-item">
                        <div class="row title txt-md mb-5">Ask a Question</div>
                        <div class="row text txt-sm">Got a question? Ask our experts</div>
                    </a>
                    <a href="<?php echo site_url('register')?>" class="nav-item">
                        <div class="row title txt-md mb-5">Register</div>
                        <div class="row text txt-sm">Reserve your space. 100% free</div>
                    </a>
					<a href="<?php echo site_url('boa-1-0')?>" class="nav-item">  
                        <div class="row title txt-md mb-5">BOA 1.0</div>
                        <div class="row text txt-sm">Business of agriculture debut masterclass</div>
                    </a>
                </div>
            </div>
        </nav>
        <!-- Top Navigation Menu for mobile -->
        <div class="topnav mobile">
            <a href="<?php echo site_url()?>" class="active d-flex justify-content-left nav-logo">
                <img src="<?php echo get_theme_file_uri('assets/imgs/logos/BoA Logo 1.png')?>" class="mr-3" alt="">
                <img src="<?php echo get_theme_file_uri('assets/imgs/logos/PSAG-Logo only 1.png')?>" alt="">
            </a>
            <!-- Navigation links (hidden by default) -->
            <div id="myLinks">
				<a href="<?php echo site_url('boa-1-0')?>">BOA 1.0</a>
                <a href="<?php echo site_url('agenda')?>">Agenda</a>
                <a href="<?php echo site_url('experts')?>">Speakers</a>
                <a href="<?php echo site_url('sessions')?>">Sessions</a>
                <a href="<?php echo site_url('ask-a-question')?>">Ask a Question</a>
                <a href="<?php echo site_url('register')?>">Register</a>
            </div>
            <!-- "Hamburger menu" / "Bar icon" to toggle the navigation links -->
            <a href="javascript:void(0);" class="icon" onclick="myFunction()">
                <i class="fa fa-bars"></i>
            </a>
        </div>