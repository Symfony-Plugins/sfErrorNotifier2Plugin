<?php

abstract class sfBaseErrorNotifierDriverMail extends sfBaseErrorNotifierDriver
{    
  /**
   * 
   * @param sfBaseErrorNotifierMessage $message
   * 
   * @return void
   */
  abstract public function notify(sfBaseErrorNotifierMessage $message);
}