<?php
    require('../wp-blog-header.php');
    $response = [];

    if($_REQUEST['call'] == 'login'){
        if($_REQUEST['username'] == '' || $_REQUEST['password'] == ''){
            $response['error'] = 'Empty login credentials';
        }else {
            $creds = array();
            $creds['user_login'] = $_REQUEST['username'];
            $creds['user_password'] = $_REQUEST['password'];

            if($_REQUEST['remember'] == 1){
                $creds['remember'] = true;
            }

            $user = wp_signon($creds, false);
            if (is_wp_error($user)) {
                echo  $response['error'] = $user->get_error_message();
            } else {
                $user_id = $user->data->ID;
                wp_set_current_user($user_id, $creds['user_login']);
                wp_set_auth_cookie($user_id);
                echo json_encode(['success' => 'logged in']);


//                wp_redirect(get_admin_url()); exit;
            }
        }
    }elseif($_REQUEST['call'] == 'logout'){
        wp_logout();
        $response['success'] = 'Logged out';
    }

?>