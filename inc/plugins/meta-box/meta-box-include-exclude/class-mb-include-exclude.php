<?php

/**
 * Control the include, exclude condition for meta boxes
 *
 * @link       http://metabox.io/plugins/meta-box-include-exclude/
 * @package    Meta Box
 * @subpackage Meta Box Include Exclude
 */
class MB_Include_Exclude
{
	/**
	 * Store the current post ID
	 *
	 * @var string
	 */
	static $post_id;

	/**
	 * Check if meta box is displayed or not
	 *
	 * @param bool  $show
	 * @param array $meta_box
	 *
	 * @return bool
	 */
	public static function check( $show, $meta_box )
	{
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX )
			return $show;

		$post_id       = isset( $_GET['post'] ) ? $_GET['post'] : ( isset( $_POST['post_ID'] ) ? $_POST['post_ID'] : false );
		self::$post_id = (int) $post_id;

		if ( isset( $meta_box['include'] ) )
			$show = self::maybe_exclude_include( 'include', $meta_box );

		if ( isset( $meta_box['exclude'] ) )
			$show = ! self::maybe_exclude_include( 'exclude', $meta_box );

		return $show;
	}

	/**
	 * Check if meta box is excluded for current post
	 *
	 * @param string $type 'include' or 'exclude'
	 * @param array  $meta_box
	 *
	 * @return bool
	 */
	public static function maybe_exclude_include( $type, $meta_box )
	{
		$value = false;

		$conditions = $meta_box[$type];
		$relation   = isset( $conditions['relation'] ) && in_array( strtoupper( $conditions['relation'] ), array( 'AND', 'OR' ) ) ? strtoupper( $conditions['relation'] ) : 'OR';

		// For better loop of checking terms
		unset( $conditions['relation'] );

		$check_by = array( 'ID', 'parent', 'slug', 'template', 'user_role', 'user_id', 'custom', 'is_child' );
		$check_by = apply_filters( 'rwmb_include_exclude_by', $check_by );
		foreach ( $check_by as $by )
		{
			$func = "check_{$by}";
			if ( ! isset( $conditions[$by] ) || ! method_exists( __CLASS__, $func ) )
				continue;

			$condition = call_user_func( array( __CLASS__, $func ), $conditions[$by], $meta_box );

			if ( 'OR' == $relation )
			{
				$value = $value || $condition;
				if ( $value )
					return $value;
			}
			else
			{
				$value = $value && $condition;
				if ( ! $value )
					return $value;
			}

			// For better loop of checking terms
			unset( $conditions[$by] );
		}

		// By taxonomy, including category and post_tag
		// Note that we unset all other parameters, so we can safely loop in the condition array
		if ( ! empty( $conditions ) )
		{
			// Change 'tag' to correct name 'post_tag'
			if ( isset( $conditions['tag'] ) )
			{
				$conditions['post_tag'] = $conditions['tag'];
				unset( $conditions['tag'] );
			}

			foreach ( $conditions as $taxonomy => $terms )
			{
				$condition = self::check_terms( $taxonomy, $terms );

				if ( 'OR' == $relation )
				{
					$value = $value || $condition;
					if ( $value )
						return $value;
				}
				else
				{
					$value = $value && $condition;
					if ( ! $value )
						return $value;
				}
			}
		}

		return $value;
	}

	/**
	 * Check if current post has specific ID
	 *
	 * @param array $ids
	 *
	 * @return bool
	 */
	public static function check_ID( $ids )
	{
		return in_array( self::$post_id, self::csv_to_array( $ids ) );
	}

	/**
	 * Check if current post has specific parent
	 *
	 * @param array $ids
	 *
	 * @return bool
	 */
	public static function check_parent( $ids )
	{
		$post = get_post( self::$post_id );

		return $post && in_array( $post->post_parent, self::csv_to_array( $ids ) );
	}

	/**
	 * Check if current post has specific slug
	 *
	 * @param array $slugs
	 *
	 * @return bool
	 */
	public static function check_slug( $slugs )
	{
		$post = get_post( self::$post_id );

		return $post && in_array( $post->post_name, self::csv_to_array( $slugs ) );
	}

	/**
	 * Check if current post has specific template
	 *
	 * @param array $templates
	 *
	 * @return bool
	 */
	public static function check_template( $templates )
	{
		$template = get_post_meta( self::$post_id, '_wp_page_template', true );

		return in_array( $template, self::csv_to_array( $templates ) );
	}

	/**
	 * Check if current post has specific term
	 *
	 * @param string $taxonomy
	 * @param array  $terms
	 *
	 * @return bool
	 */
	public static function check_terms( $taxonomy, $terms )
	{
		$terms = self::csv_to_array( $terms );

		$post_terms = wp_get_post_terms( self::$post_id, $taxonomy );
		if ( is_wp_error( $post_terms ) || ! is_array( $post_terms ) || empty( $post_terms ) )
			return false;

		foreach ( $post_terms as $post_term )
		{
			if ( in_array( $post_term->term_id, $terms ) || in_array( $post_term->name, $terms ) || in_array( $post_term->slug, $terms ) )
				return true;
		}

		return false;
	}

	/**
	 * Check by user role
	 *
	 * @param array|string $roles
	 *
	 * @return bool
	 */
	public static function check_user_role( $roles )
	{
		global $current_user;
		$user_role = array_shift( $current_user->roles );

		return in_array( $user_role, array_map( 'strtolower', self::csv_to_array( $roles ) ) );
	}

	/**
	 * Check by user ID
	 *
	 * @param array|string $user_ids
	 *
	 * @return bool
	 */
	public static function check_user_id( $user_ids )
	{
		return in_array( get_current_user_id(), self::csv_to_array( $user_ids ) );
	}

	/**
	 * Check by custom function
	 *
	 * @param array $func
	 *
	 * @param array $meta_box
	 *
	 * @return bool
	 */
	public static function check_custom( $func, $meta_box )
	{
		if ( ! function_exists( $func ) )
			return false;

		return call_user_func( $func, $meta_box );
	}

	/**
	 * Convert a comma separated string to array
	 *
	 * @param string $string Comma separated string
	 *
	 * @return array
	 */
	public static function csv_to_array( $string )
	{
		if ( is_array( $string ) )
			return $string;

		return array_filter( array_map( 'trim', explode( ',', $string . ',' ) ) );
	}

	/**
	 * Check the page is child or not
	 *
	 * @param bool $value 
	 *
	 * @return bool
	 */
	public static function check_is_child( $value )
	{
		$post = get_post( self::$post_id );
		$is_child = $post->post_parent ? true : false;

		return $is_child === $value;
	}
}
