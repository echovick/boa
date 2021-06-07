<?php
    // Variables Definition
    $post_id = '';

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
        $list = 'VjlKy7H9NKlDMhTYwU7636Gg';

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

    if(isset($_POST['ask-question'])){
        $topic = $_POST['topic'];
        $question = $_POST['question'];
        $email = $_POST['email'];

        // Create post for lesson attendance
        $post_id = wp_insert_post(array(
            'ID'=>$post_id,
            'post_type' => 'question',
            'post_title' => $email.': On '.$topic,
            'post_content' => '',
            'post_status' => 'publish',
        ));

        // save data
        update_post_meta($post_id,'topic',$topic);
        update_post_meta($post_id,'question',$question);
        update_post_meta($post_id,'email',$email);

        $url = site_url('ask-a-question?msg=question-submitted');
        wp_redirect($url);
        exit();
    }
?>