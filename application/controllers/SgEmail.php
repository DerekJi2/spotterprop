
<?php 

if (! defined('BASEPATH')) {
    exit('No direct script access allowed');
}

// using SendGrid's PHP Library
// https://github.com/sendgrid/sendgrid-php

// If you are using Composer (recommended)
require 'vendor/autoload.php';

class SgEmail extends CI_Controller
{
    protected $apiKey = "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";
    protected $fromEmailAddress = "mouris.brick.service@gmail.com";
    protected $emailSubject = "You've got a new message from Syrian Property";

    public function __construct()
    {
        parent::__construct();
/*
        $this->load->database();
        $this->load->helper('url');

        $this->load->library('grocery_CRUD');
        */
    }



    private function demo()
    {
        // If you are not using Composer
        // require("path/to/sendgrid-php/sendgrid-php.php");
        $from = new SendGrid\Email("Syrian Property", $this->emailAddress);

        $subject = "Sending with SendGrid is Fun";
        $to = new SendGrid\Email("Mouris To", $this->emailAddress);
        $content = new SendGrid\Content("text/plain", "and easy to do anywhere, even with PHP");
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
        
        $sg = new \SendGrid($this->apiKey);
        $response = $sg->client->mail()->send()->post($mail);
        echo $response->statusCode();
        print_r($response->headers());
        echo $response->body();
    }

    public function send()
    {
        $email_html = $this->buildEmailContent($this->input);

        $debug = $this->input->get("debug");

        $statusCode = $this->sendmail($email_html, $debug);

        echo $statusCode;
    }

    private function buildEmailContent($input)
    {
        $content = $input->get("yoursay");
        $email_html = "\r\n" . $content . "\r\n";

        $plsRespond = $input->get("plsRespond");
        if ($plsRespond != null && $plsRespond != "")
        {
            $name = $input->get("name");
            $phone =$input->get("phone");
            $email =$input->get("email");

            $email_html .= "\r\n";
            $email_html .= "\r\n" . "Please reply me:" . "\r\n";
            $email_html .= "\r\n" . "Name: $name" . "\r\n";
            $email_html .= "\r\n" . "Phone: $phone" . "\r\n";
            $email_html .= "\r\n" . "Email: $email" . "\r\n";
        }

        return $email_html;
    }

    private function sendmail($content, $debug)
    {
        // If you are not using Composer
        // require("path/to/sendgrid-php/sendgrid-php.php");
        $from = new SendGrid\Email("Syrian Property", $this->fromEmailAddress);

        $subject = $this->emailSubject;
        
        $toEmailAddress = $this->getContactEmail();
        if ($debug == "true")
        {
            $toEmailAddress = $this->fromEmailAddress;
        }

        $to = new SendGrid\Email("Mouris To", $toEmailAddress);
        $content = new SendGrid\Content("text/plain", $content);
        $mail = new SendGrid\Mail($from, $subject, $to, $content);
        
        $sg = new \SendGrid($this->apiKey);
        $response = $sg->client->mail()->send()->post($mail);
        return $response->statusCode();
    }

    private function getContactEmail()
    {
        $this->load->helper("MY_Contact_helper");
        $contact = get_contact("en");
        $email = $contact->Email;

        return $email;
    }
}