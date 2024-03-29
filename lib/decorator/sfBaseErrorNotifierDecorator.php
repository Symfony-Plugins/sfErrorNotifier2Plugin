<?php

/**
 *
 * @package    sfErrorNotifier
 * @subpackage decorator 
 * 
 * @author     Maksim Kotlyar <mkotlar@ukr.net>
 */
abstract class sfBaseErrorNotifierDecorator extends sfBaseErrorNotifierMessage
{
  /**
   * 
   * @var sfBaseErrorNotifierMessage
   */
  protected $message;
  
  /**
   * 
   * @param sfBaseErrorNotifierMessage $message
   */
  public function __construct(sfBaseErrorNotifierMessage $message)
  {
    $this->message = $message;
  }
  
  /**
   * 
   * @return string
   */
  public function render()
  {
    $body = '';
    foreach ($this->message as $title => $data) {
      is_array($data) || $data = array($data); 
      
      $body .= $this->_renderTitle($title);
      $body .= $this->_renderSection($data);
    }
    
    return $body;
  }
  
  /**
   * 
   * @param string $title
   */
  abstract protected function _renderTitle($title);
  
  /**
   * 
   * @param array $data
   */
  abstract protected function _renderSection(array $data);
  
  public function __call($name, $args) 
  {
    return call_user_func_array(array($this->message, $name), $args);
  }
  
  public function __set($name, $value)
  {
    $this->message->$name = $value;
  }
  
  public function __get($name)
  {
    return $this->message->$name;
  }
  
  /**
   * 
   * @return string
   */
  public function __toString()
  {
    return $this->render(); 
  }
  
  /**
   * 
   * @param string $name
   * @param array $data
   * 
   * @return sfErrorNotifierMessage
   */
  public function addSection($name, array $data)
  {
    $this->message->addSection($name, $data);
    
    return $this;
  }
  
  /**
   * 
   * @param string $name
   * 
   * @return sfErrorNotifierMessage
   */
  public function removeSection($name)
  {
    $this->message->removeSection($name);
    
    return $this;
  }
  
  /**
   * 
   * @return string 
   */
  public function getSubject()
  {
    return $this->message->getSubject();
  }
  
  /**
   * 
   * @return ArrayIterator
   */
  public function getIterator()
  {
    return $this->message->getIterator();
  }
  
  /**
   * 
   * @return sfErrorNotifier
   */
  protected function notifier()
  {
    return sfErrorNotifier::getInstance();
  }
}