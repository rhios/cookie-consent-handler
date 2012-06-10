<?php
/*

This file is part of cookie-consent-handler.

cookie-consent-handler is free software: you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation, either version 3 of the License, or
(at your option) any later version.

cookie-consent-handler is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with cookie-consent-handler.  If not, see <http://www.gnu.org/licenses/>.

 */

/**
 * Provides magic getter and setter handling for classes that use an internal array of data
 * exposed via PHP's magic methods.
 * 
 * @author Rhys Elsworth <github@rhios.co.uk>
 * @version 2012-06-03
 */
class CookieMagicData
{
    // An array to store data!
    protected $_data = array();
    
    /**
     * Magic setter for view data.
     *
     * @param string $name
     * @param mixed $value
     */
    public function __set($name, $value)
    {
        $this->_data[$name] = $value;
    }

    /**
     * Magic getter.
     *
     * @param string $name
     * @return mixed
     */
    public function __get($name)
    {
        if (isset($this->_data[$name])) {
            return $this->_data[$name];
        }

        return NULL;
    }

    /**
     * Magic isset.
     *
     * @param string $name
     * @return bool
     */
    public function __isset($name)
    {
        return isset($this->_data[$name]);
    }

    /**
     * Magic unset.
     *
     * @param string $name
     */
    public function __unset($name)
    {
        if (isset($this->_data[$name])) {
            unset($this->_data[$name]);
        }
    }
}
