<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package capside
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */
function capside_body_classes( $classes ) {
	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	// Adds a class of no-sidebar when there is no sidebar present.
	if ( ! is_active_sidebar( 'sidebar-1' ) ) {
		$classes[] = 'no-sidebar';
	}

	return $classes;
}
add_filter( 'body_class', 'capside_body_classes' );

/**
 * Add a pingback url auto-discovery header for single posts, pages, or attachments.
 */
function capside_pingback_header() {
	if ( is_singular() && pings_open() ) {
		printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
	}
}
add_action( 'wp_head', 'capside_pingback_header' );
add_action('wp_head', 'display_url_header');
function display_url_header(){
    //Close PHP tags ?>
    <script>
		const ajax = {
			site : "<?=site_url()?>",
			url : "<?=admin_url( 'admin-ajax.php' )?>",
			api : "<?=get_rest_url( null, 'api/' )?>",
		}
	</script>
    <?php //Open PHP tags
}
// Custom functions
// return url logo
function getUrlLogo(){
	$logo = get_theme_mod( 'custom_logo' );
	$image = wp_get_attachment_image_src( $logo , 'full' );
	return $image[0];
}
function getSrc($post_id, $size){
    $imgID = get_post_thumbnail_id( $post_id );
    $image = wp_get_attachment_image_src( $imgID , $size );
    return $image[0];
}
// Return url of image attachment
function imgUrl( $post_id ){
	return wp_get_attachment_url( get_post_thumbnail_id( $post_id ) );
}

// Return url of image attachment
function imageUrlMeta( $post_id ){
	return wp_get_attachment_url( $post_id );
}
// Return url of image attachment
function asset( $resource ){
	return get_template_directory_uri().'/assets'.$resource;
}
function dbug($arg){
	echo "<pre>";
	print_r($arg);
	echo "</pre>";
	die();
}
function getPosts($items = 4, $not_in = false){
    $args = [
		'post_type' => 'post',
        'posts_per_page' => $items,
        'post_status' => 'publish'
	];
    if( $not_in > 1 ){
        $args['post__not_in'] = [$not_in];
    }
    $query = new wp_query($args);
    return $query->posts;
}

// Custom's functions 
function c_wp_nav_menu( $args = array() ) {
    static $menu_id_slugs = array();
 
    $defaults = array(
        'menu'                 => '',
        'container'            => 'div',
        'container_class'      => '',
        'container_id'         => '',
        'container_aria_label' => '',
        'menu_class'           => 'navbar-nav',
        'menu_id'              => '',
        'echo'                 => true,
        'fallback_cb'          => 'wp_page_menu',
        'before'               => '',
        'after'                => '',
        'link_before'          => '',
        'link_after'           => '',
        'items_wrap'           => '<ul id="%1$s" class="%2$s">%3$s</ul>',
        'item_spacing'         => 'preserve',
        'depth'                => 0,
        'walker'               => '',
        'theme_location'       => '',
    );
 
    $args = wp_parse_args( $args, $defaults );
 
    if ( ! in_array( $args['item_spacing'], array( 'preserve', 'discard' ), true ) ) {
        // Invalid value, fall back to default.
        $args['item_spacing'] = $defaults['item_spacing'];
    }
 
    /**
     * Filters the arguments used to display a navigation menu.
     *
     * @since 3.0.0
     *
     * @see wp_nav_menu()
     *
     * @param array $args Array of wp_nav_menu() arguments.
     */
    $args = apply_filters( 'wp_nav_menu_args', $args );
    $args = (object) $args;
 
    /**
     * Filters whether to short-circuit the wp_nav_menu() output.
     *
     * Returning a non-null value from the filter will short-circuit wp_nav_menu(),
     * echoing that value if $args->echo is true, returning that value otherwise.
     *
     * @since 3.9.0
     *
     * @see wp_nav_menu()
     *
     * @param string|null $output Nav menu output to short-circuit with. Default null.
     * @param stdClass    $args   An object containing wp_nav_menu() arguments.
     */
    $nav_menu = apply_filters( 'pre_wp_nav_menu', null, $args );
 
    if ( null !== $nav_menu ) {
        if ( $args->echo ) {
            echo $nav_menu;
            return;
        }
 
        return $nav_menu;
    }
 
    // Get the nav menu based on the requested menu.
    $menu = wp_get_nav_menu_object( $args->menu );
 
    // Get the nav menu based on the theme_location.
    $locations = get_nav_menu_locations();
    if ( ! $menu && $args->theme_location && $locations && isset( $locations[ $args->theme_location ] ) ) {
        $menu = wp_get_nav_menu_object( $locations[ $args->theme_location ] );
    }
 
    // Get the first menu that has items if we still can't find a menu.
    if ( ! $menu && ! $args->theme_location ) {
        $menus = wp_get_nav_menus();
        foreach ( $menus as $menu_maybe ) {
            $menu_items = wp_get_nav_menu_items( $menu_maybe->term_id, array( 'update_post_term_cache' => false ) );
            if ( $menu_items ) {
                $menu = $menu_maybe;
                break;
            }
        }
    }
 
    if ( empty( $args->menu ) ) {
        $args->menu = $menu;
    }
 
    // If the menu exists, get its items.
    if ( $menu && ! is_wp_error( $menu ) && ! isset( $menu_items ) ) {
        $menu_items = wp_get_nav_menu_items( $menu->term_id, array( 'update_post_term_cache' => false ) );
    }
 
    /*
     * If no menu was found:
     *  - Fall back (if one was specified), or bail.
     *
     * If no menu items were found:
     *  - Fall back, but only if no theme location was specified.
     *  - Otherwise, bail.
     */
    if ( ( ! $menu || is_wp_error( $menu ) || ( isset( $menu_items ) && empty( $menu_items ) && ! $args->theme_location ) )
        && isset( $args->fallback_cb ) && $args->fallback_cb && is_callable( $args->fallback_cb ) ) {
            return call_user_func( $args->fallback_cb, (array) $args );
    }
 
    if ( ! $menu || is_wp_error( $menu ) ) {
        return false;
    }
 
    $nav_menu = '';
    $items    = '';
 
    $show_container = false;
    if ( $args->container ) {
        /**
         * Filters the list of HTML tags that are valid for use as menu containers.
         *
         * @since 3.0.0
         *
         * @param string[] $tags The acceptable HTML tags for use as menu containers.
         *                       Default is array containing 'div' and 'nav'.
         */
        $allowed_tags = apply_filters( 'wp_nav_menu_container_allowedtags', array( 'div', 'nav' ) );
 
        if ( is_string( $args->container ) && in_array( $args->container, $allowed_tags, true ) ) {
            $show_container = true;
            $class          = $args->container_class ? ' class="' . esc_attr( $args->container_class ) . '"' : ' class="menu-' . $menu->slug . '-container"';
            $id             = $args->container_id ? ' id="' . esc_attr( $args->container_id ) . '"' : '';
            $aria_label     = ( 'nav' === $args->container && $args->container_aria_label ) ? ' aria-label="' . esc_attr( $args->container_aria_label ) . '"' : '';
            $nav_menu      .= '<' . $args->container . $id . $class . $aria_label . '>';
        }
    }
 
    // Set up the $menu_item variables.
    _wp_menu_item_classes_by_context( $menu_items );
 
    $sorted_menu_items        = array();
    $menu_items_with_children = array();
    foreach ( (array) $menu_items as $menu_item ) {
        $sorted_menu_items[ $menu_item->menu_order ] = $menu_item;
        if ( $menu_item->menu_item_parent ) {
            $menu_items_with_children[ $menu_item->menu_item_parent ] = true;
        }
    }
 
    // Add the menu-item-has-children class where applicable.
    if ( $menu_items_with_children ) {
        foreach ( $sorted_menu_items as &$menu_item ) {
            if ( isset( $menu_items_with_children[ $menu_item->ID ] ) ) {
                $menu_item->classes[] = 'menu-item-has-children';
            }
        }
    }
 
    unset( $menu_items, $menu_item );
 
    /**
     * Filters the sorted list of menu item objects before generating the menu's HTML.
     *
     * @since 3.1.0
     *
     * @param array    $sorted_menu_items The menu items, sorted by each menu item's menu order.
     * @param stdClass $args              An object containing wp_nav_menu() arguments.
     */
    $sorted_menu_items = apply_filters( 'wp_nav_menu_objects', $sorted_menu_items, $args );
 
    $items .= walk_nav_menu_tree( $sorted_menu_items, $args->depth, $args );
    unset( $sorted_menu_items );
 
    // Attributes.
    if ( ! empty( $args->menu_id ) ) {
        $wrap_id = $args->menu_id;
    } else {
        $wrap_id = 'holi menu-' . $menu->slug;
 
        while ( in_array( $wrap_id, $menu_id_slugs, true ) ) {
            if ( preg_match( '#-(\d+)$#', $wrap_id, $matches ) ) {
                $wrap_id = preg_replace( '#-(\d+)$#', '-' . ++$matches[1], $wrap_id );
            } else {
                $wrap_id = $wrap_id . '-1';
            }
        }
    }
    $menu_id_slugs[] = $wrap_id;
 
    $wrap_class = $args->menu_class ? $args->menu_class : '';
 
    /**
     * Filters the HTML list content for navigation menus.
     *
     * @since 3.0.0
     *
     * @see wp_nav_menu()
     *
     * @param string   $items The HTML list content for the menu items.
     * @param stdClass $args  An object containing wp_nav_menu() arguments.
     */
    $items = apply_filters( 'wp_nav_menu_items', $items, $args );
    /**
     * Filters the HTML list content for a specific navigation menu.
     *
     * @since 3.0.0
     *
     * @see wp_nav_menu()
     *
     * @param string   $items The HTML list content for the menu items.
     * @param stdClass $args  An object containing wp_nav_menu() arguments.
     */
    $items = apply_filters( "wp_nav_menu_{$menu->slug}_items", $items, $args );
 
    // Don't print any markup if there are no items at this point.
    if ( empty( $items ) ) {
        return false;
    }
 
    $nav_menu .= sprintf( $args->items_wrap, esc_attr( $wrap_id ), esc_attr( $wrap_class ), $items );
    unset( $items );
 
    if ( $show_container ) {
        $nav_menu .= '</' . $args->container . '>';
    }
 
    /**
     * Filters the HTML content for navigation menus.
     *
     * @since 3.0.0
     *
     * @see wp_nav_menu()
     *
     * @param string   $nav_menu The HTML content for the navigation menu.
     * @param stdClass $args     An object containing wp_nav_menu() arguments.
     */
    $nav_menu = apply_filters( 'wp_nav_menu', $nav_menu, $args );
 
    if ( $args->echo ) {
        echo $nav_menu;
    } else {
        return $nav_menu;
    }
}


class plantilla{
    function __construct($template_file) {
        $this->tpl_file = get_template_directory().'/template-parts/mail/' . $template_file . '.php';
    }
	function asigna_variables($vars){
		$this->vars= (empty($this->vars)) ? $vars : $this->vars . $vars;
	}
	
	function muestra(){
		if (!($this->fd = @fopen($this->tpl_file, 'r'))) {
			echo 'error al abrir la plantilla ' . $this->tpl_file;
		} else{
			$this->template_file = fread($this->fd, filesize($this->tpl_file));
			fclose($this->fd);
			$this->mihtml = $this->template_file;
			$this->mihtml = str_replace ("'", "\'", $this->mihtml);
			$this->mihtml = preg_replace('#\{([a-z0-9\-_]*?)\}#is', "' . $\\1 . '", $this->mihtml);
			reset ($this->vars);
			while (list($key, $val) = each($this->vars)) {
				$$key = $val;
			}
			eval("\$this->mihtml = '$this->mihtml';");
			reset ($this->vars);
			while (list($key, $val) = each($this->vars)) {
				unset($$key);
			}
			$this->mihtml=str_replace ("\'", "'", $this->mihtml);
			return $this->mihtml;
		}
	}
}

function events_endpoint($request) {
	register_rest_route( 'api', '/contactForm', array(
        'methods'  => 'POST',
        'callback' => 'send_mail',
        'permission_callback' => '__return_true'
    ));

    register_rest_route( 'api', '/sendFile',array(
        'methods'  => 'POST',
        'callback' => 'processFile',
        'permission_callback' => '__return_true'
    ));
    
}
add_action( 'rest_api_init', 'events_endpoint' );

function send_mail($request){
    $data = $request->get_params();
    $data["header"] = file_get_contents( get_template_directory() . '/template-parts/mail/header.php' );
    $data["footer"] = file_get_contents( get_template_directory() . '/template-parts/mail/footer.php' );
    $template = isset($data["template"]) ? $data["template"] : 'tpl-mail';

    try{
        $Contenido = new Plantilla($template);
        $Contenido->asigna_variables($data);
        $body = $Contenido->muestra();
        $headers = array('Content-Type: text/html; charset=UTF-8');
        $response = [];
        // if( wp_mail('ventas@agoinversiones.com', 'Formulario de contacto', $body, $headers ) ){
        if( wp_mail(['beto@develover.mx','marketing.agoinversiones@gmail.com'], 'Formulario de contacto', $body, $headers ) ){
            $response = [
                'status' => 'success',
                'message' => 'Sus datos se han enviado con éxito',
                'data' => []
            ];       
        }else{
            $response = [
                'status' => 'error',
                'message' => 'Intente más tarde',
                'data' => []
            ];  
        }
    }catch (\Exception $e){
        echo $e;
    }
    return $response;
}

function processFile($request){
    $data = $request->get_file_params();
    
    // if( ( $data["excel"]["type"] == "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet") ){
        $move = get_template_directory() . '/assets/files/'.$_FILES['excel']['name'];
        try{
            move_uploaded_file($data["excel"]["tmp_name"], $move);
        }catch(Exception $e){
            $move = $e->getMessage();
        }
        
    // }
    return [
        "status" => 200,
        "message" => $move,
        "data" => ["saludos"]
    ];
    
}