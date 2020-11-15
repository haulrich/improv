<?php
if ( class_exists( 'Yoast_Notification_Center' ) ) {
    remove_action( 'admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );
    remove_action( 'all_admin_notices', array( Yoast_Notification_Center::get(), 'display_notifications' ) );
}