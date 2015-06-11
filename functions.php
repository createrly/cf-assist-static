<?php

if (!function_exists('cfassistInit'))
{
  function cfassistInit()
  {
    register_nav_menus(array(
  		'primary'   => 'Header Menu',
      'footer'    => 'Footer Menu'
    ));
    add_theme_support('post-thumbnails');
    add_theme_support('post-formats', array('gallery', 'video'));
  }
}
add_action('after_setup_theme', 'cfassistInit');

if (!function_exists('cfassistSidebar'))
{
  function cfassistSidebar()
  {
    register_sidebar( array(
      'name'          => 'Blog Sidebar',
      'id'            => 'blog-sidebar',
      'description'   => 'Widgets in this area will be shown on blog posts and pages.',
      'before_widget' => '',
      'after_widget'  => '',
      'before_title'  => '<div class="headline-v2 bg-color-light"><h2>',
      'after_title'   => '</h2></div>',
    ));
  }
}
add_action('widgets_init', 'cfassistSidebar');

// TGM Automatic Plugins
require_once dirname( __FILE__ ) . '/class-tgm-plugin-activation.php';
if (!function_exists('cfassistPlugins'))
{
  function cfassistPlugins()
  {
    $plugins = array(
      // ACF Pro
      array(
        'name' => 'Advanced Custom Fields Pro',
        'slug' => 'advanced-custom-fields-pro',
        'source' => get_stylesheet_directory() . '/dist/acf-pro.zip',
        'required' => true,
        'force_activation' => true
      )
    );

    // Built-in defaults
    $config = array(
      'default_path' => '',                      // Default absolute path to pre-packaged plugins.
      'menu'         => 'tgmpa-install-plugins', // Menu slug.
      'has_notices'  => true,                    // Show admin notices or not.
      'dismissable'  => true,                    // If false, a user cannot dismiss the nag message.
      'dismiss_msg'  => '',                      // If 'dismissable' is false, this message will be output at top of nag.
      'is_automatic' => false,                   // Automatically activate plugins after installation or not.
      'message'      => '',                      // Message to output right before the plugins table.
      'strings'      => array(
        'page_title'                      => __( 'Install Required Plugins', 'tgmpa' ),
        'menu_title'                      => __( 'Install Plugins', 'tgmpa' ),
        'installing'                      => __( 'Installing Plugin: %s', 'tgmpa' ), // %s = plugin name.
        'oops'                            => __( 'Something went wrong with the plugin API.', 'tgmpa' ),
        'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.' ), // %1$s = plugin name(s).
        'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.' ), // %1$s = plugin name(s).
        'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this site for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.' ), // %1$s = plugin name(s).
        'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
        'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.' ), // %1$s = plugin name(s).
        'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this site for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.' ), // %1$s = plugin name(s).
        'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.' ), // %1$s = plugin name(s).
        'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this site for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.' ), // %1$s = plugin name(s).
        'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins' ),
        'activate_link'                   => _n_noop( 'Begin activating plugin', 'Begin activating plugins' ),
        'return'                          => __( 'Return to Required Plugins Installer', 'tgmpa' ),
        'plugin_activated'                => __( 'Plugin activated successfully.', 'tgmpa' ),
        'complete'                        => __( 'All plugins installed and activated successfully. %s', 'tgmpa' ), // %s = dashboard link.
        'nag_type'                        => 'updated' // Determines admin notice type - can only be 'updated', 'update-nag' or 'error'.
      )
    );

    // Init
    tgmpa($plugins, $config);
  }
}
add_action('tgmpa_register', 'cfassistPlugins');




/* Recent Posts Widget */
class CFAssist_Widget_Recent_Posts extends WP_Widget {

	public function __construct() {
		$widget_ops = array('classname' => 'widget_recent_entries', 'description' => __( "Your site&#8217;s most recent Posts.") );
		parent::__construct('recent-posts', __('Recent Posts'), $widget_ops);
		$this->alt_option_name = 'widget_recent_entries';

		add_action( 'save_post', array($this, 'flush_widget_cache') );
		add_action( 'deleted_post', array($this, 'flush_widget_cache') );
		add_action( 'switch_theme', array($this, 'flush_widget_cache') );
	}

	/**
	 * @param array $args
	 * @param array $instance
	 */
	public function widget( $args, $instance ) {
		$cache = array();
		if ( ! $this->is_preview() ) {
			$cache = wp_cache_get( 'widget_recent_posts', 'widget' );
		}

		if ( ! is_array( $cache ) ) {
			$cache = array();
		}

		if ( ! isset( $args['widget_id'] ) ) {
			$args['widget_id'] = $this->id;
		}

		if ( isset( $cache[ $args['widget_id'] ] ) ) {
			echo $cache[ $args['widget_id'] ];
			return;
		}

		ob_start();

		$title = ( ! empty( $instance['title'] ) ) ? $instance['title'] : __( 'Recent Posts' );

		/** This filter is documented in wp-includes/default-widgets.php */
		$title = apply_filters( 'widget_title', $title, $instance, $this->id_base );

		$number = ( ! empty( $instance['number'] ) ) ? absint( $instance['number'] ) : 5;
		if ( ! $number )
			$number = 5;
		$show_date = isset( $instance['show_date'] ) ? $instance['show_date'] : false;

		/**
		 * Filter the arguments for the Recent Posts widget.
		 *
		 * @since 3.4.0
		 *
		 * @see WP_Query::get_posts()
		 *
		 * @param array $args An array of arguments used to retrieve the recent posts.
		 */
		$r = new WP_Query( apply_filters( 'widget_posts_args', array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		) ) );

		if ($r->have_posts()) :
?>
		<?php echo $args['before_widget']; ?>
		<?php if ( $title ) {
			echo $args['before_title'] . $title . $args['after_title'];
		} ?>
		<ul class="list-unstyled blog-latest-posts margin-bottom-50">
		<?php while ( $r->have_posts() ) : $r->the_post(); ?>
			<li>
				<h3><a href="<?php the_permalink(); ?>"><?php get_the_title() ? the_title() : the_ID(); ?></a></h3>
				<small><?php the_date(); ?> / <?php the_category(', '); ?></small>
        <p><?php the_excerpt(); ?></p>
			</li>
		<?php endwhile; ?>
		</ul>
		<?php echo $args['after_widget']; ?>
<?php
		// Reset the global $the_post as this query will have stomped on it
		wp_reset_postdata();

		endif;

		if ( ! $this->is_preview() ) {
			$cache[ $args['widget_id'] ] = ob_get_flush();
			wp_cache_set( 'widget_recent_posts', $cache, 'widget' );
		} else {
			ob_end_flush();
		}
	}

	/**
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	public function update( $new_instance, $old_instance ) {
		$instance = $old_instance;
		$instance['title'] = strip_tags($new_instance['title']);
		$instance['number'] = (int) $new_instance['number'];
		$instance['show_date'] = isset( $new_instance['show_date'] ) ? (bool) $new_instance['show_date'] : false;
		$this->flush_widget_cache();

		$alloptions = wp_cache_get( 'alloptions', 'options' );
		if ( isset($alloptions['widget_recent_entries']) )
			delete_option('widget_recent_entries');

		return $instance;
	}

	/**
	 * @access public
	 */
	public function flush_widget_cache() {
		wp_cache_delete('widget_recent_posts', 'widget');
	}

	/**
	 * @param array $instance
	 */
	public function form( $instance ) {
		$title     = isset( $instance['title'] ) ? esc_attr( $instance['title'] ) : '';
		$number    = isset( $instance['number'] ) ? absint( $instance['number'] ) : 5;
		$show_date = isset( $instance['show_date'] ) ? (bool) $instance['show_date'] : false;
?>
		<p><label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title:' ); ?></label>
		<input class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" type="text" value="<?php echo $title; ?>" /></p>

		<p><label for="<?php echo $this->get_field_id( 'number' ); ?>"><?php _e( 'Number of posts to show:' ); ?></label>
		<input id="<?php echo $this->get_field_id( 'number' ); ?>" name="<?php echo $this->get_field_name( 'number' ); ?>" type="text" value="<?php echo $number; ?>" size="3" /></p>

		<p><input class="checkbox" type="checkbox" <?php checked( $show_date ); ?> id="<?php echo $this->get_field_id( 'show_date' ); ?>" name="<?php echo $this->get_field_name( 'show_date' ); ?>" />
		<label for="<?php echo $this->get_field_id( 'show_date' ); ?>"><?php _e( 'Display post date?' ); ?></label></p>
<?php
	}
}
function cfassistCustomWidget()
{
  register_widget('CFAssist_Widget_Recent_Posts');
}
add_action('widgets_init', 'cfassistCustomWidget');
