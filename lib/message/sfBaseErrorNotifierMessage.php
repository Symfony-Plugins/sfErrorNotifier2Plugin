<?php

/**
 * 
 * @author Maksim Kotlyar <mkotlar@ukr.net>
 *
 */
abstract class sfBaseErrorNotifierMessage
{
  protected $_data = array();
  
  protected $_context;
  
  public function __construct($text = 'Internal error', $data = array(), $context = null)
  {
    $this->_context = $this->_initContext($context);
    
    $this->_data = array_merge(
      array('summary' => $this->_initSummarySection($text)),
      $data,
      array('server' => $this->_initServerSection()));
  }
  
  public function __toString()
  {
    return $this->render(); 
  }
  
  /**
   * @return string
   */
  abstract public function render();
  
  /**
   * @return string
   */
  abstract function getFormat();
  
  public function getSubject()
  {
    return "ERROR: {$this->_data['server']['host']} - {$this->_data['summary']['environmen']} - {$data['summary']['subject']}";
  }
  
  protected function _initSummarySection($text)
  {
    return array(
      'subject' => $text,
      'environment' => $this->_context->getConfiguration()->getEnvironment(),
      'generated at' => date('H:i:s j F Y'));
  }
  
  protected function _initServerSection()
  {
    return array(
      'module' => $this->_context->getModuleName(),
      'action' => $this->_context->getActionName(),
      'uri' => $this->_context->getRequest()->getUri(),
      'server' => var_export($_SERVER, true),
      'session' => var_export(isset($_SESSION) ? $_SESSION : null, true));
  }
  
  /**
   * 
   * @param mixed $context
   * 
   * @return sfContext|sfErrorNotifierNullContext
   */
  protected function _initContext($context)
  {
    if ($context instanceof sfContext) return $context;
    if (sfContext::hasInstance()) return sfContext::getInstance();
    
    return new sfErrorNotifierNullContext();
  }
  
  protected function _prepareTitle($title)
  {
    return ucfirst(strtolower($title));
  }
  
  /**
   * 
   * @param string|void $text
   * @param array|void $data
   * @param sfContext|void $context
   * 
   * @return sfBaseErrorNotifierMessage
   */
  public static function get($text = 'Internal error', array $data, $context = null)
  {
    $options = sfConfig::get('sf_notify_message');
    $class = $options['class'];
    
    return new $class($text, $data, $context); 
  }
}