<?php
/**
 * Class for <button> elements
 *
 * PHP version 5
 *
 * LICENSE:
 *
 * Copyright (c) 2006-2014, Alexey Borzov <avb@php.net>,
 *                          Bertrand Mansion <golgote@mamasam.com>
 * All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions
 * are met:
 *
 *    * Redistributions of source code must retain the above copyright
 *      notice, this list of conditions and the following disclaimer.
 *    * Redistributions in binary form must reproduce the above copyright
 *      notice, this list of conditions and the following disclaimer in the
 *      documentation and/or other materials provided with the distribution.
 *    * The names of the authors may not be used to endorse or promote products
 *      derived from this software without specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS
 * IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO,
 * THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR
 * PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT OWNER OR
 * CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL,
 * EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO,
 * PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR
 * PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY
 * OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING
 * NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * @category HTML
 * @package  HTML_QuickForm2
 * @author   Alexey Borzov <avb@php.net>
 * @author   Bertrand Mansion <golgote@mamasam.com>
 * @license  http://opensource.org/licenses/bsd-license.php New BSD License
 * @link     http://pear.php.net/package/HTML_QuickForm2
 */

/**
 * Base class for simple HTML_QuickForm2 elements
 */
require_once 'HTML/QuickForm2/Element.php';

/**
 * Class for <button> elements
 *
 * Note that this element was named 'xbutton' in previous version of QuickForm2,
 * the name 'button' being used for current 'inputbutton' element.
 *
 * @category HTML
 * @package  HTML_QuickForm2
 * @author   Alexey Borzov <avb@php.net>
 * @author   Bertrand Mansion <golgote@mamasam.com>
 * @license  http://opensource.org/licenses/bsd-license.php New BSD License
 * @version  Release: 2.0.2
 * @link     http://pear.php.net/package/HTML_QuickForm2
 */
class HTML_QuickForm2_Element_Button extends HTML_QuickForm2_Element
{
   /**
    * Contains options and data used for the element creation
    * - content: Content to be displayed between <button></button> tags
    * @var  array
    */
    protected $data = array('content' => '');

   /**
    * Element's submit value
    * @var  string
    */
    protected $submitValue = null;


    public function getType()
    {
        return 'button';
    }

   /**
    * Buttons can not be frozen
    *
    * @param bool $freeze Whether element should be frozen or editable. This
    *                     parameter is ignored in case of buttons
    *
    * @return   bool    Always returns false
    */
    public function toggleFrozen($freeze = null)
    {
        return false;
    }

   /**
    * Sets the contents of the button element
    *
    * @param string $content Button content (HTML to add between <button></button> tags)
    *
    * @return $this
    */
    function setContent($content)
    {
        $this->data['content'] = $content;
        return $this;
    }

   /**
    * Button's value cannot be set via this method
    *
    * @param mixed $value Element's value, this parameter is ignored
    *
    * @return $this
    */
    public function setValue($value)
    {
        return $this;
    }

   /**
    * Returns the element's value
    *
    * The value is only returned if the following is true
    *  - button has 'type' attribute set to 'submit' (or no 'type' attribute)
    *  - the form was submitted by clicking on this button
    *
    * This method returns the actual value submitted by the browser. Note that
    * different browsers submit different values!
    *
    * @return    string|null
    */
    public function getRawValue()
    {
        if ((empty($this->attributes['type']) || 'submit' == $this->attributes['type'])
            && !$this->getAttribute('disabled')
        ) {
            return $this->submitValue;
        } else {
            return null;
        }
    }

    public function __toString()
    {
        return $this->getIndent() . '<button' . $this->getAttributes(true) .
               '>' . $this->data['content'] . '</button>';
    }

    protected function updateValue()
    {
        foreach ($this->getDataSources() as $ds) {
            if ($ds instanceof HTML_QuickForm2_DataSource_Submit
                && null !== ($value = $ds->getValue($this->getName()))
            ) {
                $this->submitValue = $value;
                return;
            }
        }
        $this->submitValue = null;
    }
}
?>