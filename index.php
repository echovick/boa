<?php echo get_header()?>
    <main class="w-100">
        <?php
            while(have_posts()):the_post();
                $page_title = rwmb_meta('page_title');
                $page_snippet = rwmb_meta('page_snippet');

                $show_live_session = rwmb_meta('show_live_session');
                $select_live_session = rwmb_meta('select_live_session');
                $add_feature = rwmb_meta('add_feature');
                $session_card_group = rwmb_meta('session_card_group');
                $expert_card_group = rwmb_meta('expert_card_group');
                $pitch_card_group= rwmb_meta('pitch_card_group');
                
                // Agenda Section
                $agenda_section_topic = rwmb_meta('agenda_section_topic');
                $agenda_snippet = rwmb_meta('agenda_snippet');
                $add_section_group = rwmb_meta('add_section_group');

                $influencer_section_topic = rwmb_meta('influencer_section_topic');
                $influencer_snippet = rwmb_meta('influencer_snippet');
                $add_influencer = rwmb_meta('add_influencer');

                // Partners Section
                $partners_section_topic = rwmb_meta('partners_section_topic');
                $partners_snippet = rwmb_meta('partners_snippet');
                $partners_section_button_url = rwmb_meta('partners_section_button_url');
                $add_partner_group = rwmb_meta('add_partner_group');

                // FAQ Section
                $add_faq = rwmb_meta('add_faq');
            endwhile;
        ?>
        <div class="top-section">
            <p class="title txt-xlg txt-blue"><?php echo $page_title?></p>
            <p class="text txt-md txt-xlg txt-normal"><?php echo $page_snippet?></p>
            <div class="row pl-3">
                <a href="#registerform" class="txt-white txt-sm my-3 bg-blue txt-bold button">Register to attend</a>
            </div>
        </div>
        <!-- Live session section -->
        <?php
            $the_session = get_post($select_live_session);
            $session_title = $the_session->session_title;
            $short_snippet = $the_session->short_snippet;
            $session_image = wp_get_attachment_url($the_session->session_image_thumbnail);
            $session_url = $the_session->session_url;
            $session_url = $session_url['youtube_url'] ?? '' ?? '';
            // Get facilitator
            $add_facilitator_group = $the_session->add_facilitator_group;
            if($show_live_session == "Yes"){
        ?>
        <div class="live-session">
            <div class="green-box w-90">
                <div class="row w-100">
                    <div class="col-lg-4 col-md-4 col-12">
                        <div class="img" style="background: url('<?php echo $session_image?>');">
                            <span class="badge bg-red txt-white title txt-md">Live</span>
                        </div>
                    </div>
                    <div class="col-lg-8 col-md-8 col-12">
                        <p class="txt-dark title txt-bold"><span class="txt-red">Live Now</span> <br>
                            <?php echo $session_title?></p>
                        <p class="text txt-normal"><?php echo $short_snippet?></p>
                        <p class="text"><span class="txt-bold">Featuring:</span>
                        <?php
                            foreach($add_facilitator_group as $facilitator){
                                $the_facilitator = get_post($facilitator['select_facilitator'] ?? '');
                                echo $the_facilitator->person_name.', ';
                            }
                        ?></p>
                        <div class="row pl-3 mt-5">
                            <a href="<?php echo $session_url?>" class="txt-white txt-sm my-3 bg-red title txt-bold button">Watch</a>
                        </div>
                    </div>
                </div>
                <!-- <div class="next-session">
                    <p class="title txt-lg"><span class="txt-red title txt-md">Next Session</span><br>
                        How can I make money from Animal Husbandry?</p>
                </div> -->
            </div>
        </div>
        <?php
            }
        ?>
        <!-- Statistics Section -->
		<?php
			if(is_array($add_feature) && count($add_feature) > 0){?>
			<div class="stats-section my-4">
				<div class="row w-90">
					<?php
						foreach($add_feature as $feature){
							$title = $feature['title'] ?? '';
							$content = $feature['content'] ?? '';
					?>
						<div class="col-md-4 col-lg-4 col-sm-12 col-6 mb-4 pr-4">
							<i class="fas fa-star txt-lg"></i>
							<p class="txt-green txt-xlg title"><?php echo $title?></p>
							<p class="txt-normal txt-sm text"><?php echo $content?></p>
						</div>
					<?php
						}
					?>
				</div>
			</div>
			<?php
			}
		?>
        <img src="<?php echo get_theme_file_uri('assets/imgs/green-line.png')?>" class="w-100" alt="">
        <!-- Picture info section -->
        <div class="picture-info-section">
            <!-- Sesson card -->
            <?php
                $session_card_image = $session_card_group['session_card_image'] ?? '';
                $session_card_image = get_metabox_group_image_url($session_card_group,'session_card_image');
            ?>
            <div class="info-box float-left">
                <div style="background: url(<?php echo $session_card_image?>);" class="img-bg">
                    <div class="bg-green w-70 px-4 top-box">
                        <p class="txt-white title txt-lg mb-4"><?php echo $session_card_group['session_card_topic'] ?? ''?></p>
                        <p class="text txt-normal txt-sm txt-white"><?php echo $session_card_group['session_card_content'] ?? ''?></p>
                    </div>
                    <a href="<?php echo site_url('sessions')?>" class="round-button">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php
                $expert_card_image = $expert_card_group['expert_card_image'] ?? '';
                $expert_card_image = get_metabox_group_image_url($expert_card_group,'expert_card_image');
            ?>
            <div class="info-box float-right">
                <div style="background: url(<?php echo $expert_card_image?>);" class="img-bg">
                    <div class="bg-green w-70 px-4 top-box">
                        <p class="txt-white title txt-lg mb-4"><?php echo $expert_card_group['expert_card_topic'] ?? '' ?? ''?></p>
                        <p class="text txt-normal txt-sm txt-white"><?php echo $expert_card_group['expert_card_content'] ?? ''?></p>
                    </div>
                    <a href="<?php echo site_url('experts')?>" class="round-button">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <?php
                $pitch_card_image = $pitch_card_group['pitch_card_image'] ?? '';
                $pitch_card_image = get_metabox_group_image_url($pitch_card_group,'pitch_card_image');
            ?>
            <div class="info-box float-left">
                <div style="background: url(<?php echo $pitch_card_image?>);" class="img-bg">
                    <div class="bg-green w-70 px-4 top-box">
                        <p class="txt-white title txt-lg mb-4"><?php echo $pitch_card_group['pitch_card_topic'] ?? ''?></p>
                        <p class="text txt-normal txt-sm txt-white"><?php echo $pitch_card_group['pitch_card_content'] ?? ''?></p>
                    </div>
                    <a href="<?php echo site_url('pitch')?>" class="round-button">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div>
            <!-- <div class="info-box float-right">
                <div style="background: url(<?php echo get_theme_file_uri('assets/imgs/grass-img.png')?>);" class="img-bg">
                    <div class="bg-green w-70 px-4 top-box">
                        <p class="txt-white title txt-lg mb-4">Sessions</p>
                        <p class="text txt-normal txt-sm txt-white">Our team of learning experts have designed a suite of practical programs that develop both your execution excellence capabilities and enable you to stay a step ahead.</p>
                    </div>
                    <a href="" class="round-button">
                        <i class="fas fa-arrow-right"></i>
                    </a>
                </div>
            </div> -->
        </div>
        <img src="<?php echo get_theme_file_uri('assets/imgs/green-line.png')?>" class="w-100 mt-4" alt="">
        <!-- Agenda Section -->
        <div class="agenda-section bg-green py-5">
            <div class="w-100 dotted-border-bottom py-3">
                <p class="title txt-white w-70"><?php echo $agenda_section_topic;?></p>
                <p class="text txt-lg txt-thin txt-white w-70"><?php echo $agenda_snippet;?></p>
            </div>

            <?php
                $id = 0;
                foreach($add_section_group as $section){
            ?>
                <div class="accordion title txt-md py-5 txt-white"><?php echo $section['section_title'] ?? ''?></div>
                <div class="panel dotted-border-bottom">
                    <div class="row w-100">
                        <?php
                            $add_session = $section['add_session'] ?? '';
                            foreach($add_session as $session){
                                $id++;
                                $date_time = $session['date_time'] ?? '';
                                $select_Session = $session['select_Session'] ?? '';
                                $the_Session = get_post($select_Session);
                                $add_facilitator_group = $the_Session->add_facilitator_group;
                                $google_calendar_link = $the_Session->google_calendar_link;
                                $ics_file = $the_Session->ics_file;

                                $date=date_create($date_time);
                        ?>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12 pl-0 pr-5">
                                <div class="date-circle bg-blue px-0 mb-3">
                                    <p class="txt-white text txt-sm"><span class="txt-md"><?php echo date_format($date,"d")?></span><br><?php echo date_format($date,"M")?></p>
                                </div>
                                <p class="txt-white">
                                    <i class="fas fa-clock txt-sm txt-white"></i> <?php echo $the_Session->time?>
                                </p>
                                <p class="title txt-md txt-white"><?php echo $the_Session->session_title?></p>
                                <p class="text txt-thin txt-md txt-white"><?php echo $the_Session->short_snippet?></p>
                                <p class="txt-white txt-thin txt-sm">
                                    <span class="txt-bold txt-sm">FEATURING:</span><br>
                                    <u>
                                        <?php
                                            foreach($add_facilitator_group as $facilitator){
                                                $the_facilitator = get_post($facilitator['select_facilitator'] ?? '');
                                                echo $the_facilitator->person_name.', ';
                                            }
                                        ?>
                                    </u>
                                </p>
                                <p class="txt-white txt-sm" data-toggle="collapse" href="#demo<?php echo $id;?>"><i class="fas fa-clock mr-1"></i><u>Remind Me</u></p>
                                <div id="demo<?php echo $id;?>" class="collapse mb-3" style="padding:0px !important;">
                                    <a target="_blank" href="<?php echo $google_calendar_link?>" class="text txt-sm txt-dark"><u>Google Calendar Link</u></a>
                                    <a href="<?php echo $ics_file?>" target="_blank" class="text txt-sm txt-dark"><u>Download ICS File</u></a>
                                </div>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            <?php
                }
            ?>

            <div class="row w-100 mt-4">
                <a href="#registerform" class="txt-white txt-sm my-3 ml-3 bg-blue txt-bold button">Register to attend</a>
            </div>
        </div>
        <!-- Expert reviews section -->
        <div class="expert-reviews-section">
            <p class="title header txt-white txt-xlg"><?php echo $influencer_section_topic?></p>
            <p class="text txt-white w-80 txt-lg txt-thin"><?php echo $influencer_snippet?></p>
            <div class="reviews desktop">
                <?php
                    $count = 0;
                    foreach($add_influencer as $influencer){
                        $count++;
                        $the_influencer = get_post($influencer);

                        $person_name = $the_influencer->person_name;
                        $image = wp_get_attachment_url($the_influencer->image);
                        $title = $the_influencer->title;
                        $company = $the_influencer->company;

                        $influencer_comment_group = $the_influencer->influencer_comment_group;
                        if($count%2 == 1){
                ?>
                    <div class="expert-cards mt-4 row w-100">
                        <div>
                            <img src="<?php echo $image?>" alt="">
                        </div>
                        <div class="expert-review-right">
                            <p class="txt-blue txt-sm title"><?php echo $person_name.', '.$title.', '.$company?></p>
                            <p class="text txt-thin txt-sm"><?php echo $influencer_comment_group['speaking_on'] ?? '';?></p>
                            <p class="text txt-normal txt-md">“<?php echo $influencer_comment_group['comment'] ?? '';?>”</p>
                        </div>
                    </div>
                <?php
                        }else{
                ?>
                    <div class="expert-cards mt-4 row w-100" style="padding-left:40% !important;">
                        <div class="expert-review-left" style="margin-left:-14% !important;">
                            <p class="txt-blue txt-sm title"><?php echo $person_name.', '.$title.', '.$company?></p>
                            <p class="text txt-thin txt-sm"><?php echo $influencer_comment_group['speaking_on'] ?? '';?></p>
                            <p class="text txt-normal txt-md">“<?php echo $influencer_comment_group['comment'] ?? '';?>”</p>
                        </div>
                        <div class="review-pic-right">
                            <img src="<?php echo $image?>" alt="">
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="reviews mobile">
                <?php
                    $count = 0;
                    foreach($add_influencer as $influencer){
                        $count++;
                        $the_influencer = get_post($influencer);

                        $person_name = $the_influencer->person_name;
                        $image = wp_get_attachment_url($the_influencer->image);
                        $title = $the_influencer->title;
                        $company = $the_influencer->company;

                        $influencer_comment_group = $the_influencer->influencer_comment_group;
                        if($count%2 == 1){
                ?>
                <div class="row mb-3 w-100">
                    <img src="<?php echo $image?>" alt="" class="w-100">
                    <div class="expert-review">
                        <p class="txt-blue txt-sm title"><?php echo $person_name.', '.$title.', '.$company?></p>
                        <p class="text txt-thin txt-sm"><?php echo $influencer_comment_group['speaking_on'] ?? '';?></p>
                        <p class="text txt-normal txt-md">“<?php echo $influencer_comment_group['comment'] ?? '';?>”</p>
                    </div>
                </div>
                <?php
                    }else{
                ?>
                    <div class="row mb-3 w-100">
                        <img src="<?php echo $image?>" alt="" class="w-100">
                        <div class="expert-review">
                            <p class="txt-blue txt-sm title"><?php echo $person_name.', '.$title.', '.$company?></p>
                            <p class="text txt-thin txt-sm"><?php echo $influencer_comment_group['speaking_on'] ?? '';?></p>
                            <p class="text txt-normal txt-md">“<?php echo $influencer_comment_group['comment'] ?? '';?>”</p>
                        </div>
                    </div>
                <?php
                        }
                    }
                ?>
            </div>
            <div class="row pl-3 mt-5">
                <a href="<?php echo site_url('influencers')?>" class="txt-white txt-sm my-3 bg-blue txt-bold button">Listen to more...</a>
            </div>
        </div>
        <!-- Partners section -->
        <div class="partners-section">
            <p class="title header txt-green"><?php echo $partners_section_topic?></p>
            <p class="text txt-normal text-dark w-80 txt-lg"><?php echo $partners_snippet?></p>
            <div class="row mt-5 w-100">
                <?php
                    foreach($add_partner_group as $partner){
                        $partner_logo = $partner['partner_logo'] ?? '';
                        $partner_logo = get_metabox_group_image_url($partner,'partner_logo');
                ?>
                    <div class="col-lg-2 col-md-2 col-6 mb-4">
                        <a href="<?php echo $partner['partner_url'] ?? ''?>">
                        <div class="partner-logo-box row w-100">
                            <img src="<?php echo $partner_logo;?>" alt="" class="mx-auto w-70">
                        </div>
                        </a>
                    </div>
                <?php
                    }
                ?>
            </div>
            <div class="row pl-3 mt-5 w-100">
                <a href="<?php echo $partners_section_button_url?>" class="txt-white txt-sm my-3 bg-blue txt-bold button">Learn about PSAG Nigeria</a>
            </div>
        </div>
        <!-- Faq section -->
        <div class="faq-section">
            <p class="title header txt-white mb-5">Frequently Asked Questions</p>

            <?php
                foreach($add_faq as $faq){
            ?>
                <button class="accordion text txt-bold txt-sm txt-dark"><?php echo $faq['add_question'] ?? ''?></button>
                <div class="panel txt-thin text txt-sm">
                    <p class="txt-thin text txt-sm pl-2"><?php echo $faq['add_answer'] ?? ''?></p>
                </div>
            <?php
                }
            ?>
        </div>
        <!-- Rehister form section -->
        <div class="register-form-section" id="registerform">
            <p class="title header txt-blue">Register to Attend</p>
            <p class="txt-normal text txt-lg w-70">Save your spot in the sessions you would love to attend</p>
            <div class="px-1 py-3 my-5 w-70">
                <?php
                    echo do_shortcode( "[gravityform id='1' title='false' description='false' ajax='false']" );
                ?>
            </div>
        </div>
    </main>
<?php echo get_footer()?>
