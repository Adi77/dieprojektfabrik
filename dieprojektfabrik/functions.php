<?php
/**
 * Timber starter-theme
 * https://github.com/timber/starter-theme
 *
 * @package  WordPress
 * @subpackage  Timber
 * @since   Timber 0.1
 */

/**
 * If you are installing Timber as a Composer dependency in your theme, you'll need this block
 * to load your dependencies and initialize Timber. If you are using Timber via the WordPress.org
 * plug-in, you can safely delete this block.
 */
$composer_autoload = __DIR__ . '/vendor/autoload.php';
if (file_exists($composer_autoload)) {
    require_once $composer_autoload;
    $timber = new Timber\Timber();
}

/**
 * This ensures that Timber is loaded and available as a PHP class.
 * If not, it gives an error message to help direct developers on where to activate
 */
if (! class_exists('Timber')) {
    add_action(
        'admin_notices',
        function () {
            echo '<div class="error"><p>Timber not activated. Make sure you activate the plugin in <a href="' . esc_url(admin_url('plugins.php#timber')) . '">' . esc_url(admin_url('plugins.php')) . '</a></p></div>';
        }
    );

    add_filter(
        'template_include',
        function ($template) {
            return get_stylesheet_directory() . '/static/no-timber.html';
        }
    );
    return;
}

/**
 * Sets the directories (inside your theme) to find .twig files
 */
Timber::$dirname = array( 'templates', 'views' );

/**
 * By default, Timber does NOT autoescape values. Want to enable Twig's autoescape?
 * No prob! Just set this value to true
 */
Timber::$autoescape = false;




/**
 * Enqueue scripts and styles.
 */
function dieprojektfabrik_theme_scripts()
{
    switch (wp_get_environment_type()) {
        case 'local':
        case 'development':
            // load assets (dev)
                wp_enqueue_script('dieprojektfabrik_theme-scripts-dev', 'http://'. getenv('VIRTUAL_HOST'). ':8080/site.js', array(), null, true);
                //wp_enqueue_script('dieprojektfabrik_theme-admin-scripts-dev', 'http://localhost:8080/admin.js');
          break;
        case 'staging':
            // load assets (staging)
            wp_enqueue_style('dieprojektfabrik_theme-style', get_stylesheet_directory_uri() . '/dist/site.css');
            wp_enqueue_script('dieprojektfabrik_theme-scripts', get_stylesheet_directory_uri() . '/dist/site.js', array(), null, true);
            //wp_enqueue_script('dieprojektfabrik_theme-admin-scripts', get_stylesheet_directory_uri() . '/dist/admin.js');
          break;
        case 'production':
        default:
            // load assets (prod)
                wp_enqueue_style('dieprojektfabrik_theme-style', get_stylesheet_directory_uri() . '/dist/site.css');
                wp_enqueue_script('dieprojektfabrik_theme-scripts', get_stylesheet_directory_uri() . '/dist/site.js', array(), null, true);
                //wp_enqueue_script('dieprojektfabrik_theme-admin-scripts', get_stylesheet_directory_uri() . '/dist/admin.js');
          break;
      }
}
add_action('wp_enqueue_scripts', 'dieprojektfabrik_theme_scripts', 9999);



/**
 * We're going to configure our theme inside of a subclass of Timber\Site
 * You can move this to its own file and include here via php's include("MySite.php")
 */
class StarterSite extends Timber\Site
{
    /** Add timber support. */
    public function __construct()
    {
        add_action('after_setup_theme', array( $this, 'theme_supports' ));
        add_filter('timber/context', array( $this, 'add_to_context' ));
        //add_filter('timber/twig', array( $this, 'add_to_twig' ));
        add_action('init', array( $this, 'register_post_types' ));
        add_action('init', array( $this, 'register_taxonomies' ));
        parent::__construct();
    }
    /** This is where you can register custom post types. */
    public function register_post_types()
    {
        $labels = array(
            'name'                  => _x('Cases', 'Post Type General Name', 'text_domain'),
            'singular_name'         => _x('Case', 'Post Type Singular Name', 'text_domain'),
            'menu_name'             => __('Cases', 'text_domain'),
            'name_admin_bar'        => __('Case', 'text_domain'),
            'archives'              => __('Case Archiv', 'text_domain'),
            'attributes'            => __('Case Attribute', 'text_domain'),
            'parent_item_colon'     => __('Parent Case:', 'text_domain'),
            'all_items'             => __('Alle Cases', 'text_domain'),
            'add_new_item'          => __('Neuer Case hinzufügen', 'text_domain'),
            'add_new'               => __('Neuer Case', 'text_domain'),
            'new_item'              => __('Neues Element', 'text_domain'),
            'edit_item'             => __('Case bearbeiten', 'text_domain'),
            'update_item'           => __('Case aktualisieren', 'text_domain'),
            'view_item'             => __('Case anzeigen', 'text_domain'),
            'view_items'            => __('Elemente anzeigen', 'text_domain'),
            'search_items'          => __('Cases suchen', 'text_domain'),
            'not_found'             => __('Kein Case gefunden', 'text_domain'),
            'not_found_in_trash'    => __('Kein Case gefunden im Papierkorb', 'text_domain'),
            'featured_image'        => __('Featured Image', 'text_domain'),
            'set_featured_image'    => __('Set featured image', 'text_domain'),
            'remove_featured_image' => __('Entferne featured image', 'text_domain'),
            'use_featured_image'    => __('Use as featured image', 'text_domain'),
            'insert_into_item'      => __('Insert into item', 'text_domain'),
            'uploaded_to_this_item' => __('Uploaded to this item', 'text_domain'),
            'items_list'            => __('Items list', 'text_domain'),
            'items_list_navigation' => __('Items list navigation', 'text_domain'),
            'filter_items_list'     => __('Filter items list', 'text_domain'),
        );
        $args = array(
            'label'                 => __('Case', 'text_domain'),
            'description'           => __('Case information.', 'text_domain'),
            'labels'                => $labels,
            'supports'              => array( 'title', 'editor', 'thumbnail', 'comments', 'revisions', 'custom-fields' ),
            'taxonomies'            => array( 'category', 'post_tag', 'location', 'type' ),
            'hierarchical'          => false,
            'public'                => true,
            'show_ui'               => true,
            'show_in_menu'          => true,
            'menu_position'         => 5,
            'menu_icon'             => 'dashicons-analytics',
            'show_in_admin_bar'     => true,
            'show_in_nav_menus'     => true,
            'can_export'            => true,
            'has_archive'           => true,
            'exclude_from_search'   => false,
            'publicly_queryable'    => true,
            'capability_type'       => 'page',
            'show_in_rest'          => true,
        );
        register_post_type('case', $args);
    }
    /** This is where you can register custom taxonomies. */
    public function register_taxonomies()
    {
    }

    /** This is where you add some context
     *
     * @param string $context context['this'] Being the Twig's {{ this }}.
     */
    public function add_to_context($context)
    {
        //$context['foo']   = 'bar';
        //$context['stuff'] = 'I am a value set in your functions.php file';
        //$context['notes'] = 'These values are available everytime you call Timber::context();';
        //$context['menu']  = new Timber\Menu();
        $context['mainmenuLeft']  = new Timber\Menu('mainmenuLeft');
        $context['mainmenuRight']  = new Timber\Menu('mainmenuRight');
        $context['site']  = $this;
        return $context;
    }

    public function theme_supports()
    {
        // Add default posts and comments RSS feed links to head.
        add_theme_support('automatic-feed-links');

        /*
         * Let WordPress manage the document title.
         * By adding theme support, we declare that this theme does not use a
         * hard-coded <title> tag in the document head, and expect WordPress to
         * provide it for us.
         */
        add_theme_support('title-tag');

        /*
         * Enable support for Post Thumbnails on posts and pages.
         *
         * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
         */
        add_theme_support('post-thumbnails');

        /*
         * Switch default core markup for search form, comment form, and comments
         * to output valid HTML5.
         */
        add_theme_support(
            'html5',
            array(
                'comment-form',
                'comment-list',
                'gallery',
                'caption',
            )
        );

        /*
         * Enable support for Post Formats.
         *
         * See: https://codex.wordpress.org/Post_Formats
         */
        add_theme_support(
            'post-formats',
            array(
                'aside',
                'image',
                'video',
                'quote',
                'link',
                'gallery',
                'audio',
            )
        );

        add_theme_support('menus');
        /* Enable ci/cd styles in Backend */
        add_theme_support('editor-styles');
        add_editor_style('dist/site.css');
    }

    /** This Would return 'foo bar!'.
     *
     * @param string $text being 'foo', then returned 'foo bar!'.
     */
  /*   public function myfoo($text)
    {
        $text .= ' bar!';
        return $text;
    } */

    /** This is where you can add your own functions to twig.
     *
     *
     * @param string $twig get extension.
     */
/*     public function add_to_twig($twig)
    {
        $twig->addExtension(new Twig\Extension\StringLoaderExtension());
        $twig->addFilter(new Twig\TwigFilter('myfoo', array( $this, 'myfoo' )));
        return $twig;
    } */
}

new StarterSite();




// Remove Block vorlagen
add_action('after_setup_theme', 'fire_theme_support');
function fire_theme_support()
{
    remove_theme_support('core-block-patterns');
}

// Remove UAG Templates Button
add_filter('ast_block_templates_disable', '__return_true');
