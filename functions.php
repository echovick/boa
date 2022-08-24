<?php
    function theme_files(){
        /* Activate js scripts */
        wp_enqueue_script('ajax-js','https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js',NULL,'1.0',true);
        wp_enqueue_script('popper-js','https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js',NULL,'1.0',true);
        wp_enqueue_script('bootstrap-js','https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js',NULL,'1,0',true);
        wp_enqueue_script('font-awesome-kit','https://kit.fontawesome.com/dcf3d07c5a.js',NULL,'1.0',true);
        wp_enqueue_script('custom-js',get_theme_file_uri('/assets/js/script.js'),'NULL','1.0',true);

        /* Activate Stylesheets */
        wp_enqueue_style('theme_main_styles', get_stylesheet_uri());
        wp_enqueue_style('bootstrap-css','https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css');
        wp_enqueue_style('responsive-css', get_template_directory_uri().'/assets/css/responsive.css');
    }

    /* Hook to load scripts */
    add_action('wp_enqueue_scripts','theme_files');

    /* Hook to remove admin bar */
    add_action('after_setup_theme', 'remove_admin_bar');
 
    /* Function to remove admin bar for users */
    function remove_admin_bar() {
        if (!current_user_can('administrator') && !is_admin()) {
        show_admin_bar(false);
        }
    }

    function theme_features(){
        add_theme_support('title-tag');
    }

    /* 
        ======================================================================
        METABOX SPECIFIC FUNCTIONS BEGIN
        ======================================================================
    */

    /* Function to get the direct url for a metabox image */
    function get_metabox_image_url($key){
        /* Reset */
        $image = 0;
        $images = rwmb_meta( $key, array( 'limit' => 1 ) );
        $image = reset( $images );
        
        return $image['full_url'];
    }

    /* Function to get the alt caption for a metabox image */
    function get_metabox_image_alt($key){
        /* Reset */
        $image = 0;
        $images = rwmb_meta( $key, array( 'limit' => 1 ) );
        $image = reset( $images );
        
        return $image['alt'];
    }

    /* Function to get the direct url of an image in a metabox image gallery */
    function get_metabox_image_gallery_url($key){
        /* Reset */
        $image = 0;
        $images = rwmb_meta( $key, array( 'size' => 'thumbnail' ) );
        $image = reset( $images );
        
        return $image['full_url'];
    }

    /* Function to get metabox gallery images, it returns an array */
    function get_metabox_image_gallery($key){
        $image = 0;
        $images = rwmb_meta( $key, array( 'size' => 'thumbnail' ) );
        return $images;
    }

    /* Function to get the caption of a particular image from a metabox image gallery*/
    function get_metabox_image_gallery_caption($key){
        /* Reset */
        $image = 0;
        $images = rwmb_meta( $key, array( 'limit' => '1' ) );
        $image = reset( $images );
        
        return $image['caption'];
    }

    /* Function to get the url of an image from a metabox group */
    function get_metabox_group_image_url( $array, $key ){
        /* Reset */
        $image = 0;
        $image_ids = isset( $array[$key] ) ? $array[$key] : array();

        foreach ( $image_ids as $image_id ) {
            $image = RWMB_Image_Field::file_info( $image_id, array( 'size' => 'thumbnail' ) );
        }
        
        return $image['full_url'] ?? '';
    }

    /* Function to get a file url from a metabox group */
    function get_metabox_group_file_url($array, $key){
        $files = 0;
        if(isset($array[$key])){
            $files_id = $array[$key];
        }
        //  = isset($array[$key] ) ? $array[$key] : array();
        $files = rwmb_meta( $files_id, array( 'limit' => 1 ) );
        $file = reset( $files );

        return $file['url'];
    }

    /* Function to get image alt caption from a metabox group */
    function get_metabox_group_image_alt( $array, $key ){
        /* Reset */
        $image = 0;
        $image_ids = isset( $array[$key] ) ? $array[$key] : array();

        foreach ( $image_ids as $image_id ) {
            $image = RWMB_Image_Field::file_info( $image_id, array( 'size' => 'thumbnail' ) );
        }
        
        return $image['alt'];
    }

    /* 
        =======================================================================
        METABOX SPECIFIC FUNCTIONS ENDS
        =======================================================================
    */

    include(get_template_directory().'/includes/process.php');

    /* 
    * Sendey Mail Bos functions
    */
    
    // update user in list
    function update_user_to_list($n, $e, $l, $p){
        $your_installation_url = 'https://maylbox.com'; //Your Sendy installation (without the trailing slash)
        $api_key = 'pOVgVSzG0zm1ILB5nIeI'; //Can be retrieved from your Sendy's main settings

        $name = $n;
        $email = $e;
        $list = $l;
        $plan = $p;

        //Check fields
        if($name=='' || $email=='' || $list=='')
        {
            echo 'Please fill in all fields';
            exit;
        }

        //Subscribe
        $postdata = http_build_query(
            array(
            'name' => $name,
            'email' => $email,
            'plan' => $plan,
            'list' => $list,
            'api_key' => $api_key,
            'boolean' => 'true'
            )
        );
        
        $opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
        $context  = stream_context_create($opts);
        $result = file_get_contents($your_installation_url.'/subscribe', false, $context);
        
        //check result and redirect
        if($result){
            return $result;
        }
    }

    // Add user to product list
    function add_user_to_list($n, $e, $l){
        $your_installation_url = 'https://maylbox.com'; //Your Sendy installation (without the trailing slash)
        $api_key = 'pOVgVSzG0zm1ILB5nIeI'; //Can be retrieved from your Sendy's main settings

        $name = $n;
        $email = $e;
        $list = $l;

        //Check fields
        if($name=='' || $email=='' || $list=='')
        {
            echo 'Please fill in all fields';
            exit;
        }

        //Subscribe
        $postdata = http_build_query(
            array(
            'name' => $name,
            'email' => $email,
            'list' => $list,
            'api_key' => $api_key,
            'boolean' => 'true'
            )
        );
        
        $opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
        $context  = stream_context_create($opts);
        $result = file_get_contents($your_installation_url.'/subscribe', false, $context);
        
        //check result and redirect
        if($result){
            return $result;
        }
    }

    // Remove user from list
    function remove_user_from_list_one($e,$l){
        $your_installation_url = 'https://maylbox.com'; //Your Sendy installation (without the trailing slash)
        $api_key = 'pOVgVSzG0zm1ILB5nIeI'; //Can be retrieved from your Sendy's main settings

        $email = $e;
        $list = $l;

        //Check fields
        if($email=='' || $list=='')
        {
            echo 'Please fill in all fields..';
            exit;
        }

        //Unsubscribe
        $postdata = http_build_query(
            array(
            'email' => $email,
            'list' => $list,
            'api_key' => $api_key,
            'boolean' => 'true'
            )
        );
        $opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
        $context  = stream_context_create($opts);
        $result = file_get_contents($your_installation_url.'/unsubscribe', false, $context);
        
        //check result and redirect
        if($result){
            return $result;
        }
    }

    // Delete user from list
    function delete_user_from_list($e,$l){
        $your_installation_url = 'https://maylbox.com'; //Your Sendy installation (without the trailing slash)
        $api_key = 'pOVgVSzG0zm1ILB5nIeI'; //Can be retrieved from your Sendy's main settings

        $email = $e;
        $list = $l;

        //Check fields
        if($email=='' || $list=='')
        {
            echo 'Please fill in all fields...';
            exit;
        }

        //delete
        $postdata = http_build_query(
            array(
            'email' => $email,
            'list' => $list,
            'api_key' => $api_key,
            'boolean' => 'true'
            )
        );
        $opts = array('http' => array('method'  => 'POST', 'header'  => 'Content-type: application/x-www-form-urlencoded', 'content' => $postdata));
        $context  = stream_context_create($opts);
        $result = file_get_contents($your_installation_url.'/api/subscribers/delete.php', false, $context);
        
        //check result and redirect
        if($result){
            return $result;
        }
    }
?>