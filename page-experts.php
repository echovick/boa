<?php echo get_header()?>
<main class="experts">
    <?php
            while(have_posts()):the_post();
                $page_title = rwmb_meta('page_title');
                $page_snippet = rwmb_meta('page_snippet');
            endwhile;   
        ?>
    <div class="experts-page">
        <div class="page-header-section">
            <p class="title header txt-bold txt-blue"><?php echo $page_title?></p>
            <p class="text txt-lg w-60 txt-normal"><?php echo $page_snippet?></p>
        </div>
        <div class="row mt-5">
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
                ?>
            <div class="col-lg-4 col-md-4 col-6 mb-4">
                <a href="" type="button" data-toggle="modal" data-target="#myModal<?php echo get_the_id();?>">
                    <p class="txt-green title txt-lg text-center"><?php echo $person_name?></p>
                    <img src="<?php echo $image?>" alt="" class="w-90">
                    <p class="text-center txt-dark txt-normal txt-md text mt-3">
                        <?php echo $title?><br><?php echo $company?>
                    </p>
                </a>
            </div>
            <?php
                    endwhile;
                ?>
        </div>
        <!-- Rehister form section -->
        <div class="experts-register">
            <p class="title header txt-blue">Register to Attend</p>
            <p class="txt-normal text txt-lg w-70">Gain access to session links and informative newsletters in a few
                easy steps. </p>
            <form action="" class="px-1 py-3 my-5 w-70">
                <?php
                        echo do_shortcode( "[gravityform id='1' title='false' description='false' ajax='false']" );
                    ?>
            </form>
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
                            <a href="<?php echo $linkedin_url?>" class="mx-auto text-center"><i class="fab fa-linkedin txt-xlg txt-blue"></i></a>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </div>
        </div>
<?php
    endwhile;
?>
<?php echo get_footer()?>