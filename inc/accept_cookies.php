<?php
/**
 * Handles action taken after consent has been given to use cookies.
 * 
 * @author Rhys Elsworth <github@rhios.co.uk>
 * @version 2012-05-17
 */

require_once CCH_CLASSES . '/CookieUtils.php';
require_once CCH_CLASSES . '/CookieConfig.php';

$utils = new CookieUtils();
$config = new CookieConfig();

if (isset($_REQUEST[$config->get_accept_param])
    && $_REQUEST[$config->get_accept_param]
) {
    // Get an instance of the consent handler
    $c = new CookieConsentHandler();
    
    // If consent has not yet been established, set the consent cookie now
    if (!$c->checkConsent()) {
        $c->setConsentCookie();

        // Reload the current URL so that the browser sends the new cookie back to the server
        header("Location: " . $utils->getCurrentUrl());
        exit(); // Ensure no more output follows
    }
}
