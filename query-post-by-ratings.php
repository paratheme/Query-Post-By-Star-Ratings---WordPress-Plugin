<?php


		$post_type = 'post';
		$post_status = 'publish';
		$posts_per_page = 5;
				
		$html = '';
		
		$wp_query = new WP_Query(
			array (
				'post_type' => $post_type,
				'post_status' => $post_status,
				'posts_per_page' => $posts_per_page,
				'meta_query' => array(
						array(
							'key' => 'totalstarvalue',
							'value' => 0,
							'compare' => '>',
							'type' => 'NUMERIC'
							),

					)
				) );
						
						
		if ( $wp_query->have_posts() ) :
		
		while ( $wp_query->have_posts() ) : $wp_query->the_post();

			$all_rate[get_the_ID()] = get_post_meta( get_the_ID(), 'totalstarvalue', true );
			$all_count[get_the_ID()] = get_post_meta( get_the_ID(), 'totalstarcount', true );	
			$post_rates[get_the_ID()] = 	$all_rate[get_the_ID()]/$all_count[get_the_ID()];		
				
		endwhile;
		
		wp_reset_query();
		endif;				
		
		
		$html .= '<br />';

		
		arsort($post_rates);

		foreach($post_rates as $key => $value)
			{
				$post = get_post($key);
				$html .= $post->post_title.' - '.$value.'<br />';
				
				// you content display here
				// Please read more about get_post http://codex.wordpress.org/Function_Reference/get_post
			}

		
		return $html;
?>