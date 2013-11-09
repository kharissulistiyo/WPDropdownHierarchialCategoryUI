<?php
/*
Plugin Name: WP Dropdown Hierarchical Category UI
Version: 1.2
Description: Dropdown hierarchical category in WordPress post write panel or editing screen. It makes the categories or custom taxonomy list in a better UI which enables show/hide toggle of child categories.
Author: <a href="http://twitter.com/kharissulistiyo">Kharis Sulistiyono</a>
Author URI: http://twitter.com/kharissulistiyo
Plugin URI: http://www.kharissulistiyono.com/wp-dropdown-hierarchical-category-ui-plugin
*/

class Hirarchical_Category_UI {


	function plugin_init() {
		
		add_filter( 'wp_terms_checklist_args', array( __CLASS__, 'lock_child_cat_hirarchy' ) );
		add_action( 'admin_head', array( __CLASS__, 'new_cat_hirarchy_style' ) );
		add_action( 'admin_menu', array( __CLASS__, 'fillpress_admin_menu' ) );
		add_action( 'admin_init', array( __CLASS__, 'fillpress_admin_init' ) );
	
	}

	function lock_child_cat_hirarchy( $args ) {
	
		
		add_action( 'admin_footer', array( __CLASS__, 'cat_hirarchy_js' ) );

			
		$setting = (array) get_option('fp-select-post-type');	
			
		global $typenow;
		
		if (!empty($setting)){
		
			foreach($setting as $key => $value):
		
				if ($value == $typenow){
				
					$args['checked_ontop'] = false;

				}	
			
			endforeach;
			
			
		} else {
			$args['checked_ontop'] = true;
		}
		
		return $args;
			
	}

	function cat_hirarchy_js() {
	
		$setting = (array) get_option('fp-select-post-type');
	
		global $typenow;
		
		foreach($setting as $key => $value):
		
			if ($value == $typenow){ 	
	
?>
<script type="text/javascript">
	jQuery(function(){
	
		jQuery('[id$="-all"] > ul.categorychecklist').each(function() {
			var $list = jQuery(this);
			var $firstChecked = $list.find(':checkbox:checked').first();

			if ( !$firstChecked.length )
				return;

			var pos_first = $list.find(':checkbox').position().top;
			var pos_checked = $firstChecked.position().top;

			$list.closest('.tabs-panel').scrollTop(pos_checked - pos_first + 5);
		});
	
		jQuery('ul.categorychecklist li ul.children').parent().addClass('cat_parent');
	
		jQuery('ul.categorychecklist > li > label').removeClass('selectit');
	
		jQuery('ul.categorychecklist li ul.children').parent().children('label').wrap('<span />');
	
		jQuery('ul.categorychecklist li ul.children').parent().css({'cursor':'pointer'});
	
		jQuery('.cat_parent > span').click(function(){
		
			jQuery(this).next('ul.children').toggleClass('open_child');
	
		});		
	});
</script>
<?php		}

		endforeach;


	}
	
	
	function new_cat_hirarchy_style() { 
		
		$setting = (array) get_option('fp-select-post-type');
	
		global $typenow;
		
		foreach($setting as $key => $value): 
		
			if ($value == $typenow){ 	
	
	
	?>
	
	<style type="text/css">
	
		div[id$="-all"]{height:auto; max-height:auto !important}

		.categorychecklist >li{background:#f5f5f5; border-bottom:1px solid #dfdfdf; padding-left:3px !important; padding-right:3px !important}

		.categorychecklist >li span{display:block}

		.categorychecklist >li label{display:inline}

		.categorychecklist ul.children{display:none}

		.categorychecklist ul.children.open_child{display:block}

		.categorychecklist ul.children li{background:transparent}

		li.cat_parent >span{position:relative}

		li.cat_parent >span:before{background:url(<?php echo admin_url() . 'images/arrows.png'; ?>) top right no-repeat; content:''; width:15px; height:15px; color:#878787; display:inline-block; position:absolute; top:2px; right:2px}

	
	</style>
	
<?php	


			}
		
		endforeach;	

	}

	
	
	
	
	/** SETTINGS **/
	
	
	function fillpress_admin_menu() {
		add_menu_page( 'WP-DHCUI', 'WP-DHCUI', 'manage_options', 'fillpress', array( __CLASS__, 'fillpress_options_page' ) );
	}	
	
	function fillpress_admin_init() {
		/* Register setting */
		register_setting( 'fillpress-group-1', 'fp-select-post-type' );
		/* Create setting section */ 
		add_settings_section( 'fillpress-section-one', '', array( __CLASS__,'section_one_callback'), 'fillpress-section-1' );	
		/* Create fields */
		add_settings_field( 'field-one', __('Select Post Type(s)', 'wp-dropdown-hierarchical-category-ui'), array( __CLASS__, 'field_one_callback'), 'fillpress-section-1', 'fillpress-section-one' );		
	}	
	
	
	function section_one_callback() {
		echo '<p>';
		_e('In what post type(s) the hierarchical category or taxonomy UI	will be applied to?', 'wp-dropdown-hierarchical-category-ui');
		echo'</p>';
	}


	function field_one_callback() {
	
		$setting = esc_attr( get_option( 'fp-select-post-type' ) );

		$output = 'names'; // names or objects, note names is the default

		$post_types = get_post_types('', $output); 
	
		foreach ($post_types as $post_type) :
			
			$exclude = array( 'page', 'attachment', 'revision', 'nav_menu_item' );
			
			if( TRUE === in_array( $post_type, $exclude ) )
                continue;
			
			if(in_array($post_type, (array) get_option( 'fp-select-post-type' ))) {
				$checked = 'checked="checked"';
			} else {
				$checked = '';
			}
			
			?>
		
			<p>	
				<label for="fp-select-post-type-<?php echo $post_type; ?>">
					<input id="fp-select-post-type-<?php echo $post_type; ?>" type="checkbox" <?php echo $checked; ?> name="fp-select-post-type[]" value="<?php echo esc_attr($post_type); ?>" /> <?php echo esc_attr($post_type); ?>  
				</label>
			</p>		
	
		<?php endforeach;
		
	}	
	
	
	function fillpress_options_page(){
    ?>
		<div class="wrap">
			<div id="icon-options-general" class="icon32"></div> <h2><?php _e('WP-DHCUI Setting', 'wp-dropdown-hierarchical-category-ui'); ?></h2>
			<form action="options.php" method="POST">
				<?php settings_fields( 'fillpress-group-1' ); ?>
				<?php do_settings_sections( 'fillpress-section-1' ); ?>
				<?php submit_button(); ?>
			</form>
			
			<p><?php _e('Plugin setting page powered by', 'wp-dropdown-hierarchical-category-ui'); ?> <a href="http://kharissulistiyo.github.io/fillpress" target="_blank">FillPress</a>. <?php _e('Developed with a bunch of love by ', 'wp-dropdown-hierarchical-category-ui'); ?> <a href="http://kharissulistiyo.github.io/" target="_blank" title="<?php _e('I am available for freelance works.', 'wp-dropdown-hierarchical-category-ui'); ?>">Kharis Sulistiyono</a>.</p>
			
		</div>
    <?php
	}
	
	
	/** / SETTINGS **/
	
	
	
} // End of Class

Hirarchical_Category_UI::plugin_init();

