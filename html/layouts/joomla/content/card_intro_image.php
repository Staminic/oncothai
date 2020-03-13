<?php
/**
 * @package     Joomla.Site
 * @subpackage  Layout
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('JPATH_BASE') or die;
$params = $displayData->params;
?>
<?php $images = json_decode($displayData->images); ?>
<?php if (isset($images->image_intro) && !empty($images->image_intro)) : ?>
	<?php // if ($params->get('show_readmore') && !empty($displayData->fulltext) && $params->get('access-view')) : ?>
		<a href="<?php echo JRoute::_(ContentHelperRoute::getArticleRoute($displayData->slug, $displayData->catid, $displayData->language)); ?>">
			<div class="card_item-image" style="background-image: url('<?php echo htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8'); ?>');"></div>
		</a>
	<?php // else : ?>
		<?php // echo " <div class="card_item-image" style="background-image: url(' ".htmlspecialchars($images->image_intro, ENT_COMPAT, 'UTF-8').');"></div> ; ?>
	<?php // endif; ?>
<?php endif; ?>
