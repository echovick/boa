<?php
    if(isset($_GET['msg']) && $_GET['msg'] == 'question-submitted'){
        wp_head();
?>
    <div class="info-view w-100">
        <div class="info-content shadow mx-auto justify-content-center text-center">
            <i class="far fa-check-circle txt-white mx-auto text-center mb-3" style="font-size:80px;"></i>
            <p class="title txt-white txt-md text-center mx-auto">We have recieved your Question</p>
            <p class="text txt-dark txt-sm mb-5">We will do our best to see that we can attend to it during the session .</p>
            <a href="<?php echo site_url('ask-a-question')?>" class="button botton-ask-question txt-sm title txt-white">Ask another Question</a>
        </div>
    </div>
<?php
        wp_footer();
    }else{
?>
<?php echo get_header()?>
    <main class="sessions">
        <?php
            while(have_posts()):the_post();
                $page_title = "Ask a Question";
                $page_snippet = "What specific issues will you want the experts to address during any of the sessions? Tell us here and we will do our best to send it across to them.";  
            endwhile;
        ?>
        <div class="sessions-page">
            <div class="page-header-section">
                <p class="title header txt-bold txt-dark"><?php echo $page_title?></p>
                <p class="text txt-lg w-60 txt-normal"><?php echo $page_snippet?></p>
            </div>
            <div class="content mt-5 pt-4">
                <div class="row">
                    <?php
                        $sessions = new WP_Query(array('post_type'=>'session','posts_per_page'=>'-1'));
                        while($sessions->have_posts()):$sessions->the_post();
                            $select_date = rwmb_meta('select_date');
                            $session_title = rwmb_meta('session_title');
                            $session_image = get_metabox_image_url('session_image');
                            $session_image_thumbnail = get_metabox_image_url('session_image_thumbnail');
                            $short_snippet = rwmb_meta('short_snippet');
                            $date = date_create($select_date);
                            $today = date('Y-m-d');
                    ?>
                        <div class="col-md-4 col-lg-4 col-sm-6 col-6">
                            <div class="question-session-box w-95 mb-5">
                                <p class="title txt-white txt-md">Ask a question on <?php echo $session_title?></p>
                                <img src="<?php echo $session_image;?>" alt="" class="question-session-img">
                                <button class="button botton-ask-question txt-sm title txt-white p-2 mt-2" data-toggle="modal" data-target="#session<?php echo get_the_id();?>">Ask Your Question</button>
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
    <?php
        while($sessions->have_posts()):$sessions->the_post();
            $select_date = rwmb_meta('select_date');
            $session_title = rwmb_meta('session_title');
            $session_image = get_metabox_image_url('session_image');
            $session_image_thumbnail = get_metabox_image_url('session_image_thumbnail');
            $short_snippet = rwmb_meta('short_snippet');
            $date = date_create($select_date);
            $today = date('Y-m-d');
    ?>
    <div id="session<?php echo get_the_id()?>" class="modal bg-blue modal-ask-question fade" role="dialog">
        <div class="modal-dialog bg-blue">
            <!-- Modal content-->
            <div class="modal-content bg-blue shadow">
                <div class="modal-body bg-blue">
                    <p class="title txt-white txt-md w-70">Ask a question on <?php echo $session_title?></p>
                    <p class="text txt-dark txt-sm">Feel free to add as many questions you have about <?php echo $session_title;?></p>
                    <form action="" method="POST">
                        <input type="text" name="topic" value="<?php echo $session_title;?>" hidden>
                        <textarea name="question" class="w-100 ask-question-textarea text txt-dark txt-sm" id="" cols="30" rows="10" required>Your question</textarea>
                        <input type="text" name="email" id="" class="ask-question-input w-100 txt-dark txt-sm text" placeholder="Your Email Address" required>
                        <div class="d-flex justify-content-between">
                            <button type="submit" name="ask-question" class="mt-3 button botton-ask-question txt-sm title txt-white">Submit</button>
                            <button class="mt-3 button botton-ask-question txt-sm title txt-white" data-dismiss="modal">Cancel</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <?php
        endwhile;
    ?>
<?php echo get_footer()?>
<?php
    }
?>