<?php

function register_theme_menus() {
	register_nav_menus(
		array(
			'header_menu'	=> __( 'Header Menu' ),
			'politica_menu' => __('Politica Menu'),
			
		)
	);
}
add_action( 'init', 'register_theme_menus' );

class Walker_Nav_Header extends Walker_Nav_Menu{
	public function start_el( &$output, $item, $depth, $args ){
		$output .= '<li>';
		! empty ( $item->attr_title )
			and $item->attr_title !== $item->title
			and $attributes .= ' title="' . esc_attr( $item->attr_title ) .'"';
		! empty ( $item->url )
			and $attributes .= ' href="' . esc_attr( $item->url ) .'"';
		! empty( $item->xfn )  
			and $attributes .= ' rel="'    . esc_attr( $item->xfn        ) .'"';
		$attributes  = trim( $attributes );
		$title       = apply_filters( 'the_title', $item->title, $item->ID );
		$anchor = "{$args->before}<a class=\"page-scroll\" {$attributes}>{$args->link_before}{$title}</a>"
			. $args->link_after . $args->after;
		//Agregamos un filtro par si un plugin necesita acceso
		$output .= apply_filters('walker_nav_menu_start_el', $anchor, $item, $depth, $args);
	}

	function end_el( &$output ){
		$output .= '</li>';
	}
}
