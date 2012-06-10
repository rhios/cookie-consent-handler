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
 * Simple configuration options for cookie-consent-handler.
 * 
 * @see classes/CookieConfig.php
 * @author Rhys Elsworth <github@rhios.co.uk>
 * @version 2012-06-03
 */

/* -------------------------------------------------------------------------------------------------
 * consent_cookie_name
 * 
 * Name of the permenant cookie used to establish consent.
 * ---------------------------------------------------------------------------------------------- */
$config['consent_cookie_name'] = 'cookie_consent';

/* -------------------------------------------------------------------------------------------------
 * cookie_expiry_secs
 * 
 * The default number of seconds before expiry of the consent cookie, 
 * from the current date. (Some browsers will ignore the maximum expiry regardless)
 * ---------------------------------------------------------------------------------------------- */
$config['cookie_expiry_secs'] = 44928000; // 10-years


/* -------------------------------------------------------------------------------------------------
 * bar_message_view
 * 
 * Specifies the path to the view file used to render the message within the consent bar.
 * ---------------------------------------------------------------------------------------------- */
$config['bar_message_view'] = 'bar_message';

/* -------------------------------------------------------------------------------------------------
 * bar_accept_buttons_view
 * 
 * Specifies the path to the view file used to render the accept buttons on the consent bar.
 * ---------------------------------------------------------------------------------------------- */
$config['bar_accept_view'] = 'bar_accept_buttons';

/* -------------------------------------------------------------------------------------------------
 * get_accept_param
 * 
 * The parameter used on the GET string to indicate acceptance of cookies, eg. /index.php?ac=1
 * ---------------------------------------------------------------------------------------------- */
$config['get_accept_param'] = 'ac';

/* -------------------------------------------------------------------------------------------------
 * more_info_url
 * 
 * A URL that will be passed to the consent bar output that will be used form a link to any page
 * that explains what cookies are used.
 * ---------------------------------------------------------------------------------------------- */
$config['more_info_url'] = 'http://www.allaboutcookies.org/';
