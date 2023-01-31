<!-- Footer-->
<footer class="bg-black text-center py-5">
            <div class="container px-5">
                <div class="text-white-50 small">
                    <div class="mb-2 ">
                        <?php echo get_theme_mod('set_copyright', '&copy; Your Website 20XX - All Rights Reserved') ?>
                    </div>

                    <?php 
                        wp_nav_menu(
                            array(
                                'menu' => 'secondary',//name of the menu in the array created in functions.php
                                'container' => '',
                                'theme_location' => 'secondary', //selected in wp admin
                                'items_wrap' => '<ul id="" class="d-flex flex-row list-unstyled justify-content-center">
                                                    %3$s
                                                </ul>',
                                'link_after' => '&nbsp;.&nbsp;',
                            )
                        ); 
                    ?>
                    
                </div>
            </div>
        </footer>

        <?php wp_footer(); ?>
    </body>

    
</html>