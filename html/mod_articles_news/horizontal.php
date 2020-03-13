<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;
?>
<div class="newsflash">
	<div class="container">
		<div class="items-row cols-3 newsflash-horiz<?php echo $params->get('moduleclass_sfx'); ?>">
			<?php for ($i = 0, $n = count($list); $i < $n; $i ++) : ?>
				<?php $item = $list[$i]; ?>
				<div class="item card">
					<?php require JModuleHelper::getLayoutPath('mod_articles_news', '_item'); ?>
				</div>
			<?php endfor; ?>
		</div>
		<?php $language = JRequest::getCmd('language');
		if ($language == "en-GB") : ?>
		<p class="text-right">
			<a href="/index.php/news">All news <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
		</p>
	<?php else : ?>
		<p class="text-right">
			<a href="/index.php/fr/actualites">Toutes les actualités <i class="fa fa-chevron-right" aria-hidden="true"></i></a>
		</p>
	<?php endif; ?>
	</div>
</div>
