<?php


include( get_stylesheet_directory() . '/badge-module/badge-module.php' );


function add_script_custom() {

    if( !is_user_logged_in() ){ ?>
        <script type="text/javascript">
            (function($){
                $(document).ready(function(){
                    $(".enable-login").click(function(){
                        $(".login-btn").trigger("click");
                    });

                    $(".enable-signup").click(function(){
                        $(".register-btn").trigger("click");
                    });                   
                });
            })(jQuery);
        </script>
    <?php
    }
}
add_action( 'wp_footer', 'add_script_custom', 100);