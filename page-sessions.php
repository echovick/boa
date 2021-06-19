<?php echo get_header()?>
    <main class="sessions">
        <?php
            while(have_posts()):the_post();
                $page_title = rwmb_meta('page_title');
                $page_snippet = rwmb_meta('page_snippet');  
            endwhile;
        ?>
        <div class="sessions-page">
            <div class="page-header-section">
                <p class="title header txt-bold txt-blue"><?php echo $page_title?></p>
                <p class="text txt-lg w-60 txt-normal"><?php echo $page_snippet?></p>
            </div>
            <div class="content">
                <!-- Tab links -->
                <div class="tab">
                    <button class="tablinks txt-green title txt-md" onclick="openCity(event, 'liveSession')">Live <span class="desktop">Session</span></button>
                    <button class="tablinks txt-green title txt-md" onclick="openCity(event, 'upcomingSessions')" id="defaultOpen">Upcoming <span class="desktop">Session</span></button>
                    <button class="tablinks txt-green title txt-md" onclick="openCity(event, 'concludedSessions')">Concluded <span class="desktop">Session</span></button>
                </div>

                <?php
                    $sessions = new WP_Query(array('post_type'=>'session','posts_per_page'=>'-1'));
                ?>

                <!-- Tab content -->
                <div id="liveSession" class="tabcontent">
                    <?php
                        while($sessions->have_posts()):$sessions->the_post();
                            $session_title = rwmb_meta('session_title');
                            $short_snippet = rwmb_meta('short_snippet');
                            $session_image = get_metabox_image_url('session_image');
                            $session_url = rwmb_meta('session_url');
                            $session_url = $session_url['youtube_url'];
                            $status = rwmb_meta('status');
            
                            // Get facilitator
                            $add_facilitator_group = rwmb_meta('add_facilitator_group');
                        endwhile;
            
                        if($status == 1){
                    ?>
                    <div class="row w-100">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-12 mb-4">
                            <div class="img" style="background:url('<?php echo $session_image;?>');">
                                <span class="badge-live txt-white bg-red text-center txt-md">Live</span>
                            </div>
                            <div class="row w-100 px-4 mt-3">
                                <p class="title txt-dark txt-dark txt-md"><a href="<?php echo $session_url?>"><?php echo $session_title?></a></p>
                                <p class="text txt-normal txt-md"><?php echo $short_snippet?></p>
                            </div>
                        </div>
                    </div>
                    <?php
                        }
                    ?>
                </div>
    
                <div id="upcomingSessions" class="tabcontent">
                    <div class="row w-100">
                        <?php
                            while($sessions->have_posts()):$sessions->the_post();
                                $select_date = rwmb_meta('select_date');
                                $session_title = rwmb_meta('session_title');
                                $session_image = get_metabox_image_url('session_image');
                                $session_image_thumbnail = get_metabox_image_url('session_image_thumbnail');
                                $short_snippet = rwmb_meta('short_snippet');
                                $date = date_create($select_date);
                                $today = date('Y-m-d');
                                


                                if($select_date >= $today){
                        ?>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-4">
                                <div class="img" style="background:url('<?php echo $session_image_thumbnail;?>');">
                                    <span class="badge-date txt-white bg-blue text-center txt-sm"><span class="txt-lg"><?php echo date_format($date,"d")?></span><br><?php echo date_format($date,"M")?></span>
                                </div>
                                <div class="row w-100 px-4 mt-3">
                                    <p class="title txt-dark txt-dark txt-md"><a href="<?php echo get_permalink()?>"><?php echo $session_title?></a></p>
                                    <p class="text txt-normal txt-md"><?php echo $short_snippet?></p>
                                </div>
                            </div>
                        <?php
                                }
                            endwhile;
                        ?>
                    </div>
                </div>

                <div id="concludedSessions" class="tabcontent">
                    <div class="row">
                        <?php
                            while($sessions->have_posts()):$sessions->the_post();
                                $select_date = rwmb_meta('select_date');
                                $session_title = rwmb_meta('session_title');
                                $session_image = get_metabox_image_url('session_image');
                                $short_snippet = rwmb_meta('short_snippet');
                                $date=date_create($select_date);
                                $today = date('Y-m-d');


                                if($select_date <= $today){
                        ?>
                            <div class="col-lg-4 col-md-4 col-sm-12 col-12 mb-4">
                                <div class="img" style="background:url('<?php echo $session_image;?>');">
                                    <span class="badge-date txt-white bg-blue text-center txt-sm"><span class="txt-lg"><?php echo date_format($date,"d")?></span><br><?php echo date_format($date,"M")?></span>
                                </div>
                                <div class="row w-100 px-4 mt-3">
                                    <p class="title txt-dark txt-dark txt-md"><a href="<?php echo get_permalink()?>"><?php echo $session_title?></a></p>
                                    <p class="text txt-normal txt-md"><?php echo $short_snippet?></p>
                                </div>
                            </div>
                        <?php
                                }
                            endwhile;
                        ?>
                    </div>
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
<?php echo get_footer()?>