<?php

abstract class sfBaseErrorNotifierDriver
{ 
  protected $_options = array();
  
  public function __construct(array $options = array())
  {
    $this->_options = $options;
  }
  
  /**
   * 
   * @param sfBaseErrorNotifierMessage $message
   * 
   * @return void
   */
  abstract public function notify(sfBaseErrorNotifierMessage $message);
  
  public function getOption($name)
  {
    return isset($this->_options[$name]) ? $this->_options[$name] : null;
  }
  
  /**
   * @return sfBaseErrorNotifierDriver
   */
  public static function get()
  {
    $options = sfConfig::get('sf_notify_driver');
    
    $class = $options['class'];

    return new $class($options['options']);
  }
}