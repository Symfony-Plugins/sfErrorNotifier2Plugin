<?php

class sfErrorNotifierMessageText extends sfBaseErrorNotifierMessage
{
  public function getFormat()
  {
    return 'text/plain';
  }
  
  public function render()
  {
    foreach ($this->_data as $title => $values) {
      is_array($values) || $values = array($values); 
      
      $body .= $this->_renderTitle($title);
      $body .= $this->_renderTable($values);
    }
    
    return $body;
  }
  
  protected function _renderTitle($title)
  {
    return "{$this->_prepareTitle($title)}\n";
  }
  
  protected function _renderTable(array $data)
  { 
    $body = '';    
    foreach ($data as $name => $value) {
      $body .= "\t{$this->_prepareTitle($name)}: {$value}\n";
    }
    
    return $body;
  }
}