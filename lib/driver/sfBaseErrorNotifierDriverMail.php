<?php

abstract class sfBaseErrorNotifierDriverMail extends sfBaseErrorNotifierDriver
{  
  public function __construct(array $options = array())
  {
    $options['to'] = $options['to'] ? 
      $options['to'] : 
      sfConfig::get('app_sfErrorNotifier_emailTo');
    
    $options['from'] = $options['from'] ? 
      $options['from'] : 
      sfConfig::get('app_sfErrorNotifier_emailFrom');
    
    parent::__construct($options);
  }
}