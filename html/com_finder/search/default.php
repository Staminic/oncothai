<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_finder
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::_('behavior.core');
JHtml::_('formbehavior.chosen');
JHtml::addIncludePath(JPATH_COMPONENT . '/helpers/html');
JHtml::_('stylesheet', 'com_finder/finder.css', array('version' => 'auto', 'relative' => true));
?>

<div class="finder<?php echo $this->pageclass_sfx; ?>">
<?php if ($this->params->get('show_page_heading')) : ?>
	<div class="page-header">
		<div class="container">
			<h1 class="text-center">
				<?php if ($this->escape($this->params->get('page_heading'))) : ?>
					<?php echo $this->escape($this->params->get('page_heading')); ?>
				<?php else : ?>
					<?php echo $this->escape($this->params->get('page_title')); ?>
				<?php endif; ?>
			</h1>
		</div>
		<div class="wave" style="background-image: url('/images/wave.svg');"></div>
	</div>
<?php endif; ?>

<?php if ($this->params->get('show_search_form', 1)) : ?>
	<div class="container">
		<?php echo JHtml::_('content.prepare', '{loadposition override}'); ?>
		
		<div id="search-form">
			<?php echo $this->loadTemplate('form'); ?>
		</div>
	</div>
<?php endif;

// Load the search results layout if we are performing a search.
if ($this->query->search === true) :
?>
	<div class="container">
		<div id="search-results">
			<?php echo $this->loadTemplate('results'); ?>
		</div>
	</div>
<?php endif; ?>
</div>
