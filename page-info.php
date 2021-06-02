<?php echo get_header()?>
    <main class="experts">
        <?php
            if(isset($_GET['msg'])){
                if($_GET['msg'] == 'success'){
        ?>
            <div class="expert-comments-top text-center alert alert-info">
                <p class="title txt-dark txt-xlg">Thank You!!</p>
                <p class="text txt-normal txt-lg w-100">Your request has been submitted successfully</p>
                <div class="row pl-3">
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