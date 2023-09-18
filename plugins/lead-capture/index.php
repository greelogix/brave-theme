<?php

// add a custom table called leads
function add_leads_table()
{
    global $wpdb;
    $table_name = $wpdb->prefix . 'leads';

    $charset_collate = $wpdb->get_charset_collate();
    $sql = "CREATE TABLE $table_name (
        id mediumint(9) NOT NULL AUTO_INCREMENT,
        first_name varchar(255) NOT NULL,
        last_name varchar(255) NOT NULL,
        email varchar(255) NOT NULL,
        phone varchar(255) NOT NULL,
        trial_type varchar(255) NOT NULL,
        incentive varchar(255) NOT NULL,
        activity longtext NOT NULL DEFAULT '[]',
        created_at datetime DEFAULT CURRENT_TIMESTAMP,
        updated_at datetime DEFAULT CURRENT_TIMESTAMP,
        PRIMARY KEY  (id)
    ) $charset_collate;";
    require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
    dbDelta($sql);
}

// run after theme  installation
add_action('after_switch_theme', 'add_leads_table');


// add a menu item and page called leads
add_action('admin_menu', 'leads_menu');
function leads_menu()
{
    add_menu_page('Leads', 'Leads', 'manage_options', 'leads', 'leads_page', 'dashicons-email-alt', 6);
}

function leads_page()
{
    require_once('admin-template.php');
}

add_action('wp_ajax_lead_capture', 'process_lead_capture');

// Capture data submitted by the lead capture form
function process_lead_capture()
{
    if (empty($_POST) || !wp_verify_nonce($_POST['security-code-here'], 'lead_capture')) {
        echo 'You targeted the right function, but sorry, your nonce did not verify.';
        die();
    }

    // get the data from the form
    $first_name = sanitize_text_field($_POST['first_name']);
    $last_name = sanitize_text_field($_POST['last_name']);
    $email = sanitize_email($_POST['email']);
    $phone = sanitize_text_field($_POST['phone']);
    $incentive = sanitize_text_field($_POST['incentive']);
    $trial_type = sanitize_text_field($_POST['trial_type']);

    // insert the data into the wp_leads table
    global $wpdb;

    $table_name = $wpdb->prefix . 'leads';

    // Check if a lead with the same email already exists
    $lead = $wpdb->get_row("SELECT * FROM $table_name WHERE email = '$email'");

    if ($lead) {
        // update the lead's activity
        $activity = json_decode($lead->activity);
        $activity[] = [
            'type' => $first_name . ' ' . $last_name . ' requested a ' . $incentive . ($trial_type ? ' of the ' . $trial_type . ' program.' : ''),
            'date' => current_time('mysql'),
        ];
        $updated_activity = json_encode($activity);
        // update the lead's created_at timestamp and reacitvate the lead
        $wpdb->update(
            $table_name,
            [
                'updated_at' => current_time('mysql'),
                // updated activity is an array of objects
                'activity' => $updated_activity,
            ],
            [
                'id' => $lead->id,
            ],
        );
    } else {
        $lead = $wpdb->insert(
            $table_name,
            array(
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'phone' => $phone,
                'incentive' => $incentive,
                'trial_type' => $trial_type ? $trial_type : '',
            )
        );
    }

    // send an email to the gym owner
    $to = get_option('admin_email');
    $subject = 'New Lead';
    $body = "First Name: $first_name\nLast Name: $last_name\nEmail: $email\nPhone: $phone\nIncentive: $incentive\nTrial Type: $trial_type";
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);

    // send an email to the lead
    $to = $email;
    $subject = 'Thank you for your interest';
    $body = 'Thank you for your interest in our gym. We will be in touch soon.';
    $headers = array('Content-Type: text/html; charset=UTF-8');
    wp_mail($to, $subject, $body, $headers);

    // return a success message
    echo 'success';
    die();
}
