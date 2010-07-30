<?php

class sfErrorNotifierPluginConfiguration extends sfPluginConfiguration
{
  public function initialize()
  { 
    $this->_initializeConfig();
    
    if (!$this->isEnabled()) return;
    
    $this->_initializeEventListeners();
    $this->_initializeErrorHandler();
  }
  
  protected function isEnabled()
  {
    return sfConfig::get('sf_notify_enabled');
  }
  
  protected function _initializeConfig()
  {
    $configFiles = $this->configuration->getConfigPaths('config/notify.yml');
    $config = sfDefineEnvironmentConfigHandler::getConfiguration($configFiles);
    
    foreach ($config as $name => $value) {
      sfConfig::set("sf_notify_{$name}", $value);  
    } 
  }
  
  protected function _initializeEventListeners()
  {
    $this->dispatcher->connect(
      'application.throw_exception', array('sfErrorNotifier', 'notifyEventExceptionThrown'));
  }
  
  protected function _initializeErrorHandler()
  {
    sfErrorNotifierHandler::start();
  }
}