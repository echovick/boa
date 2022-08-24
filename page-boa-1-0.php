<?php echo get_header()?>
    <main class="w-100">
		<?php
			while(have_posts()):the_post();
				$page_title = rwmb_meta('page_title');
				$page_snippet = rwmb_meta('page_snippet');

				// Session
				$sessions_section = rwmb_meta('sessions_section');
				$facilitators_section = rwmb_meta('facilitators_section');
				$testimonial_section = rwmb_meta('testimonial_section');

				$session_period = rwmb_meta('session_period');
			endwhile;
		?>
	
		<div class="top-section" style="background: url(<?php echo get_theme_file_uri('assets/imgs/bg.png')?>) !important; width:100%; opacity: 0.7;">
			<p class="title txt-xlg txt-blue w-70"><?php echo $page_title?></p>
			<p class="text txt-md txt-xlg w-50" style="color: white !important;"><?php echo $page_snippet?></p>
		</div>

		<!-- Sessions -->
		<div class="agenda-section bg-green py-5">
            <div class="w-100 dotted-border-bottom py-3">
                <p class="title txt-white w-70"><?php echo $sessions_section['session_section_title'] ?? ''?></p>
                <p class="text txt-lg txt-thin txt-white w-70"><?php echo $sessions_section['session_section_snippet'] ?? ''?></p>
            </div>

			<div class="row w-100">
				<?php
					$add_session = $sessions_section['add_session'] ?? '';
					if(is_array($add_session) && count($add_session) > 0){
						foreach($add_session as $session){
							$the_session = get_post($session);
							if(isset($the_session->select_period) && in_array(get_the_ID(), $the_session->select_period)){?>
							<div class="col-lg-4 col-md-4 col-sm-12 col-12 mt-3 pr-5 pl-3">
								<img src="<?php echo wp_get_attachment_url($the_session->session_image) ?? ''?>" alt="" style="width:100%; heigh:310px;" class="mb-2">
								<a href="<?php echo get_permalink($session)?>"><p class="text txt-md txt-white"><?php echo $the_session->session_title ?? ''?></p></a>
								<p class="text txt-thin txt-md txt-white"><?php echo $the_session->short_snippet ?? ''?></p>
							</div> 
							<?php
							}
						}
					}
				?>
			</div>

			<div class="row pl-3 mt-5 w-100 justify-content-center mb-4">
                <a href="<?php echo site_url('sessions')?>" class="txt-blue txt-sm my-3 bg-white txt-bold button py-3">View More</a>
            </div>
        </div>

		<!-- Facilitators -->
		<div class="row mt-5 agenda-section">
			<div class="page-header-section mb-3">
				<p class="title header txt-bold txt-blue"><?php echo $facilitators_section['facilitators_section_title'] ?? ''?></p>
				<p class="text txt-lg w-60 txt-normal">
					<?php echo $facilitators_section['facilitators_section_snippet'] ?? ''?>
				</p>
			</div>
		
			<?php
				$add_facilitators = $facilitators_section['add_facilitators'] ?? '';
				if(is_array($add_facilitators)){
					foreach($add_facilitators as $facilitator){
						$the_facilitator = get_post($facilitator);
						if(isset($the_facilitator->select_period) && in_array(get_the_ID(), $the_facilitator->select_period)){?>
						<div class="col-lg-4 col-md-4 col-6 mb-3">
							<a data-toggle="modal" data-target="#myModal<?php echo $facilitator;?>">
								<p class="txt-green text txt-lg txt-bold text-center"><?php echo $the_facilitator->person_name?></p>
								<img src="<?php echo wp_get_attachment_url($the_facilitator->image)?>" alt="" class="w-90">
								<p class="text-center txt-dark txt-normal txt-md text mt-3">
									<?php echo $the_facilitator->title?> (<?php echo $the_facilitator->company?>)
								</p>
							</a>
						</div>
						<?php
						}
					}
				}
			?>
        </div>

		<!-- Testimonials -->
		<div class="row mt-5 testimonial-section bg-blue pt-3">
			<div class="page-header-section mb-3">
				<p class="title header txt-bold txt-white"><?php echo $testimonial_section['testimonial_section_title'] ?? ''?></p>
				<p class="text txt-lg w-60 txt-normal">
					<?php echo $testimonial_section['testimonial_section_snippet'] ?? ''?>
				</p>
			</div>
		
			<div class="row w-100 mb-5">
				<?php
					$add_testimonials = $testimonial_section['add_testimonials'] ?? '';
					if(is_array($add_testimonials)){
						foreach($add_testimonials as $testimonial){
							$the_testimonial = get_post($testimonial)?>
							<div class="col-4">
								<div class="mt-4 row w-100">
									<div>
										<img src="<?php echo wp_get_attachment_url($the_testimonial->display_picture) ?? ''?>" alt="" style="width:80%; height:auto;">
									</div>
									<div class="testimonial-content shadow">
										<p class="txt-blue txt-sm text mt-3"><?php echo $the_testimonial->display_name_title?></p>
										<p class="text txt-normal txt-md">“<?php echo $the_testimonial->comment?>”</p>
									</div>
								</div>
							</div>
						<?php
						}
					}
				?>
			</div>

			<div class="row pl-3 mt-5 w-100 justify-content-center mb-4">
                <a href="<?php echo site_url('testimonials')?>" class="txt-blue txt-sm my-3 bg-white txt-bold button py-3">Listen to more...</a>
            </div>
        </div>
	</main>
	<!-- Experts Modal -->
<?php
    $experts = new WP_Query(array(
        'post_type'=>'people',
        'posts_per_page'=>'-1',
        'meta_query'=>array(
            array(
                'key'=>'status_checkbox',
                'value'=>'Expert',
                'compare'=>'='
            )
        )
    ));
    while($experts->have_posts()):$experts->the_post();
        $person_name = rwmb_meta('person_name');
        $image = get_metabox_image_url('image');
        $title = rwmb_meta('title');
        $company = rwmb_meta('company');
		$session_period = rwmb_meta('session_period');
		$select_period = rwmb_meta('select_period');
        $person_description = rwmb_meta('person_description');
        if(!empty(rwmb_meta('linkedin_url'))){
            $linkedin_url = rwmb_meta('linkedin_url');
        }else{
            $linkedin_url = '#';
        }
?>
        <div class="modal fade" id="myModal<?php echo get_the_id();?>" role="dialog">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-body">
                        <div class="row">
                            <img src="<?php echo $image?>" class="speaker-img mx-auto" alt="">
                        </div>
                        <p class="text-center txt-text mx-auto txt-sm mt-2"><?php echo $person_name.', '.$title.' ('.$company.')'?></p>
                        <p class="text-center txt-text mx-auto txt-md mt-2"><?php echo $person_description?></p>
                        <div class="row">
                            <a href="<?php echo $linkedin_url?>" target="_blank" class="mx-auto text-center"><i class="fab fa-linkedin txt-xlg txt-blue"></i></a>
                        </div>
                    </div>
                    <div class="modal-footer justify-content-center">
                        <a class="txt-white txt-sm my-3 bg-blue txt-bold button mx-auto" data-dismiss="modal">Close</a>
                    </div>
                </div>
            </div>
        </div>
<?php
    endwhile;
?>
<?php echo get_footer()?>
