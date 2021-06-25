<?php echo get_header()?>
    <main class="experts" style="margin-bottom:-1.2% !important;">
        <?php
            if(isset($_GET['msg'])){
                if($_GET['msg'] == 'success'){
        ?>
            <div class="expert-comments-top text-center alert alert-info">
                <p class="title txt-dark txt-xlg mt-4">Thank You!!</p>
                <p class="text txt-normal txt-lg w-100">Your registration is confirmed.</p>
                <p class="title txt-md w-20 mx-auto pt-3 mt-5" style="border-top:1px solid grey;">What Next?</p>
                <p class="text txt-normal txt-sm mt-3 w-100">Follow us across our social media handles to stay up to date on announcements and updates.</p>
                <div class="d-flex justify-content-center">
                    <a href="https://www.facebook.com/psagnigeria" target="_blank"><i class="fab fa-facebook-square txt-xlg txt-blue mx-3"></i></a>
                    <a href="https://www.instagram.com/psag_nigeria" target="_blank"><i class="fab fa-instagram-square txt-xlg txt-blue mx-3"></i></a>
                    <a href="https://twitter.com/PsagNigeria" target="_blank"><i class="fab fa-twitter-square txt-xlg txt-blue mx-3"></i></a>
                    <a href="https://www.linkedin.com/company/psagnigeria/about/"><i class="fab fa-linkedin txt-xlg txt-blue mx-3"></i></a>
                </div>
                <div class="row pl-3 mt-5 py-1">
                    <a href="<?php echo wp_get_referer()?>" class="txt-white txt-sm my-3 mx-auto bg-blue txt-bold button"><i class="fas fa-arrow-left mr-3"></i>Return</a>
                </div>
            </div>
        <?php
                }elseif($_GET['msg'] == 'info-exists'){
        ?>
                <div class="expert-comments-top text-center alert alert-danger">
                    <p class="title txt-dark txt-xlg">Oops, Sorry</p>
                    <p class="text txt-normal txt-lg w-100">It seems you have already registered with these information</p>
                    <div class="row pl-3">
                        <a href="<?php echo wp_get_referer()?>" class="txt-white txt-sm my-3 mx-auto bg-blue txt-bold button"><i class="fas fa-arrow-left mr-3"></i>Return</a>
                    </div>
                </div>
        <?php
                }
            }elseif($_GET['msg'] == 'question-submitted'){
        ?>
            <div class="expert-comments-top text-center alert alert-info">
                <p class="title txt-dark txt-xlg">Thank You!!</p>
                <p class="text txt-normal txt-lg w-100">Your request has been submitted successfully</p>
                <div class="row pl-3">
                    <a href="<?php echo wp_get_referer()?>" class="txt-white txt-sm my-3 mx-auto bg-blue txt-bold button"><i class="fas fa-arrow-left mr-3"></i>Return</a>
                </div>
            </div>
        <?php
            }else{
        ?>
            <div class="expert-comments-top text-center alert alert-info">
                <p class="title txt-dark txt-xlg">Thank You!!</p>
                <p class="text txt-normal txt-lg w-100">Your request has been submitted successfully</p>
                <div class="row pl-3">
                    <a href="<?php echo wp_get_referer()?>" class="txt-white txt-sm my-3 mx-auto bg-blue txt-bold button"><i class="fas fa-arrow-left mr-3"></i>Return</a>
                </div>
            </div>
        <?php
            }
        ?>
    </main>
<?php get_footer();?>