<?php

/**
 * Requires the "PHP Email Form" library
 * The "PHP Email Form" library is available only in the pro version of the template
 * The library should be uploaded to: vendor/php-email-form/php-email-form.php
 * For more info and help: https://bootstrapmade.com/php-email-form/
 */

// Replace contact@example.com with your real receiving email address
$receiving_email_address = 'contact@example.com';

$php_email_form = __DIR__ . '/../assets/vendor/php-email-form/php-email-form.php';
if (file_exists($php_email_form)) {
  require_once($php_email_form);
  if (!class_exists('PHP_Email_Form')) {
    die('The class "PHP_Email_Form" was not found in ' . $php_email_form . '. Please check the library file.');
  }
} else {
  die('Unable to load the "PHP Email Form" Library! Please make sure the file exists at ' . $php_email_form);
}

// If the class still does not exist, define a stub to prevent errors (for development only)
if (!class_exists('PHP_Email_Form')) {
  class PHP_Email_Form
  {
    public $ajax = false;
    public $to;
    public $from_name;
    public $from_email;
    public $subject;
    public $smtp;
    public function add_message($value, $label, $min_length = 0) {}
    public function send()
    {
      return 'PHP_Email_Form class not found. Please upload the required library.';
    }
  }
}

$contact = new PHP_Email_Form;
$contact->ajax = true;

$contact->to = $receiving_email_address;
$contact->from_name = $_POST['name'];
$contact->from_email = $_POST['email'];
$contact->subject = $_POST['subject'];

// Uncomment below code if you want to use SMTP to send emails. You need to enter your correct SMTP credentials
/*
  $contact->smtp = array(
    'host' => 'example.com',
    'username' => 'example',
    'password' => 'pass',
    'port' => '587'
  );
  */

$contact->add_message($_POST['name'], 'From');
$contact->add_message($_POST['email'], 'Email');
$contact->add_message($_POST['message'], 'Message', 10);

echo $contact->send();
