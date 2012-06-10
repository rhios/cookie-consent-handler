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

require_once CCH_CLASSES . '/CookieConfig.php';

/**
 * Handles setting up a standard PHP session where consent needs to be obtained from the user
 * before cookies can be used.
 * 
 * @see http://www.ico.gov.uk/for_organisations/privacy_and_electronic_communications/the_guide/cookies.aspx
 * @see http://www.international-chamber.co.uk/components/com_wordpress/wp/wp-content/uploads/2012/04/icc_uk_cookie_guide.pdf
 * @author Rhys Elsworth <github@rhios.co.uk>
 * @version 2012-05-17
 */
class CookieConsentHandler
{   
    // Consent cookie name
    protected $_cookieName = '';
    // Number of seconds before cookie expiry
    protected $_cookieExpiry = 0;
    
    /**
     * Creates an instance of the ConsentHandler.
     *  
     * @param string $cookieName
     *      Optional. Set the name of the cookie to use to establish consent.
     * @param int $cookieExpiry
     *      Optional. The number of seconds from today until the consent cookie expires.
     */
    public function __construct($cookieName='', $cookieExpiry=0)
    {
        // Get the configuration
        $config = new CookieConfig();
        
        if (!$cookieName) {
            $this->_cookieName = $config->consent_cookie_name;
        } else {
            $this->_cookieName = $cookieName;
        }
        if (!$cookieExpiry) {
            $this->_cookieExpiry = $config->cookie_expiry_secs;
        } else {
            $this->_cookieExpiry = $cookieExpiry;
        }
    }
    
    /**
     * Checks to see if the current visitor has already consented to the use of cookies by looking 
     * for a pre-existing 'permenant' cookie.  
     */
    public function checkConsent()
    {
        if (isset($_COOKIE[$this->_cookieName]) 
            && !empty($_COOKIE[$this->_cookieName])
        ) {
            return TRUE;
        }
        
        return FALSE;
    }
    
    /**
     * Sets a long lasting cookie that identifies that the user has consented to using cookies on
     * the website.
     * 
     * @throws Exception
     *      If the consent cookie cannot be set.
     */
    public function setConsentCookie()
    {
        $expiry = time() + $this->_cookieExpiry;
        if (!setcookie($this->_cookieName, time(), $expiry)) {
            throw new Exception("Failed to set consent cookie.");
        }
    }
    
    /**
     * Drop-in replacement for PHP's standard session_start().
     * 
     * This uses checkConsent() to check for a users consent to the use of cookies. If it has not
     * been provided then session_start() is not called.
     * 
     * @return bool
     *      Passed through from session_start(), or TRUE if consent was not given as the only actual
     *      error condition will be if session_start() is called and fails.
     */
    public function sessionStart()
    {
        $result = TRUE;
        if ($this->checkConsent()) {
            $result = session_start();
        }
        
        return $result;
    }
}
