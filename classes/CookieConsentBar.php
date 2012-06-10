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
require_once CCH_CLASSES . '/CookieUtils.php';
require_once CCH_CLASSES . '/CookieView.php';

/**
 * Handles outputting a 'Consent Bar' for the header or footer of a web page.
 * 
 * @author Rhys Elsworth <github@rhios.co.uk>
 * @version 2012-06-03
 */
class CookieConsentBar
{    
    // An instance of the ConsentHandler
    protected $_consentHandler = NULL;
    // The URL to use for the consent page
    protected $_consentPage = '';
    // Whether to initially hide the consnt ba
    protected $_initialHide = FALSE;
    // Whether to always display the consent bar despite having obtained consent
    protected $_alwaysDisplay = FALSE;
    // A view to use for the consent message
    protected $_messageView = NULL;
    // A view to use for the acceptance buttons/links
    protected $_acceptView = NULL;
    // The query parameter which will be used to indicate acceptance of cookies
    protected $_acceptQueryParam = '';
    // A URL to use to direct the user to more info about cookies.
    protected $_moreInfoUrl = '';
    
    /**
     * Creates a ConsentBar
     * 
     * @param string $consentUrl
     *      Optional. The URL of a page that will enable cookies. If the consent page is not set, 
     *      then the current request URL will be used with the ac=1 parameter set.
     * @param string $cookieName
     *      Optional. Set the name of the cookie to use to establish consent.
     * @param int $cookieExpiry
     *      Optional. The number of seconds from today until the consent cookie expires.
     */
    public function __construct($consentUrl='', $cookieName='', $cookieExpiry=0)
    {
        // Fetch some values from the Config
        $config = new CookieConfig();
        $this->_messageView      = $config->bar_message_view;
        $this->_acceptView       = $config->bar_accept_view;
        $this->_acceptQueryParam = $config->get_accept_param;
        $this->_moreInfoUrl      = $config->more_info_url;
        
        // Create an instance of the consent handler
        if (!$cookieName) {
            $cookieName = $config->consent_cookie_name;
        }
        if (!$cookieExpiry) {
            $cookieExpiry = $config->cookie_expiry_secs;
        }
        $this->_consentHandler = new CookieConsentHandler($cookieName, $cookieExpiry);
        
        // Make sure we have URL to use to establish consent
        if (!$consentUrl) {
            $this->_consentUrl = $this->_createConsentUrl();
        }
    }
    
    /**
     * Set whether to initialy hide the consent bar using "style='display: none;'". In case of 
     * display view JS effect.
     * 
     * @param bool $initialHide
     */    
    public function setInitialHide($initialHide)
    {
        $this->_initialHide = $initialHide;
    }
    
    /**
     * Set whether to always display the consent bar.= even if cookie consent had been attained.
     * Useful for styling the consent bar element.
     * 
     * @param bool $alwaysDisplay 
     */
    public function setAlwaysDisplay($alwaysDisplay)
    {
        $this->_alwaysDisplay = $alwaysDisplay;
    }
    
    /**
     * Set a custom view to be used for the message part of the bar.
     * 
     * @param CookieView $messageView
     */
    public function setMessageView(CookieView $messageView)
    {
        $this->_messageView = $messageView;
    }
    
    /**
     * Set a custom view tp be used for the acceptance part of the bar.
     * 
     * @param CookieView $acceptView
     */
    public function setAcceptView(CookieView $acceptView) 
    {
        $this->_acceptView = $acceptView;
    }
    
    /**
     * Sets the more info URL to use in the default message output.
     * 
     * @param string $moreInfoUrl
     */
    public function setMoreInfoUrl($moreInfoUrl)
    {
        $this->_moreInfoUrl = $moreInfoUrl;
    }
    
    /**
     * Outputs some HTML that will allow a consent bar to be displayed
     * Does not output the consent bar unless consent has not been obtained unless the 
     * 'always display' option is set.
     */
    public function output() 
    {
        if ($this->_alwaysDisplay || !$this->_consentHandler->checkConsent()) {
            $bar = new CookieView('consent_bar', array(
                'initalHide' => $this->_initialHide,
            ));

            // Set the message view
            $bar->messageView = new CookieView($this->_messageView, array(
                'moreInfoUrl' => $this->_moreInfoUrl,
            ));
            
            // Set the accept view
            $bar->acceptView = new CookieView($this->_acceptView, array(
                'consentUrl' => $this->_consentUrl,
            ));

            $bar->render();
        }
    }
    
    /*
     * Works out the current page URL and adds the cookie accept query parameter, 
     * preserving other parameters.
     * 
     * @return string
     */
    protected function _createConsentUrl()
    {
        $baseUrl = htmlentities($_SERVER['PHP_SELF']);
        
        // Handle query params
        $queryString = '';
        if (isset($_SERVER['QUERY_STRING']) && !empty($_SERVER['QUERY_STRING'])) {
            parse_str($_SERVER['QUERY_STRING'], $query);
            
            // Sanitise current query parameters
            $utils = new CookieUtils();
            $safeQuery = array();
            foreach ($query as $param => $value) {
                $safeQuery[$utils->xssClean($param)] = $utils->xssClean($value);
            }
            
            // Add acceptance param
            $safeQuery[$this->_acceptQueryParam] = 1;
        } else {
            $safeQuery = array($this->_acceptQueryParam => 1);
        }
        
        // Re-build params in to a string
        $queryString = http_build_query($safeQuery);
        if (!empty($queryString)) {
            $baseUrl .= '?' . $queryString;
        }
        
        return $baseUrl;
    }
}
