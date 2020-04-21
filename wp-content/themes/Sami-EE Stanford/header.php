<!doctype html>
<!--[if IE 6]>
<html id="ie6" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 7]>
<html id="ie7" <?php language_attributes(); ?>>
<![endif]-->
<!--[if IE 8]>
<html id="ie8" <?php language_attributes(); ?>>
<![endif]-->
<!--[if !(IE 6) | !(IE 7) | !(IE 8)  ]><!-->
<html <?php language_attributes(); ?>>
    <!--<![endif]-->
    <head>
        <meta charset="<?php bloginfo('charset'); ?>" />
        <meta name="viewport" content="width=device-width" />
        
        <title>Trung tâm an toàn an ninh thông tin</title>
        <link rel="profile" href="http://gmpg.org/xfn/11" />
        <link rel="stylesheet" type="text/css" href="css/style.css">
        <link rel="stylesheet" type="text/css" href="<?php echo get_template_directory_uri(); ?>/css/grid.css?ver=1.0.3" />
        <link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/samiweb/bootstrap/css/bootstrap.minified.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/samiweb/bootstrap/css/style.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/samiweb/bootstrap/css/custom.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo plugins_url(); ?>/wp-pagenavi/pagenavi-css.css?ver=1.0.2" />
        <link rel='stylesheet' id='open-sans-css'  href='http://fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,600italic,700italic,800italic,400,300,600,700,800&subset=latin,vietnamese' type='text/css' media='all' />	


        <link rel="pingback" href="<?php bloginfo('pingback_url'); ?>" />
        <?php
        wp_head();
        $home_url = home_url('/');
        ?>
    </head>

    <body>
        <div class="blog-masthead">
            <div class="container">
                <nav class="blog-nav">
                    <a class="blog-nav-item" href="http://www.hust.edu.vn">Đại học Bách Khoa Hà Nội</a>
                </nav>
            </div> <!-- container -->
        </div> <!-- blog-masthead -->
        <div class="sami-header">
            <div class="container">
                <div id="top-logo" class="col-sm-5">
                    <a href="<?php echo home_url('/'); ?>" id="branding">
                        <img src="<?php echo plugins_url(); ?>/samiweb/img/bkcs-logo.png"
                             style="max-width: 100%;width:30%" alt="Trung Tâm an toàn máy tính đại học bách khoa hà nội"/></a>
                    <!-- <h1 class="blog-title">Viện Toán ứng dụng và Tin học</h1>
                    <p class="lead blog-description">School of Applied Mathematics and Informatics</p> -->
                </div>	

                <ul class="nav navbar-nav navbar-right animated lightSpeedIn hidden-xs" style="margin-right: -3px">
                    <li class="ng-scope">
                        <a class="point" style="display:inline-block; padding-right: 0px">
                            <img src="<?php echo plugins_url(); ?>/samiweb/img/en.jpg" width="22.5px" height="15px">
                        </a>
                        <a class="point" style="display:inline-block; padding-left: 5px">
                            <img src="<?php echo plugins_url(); ?>/samiweb/img/vi.jpg" width="22.5px" height="15px">
                        </a>
                    </li>
                </ul>
                <div id="top-logo" class="col-sm-7 top-menu" style="right: -4%">
                    <div class="container-fluid" >
                        <div class="navbar-header">
                            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                <span class="sr-only">Toggle navigation</span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                                <span class="icon-bar"></span>
                            </button>
                        </div>

                        <?php
                        wp_nav_menu(array(
                            'menu' => 'primary',
                            'depth' => 3,
                            'container' => 'div',
                            'container_class' => 'navbar-collapse collapse',
                            'container_id' => 'navbar',
                            'menu_class' => 'nav navbar-nav',
                            'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
                            'walker' => new wp_bootstrap_navwalker())
                        );
                        ?>
                    </div><!-- container-fluid -->
                </div>

            </div> <!-- container -->
        </div><!-- page-header -->

        <!-- Static navbar -->
        <!--        <nav class="navbar navbar-default" role="navigation">
                    <div class="container">
                        <div class="container-fluid">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                                    <span class="sr-only">Toggle navigation</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                            </div>
        
        <?php
        wp_nav_menu(array(
            'menu' => 'primary',
            'theme_location' => 'top-nav-menu',
            'depth' => 3,
            'container' => 'div',
            'container_class' => 'navbar-collapse collapse',
            'container_id' => 'navbar',
            'menu_class' => 'nav navbar-nav',
            'fallback_cb' => 'wp_bootstrap_navwalker::fallback',
            'walker' => new wp_bootstrap_navwalker())
        );
        ?>
                        </div> container-fluid 
                    </div>
                </nav>-->
        <?php //wp_nav_menu( array('menu' => 'top-nav-menu' ));  ?>
        <div class="main" style="margin-top: 30px;background-color: white">
