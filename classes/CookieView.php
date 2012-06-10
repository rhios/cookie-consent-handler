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

require_once CCH_CLASSES . '/CookieMagicData.php';

/**
 * A very basic implementation of an MVC style view. Used purely to more easilt separate output from
 * PHP code. 
 * 
 * This version simplified and adapted to work with cookie-consent-handler, hence the name 'CookieView'.
 *
 * @author Rhys Elsworth <github@rhios.co.uk>
 * @version 2012-01-17
 */
class CookieView extends CookieMagicData
{
    /**
     * The extension used for view files.
     */
    const VIEW_EXT = '.php';

    // This view's name
    protected $_view = '';
    
    // Path to views dir
    protected $_viewsDir = '';

    /**
     * Construct a single view.
     *
     * @param string $view
     *      The name of the view. This will be used to find it in the views directory.
     *      Specify nested views by delimiting the name with a full stop.
     *      Eg. test.my.view will be translated to <views_dir>/test/my/view.php
     * @param array $data
     *      An array of data that should be made available to the view file.
     * @param string $viewsDir
     *      Optional. The location of the directory where views are stored.
     */
    public function __construct($view, array $data=array(), $viewsDir='')
    {
        $this->_view = $view;
        $this->_data = $data;
        if (!$viewsDir) {
            $this->_viewsDir = CCH_VIEWS;
        } else {
            $this->_viewsDir = $viewsDir;
        }
    }
    
    /**
     * Sets the location of the views directory. This will be searched for view files.
     * 
     * @param string $viewsDir 
     */
    public function setViewsDir($viewsDir)
    {
        $this->_viewsDir = $viewsDir;
    }

    /**
     * Set the data available to the view.
     *
     * @param array $data
     */
    public function setData(array $data)
    {
        $this->_data = $data;
    }

    /**
     * Get all of the data assigned to this view.
     *
     * @return array
     */
    public function getData()
    {
        return $this->_data;
    }

    /**
     * Renders this view.
     */
    public function render()
    {
        // Translate the view name to a relative file path
        $relativePath = $this->_viewNameToPath($this->_view);

        // Check for a view that matches in the views dir
        $viewPath = $this->_viewsDir . '/' . $relativePath . self::VIEW_EXT;
        if (file_exists($viewPath)) {
            include($viewPath);
        } else {
            // If we reach here, the specified view was not found!
            throw new Exception("View: '$this->_view' not found!");
        }
    }

    /*
     * Translates a view name to a filepath.
     *
     * @param string $view
     *      The view name to translate
     * @return string
     */
    public function _viewNameToPath($view)
    {
        // Convert to lowercase and trim!
        $view = strtolower(trim($view));
        
        // Check the view has been properly specified
        if (!$view) {
            throw new Exception("View name was blank!");
        }

        // Replace dots for slashes
        $view = implode('/', explode('.', $view));

        return $view;
    }
}
