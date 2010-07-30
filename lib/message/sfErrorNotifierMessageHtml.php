<?php

class sfErrorNotifierMessageHtml extends sfBaseErrorNotifierMessage
{
  public function getFormat()
  {
    return 'text/html';
  }
  
  public function render()
  {
    //Initialize the body message
    $body = '<div style="font-family: Verdana, Arial;">';

    foreach ($this->_data as $title => $values) {
      is_array($values) || $values = array($values); 
      
      $body .= $this->_renderTitle(ucfirst(strtolower($title)));
      $body .= $this->_renderTable($values);
    }
   
    $body .= '</div>';
    
    return $body;
  }
  
  protected function _renderTable(array $data)
  {
    $body = '<table cellspacing="1" width="100%">';
    
    foreach ($data as $name => $value) {
      $body .= $this->_renderRow($name, $value);
    }
    
    $body .= '</table>';
    
    return $body;
  }
  
  protected function _renderRow($th, $td = '')
  {
    return "
      <tr style=\"padding: 4px;spacing: 0;text-align: left;\">\n
        <th style=\"background:#cccccc\" width=\"140px\">
          {$this->_prepareTitle($th)}:
        </th>\n
        <td style=\"padding: 4px;spacing: 0;text-align: left;background:#eeeeee\">
          {$this->_prepareValue($td)}
        </td>\n
      </tr>";  
  } 
  
  protected function _renderTitle($title)
  {
    return "<h1 style=\"background: #0055A4; color:#ffffff;padding:5px;\">
        {$this->_prepareTitle($title)}
      </h1>";
  }
  
  protected function _prepareValue($value)
  {
    $return = "<pre style='margin: 0px 0px 10px 0px; display: block; color: black; font-family: Verdana; border: 1px solid #cccccc; padding: 5px; font-size: 15px; line-height: 13px;'>";
    $return .= nl2br(htmlspecialchars($value));
    $return .= '</pre>';
    
    return $return;
  }
}