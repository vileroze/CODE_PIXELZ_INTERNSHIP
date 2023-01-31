<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>New Age</title>

        <!-- Bootstrap icons-->
        <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.5.0/font/bootstrap-icons.css" rel="stylesheet" />

        <!-- Google fonts-->
        <link rel="preconnect" href="https://fonts.gstatic.com" />

        <?php wp_head(); ?>
    </head>
    <body id="page-top">
        <!-- Navigation--> 
        <nav class="navbar navbar-expand-lg navbar-light fixed-top shadow-sm pt-5" id="mainNav">
            <div class="container px-5">
                <?php 
					$default_logo = "/wp-content/themes/vilecustomizable/assets/images/logo.png";
					$custom_logo_id = get_theme_mod('custom_logo');
					$logo = wp_get_attachment_image_src($custom_logo_id);
				?>
				<img class="mb-3 mx-auto logo img-fluid" src="
                    <?php 
                        if($logo[0] == ""){
                            echo $default_logo;
                        }else{
                            echo $logo[0]; 
                        }
                        
                    ?>
                 " 
                 alt="logo" >	
                <!-- <a class="navbar-brand fw-bold" href="#page-top">Start Bootstrap</a> -->
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
                    Menu
                    <i class="bi-list"></i>
                </button>
                <div class="collapse navbar-collapse" id="navbarResponsive">

                    <?php 
                        wp_nav_menu(
                            array(
                                'menu' => 'primary',//name of the menu in the array created in functions.php
                                'container' => '',
                                'theme_location' => 'primary', //selected in wp admin
                                'items_wrap' => '
                                <ul id="" class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                                    %3$s
                                </ul>' //giving styling
                            )
                        ); 
                    ?>
                    
                    <button class="btn btn-primary rounded-pill px-3 mb-2 mb-lg-0" data-bs-toggle="modal" data-bs-target="#feedbackModal">
                        <span class="d-flex align-items-center">
                            <i class="bi-chat-text-fill me-2"></i>
                            <span class="small">Send Feedback</span>
                        </span>
                    </button>
                </div>
            </div>
        </nav>