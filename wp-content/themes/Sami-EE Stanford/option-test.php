<?php
/*
Template Name: Option Tests
*/
	$theme_options = get_option('sami-settings');
	$smtp_host = $theme_options['smtp_host'];
	$smtp_port = $theme_options['smtp_port'];
	$email_login = $theme_options['email_login'];
	$email_password = $theme_options['email_password'];
	
	echo "$smtp_host<br />";
	echo "$smtp_port<br />";
	echo "$email_login<br />";
	echo "$email_password<br />";