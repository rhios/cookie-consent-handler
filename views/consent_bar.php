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
 * A 'bar' that can be placed at the top of a page to obtain a users consent to using cookies.
 */

// Determine the initial display style
$displayStyle = "";
if (isset($this->initialHide) && $this->initialHide) {
    $displayStyle = " style=\"display: none;\"";
}
?>
<div id="cookie-consent-bar"<?= $displayStyle?>>
    <div class="cookie-consent-message">
        <?= $this->messageView->render() ?>
    </div>
    <div class="cookie-consent-buttons">
        <?= $this->acceptView->render() ?>
    </div>

</div>