<?php
/**
 * @package     Joomla.Site
 * @subpackage  com_content
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

JHtml::addIncludePath(JPATH_COMPONENT . '/helpers');

JHtml::_('behavior.caption');

$dispatcher = JEventDispatcher::getInstance();

$this->category->text = $this->category->description;
$dispatcher->trigger('onContentPrepare', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$this->category->description = $this->category->text;

$results = $dispatcher->trigger('onContentAfterTitle', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayTitle = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentBeforeDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$beforeDisplayContent = trim(implode("\n", $results));

$results = $dispatcher->trigger('onContentAfterDisplay', array($this->category->extension . '.categories', &$this->category, &$this->params, 0));
$afterDisplayContent = trim(implode("\n", $results));

?>
<div class="blog<?php echo $this->pageclass_sfx; ?>" itemscope itemtype="https://schema.org/Blog">

	<?php if ($this->params->get('show_description_image') && $this->category->getParams()->get('image')) : ?>
		<div class="article-header">
			<div class="item-image" style="background-image: url('<?php echo $this->category->getParams()->get('image'); ?>');"></div>
			<?php if ($this->params->get('show_page_heading')) : ?>
				<div class="page-header">
					<div class="container">
						<h1 class="text-center"> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
				</div>
			</div>
			<?php endif; ?>
			<div class="wave" style="background-image: url('/images/wave.svg');"></div>
		</div>
	<?php else : ?>
		<?php if ($this->params->get('show_page_heading')) : ?>
			<div class="page-header">
				<div class="container">
					<h1 class="text-center"> <?php echo $this->escape($this->params->get('page_heading')); ?> </h1>
				</div>
				<div class="wave" style="background-image: url('/images/wave.svg');"></div>
			</div>
		<?php endif; ?>
	<?php endif; ?>

	<?php if ($this->params->get('show_category_title', 1) or $this->params->get('page_subheading')) : ?>
		<h2> <?php echo $this->escape($this->params->get('page_subheading')); ?>
			<?php if ($this->params->get('show_category_title')) : ?>
				<span class="subheading-category"><?php echo $this->category->title; ?></span>
			<?php endif; ?>
		</h2>
	<?php endif; ?>
	<?php echo $afterDisplayTitle; ?>

	<div class="container">

	<?php echo JHtml::_('content.prepare', '{loadposition override}'); ?>

	<?php if ($this->params->get('show_cat_tags', 1) && !empty($this->category->tags->itemTags)) : ?>
		<?php $this->category->tagLayout = new JLayoutFile('joomla.content.tags'); ?>
		<?php echo $this->category->tagLayout->render($this->category->tags->itemTags); ?>
	<?php endif; ?>

	<?php if ($beforeDisplayContent || $afterDisplayContent || $this->params->get('show_description', 1)) : ?>
		<div class="category-desc clearfix">
			<?php echo $beforeDisplayContent; ?>
			<?php if ($this->params->get('show_description') && $this->category->description) : ?>
				<?php echo JHtml::_('content.prepare', $this->category->description, '', 'com_content.category'); ?>
			<?php endif; ?>
			<?php echo $afterDisplayContent; ?>
		</div>
	<?php endif; ?>

	<?php if (empty($this->lead_items) && empty($this->link_items) && empty($this->intro_items)) : ?>
		<?php if ($this->params->get('show_no_articles', 1)) : ?>
			<p><?php echo JText::_('COM_CONTENT_NO_ARTICLES'); ?></p>
		<?php endif; ?>
	<?php endif; ?>

	<?php $leadingcount = 0; ?>
	<?php if (!empty($this->lead_items)) : ?>
		<div class="leading-items items-row cols-3">
			<?php
			//since you're checking the category ID, check against the last one, so the first is set to null
			$prev = null;
			foreach ($this->lead_items as &$item) : ?>
				<?php if ($prev == null || $prev != $item->catid) {
					$prev = $item->catid;
					foreach ($this->children[$this->category->id] as $kategorie) {
							if ($item->catid == $kategorie->id) { ?>
									<h2 id="<?php echo $kategorie->alias; ?>" class="category-name"><?php echo $kategorie->title; ?></h2>
							<?php
						}
					}
				} ?>
				<div class="item card<?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
					itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
					<?php
					$this->item = & $item;
					echo $this->loadTemplate('item');
					?>
				</div>
				<?php $leadingcount++; ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php
	$introcount = count($this->intro_items);
	$counter = 0;
	?>

	<?php if (!empty($this->intro_items)) : ?>
		<div class="items-row cols-<?php echo (int) $this->columns; ?>">
			<?php foreach ($this->intro_items as $key => &$item) : ?>
					<div class="item card <?php echo $item->state == 0 ? ' system-unpublished' : null; ?>"
						itemprop="blogPost" itemscope itemtype="https://schema.org/BlogPosting">
						<?php
						$this->item = & $item;
						echo $this->loadTemplate('item');
						?>
					</div>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>

	<?php if (!empty($this->link_items)) : ?>
		<div class="items-more">
			<?php echo $this->loadTemplate('links'); ?>
		</div>
	<?php endif; ?>

	<?php if ($this->maxLevel != 0 && !empty($this->children[$this->category->id])) : ?>
		<div class="cat-children">
			<?php if ($this->params->get('show_category_heading_title_text', 1) == 1) : ?>
				<h3> <?php echo JText::_('JGLOBAL_SUBCATEGORIES'); ?> </h3>
			<?php endif; ?>
			<?php echo $this->loadTemplate('children'); ?> </div>
	<?php endif; ?>
	<?php if (($this->params->def('show_pagination', 1) == 1 || ($this->params->get('show_pagination') == 2)) && ($this->pagination->get('pages.total') > 1)) : ?>
		<div class="pagination pagination-block">
			<?php if ($this->params->def('show_pagination_results', 1)) : ?>
				<p class="counter"><?php echo $this->pagination->getPagesCounter(); ?></p>
			<?php endif; ?>
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
	<?php endif; ?>
	</div>
</div>
