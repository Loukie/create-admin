<?php
// ADD NEW ADMIN USER TO WORDPRESS
// ----------------------------------
// Put this file in your WordPress root directory and run it from your browser.
// Delete it when you're done.

require_once('wp-load.php'); // This loads the WordPress environment
require_once('wp-includes/pluggable.php'); // Necessary for user-related functions

// ----------------------------------------------------
// CONFIG VARIABLES
// Make sure that you set these before running the file.
$newusername = 'your_new_username';
$newpassword = 'your_new_password';
$newemail = 'your_new_email@example.com';

// ----------------------------------------------------
// Check if the config variables have been changed from their default values.
if ($newusername === 'your_new_username' || 
    $newpassword === 'your_new_password' || 
    $newemail === 'your_new_email@example.com') {
    die('Please change the default values for $newusername, $newpassword, and $newemail.');
}

// Check that user doesn't already exist
if (username_exists($newusername) || email_exists($newemail)) {
    die('This username or email already exists. No changes were made.');
}

// Create the new user and set the role to administrator
$user_id = wp_create_user($newusername, $newpassword, $newemail);
if (is_wp_error($user_id)) {
    die('Error creating user: ' . $user_id->get_error_message());
}

$wp_user_object = new WP_User($user_id);
$wp_user_object->set_role('administrator');

echo 'Successfully created new admin user. Now delete this file!';
?>
