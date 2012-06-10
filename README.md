cookie-consent-handler
======================

Simple PHP 5+ Handler for Cookie Consent Laws.

This is intended to be a drop-in solution for any third-party or custom built PHP application that
uses PHP's built-in session_start() function.

Quick Start:
==================================================================

Look at examples/example1.php


Integrating cookie-consent-handler and handling session_start()'s:
==================================================================

Somewhere in your application, require the consent handler init file:

require_once 'inc/init_cookie_consent_handler.php';

This will define paths used to find other files used by the consent handler, you may want to edit
the paths defined here to suit your system.


Search your application for instances of 'session_start()'. Where found replace them with:

require_once CCH_CLASSES . '/CookieConsentHandler.php';
$consentHandler = new CookieConsentHandler();
$consentHandler->sessionStart();

This will ensure a session is not started unless consent has been given.


You can check if a user has provided consent by calling the checkConsent() method on the 
CookieConsentHandler object. This can be used to conditionally display content that requires 
consent. Eg.

$consentHandler = new CookieConsentHandler();
if ($consentHandler->checkConsent()) {
    // Output Analytics/Tracking code...
}

Gaining User Consent:
=================================================================

You can gain consent in one of two ways:

1) Use the CookieConsentBar and the accept_cookies.php script.

Together these allow you to place a 'bar' (Or box, etc. depending on how you style the output) that
displays a message on any given page, asking for the users consent to accept cookies. When the user
clicks 'Accept' the accept_cookies.php script picks up on the request and sets a long-term cookie
that indicates the users acceptance over subsequent page requests. The bar will then disappear.

To do this, somewhere in your application, require the accept_cookies.php script. You should include 
this file BEFORE any page output!

require_once CCH_INC . '/accept_cookies.php';

Then, output the consent bar somewhere appropriate:

require_once CCH_CLASSES . '/CookieConsentBar.php';
$consentBar = new CookieConsentBar();
$consentBar->output();

2) Gain consent in some other way and handle it using the CookieConsentHandler class.

If you gain consent in any other way, just use the setConsentCookie() and checkConsent()
methods on the CookieConsentHandler class to handle cookies.


Customising:
=================================================================

You can customise the behaviour of the CookieConsentHandler and CookieConsentBar classes by chaning
values in the configuration file (config/cookie_consent_handler.php). All options are commented.

You can also choose to provide different parameters to the class constructors and method calls, see
the code comments for details.

The text output of the consent bar can be changed by editing the files in the views directory.

Depending on how complex your application is, you may also want to edit the getCurrentUrl() and
xssClean() methods in the CookieUtils class to suit your setup/security policy.

You might want to add the relevant requires to the end of the init script to make things a little
easier. Eg.

require_once CCH_CLASSES . '/CookieConsentHandler.php';
require_once CCH_CLASSES . '/CookieConsentBar.php';

Reference: 
=================================================================

http://www.ico.gov.uk/for_organisations/privacy_and_electronic_communications/the_guide/cookies.aspx
http://www.international-chamber.co.uk/components/com_wordpress/wp/wp-content/uploads/2012/04/icc_uk_cookie_guide.pdf