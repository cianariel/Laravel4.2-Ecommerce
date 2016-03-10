<?php
require('../wp-blog-header.php');
if($_REQUEST['call'] == 'login'){
    if($_REQUEST['username'] == '' || $_REQUEST['password'] == ''){
        echo 'Empty login credentials';
    }else {
        $creds = array();
        $creds['user_login'] = $_REQUEST['username'];
        $creds['user_password'] = $_REQUEST['password'];
        $creds['remember'] = true;
        $user = wp_signon($creds, false);
        if (is_wp_error($user)) {
            echo $user->get_error_message();
        } else {
            $user_id = $user->data->ID;
            wp_set_current_user($user_id, $creds['user_login']);
            wp_set_auth_cookie($user_id);
            echo 'logged in!';
        }
    }
}elseif($_REQUEST['call'] == 'logout'){
    wp_logout();
    echo 'logged out!';
}

?>