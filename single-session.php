<?php echo get_header()?>
<?php
        while(have_posts()):the_post();
    ?>
<main class="sessions">
    <div class="sessions-page">
        <p class="txt-blue txt-md title">Session</p>
        <p class="title txt-dark txt-xlg"><?php echo rwmb_meta('session_title')?></p>
        <p class="text txt-normal txt-lg w-60"><?php echo rwmb_meta('short_snippet')?></p>
        <div class="d-flex desktop">
            <a href="#registerform" class="txt-white txt-sm my-3 bg-blue txt-bold button mr-3">Register to attend</a>
            <a href="#registerform" class="txt-white txt-sm my-3 bg-blue ask-question txt-bold button mr-3"
                data-toggle="modal" data-target="#questionform">Ask a Question</a>
            <?php
                    $brochure_url = rwmb_meta('upload_brochure');
                    foreach($brochure_url as $brochure){$url = $brochure['url'];}
                    if(!empty($url)){
                ?>
            <span class="txt-blue txt-sm pt-4"><a href="<?php echo $url;?>" target="_blank" download><u>Download Session
                        Brochure</u></a></span>
            <?php
                    }
                ?>
        </div>
        <div class="d-flex mobile">
            <a href="#registerform" class="txt-white txt-sm my-3 bg-blue txt-bold button mr-3">Register to attend</a>
            <a href="#registerform" class="txt-white txt-sm my-3 bg-blue ask-question txt-bold button mr-3"
                data-toggle="modal" data-target="#questionform">Ask a Question</a>
            <?php
                    $brochure_url = rwmb_meta('upload_brochure');
                    foreach($brochure_url as $brochure){$url = $brochure['url'];}
                    if(!empty($url)){
                ?>
            <div class="txt-blue txt-sm pt-3"><a href="<?php echo $url?>" target="_blank" download><u>Download Session
                        Brochure</u></a></div>
            <?php
                    }
                ?>
        </div>
        <div style="vertical-align:middle !important;" class="mt-2">
            <span class="txt-blue txt-sm" data-toggle="collapse" href="#demo"><u>Remind Me</u></span>
            <div id="demo" class="collapse mb-3" style="padding:0px !important;">
                <a target="_blank" href="<?php echo rwmb_meta('google_calendar_link')?>"
                    class="text txt-sm txt-dark"><u>Google Calendar Link</u></a>
                <?php
                        $brochure_url = rwmb_meta('ics_file');
                        foreach($brochure_url as $brochure){$url = $brochure['url'];}
                    ?>
                <a href="<?php echo $url;?>" target="_blank" class="text txt-sm txt-dark" download><u>Download ICS
                        File</u></a>
            </div>
        </div>
    </div>
    <div class="view-session">
        <p class="txt-green title txt-lg">View Session</p>
        <?php
                $session_url = rwmb_meta('session_url');
                $youtube_url = $session_url['youtube_url'];
                if(rwmb_meta('status') == 1){
            ?>
        <iframe style="width:90%;" height="500" src="<?php echo $youtube_url?>" frameborder="1"
            allow="accelerometer; autoplay; clipboard-write; gyroscope; picture-in-picture" allowfullscreen></iframe>
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
                    $schedule_group = $session_content['schedule_group'] ?? '';
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
                    if(!empty($schedule_group)){
                        foreach($schedule_group as $schedule){
                            echo '<button class="accordion text txt-bold txt-md txt-dark" style="color:black !important;">'.$schedule["schedule_title"].'</button>';
                            $schedule_content = $schedule['schedule_content'];
                    ?>
        <div class="panel">
            <?php
                                    echo '<ul>';
                                    foreach($schedule_content as $content){
                                        echo '<li class="text txt-md mb-2">'.$content.'</li>';   
                                    }
                                    echo '</ul><br>';
                                ?>
        </div>
        <?php
                        }
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
        <p class="txt-dark text txt-md txt-bold"><i
                class="fas fa-clock mr-2"></i><?php echo date_format($date,"D").', '.date_format($date,"d").' '.date_format($date,"M").', '.date_format($date,"Y");?>
        </p>
        <p class="txt-dark text txt-md txt-bold"><i class="fas fa-clock mr-2"></i><?php echo $time?>hrs, GMT + 1</p>
        <p class="txt-dark text txt-md txt-bold"><i class="fas fa-map-marker-alt mr-2"></i><?php echo $location?></p>
    </div>
    <div class="featured-speakers">
        <p class="txt-white title header">Featured Speakers</p>
        <p class="text txt-lg w-80 txt-normal txt-dark txt-white">Meet the experts who will be discussing the topic</p>
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
                <a data-toggle="modal" data-target="#myModal<?php echo $facilitator['select_facilitator'];?>">
                    <img src="<?php echo $image?>" alt="" class="speaker-img">
                </a>
                <p class="txt-dark title mt-3 txt-md facilitator-info"><?php echo $the_facilitator->person_name?></p>
                <p class="text txt-sm txt-normal"><?php echo $the_facilitator->title.', '.$the_facilitator->company;?>
                </p>
                <!-- <br> -->
                <span
                    class="badge-<?php if($select_role == 'Moderator'){ echo 'moderator';}else{ echo 'panelist';} ?> title txt-sm"><?php echo $select_role?></span>
            </div>
            <?php
                    }
                ?>
        </div>
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
<div id="questionform" class="modal bg-blue modal-ask-question fade" role="dialog">
    <div class="modal-dialog bg-blue">
        <!-- Modal content-->
        <div class="modal-content bg-blue shadow">
            <div class="modal-body bg-blue">
                <p class="title txt-white txt-md w-70">Ask a question on <?php echo rwmb_meta('session_title')?></p>
                <p class="text txt-dark txt-sm">Feel free to add as many questions you have about
                    <?php echo rwmb_meta('session_title')?></p>
                <form action="" method="POST">
                    <input type="text" name="topic" value="<?php echo rwmb_meta('session_title');?>" hidden>
                    <textarea name="question" class="w-100 ask-question-textarea text txt-dark txt-sm" id="" cols="30"
                        rows="10" required>Your question</textarea>
                    <input type="text" name="email" id="" class="ask-question-input w-100 txt-dark txt-sm text"
                        placeholder="Your Email Address" required>
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="ask-question"
                            class="mt-3 button botton-ask-question txt-sm title txt-white">Submit</button>
                        <button class="mt-3 button botton-ask-question txt-sm title txt-white"
                            data-dismiss="modal">Cancel</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php
        endwhile;
    ?>
<!-- Experts Modal -->
<?php
    $experts = new WP_Query(array(
        'post_type'=>'people',
        'posts_per_page'=>'-1',
    ));
    while($experts->have_posts()):$experts->the_post();
        $person_name = rwmb_meta('person_name');
        $image = get_metabox_image_url('image');
        $title = rwmb_meta('title');
        $company = rwmb_meta('company');
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
                <p class="text-center txt-text mx-auto txt-sm mt-2">
                    <?php echo $person_name.', '.$title.' ('.$company.')'?></p>
                <p class="text-center txt-text mx-auto txt-md mt-2"><?php echo $person_description?></p>
                <div class="row">
                    <a href="<?php echo $linkedin_url?>" target="_blank" class="mx-auto text-center"><i
                            class="fab fa-linkedin txt-xlg txt-blue"></i></a>
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