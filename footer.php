        <footer>
            <div class="row w-100">
                <div class="col-lg-5 col-md-5 col-12 partners-logo">
                    <div class="row">
                        <div class="d-flex justify-content-center">
                            <img src="<?php echo get_theme_file_uri('assets/imgs/logos/BoA Logo 1.png')?>" alt="" class="mx-4">
                            <img src="<?php echo get_theme_file_uri('assets/imgs/logos/PSAG-Logo only 1.png')?>" alt="" class="mx-4">
                            <img src="<?php echo get_theme_file_uri('assets/imgs/logos/image 17.png')?>" alt="" class="mx-4">
                        </div>
                    </div>
                    <p class="text txt-normal txt-dark text-left mt-5">Our team of learning experts have designed a suite of practical programs that develop both your execution excellence capabilities and enable you to stay a step ahead.</p>
                </div>
                <div class="col-lg-4 col-md-4 col-12 footer-quick-links">
                    <p class="txt-blue text txt-md txt-normal txt-bold mb-4">Quick Links</p>
                    <ul>
                        <?php
                            $top_links = get_terms( array(
                                'taxonomy' => 'footer-quick-link',
                                'hide_empty' => false
                            ) );
                            if(!empty($top_links)){
                                foreach($top_links as $links){
                                    $label = get_term_meta($links->term_id,'link_text',true);
                                    $url = get_term_meta($links->term_id,'_link_url',true);
                        ?>
                                <li><a href="<?php echo $url?>"><?php echo $label?></a></li>
                        <?php
                                }
                            }
                        ?>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-12 sc-links">
                    <div class="d-flex">
                        <i class="fab fa-facebook-square txt-xlg txt-blue mr-5"></i>
                        <i class="fab fa-instagram-square txt-xlg txt-blue mr-5"></i>
                        <i class="fab fa-twitter-square txt-xlg txt-blue mr-5"></i>
                        <i class="fab fa-linkedin txt-xlg txt-blue mr-5"></i>
                    </div>
                </div>
            </div>
        </footer>
        <script>
            var acc = document.getElementsByClassName("accordion");
            var i;

            for (i = 0; i < acc.length; i++) {
            acc[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var panel = this.nextElementSibling;
                if (panel.style.maxHeight) {
                panel.style.maxHeight = null;
                } else {
                panel.style.maxHeight = panel.scrollHeight + "px";
                }
            });
            }

            function openCity(evt, cityName) {
            // Declare all variables
            var i, tabcontent, tablinks;

            // Get all elements with class="tabcontent" and hide them
            tabcontent = document.getElementsByClassName("tabcontent");
            for (i = 0; i < tabcontent.length; i++) {
                tabcontent[i].style.display = "none";
            }

            // Get all elements with class="tablinks" and remove the class "active"
            tablinks = document.getElementsByClassName("tablinks");
            for (i = 0; i < tablinks.length; i++) {
                tablinks[i].className = tablinks[i].className.replace(" active", "");
            }

            // Show the current tab, and add an "active" class to the button that opened the tab
            document.getElementById(cityName).style.display = "block";
            evt.currentTarget.className += " active";
            }
            // Get the element with id="defaultOpen" and click on it
            document.getElementById("defaultOpen").click();
        </script>
        <script src=""></script>
        <?php wp_footer();?>
    </body>
</html>
