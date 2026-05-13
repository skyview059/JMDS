<?php

defined('BASEPATH') OR exit('No direct script access allowed');

class Mail extends MX_Controller {
    private $cc = false;
    private $bcc = false;
    private $subject = 'Someone try to send mail without subject';
    public $send_from = 'noreply@freelancerklub.com';
    public $from_name = 'Test';
    public $send_to = 'skyview059@gmail.com';
    public $body;
    private $ip;

    public function __construct() {
        parent::__construct();
        $this->ip = $this->input->ip_address();
        $this->send_from = getSettingItem('OutgoingEmail');
        $this->return_path = getSettingItem('IncomingEmail');
        $this->from_name = getSettingItem('ComName');
    }

    public function index() {
        echo 'Nothing is here';
    }

    private function useEmailTeamplate($slug = '') {
        $data = $this->db->get_where('email_templates', ['slug' => $slug])->row();
        return $data;
    }

    private function filterEmailBody($template = null, $placeholders = []) {
        if ($template && count($placeholders)) {
            foreach ($placeholders as $key => $value) {
                $template = str_replace('%' . $key . '%', $value, $template);
            }
        }
        return $template;
    }

    private function log() {
        $log_path = APPPATH . '/logs/mail_log.txt';
        $mail_log = date('Y-m-d H:i:s A') . ' | ' . $this->ip . ' | ' . $this->subject . "\r\n";
        file_put_contents($log_path, $mail_log, FILE_APPEND);
    }

    private function send() {
        // $send_to, $subject, $body, $cc = false, $bcc = false, $attach = null
        $mail = new PHPMailer;

        $mail->setFrom($this->send_from, $this->from_name);
        $mail->addAddress($this->send_to);
        $mail->addReplyTo($this->send_from, $this->from_name);

        $server = $_SERVER['SERVER_NAME'];

        $mail->HeaderLine('MIME-Version', '1.0');
        $mail->HeaderLine('X-Mailer', 'PHP/' . phpversion());
        $mail->HeaderLine('Return-Path', $this->return_path);
        $mail->HeaderLine('X-Mailer', "Microsoft Office Outlook, Build 11.0.5510");
        $mail->HeaderLine("X-MimeOLE", "Produced By Microsoft MimeOLE V6.00.2800.1441");
        $mail->HeaderLine('Content-Transfer-encoding', '8bit');
        $mail->HeaderLine('Organization', $server);
        $mail->HeaderLine('Message-ID', "<" . md5(uniqid(time())) . "@{$server}>");
        $mail->HeaderLine('X-MSmail-Priority', 'Normal');
        $mail->HeaderLine('X-Sender', $this->send_from);
        $mail->HeaderLine('X-AntiAbuse', "This is a solicited email for - $server mailing list.");
        $mail->HeaderLine('X-AntiAbuse', "Servername - {$server}");
        $mail->HeaderLine('X-AntiAbuse', $this->send_from);

        if($this->cc){ $mail->addCC($this->cc); }
        if($this->bcc){ $mail->addBCC($this->bcc); }

        $mail->isHTML(true);

        $mail->Subject  = $this->subject;
        $mail->Body     = $this->body;
        $mail->AltBody  = strip_tags($this->body);

        if ($mail->send()) {
            return ajaxRespond('OK', '<p class="ajax_success">Mail sent successfully</p>');
        } else {
            return ajaxRespond('Fail', '<p class="ajax_error">' . $mail->ErrorInfo . '</p>');
        }
    }

    public function send_pwd_mail($array = array()) {
        $email = $array['email'];
        $token = $array['_token'];

        $user               = $this->db->get_where('users', ['email' => $email])->row();
        $this->send_to      = $email;
        $this->from_name    = $user->first_name;

        $templateSender = $this->useEmailTeamplate('onRequestForgotPassword');
        $this->subject  = $templateSender->title;

        $this->body = $this->filterEmailBody($templateSender->template, [
            'url'       => base_url( "auth/reset_password?token={$token}&email={$email}" ),
            'fullname'  => $user->first_name
        ]);

        $this->log();
        return $this->send();
    }
        
    
    public function smsBalance( $html ) {
        $this->send_to = 'skyview059@gmail.com';
        $this->send_from = 'noreply@freelancerklub.com';
        
        $this->subject  = 'SMS Balance ';
        $this->body = "<p>----------------------</p>";
        $this->body .= "<h2>SMS Service Provider: BulkSMS BD</h2>";
        $this->body .= $html;
        $this->body .= "<p>----------------------</p>";
        $this->log();
        return $this->send();
    }
}
