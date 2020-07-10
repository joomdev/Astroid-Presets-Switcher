<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\FileLayout;

/**
 * Astroid Astroid Presets Switcher system plugin
 *
 * @since  1.0
 */
class plgSystemAstroid_presets_switcher extends JPlugin
{
    protected $app;

    public function onAfterRender()
    {
        if (defined('_ASTROID') && $this->app->isClient('site')) {
            $body = $this->app->getBody();

            $layout = new FileLayout('switcher');
            $layout->addIncludePath(JPATH_SITE . '/plugins/system/astroid_presets_switcher/tmpl');
            $switcher = $layout->render();

            $pos = strrpos($body, '</body>');
            $body = substr_replace($body, $switcher . '</body>', $pos, strlen('</body>'));
            $this->app->setBody($body);
        }
    }
}
