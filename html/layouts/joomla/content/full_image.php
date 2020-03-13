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
	<?php if (isset($images->image_fulltext) && !empty($images->image_fulltext)) : ?>
		<div class="item-image" style="background-image: url('<?php echo htmlspecialchars($images->image_fulltext); ?>');"></div>
	<?php endif; ?>
