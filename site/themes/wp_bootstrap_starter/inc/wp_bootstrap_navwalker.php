<?php
/**
 * WP Bootstrap Navwalker (customized)
 *
 * @package WP-Bootstrap-Navwalker
 */

/**
 * Class Name: WP_Bootstrap_Navwalker
 * Plugin Name: WP Bootstrap Navwalker
 * Plugin URI:  https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 * Description: A custom WordPress nav walker class to implement the Bootstrap 5 navigation style in a custom theme using the WordPress built in menu manager.
 * Author: Edward McIntyre - @twittem, WP Bootstrap, William Patton - @pattonwebz
 * Version: 3.0.1
 * Author URI: https://github.com/wp-bootstrap
 * GitHub Plugin URI: https://github.com/wp-bootstrap/wp-bootstrap-navwalker
 * GitHub Branch: master
 * License: GPL-3.0+
 * License URI: https://www.gnu.org/licenses/gpl-3.0.txt
 */

if ( ! class_exists( 'WP_Bootstrap_Navwalker' ) ) {
	/**
	 * WP_Bootstrap_Navwalker class.
	 *
	 * @extends Walker_Nav_Menu
	 */
	class WP_Bootstrap_Navwalker extends Walker_Nav_Menu {
		/**
		 * Start Level.
		 *
		 * @see Walker::start_lvl()
		 * @since 1.0.0
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 */
		function start_lvl(&$output, $depth = 0, $args = array()) {
			$indent = str_repeat("\t", $depth);
			$submenu = ($depth > 0) ? ' sub-menu' : '';
			$output .= "\n$indent<ul role=\"menu\" class=\"dropdown-menu$submenu rounded-bottom-5\">\n";
		}

		/**
		 * Start El.
		 *
		 * @see Walker::start_el()
		 * @since 1.0.0
		 *
		 * @param string   $output Used to append additional content (passed by reference).
		 * @param WP_Post  $item   Menu item data object.
		 * @param int      $depth  Depth of menu item. Used for padding.
		 * @param stdClass $args   An object of wp_nav_menu() arguments.
		 * @param int      $id     Current item ID.
		 */
		function start_el(&$output, $item, $depth = 0, $args = array(), $id = 0) {
			$indent = ($depth) ? str_repeat("\t", $depth) : '';
			$li_attributes = '';
			$class_names = join(' ', apply_filters('nav_menu_css_class', array_filter($item->classes), $item, $args));
			$class_names = 'class="' . esc_attr($class_names) . (($args->walker->has_children) ? ' dropdown' : '') . '"';
		
			$output .= $indent . '<li ' . $class_names . '>';
		
			$attributes  = !empty($item->attr_title) ? ' title="' . esc_attr($item->attr_title) . '"' : '';
			$attributes .= !empty($item->target) ? ' target="' . esc_attr($item->target) . '"' : '';
			$attributes .= !empty($item->xfn) ? ' rel="' . esc_attr($item->xfn) . '"' : '';
			$attributes .= !empty($item->url) ? ' href="' . esc_attr($item->url) . '"' : '';
			$attributes .= ($args->walker->has_children) ? ' class="nav-link dropdown-toggle" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false"' : ' class="nav-link"';
		
			// Add toggle icon for dropdown
			$toggleIcon = ($args->walker->has_children) ? '<span class="ps-2" id="toggleIcon">+</span>' : '';
		
			$item_output = $args->before;
			$item_output .= '<a' . $attributes . '>';
			$item_output .= $args->link_before . apply_filters('the_title', $item->title, $item->ID) . $args->link_after;
			$item_output .= $toggleIcon; // Include the toggle icon in the link
			$item_output .= '</a>';
			$item_output .= $args->after;
		
			$output .= apply_filters('walker_nav_menu_start_el', $item_output, $item, $depth, $args);
		}

		/**
		 * Traverse elements to create list from elements.
		 *
		 * Display one element if the element doesn't have any children otherwise,
		 * display the element and its children. Will only traverse up to the max
		 * depth and no ignore elements under that depth.
		 *
		 * This method shouldn't be called directly, use the walk() method instead.
		 *
		 * @see Walker::start_el()
		 * @since 2.5.0
		 *
		 * @param object $element           Data object.
		 * @param array  $children_elements List of elements to continue traversing (passed by reference).
		 * @param int    $max_depth         Max depth to traverse.
		 * @param int    $depth             Depth of current element.
		 * @param array  $args              An array of arguments.
		 * @param string $output            Used to append additional content (passed by reference).
		 */
		public function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			if ( ! $element ) {
				return;
			}
			$id_field = $this->db_fields['id'];
			// Display this element.
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
			}
			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		/**
		 * Menu Fallback
		 * =============
		 * If this function is assigned to the wp_nav_menu's fallback_cb variable
		 * and a menu has not been assigned to the theme location in the WordPress
		 * menu manager the function with display nothing to a non-logged in user,
		 * and will add a link to the WordPress menu manager if logged in as an admin.
		 *
		 * @param array $args passed from the wp_nav_menu function.
		 */
		public static function fallback( $args ) {
			if ( current_user_can( 'edit_theme_options' ) ) {
				$container       = $args['container'];
				$container_id    = $args['container_id'];
				$container_class = $args['container_class'];
				$menu_class      = $args['menu_class'];
				$menu_id         = $args['menu_id'];

				$output = '';

				if ( $container ) {
					$output .= '<' . esc_attr( $container ) . ( $container_id ? ' id="' . esc_attr( $container_id ) . '"' : '' ) . ( $container_class ? ' class="' . esc_attr( $container_class ) . '"' : '' ) . '>';
				}
				$output .= '<ul' . ( $menu_id ? ' id="' . esc_attr( $menu_id ) . '"' : '' ) . ( $menu_class ? ' class="' . esc_attr( $menu_class ) . '"' : '' ) . '>';
					$output .= '<li><a href="' . esc_url( admin_url( 'nav-menus.php' ) ) . '" title="">' . esc_html__( 'Add a menu', 'wp_bootstrap_starter' ) . '</a></li>';
				$output .= '</ul>';
				if ( $container ) {
					$output .= '</' . esc_attr( $container ) . '>';
				}

				echo $output;
			}
		}
	}
}
