<?php

class sfErrorNotifierDriverMailNative extends sfBaseErrorNotifierDriverMail
{
  public function notify(sfBaseErrorNotifierMessage $message)
  {
    $headers = "From: {$this->getOption('from')}\r\n";
    $headers .= "Content-type: {$message->getFormat()}\r\n";  
    
    @mail($this->getOption('to'), $message->getSubject(), (string) $message, $headers); 
  }
}