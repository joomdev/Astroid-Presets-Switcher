<?php

/**
 * @package   Astroid Framework
 * @author    JoomDev https://www.joomdev.com
 * @copyright Copyright (C) 2009 - 2020 JoomDev.
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die;
defined('_ASTROID') or die;

use Astroid\Framework;
use Joomla\CMS\Uri\Uri;

$uri = Uri::getInstance();

$style = '.astroid-preset-switcher{
    position: fixed;
    top: 0;
    left: -200px;
    height: 100vh;
    width: 200px;
    box-shadow: none;
    z-index: 99999;
    transition: left 0.6s cubic-bezier(0.16, 1, 0.3, 1);
    display: flex;
}
.astroid-preset-switcher .astroid-presets{
    overflow-y: auto;
    height: 100%;
    width: 100%;
}
.astroid-preset-switcher.open{
    left: 0px;
    box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.35);
    transition: left 0.6s cubic-bezier(0.16, 1, 0.3, 1);
}
.astroid-preset-switcher-toggle{
    position: absolute;
    z-index: 1;
    width: 40px;
    height: 40px;
    display: block;
    top: 0;
    right: 0;
    margin-right: -40px;
    text-align: center;
    line-height: 40px;
    cursor: pointer;
}
';

$script = 'function toggleAstroidPresets(){
    document.querySelector(".astroid-preset-switcher").classList.toggle("open");
}';

$document = Framework::getDocument();
$document->addStyleDeclaration($style);
$document->addScriptDeclaration($script);

$presets = Framework::getTemplate()->getPresets();
if (empty($presets)) {
    return;
}
$params = Framework::getTemplate()->getParams();

$primary = $params->get('theme_primary', '');

?>
<div class="astroid-preset-switcher bg-white p-4">
    <div class="astroid-presets">
        <?php foreach ($presets as $presetname => $preset) {
            $uri->setVar('preset', $presetname);
            $active = $preset['preset']['theme_primary'] == $primary;
        ?>
            <a class="d-block border text-center bg-light mb-4<?php echo $active ? ' border-primary' : ''; ?>" title="<?php echo $preset['title']; ?>" href="<?php echo $uri->toString(); ?>">
                <div class="astroid-preset">
                    <?php if (!empty($preset['thumbnail'])) { ?>
                        <img src="<?php echo $preset['thumbnail']; ?>" />
                    <?php } ?>
                    <span class="small text-uppercase font-weight-bold"><?php echo $preset['title']; ?></span>
                </div>
            </a>
        <?php } ?>
    </div>
    <a href="javascript:void(0);" onclick="toggleAstroidPresets()" title="Template Presets" class="astroid-preset-switcher-toggle bg-dark text-light"><span class="fa fa-cog"></span></a>
</div>