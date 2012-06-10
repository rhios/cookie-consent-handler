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
 * The default consent message.
 */
?>
<p>
    This website would like to place cookies on your device to provide an enhanced user experience
    and to monitor and improve the website in the future. Acceptance of cookies is required for some
    site features. 
    <span class="cookie-consent-accept-prompt">To accept, click the Accept button.</span>
    <?php if (isset($this->moreInfoUrl) && $this->moreInfoUrl): ?>
    For more information, <a href="<?= $this->moreInfoUrl ?>" 
    title="Click here for more information on our use of cookies">click here.</a>
    <?php endif; ?>
</p>
