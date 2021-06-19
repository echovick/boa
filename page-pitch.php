<?php echo get_header()?>
    <main class="experts">
        <?php 
            while(have_posts()):the_post();
                $page_title = rwmb_meta('page_title');
                $page_snippet = rwmb_meta('page_snippet');

                $winners_group = rwmb_meta('winners_group');
                $add_section_group = rwmb_meta('add_section_group');
            endwhile;
        ?>
        <div class="expert-comments-top">
            <p class="title txt-dark txt-xlg"><?php echo $page_title?></p>
            <p class="text txt-normal txt-lg w-60"><?php echo $page_snippet?></p>
            <div class="row pl-3">
                <a href="#registerform" class="txt-white txt-sm my-3 bg-blue txt-bold button">Register to attend</a>
            </div>
        </div>
        <!-- Agenda Section -->
        <div class="agendas">
            <?php
                $show_section = $winners_group['show_section'] ?? '';
                $add_winner = $winners_group['add_winner'] ?? '';
                if($show_section){
            ?>
                <div class="accordion title txt-md py-5 txt-green">Our Winners</div>
                <div class="panel dotted-border-bottom">
                    <div class="row w-100">
                        <?php
                            foreach($add_winner as $winner){
                                $business_name = $winner['business_name'];
                                $founders_name = $winner['founders_name'];
                                $image = get_metabox_group_image_url($winner,'image');
                                $prize = $winner['prize'];
                                $social_media_url = $winner['social_media_url'];
                        ?>
                            <div class="col-md-4 col-lg-4 mb-3">
                                <img src="<?php echo $image?>" alt="" class="winners-img mb-2">
                                <p class="title txt-bold txt-dark txt-md"><?php echo $business_name?></p>
                                <p class="text txt-normal txt-md"><?php echo $founders_name?></p>
                                <p class="text txt-md txt-normal"><span class="txt-bold">Won</span><br><?php echo $prize;?></p>
                            </div>
                        <?php
                            }
                        ?>
                    </div>
                </div>
            <?php
                }
            ?>
            
            <?php
                foreach($add_section_group as $section){
                    $title = $section['title'] ?? '';
                    $content = $section['content'] ?? '';
                    $key_points_group = $section['key_points_group'] ?? '';

                    if($title){
                        echo '<div class="accordion title txt-md py-5 txt-green">About the Pitch</div>';
                    }
                    echo '<div class="panel dotted-border-bottom">';
                    if($content){
                        echo '
                            <p class="text txt-md w-80">Our team of learning experts have designed a suite of practical programs that develop both your execution excellence capabilities and enable you to stay a step ahead. Get real-life industry secrets spoon-fed to you by Konrad Sanders, with over 10 years of experience in the copywriting business. He grew yearly revenue from $0 to a whopping $1.4 mill - and now works with the likes of Tik Tok, Adidas, Thomson Reuters, and Hyundai.</p>
                            <p class="text txt-md w-80">Get real-life industry secrets spoon-fed to you by Konrad Sanders, with over 10 years of experience in the copywriting business. He grew yearly revenue from $0 to a whopping $1.4 mill - and now works with the likes of Tik Tok, Adidas, Thomson Reuters, and Hyundai.</p>
                        ';           
                    }
                    if($key_points_group){
                        echo '<ul>';
                            foreach($key_points_group as $key_points){
                                echo '<li class="text txt-md mb-2">Free Workshop</li>';
                            }
                        echo '</ul>';
                    }
                    echo '</div>';
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
<?php get_footer();?>