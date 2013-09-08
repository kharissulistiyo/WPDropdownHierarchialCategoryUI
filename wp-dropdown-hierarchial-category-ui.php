<?php
/*
Plugin Name: WP Dropdown Hierarchial Category UI
Version: 0.0.1
Description: Dropdown hierarchial category in WordPress post write panel or editing screen. It makes the categories list in a better UI which enables show/hide toggle of child categories.
Author: Kharis Sulistiyono
Author URI: http://twitter.com/kharissulistiyo
Plugin URI: http://www.kharissulistiyono.com/wp-dropdown-hierarchial-category-ui-plugin
*/

class Hirarchial_Category_UI {

	function plugin_init() {
		add_filter( 'wp_terms_checklist_args', array( __CLASS__, 'lock_child_cat_hirarchy' ) );
		add_action( 'admin_head', array( __CLASS__, 'new_cat_hirarchy_style' ) );
	}

	function lock_child_cat_hirarchy( $args ) {
		add_action( 'admin_footer', array( __CLASS__, 'cat_hirarchy_js' ) );

		$args['checked_ontop'] = false;

		return $args;
	}

	function cat_hirarchy_js() {
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
<?php
	}
	
	
	function new_cat_hirarchy_style() { ?>
	
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
	
<?php	}
	
	
}

Hirarchial_Category_UI::plugin_init();

