<?php

class sfErrorNotifierDriverFile extends sfBaseErrorNotifierDriver
{
  public function __construct(array $options = array())
  {
    $options['path'] = isset($options['path']) ? 
      $options['path'] :
      sfConfig::get('sf_data_dir').'/last-error.html';

    parent::__construct($options);
  }
  
  public function notify(sfBaseErrorNotifierMessage $message)
  {
    $path = $this->getOption('path');
    file_exists($path) && unlink($path);
    
    $data = "
      Content-type: {$message->getFormat()}
      
      {$message}";
    
    file_put_contents($path, $data); 
  }
}