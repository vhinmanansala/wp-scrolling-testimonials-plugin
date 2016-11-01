<?php 


add_shortcode('testimonial_carousel', 'init_st_shortcode');

function init_st_shortcode($atts) {
	$count = $atts['count'];


	query_posts(array('post_type' => 'testimonials', 'posts_per_page' => $count));

	$html = "<div id='st_carousel'>";

	while(have_posts()) : the_post();
		$st_client = get_the_title();
		$st_position = get_post_meta(get_the_ID(), '_cmb_clientPosition', true);
		$st_thumbnail = wp_get_attachment_url(get_post_thumbnail_id($post->ID));
		$st_testmonial = get_post_meta(get_the_ID(), '_cmb_clientTestimonial', true);

		$html .= "<div class='item clearfix'>";
			$html .= "<div class='st_thumbnail'>";
				$html .= sprintf("<img src='%s'>", $st_thumbnail);
			$html .= "</div>";

			$html .= "<div class='st_meta'>";
				$html .= sprintf("<h4>%s</h4>", $st_client);
				$html .= sprintf("<em>%s</em>", $st_position);
				$html .= sprintf("<p>%s</p>", $st_testmonial);
			$html .= "</div>";
		$html .= "</div>";
	endwhile; wp_reset_query();

	$html .= "</div>";

	return $html;
}