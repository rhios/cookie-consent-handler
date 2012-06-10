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

require_once CCH_CLASSES . '/CookieMagicData.php';

/**
 * Loads values from a simple configuration file without polluting the global namespace with
 * a 'config' array (or similar).
 * 
 * @author Rhys Elsworth <github@rhios.co.uk>
 * @version 2012-06-03
 */
class CookieConfig extends CookieMagicData
{   
    /**
     * Initialises the configuration.
     *
     * @throws Exception
     *      If loading the config file fails.
     */
    public function __construct() 
    {        
        // Load the config file
        if (!file_exists(CCH_CONFIG_FILE) || !is_readable(CCH_CONFIG_FILE)) {
            throw new Exception("Config file " . CCH_CONFIG_FILE . " does not exist or is not " .
                                "accessible to this script.");
        }
        $config = array();
        include CCH_CONFIG_FILE;
        
        // Store config so it is accessible via CookieMagicData defined magic methods
        $this->_data = $config;
    }
}
