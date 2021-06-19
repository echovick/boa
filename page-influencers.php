<?php echo get_header()?>
    <main class="experts">
        <?php
            while(have_posts()):the_post();
                $page_title = rwmb_meta('page_title');
                $page_snippet = rwmb_meta('page_snippet');  
            endwhile;
        ?>
        <div class="expert-comments-top">
            <p class="txt-blue txt-md title">Why Agriculture?</p>
            <p class="title txt-dark txt-xlg"><?php echo $page_title?></p>
            <p class="text txt-normal txt-lg w-60"><?php echo $page_snippet?></p>
            <div class="row pl-3 mb-3">
                <a href="#registerform" class="txt-white txt-sm my-3 bg-blue txt-bold button">Register to attend</a>
            </div>
        </div>

        <!-- Comments section -->
        <div class="comments-section">
            <?php
                $influencers = new WP_Query(array(
                    'post_type'=>'people',
                    'posts_per_page'=>'-1',
                    'meta_query'=>array(
                        array(
                            'key'=>'status_checkbox',
                            'value'=>'Influencer',
                            'compare'=>'='
                        )
                    )
                ));
                $count = 0;
                while($influencers->have_posts()):$influencers->the_post();
                    $person_name = rwmb_meta('person_name');
                    $image = get_metabox_image_url('image');
                    $title = rwmb_meta('title');
                    $company = rwmb_meta('company');
                    $influencer_comment_group = rwmb_meta('influencer_comment_group');

                    if($count == 0 || $count%2 == 0){
                        echo '<div class="row w-100 dotted-border-bottom-dark dotted-border-top-dark">';
                    }
            ?>
                        <div class="col-lg-6 col-md-6 inner">
                            <div class="d-flex justify-content-between">
                                <p class="txt-md text txt-dark txt-normal"><span class="txt-green title txt-md">John Doe</span> <br> General Manager <br>BATN Foundation</p>
                                <img src="<?php echo get_theme_file_uri('assets/imgs/user1.png')?>" alt="" class="expert-img">
                            </div>
                            <p class="text txt-bold txt-grey my-5">“Our team of learning experts have designed a suite of practical programs that develop both your execution excellence capabilities and enable you to stay a step ahead.”</p>
                            <img src="<?php echo get_theme_file_uri('assets/imgs/grass-img.png"')?> alt="" class="w-100 main-img">
                            <p class="text txt-sm txt-normal mt-3"><u>click to enlarge</u></p>
                        </div>
            <?php
                    $count++;
                    if($count%2 == 0){
                        echo '</div>';
                    }
                endwhile;
                if($count%2 !== 0){
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
<?php echo get_footer()?>