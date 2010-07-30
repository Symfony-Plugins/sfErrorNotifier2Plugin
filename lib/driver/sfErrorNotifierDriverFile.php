<?php

class sfErrorNotifierDriverFile extends sfBaseErrorNotifierDriver
{  
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