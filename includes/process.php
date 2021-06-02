<?php
    // Gravity forms on submit
    add_action( 'gform_after_submission_1', 'add_to_sendy_list', 10, 2 );
    function add_to_sendy_list( $entry, $form ) {
        $first_name = rgar($entry, '5.3');
        $last_name = rgar($entry, '5.6');
        $phone_number = rgar($entry, '2');
        $email_address = rgar($entry, '4');
        $country = rgar($entry, '3');
        $state = rgar($entry, '7'); 
        $full_name = $first_name.' '.$last_name;
        $list = 'bl6o1nLjzgw8928XvTq3763aKQ';

        $result = add_user_to_list($full_name,$email_address,$list);
        if($result == 1){
            // Load Subscription successfull modal
            $url = site_url('/info?msg=success');
            wp_redirect($url);
            exit();
        }else{
            $url = site_url('/info?msg=info-exists');
            wp_redirect($url);
            exit();
        }
    }
?>