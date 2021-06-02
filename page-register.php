<?php echo get_header()?>
    <main class="experts">
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
<?php get_footer();?>