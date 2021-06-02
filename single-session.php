<?php echo get_header()?>
    <?php
        while(have_posts()):the_post();
    ?>
    <main class="sessions">
        <div class="sessions-page">
            <p class="txt-blue txt-md title">Session</p>
            <p class="title txt-dark txt-xlg"><?php echo rwmb_meta('session_title')?></p>
            <p class="text txt-normal txt-lg w-60"><?php echo rwmb_meta('short_snippet')?></p>
            <div class="row pl-3">
                <a href="#registerform" class="txt-white txt-sm my-3 bg-blue txt-bold button">Register to attend</a>
            </div>
        </div>
        <div class="view-session">
            <p class="txt-green title txt-lg">View Session</p>
            <?php
                $session_url = rwmb_meta('session_url');
                $youtube_url = $session_url['youtube_url'];
                if(rwmb_meta('status') == 1){
            ?>
                <iframe style="width:90%;" height="500" src="<?php echo $youtube_url?>" frameborder="1" allow="accelerometer; autoplay; clipboard-write; gyroscope; picture-in-picture" allowfullscreen></iframe>
            <?php
                }else{
            ?>
                <div class="video-frame w-100">
                    <img src="<?php echo get_metabox_image_url('session_image')?>" alt="" class="">
                </div>
            <?php
                }
            ?>
        </div>
        <div class="items-covered">
            <?php
                $add_session_content_group = rwmb_meta('add_session_content_group');
                foreach($add_session_content_group as $session_content){
                    $title = $session_content['title'] ?? '';
                    $content = $session_content['content'] ?? '';
                    $key_points = $session_content['key_points'] ?? '';
                    if(!empty($title)){
                        echo '<p class="txt-green title txt-lg">'.$title.'</p>';
                    }
                    if(!empty($content)){
                        echo '<p class="text txt-md w-80 txt-dark">'.$content.'</p><br>';
                    }
                    if(!empty($key_points)){
                        echo '<ul>';
                            foreach($key_points as $points){
                                echo '<li class="text txt-md mb-2">'.$points['add_key_point'].'</li>';
                            }
                        echo '</ul><br>';
                    }
                }
            ?>
            
            <!-- Schedule section -->
            <?php
                $select_date = rwmb_meta('select_date');
                $time = rwmb_meta('time');
                $location = rwmb_meta('location');

                $date = date_create($select_date);
            ?>
            <p class="txt-green title txt-lg">Schedule</p>
            <p class="txt-dark text txt-md txt-bold"><i class="fas fa-clock mr-2"></i><?php echo date_format($date,"D").', '.date_format($date,"d").' '.date_format($date,"M").', '.date_format($date,"Y");?></p>
            <p class="txt-dark text txt-md txt-bold"><i class="fas fa-clock mr-2"></i><?php echo $time?>hrs, GMT + 1</p>
            <p class="txt-dark text txt-md txt-bold"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $location?></p>
        </div>
        <div class="featured-speakers">
            <p class="txt-white title header">Featured Speakers</p>
            <p class="text txt-lg w-80 txt-normal txt-dark txt-white">Our team of learning experts have designed a suite of practical programs that develop both your execution excellence capabilities and enable you to stay a step ahead.</p>
            <div class="row mt-5 pt-4">
                <?php
                    $add_facilitator_group = rwmb_meta('add_facilitator_group');
                    foreach($add_facilitator_group as $facilitator){
                        $the_facilitator = get_post($facilitator['select_facilitator']);
                        $image = $the_facilitator->image;
                        $image = wp_get_attachment_url($image);
                        $select_role = $facilitator['select_role'];
                ?>
                    <div class="col-lg-3 col-md-3 col-6 text-center mb-3">
                        <img src="<?php echo $image?>" alt="" class="speaker-img">
                        <p class="txt-dark title mt-3 txt-lg"><?php echo $the_facilitator->person_name?><br> <span class="text txt-md txt-normal"><?php echo $the_facilitator->title.', '.$the_facilitator->company;?></span></p>
                        <!-- <br> -->
                        <span class="badge-<?php echo strtolower($select_role)?> title txt-sm"><?php echo $select_role?></span>
                    </div>
                <?php
                    }
                ?>
            </div>
        </div>
        <!-- Rehister form section -->
        <div class="register-form-section" id="registerform">
            <p class="title header txt-blue">Register to Attend</p>
            <p class="txt-normal text txt-lg w-70">Gain access to session links and informative newsletters in a few easy steps. </p>
            <form action="" class="px-1 py-3 my-5 w-70">
                <?php
                    echo do_shortcode( "[gravityform id='1' title='false' description='false' ajax='false']" );
                ?>
            </form>
        </div>
    </main>
    <?php
        endwhile;
    ?>
<?php echo get_footer()?>