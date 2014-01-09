<?php
class invitationEmail {
    public $templatePath = FALSE;
    
    public function __construct() {
        $this->templatePath = 'vendor.dbrisinajumi.person.views.emails';
    }

        public function sendInvitate($username,$password,$email,$name) {
        $emailManager = Yii::app()->emailManager;
        $emailManager->templatePath = $this->templatePath;
        
        // build the templates
        $template = 'invitate';
        $message = $emailManager->buildTemplateMessage($template, array(
            'username' => $username,
            'password' => $password,
        ));
        
        // get the message
        $swiftMessage = Swift_Message::newInstance($message['subject']);
        $swiftMessage->setBody($message['message'], 'text/html');
        //$swiftMessage->addPart($message['text'], 'text/plain');
        $swiftMessage->setFrom($emailManager->fromEmail, $emailManager->fromName);
        $swiftMessage->setTo($email, $name);
                
//        // spool the email
//        $emailSpool = $emailManager->getEmailSpool($swiftMessage);
//        $emailSpool->priority = 10;
//        $emailSpool->template = $template;
//        $emailSpool->transport = 'smtp';
//       
//        echo $emailSpool->save(false);
//        //send email
//        Yii::app()->emailManager->spool();
        return Yii::app()->emailManager->deliver($swiftMessage, 'smtp');        
        
        return TRUE;


    }
}