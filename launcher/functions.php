<?php
if(site_url(  )=="http://wpthemedev.local"){
    define("VERSION",time());
} else {
    define("VERSION", wp_get_theme(  )->get("version"));
}

function launcher_setup_theme(){
    load_theme_textdomain( "launcher" );
    add_theme_support( "post-thumbnails" );
    add_theme_support( "title-tag" );
}
add_action( "after_setup_theme", "launcher_setup_theme" );


function launcher_assets(){
    
    if(is_page(  )){
        $launcher_template_name = basename(get_page_template());
        if($launcher_template_name == "launcher.php"){
            wp_enqueue_style( "animate-css", get_theme_file_uri("/assets/css/animate.css"),null, VERSION );
            wp_enqueue_style( "icomoon-css", get_theme_file_uri("/assets/css/icomoon.css"),null, VERSION );
            wp_enqueue_style( "bootstrap-css", get_theme_file_uri("/assets/css/bootstrap.css"),null, VERSION );
            wp_enqueue_style( "style-css", get_theme_file_uri("/assets/css/style.css"),null, VERSION );
            wp_enqueue_style( "launcher", get_stylesheet_uri(),null, VERSION );
        
            wp_enqueue_script( "easing-js", get_theme_file_uri("/assets/js/jquery.easing.1.3.js"), array("jquery"), VERSION, true );
            wp_enqueue_script( "bootstrap-js", get_theme_file_uri("/assets/js/bootstrap.min.js"), array("jquery"), VERSION, true  );
            wp_enqueue_script( "waypoints-js", get_theme_file_uri("/assets/js/jquery.waypoints.min.js"), array("jquery"), VERSION, true  );
            wp_enqueue_script( "simplyCountdown-js", get_theme_file_uri("/assets/js/simplyCountdown.js"), array("jquery"), VERSION, true  );
            wp_enqueue_script( "main-js", get_theme_file_uri("/assets/js/main.js"), array("jquery"), VERSION, true  );
        
        
            $launcher_year = get_post_meta( get_the_ID(),"year", true);
            $launcher_month = get_post_meta( get_the_ID(),"month", true);
            $launcher_day = get_post_meta( get_the_ID(),"day", true);
        
            wp_localize_script( "main-js", "datedata", array(
                "year" => $launcher_year,
                "month" => $launcher_month,
                "day" => $launcher_day,
            ) );
        }
        else{
            wp_enqueue_style( "bootstrap-css", get_theme_file_uri("/assets/css/bootstrap.css"),null, VERSION );
            wp_enqueue_style( "launcher", get_stylesheet_uri(),null, VERSION );
        }
    }
}
add_action( "wp_enqueue_scripts", "launcher_assets" );

function launcher_sidebars(){
    register_sidebar(
            array(
                'name'  =>__( 'Footer Left', 'launcher'),
                'id'    =>'footer-left',
                'description'   =>__('Footer Left', 'launcher'),
                'before_widget' => '<section id="%1s" class="widget %2s">',
                'after_widget' => '</section>',
                'before_title' => '<h2 class="widget-title">',
                'after_title' => '</h2>',
                )
            );

            register_sidebar(
                    array(
                        'name'  =>__( 'Footer Right', 'launcher'),
                        'id'    =>'footer-right',
                        'description'   =>__('Footer Right', 'launcher'),
                        'before_widget' => '<section id="%1s" class="text-right widget %2s">',
                        'after_widget' => '</section>',
                        'before_title' => '<h2 class="widget-title">',
                        'after_title' => '</h2>',
                        )
                    );
}
add_action( "widgets_init", "launcher_sidebars" );

function launcher_style(){
    if(is_page(  )){
        $thumbnail_url = get_the_post_thumbnail_url( null, "large" );
        ?>
        <style>
            .home-side{
                background-image:url(<?php echo $thumbnail_url;?>);
            }
        </style>
    <?php
    }
}
add_action( "wp_head", "launcher_style" );