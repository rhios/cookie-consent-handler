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
 * Utility functions to be used across cookie classes.
 * 
 * @author Rhys Elsworth <github@rhios.co.uk>
 * @version 2012-06-10
 */
class CookieUtils
{
    /**
     * Returns the currently requestesd URL. This is only really for use when the CodeIgniter URL
     * helper functions are not available or not practical.
     * 
     * @return string
     *      The current URL.
     */
    public function getCurrentUrl() 
    {
        // Get the protocol in use...
        $proto = 'http';
        if (isset($_SERVER['HTTPS']) && $_SERVER['HTTPS']) {
            $proto = 'https';
        }

        // Combine that with the current virtual host/server name
        $url = "$proto://" . $_SERVER['SERVER_NAME'];
        if ($_SERVER['SERVER_PORT'] != 80
            || $_SERVER['SERVER_PORT'] != 443
        ) {
            $url .= ':' . $_SERVER['SERVER_PORT'];
        }

        // Tack on the URI that was requested
        $url .= $_SERVER['REQUEST_URI'];

        // Finally, return
        return $this->xssClean($url);
    }

    /**
     * Basic XSS filter. 
     * 
     * WARNING: This is not extensive!
     * 
     * @param string $input
     *      The input string to be filtered
     * @return string
     *      The filtered string, with potential vulnerabilities removed.
     */
    public function xssClean($input)
    {
        // Take a deny, allow approach snd remove all non-permitted characters
        $input = preg_replace("/[^A-Za-z0-9:\/\-_&\?=\.,]/", '', $input);

        // Look for more specialised cases:

        // Strip double dashes (Old SQL comment) '--'
        $input = preg_replace("/-{2}/", '-', $input);

        return $input;
    }
}
