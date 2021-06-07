<?php echo get_header()?>
    <main class="sessions">
        <?php
            while(have_posts()):the_post();
                $page_title = rwmb_meta('page_title');
                $page_snippet = rwmb_meta('page_snippet');
                $add_section = rwmb_meta('add_section');
            endwhile;
        ?>
        <div class="top-section">
            <p class="title txt-xlg txt-blue"><?php echo $page_title?></p>
            <p class="text txt-md txt-xlg txt-normal"><?php echo $page_snippet?></p>
        </div>
        <!-- Agenda Section -->
        <div class="agendas">
            <?php
                $id = 0;
                foreach($add_section as $section){
                    $date = $section['date'];
                    $topic = $section['topic'];
                    $add_session = $section['add_session'];

                    $date=date_create($date);
            ?>
                <div class="accordion title txt-md py-5 txt-green"><span class="badge-date txt-white bg-blue text-center txt-sm"><span class="txt-lg"><?php echo date_format($date,"d")?></span><br><?php echo strtoupper(date_format($date,"M"))?></span><?php echo $topic?></div>
                <div class="panel dotted-border-bottom">
                    <?php
                        foreach($add_session as $session){
                            $id++;
                            $the_session = get_post($session);
                            $session_title = $the_session->session_title;
                            $short_snippet = $the_session->short_snippet;
                            $session_image = $the_session->session_image;
                            $session_image_thumbnail = $the_session->session_image_thumbnail;
                            $session_image_thumbnail =  wp_get_attachment_url($session_image_thumbnail);
                            $session_image = wp_get_attachment_url($session_image);
                            $session_url = $the_session->session_url;
                            $facilitators = $the_session->add_facilitator_group;
                            $session_url = $session_url['youtube_url'] ?? '';
                            $time = $the_session->time;
                            $google_calendar_link = $the_session->google_calendar_link;
                            $ics_file = $the_session->ics_file;
                            $ics_file = wp_get_attachment_url($ics_file);
                    ?>
                        <div class="row w-100 item px-5 py-4 dotted-border-bottom-dark mt-4">
                            <div class="col-md-3 col-lg-3 col-4">
                                <img src="<?php echo $session_image_thumbnail?>" alt="" class="w-100">
                            </div>
                            <div class="col-lg-9 col-md-9 col-8">
                                <p class="text txt-md txt-green">
                                    <i class="fas fa-clock mr-2"></i>
                                    <?php echo $time;?>
                                    <span class="txt-blue ml-3" data-toggle="collapse" href="#demo<?php echo $id;?>"><u>Remind Me</u></span>
                                    <div id="demo<?php echo $id;?>" class="collapse mb-3" style="padding:0px !important;">
                                        <a href="<?php echo $google_calendar_link?>" target="_blank" class="text txt-sm txt-dark"><u>Google Calendar Link</u></a>
                                        <a href="<?php echo $ics_file?>" target="_blank" class="text txt-sm txt-dark" download><u>Download ICS File</u></a>
                                    </div>
                                </p>
                                <p class="title txt-md txt-dark"><a href="<?php echo get_permalink($session)?>"><?php echo $session_title?></a></p>
                                <p class="text txt-md txt-normal txt-dark"><?php echo $short_snippet?></p>
                                <p class="txt-dark txt-thin txt-sm">
                                    <span class="txt-bold txt-sm">FEATURING:</span> <u>
                                        <?php
                                            foreach($facilitators as $facilitator){
                                                $the_facilitator = get_post($facilitator['select_facilitator']);
                                                echo $the_facilitator->person_name.', ';
                                            }
                                        ?>
                                    </u>
                                </p>
                            </div>
                        </div>
                    <?php
                        }
                    ?>
                </div>
            <?php
                }
            ?>
        </div>
        <!-- Rehister form section -->
        <div class="register-form-section">
            <p class="title header txt-blue">Register to Attend</p>
            <p class="txt-normal text txt-lg w-70">Gain access to session links and informative newsletters in a few easy steps. </p>
            <form action="" class="px-1 py-3 my-5 w-70">
                <?php
                    echo do_shortcode( "[gravityform id='1' title='false' description='false' ajax='false']" );
                ?>
            </form>
        </div>
    </main>
<?php echo get_footer()?>