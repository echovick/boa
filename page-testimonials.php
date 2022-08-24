<?php echo get_header();?>
<main class="sessions">
	<?php
		while(have_posts()):the_post();
			$page_title = "Testimonials";
			$page_snippet = "Here is what our previous participants have to say";  
		endwhile;
	?>
	<div class="sessions-page">
		<div class="page-header-section">
			<p class="title header txt-bold txt-dark"><?php echo $page_title?></p>
			<p class="text txt-lg w-60 txt-normal"><?php echo $page_snippet?></p>
		</div>
		<div class="content mt-5 pt-4">
			<div class="row w-100 mb-5">
				<?php
                    $testimonial = new WP_Query(array('post_type'=>'testimonial','posts_per_page'=>'-1'));
					while($testimonial->have_posts()):$testimonial->the_post();
				?>
				<div class="col-4">
					<div class="mt-4 row w-100">
						<div>
							<img src="<?php echo get_metabox_image_url('display_picture')?>" alt="" style="width:80%; height:auto;">
						</div>
						<div class="testimonial-content shadow">
							<p class="txt-blue txt-sm text mt-3"><?php echo rwmb_meta('display_name_title')?></p>
							<p class="text txt-normal txt-md">“<?php echo rwmb_meta('comment')?>”</p>
						</div>
					</div>
				</div>
				<?php
					endwhile;
				?>
			</div>
		</div>
		<!-- Rehister form section -->
		<div class="experts-register">
			<p class="title header txt-blue">Register to Attend</p>
			<p class="txt-normal text txt-lg w-70">Save your spot in the sessions you would love to attend</p>
			<div class="px-1 py-3 my-5 w-70">
				<?php
					echo do_shortcode( "[gravityform id='1' title='false' description='false' ajax='false']" );
				?>
			</div>
		</div>
	</div>
</main>
<?php echo get_footer();?>