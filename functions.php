<?php
/**
 * Functions and definitions
 *
 */

//theme setup function
add_action('after_setup_theme','basicfun');
function basicfun(){
    //textdomain
    load_theme_textdomain('comet', get_template_directory().'/lang');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats',array(
        'gallery',
        'image',
        'quote',
        'status',
        'video',
        'audio',
    ));
    register_post_type('comet-portfolio', array(
        'labels' => array(
            'name' => __('Portfolio', 'comet'),
            'add_new' => __('Add New Portfolio', 'comet'),
            'add_new_item' => __('Add New Portfolio', 'comet'),
        ),
        'public' => true,
        'supports'  =>array('title','editor','thumbnail')
    ));

    register_nav_menu('main-menu', __('Main Menu', 'comet'));
    register_post_type('comet-slider',array(
        'labels'    =>  array(
            'name'          =>  'Sliders',
            'add_new'       =>  'Add New Slider',
            'add_new_item'  =>  'Add New Slider'

        ),

        'public'    =>  true,
        'supports'  =>  array('title','editor','thumbnail')

    ));

    register_taxonomy('comet-portfolio-category','comet-portfolio',array(
        'labels'    =>  array(
            'name'  =>  'Categories',
            'add_new'   =>  'Add New Category',
            'add_new_item'  =>  'Add New Category'
        ),
        'public'    =>  true,
        'hierarchial'   =>  true
    ));
   
}

// adding fonts 

function get_comet_fonts(){


    $fonts = array();

    $fonts[] = 'Montserrat:400,700';

    $fonts[] = 'Raleway:300,400,500';

    $fonts[] = 'Halant:300,400';


    $comet_fonts = add_query_arg(array(
        'family' => urlencode(implode('|', $fonts)),
        'subset' => 'latin'
    ), 'https://fonts.googleapis.com/css');


    return $comet_fonts;


}

// including the styles 

add_action('wp_enqueue_scripts', 'comet_styles');

function comet_styles(){

    wp_enqueue_style('bundle', get_template_directory_uri().'/css/bundle.css');

    wp_enqueue_style('style', get_template_directory_uri().'/css/style.css');

    wp_enqueue_style('fonts', get_comet_fonts());

    wp_enqueue_style('stylesheet', get_stylesheet_uri());

    wp_enqueue_style('comment-reply');


}

add_action('widgets_init','sidebar_areas');
function sidebar_areas(){
    register_sidebar(array(
        'name'          => __('Right Sidebar','comet'),
        'description'   => __('You may add your right sidebar here....','comet'),
        'id'            => 'right-sidebar',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="upper">',
        'after_title'   => '</h6>'

    ));
    register_sidebar(array(
        'name'          => __('Footer First Area.....','comet'),
        'description'   => __('You may add your footer first area widgets here....','comet'),
        'id'            => 'footer-first',
        'before_widget' => '<div class="col-sm-4"><div class="widget">',
        'after_widget'  => '</div></div>',
        'before_title'  => '<h6 class="upper">',
        'after_title'   => '</h6>'

    ));
    register_sidebar(array(
        'name'          => __('Footer Last Area.....','comet'),
        'description'   => __('You may add your footer last area widgets here....','comet'),
        'id'            => 'footer-last',
        'before_widget' => '<div class="widget">',
        'after_widget'  => '</div>',
        'before_title'  => '<h6 class="upper">',
        'after_title'   => '</h6>'

    ));

}


//conditional scripts
add_action('wp_enqueue_scripts', 'conditional_scripts');

function conditional_scripts(){

    wp_enqueue_script('html5shim', 'http://html5shim.googlecode.com/svn/trunk/html5.js', array(), '', false);
    wp_script_add_data('html5shim', 'conditional', 'lt IE 9');


    wp_enqueue_script('respond', 'https://oss.maxcdn.com/libs/respond.js/1.3.0/respond.min.js', array(), '', false);
    wp_script_add_data('respond', 'conditional', 'lt IE 9');

    wp_enqueue_script('comment-reply');
}

//including js scripts

add_action('wp_enqueue_scripts', 'comet_scripts');
function comet_scripts(){

    

    wp_enqueue_script('bundle', get_template_directory_uri().'/js/bundle.js', array('jquery'), '', true);

    wp_enqueue_script('google-map', 'https://maps.googleapis.com/maps/api/js?v=3.exp', array('jquery'), '', true);

    wp_enqueue_script('main', get_template_directory_uri().'/js/main.js', array('jquery', 'bundle'), '', true);
}

if(file_exists(dirname(__FILE__).'/gallery.php')){
    require_once(dirname(__FILE__).'/gallery.php');
}
if(file_exists(dirname(__FILE__).'/custom-widget/latest-post.php')){
    require_once(dirname(__FILE__).'/custom-widget/latest-post.php');
}

require get_template_directory().'/lib/sample/config.php';
require get_template_directory().'/lib/redux-core/framework.php';

if(file_exists(dirname(__FILE__).'/lib/metabox/init.php')){
    require_once(dirname(__FILE__).'/lib/metabox/init.php');
}
if(file_exists(dirname(__FILE__).'/lib/metabox/config.php')){
    require_once(dirname(__FILE__).'/lib/metabox/config.php');
}
if(file_exists(dirname(__FILE__).'/shortcodes/shortcodes.php')){
    require_once(dirname(__FILE__).'/shortcodes/shortcodes.php');
}

if(file_exists(dirname(__FILE__).'/lib/plugin/required-plugins.php')){
    require_once(dirname(__FILE__).'/lib/plugin/required-plugins.php');
}

add_action('admin_print_scripts','add_korbo',1000);
function add_korbo(){ ?>

    <?php if(get_post_type()=='post') : ?>
        <script>
            jQuery(document).ready(function(){
                
                var id = jQuery( 'input[name="post_format"]:checked' ).attr('id');

                if(id == 'post-format-video'){
                    jQuery('.cmb2-id--for-video').show();
                }else{
                    jQuery('.cmb2-id--for-video').hide();
                }

                if(id == 'post-format-audio'){
                    jQuery('.cmb2-id--for-audio').show();
                }else{
                    jQuery('.cmb2-id--for-audio').hide();
                }
                if(id == 'post-format-gallery'){
                    jQuery('.cmb2-id--for-gallery').show();
                }else{
                    jQuery('.cmb2-id--for-gallery').hide();
                }


                jQuery('input[name="post_format"]').change(function(){

                    jQuery('.cmb2-id--for-gallery').hide();
                    jQuery('.cmb2-id--for-audio').hide();
                    jQuery('.cmb2-id--for-video').hide();

                    var id = jQuery( 'input[name="post_format"]:checked' ).attr('id');

                     if(id == 'post-format-video'){

                    jQuery('.cmb2-id--for-video').show();
                    }else{
                        jQuery('.cmb2-id--for-video').hide();
                    }

                    if(id == 'post-format-audio'){

                        jQuery('.cmb2-id--for-audio').show();
                    }else{
                        jQuery('.cmb2-id--for-audio').hide();
                    }
                    if(id == 'post-format-gallery'){

                        jQuery('.cmb2-id--for-gallery').show();
                    }else{
                        jQuery('.cmb2-id--for-gallery').hide();
                    }

                });

            })
        </script>
    <?php endif; ?>

 
<?php }


register_activation_hook(__FILE__,'flush_kori');
function flush_kori(){
    flush_rewrite_rules();
}

if(function_exists('vc_map')) : 

add_action('vc_before_init','set_as_theme_vc');
function set_as_theme_vc(){
    vc_set_as_theme();
}


vc_map(array(
    'name'                      =>  'Comet Slider',
    'base'                      =>  'comet-slider',
    'show_settings_on_create'   =>  false
));

vc_map(array(
    'name'  =>  'Comet About Section',
    'base'  =>  'about-section',
    'params'    =>  array(
        array(
            'type'          =>  'textfield',
            'heading'       =>  'Title',
            'value'         =>'Who We Are',
            'param_name'    =>  'title'
        ),
        array(
            'type'          =>  'textfield',
            'heading'       =>  'subtitle',
            'value'         =>'we are driven by creative',
            'param_name'    =>  'subtitle'
        ),
        array(
            'type'          =>  'textarea_html',
            'heading'       =>  'Description',
            'param_name'          =>  'content',
            'value'         =>  'we are driven something like that what is happening'
        )
    )
));

endif;