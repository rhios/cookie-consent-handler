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
 * Basic example for using cookie-consent-handler.
 * 
 * @author Rhys Elsworth <github@rhios.co.uk>
 * @version 2012-06-10
 */

require_once '../inc/init_cookie_consent_handler.php';
require_once CCH_INC . '/accept_cookies.php';
require_once CCH_CLASSES . '/CookieConsentHandler.php';
require_once CCH_CLASSES . '/CookieConsentBar.php';


// Start a session if consent has been gained
$consentHandler = new CookieConsentHandler();
$consentHandler->sessionStart();
?>
<!DOCTYPE html>
<html>
    <head>
        <title>
            cookie-consent-handler: Example Usage
        </title>
    </head>
    <body>
        <h1>cookie-consent-handler: Example Usage</h1>
        
        <?php
            // Output consent bar
            $consentBar = new CookieConsentBar();
            $consentBar->output();
        ?>
        
        <h2>Consent Status:</h2>
        <?php if ($consentHandler->checkConsent()): ?>
            <h3>Consent obtained, session started.</h3>
        <?php else: ?>
            <h3>Consent not obtained!</h3>
        <?php endif; ?>
    </body>
</html>
