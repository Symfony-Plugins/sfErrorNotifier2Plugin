<?php

/*
 * (c) 2008-2009 Daniele Occhipinti
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

/**
 *
 * @package    symfony
 * @subpackage plugin
 * @author     Daniele Occhipinti <>
 */
class sfErrorNotifier
{
  public static function notify(sfBaseErrorNotifierMessage $message)
  {
    sfBaseErrorNotifierDriver::get()->notify($message);
  }
  
  public static function notifyEventExceptionThrown(sfEvent $event)
  {
    return self::notifyException($event->getSubject());
  }

  public static function notifyException(Exception $exception)
  {
    $message = sfBaseErrorNotifierMessage::get($exception->getMessage(), array(
      'exception' => array(
      'class' => get_class($exception),
      'code' => $exception->getCode(),
      'message' => $exception->getMessage(),
      'file' => "{$exception->getFile()}, Line: {$exception->getLine()}",
      'trace' => $exception->getTraceAsString())));
    
    return self::notify($message);
  }
}