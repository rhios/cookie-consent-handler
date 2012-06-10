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
 * Modify this file to suit your site configuration. 
 * 
 * @author Rhys Elsworth <github@rhios.co.uk>
 * @version 2012-06-03
 */

/* -------------------------------------------------------------------------------------------------
 * Where is the cookie-consent-handler package stored?
 * 
 * This is only used within this file, to further distrubute the classes, includes, config and views
 * remove/ignore this setting and change the paths below.
 * ---------------------------------------------------------------------------------------------- */
define('CCH_ROOT', $_SERVER['DOCUMENT_ROOT']);

/* -------------------------------------------------------------------------------------------------
 * Define some paths where files used by the consent handler can be found.
 * ---------------------------------------------------------------------------------------------- */
define('CCH_CLASSES', CCH_ROOT . '/classes');
define('CCH_INC',     CCH_ROOT . '/inc');
define('CCH_VIEWS',   CCH_ROOT . '/views');
define('CCH_CONFIG',  CCH_ROOT . '/config');

/* -------------------------------------------------------------------------------------------------
 * Define the name of the config file loaded by CookieConfig.
 * ---------------------------------------------------------------------------------------------- */
define('CCH_CONFIG_FILE', CCH_CONFIG . '/cookie_consent_handler.php');

// Uncomment these lines to include the core handling classes all the time
//require_once CCH_CLASSES . '/CookieConsentHandler.php';
//require_once CCH_CLASSES . '/CookieConsentBar.php';