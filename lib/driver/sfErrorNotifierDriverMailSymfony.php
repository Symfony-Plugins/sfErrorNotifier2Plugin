<?php

class sfErrorNotifierMailSymfony extends sfBaseErrorNotifierDriverMail
{
  public function notify(sfBaseErrorNotifierMessage $message)
  {
    if (!sfContext::hasInstance()) return;
    
    $context = sfContext::getInstance();
    
    $swiftMessage = new Swift_Message();
    $swiftMessage
      ->setTo($this->getOption('to'))
      ->setFrom($this->getOption('from'))
      ->setBody((string) $message)
      ->setFormat($message->getFormat())
      ->setSubject($message->getSubject());

    @$context->getMailer()->send($swiftMessage);
  }
}