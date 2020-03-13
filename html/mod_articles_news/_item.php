<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_articles_news
 *
 * @copyright   Copyright (C) 2005 - 2017 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

$item_heading = $params->get('item_heading', 'h4');
?>
<?php $images  = json_decode($item->images); ?>
<?php if (!empty($images->image_intro)) : ?>
	<?php // if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
		<a href="<?php echo $item->link; ?>">
			<div class="card_item-image" style="background-image: url('<?php echo htmlspecialchars($images->image_intro); ?>');"></div>
		</a>
	<?php // else : ?>
		<!-- <div class="card_item-image" style="background-image: url('<?php // echo htmlspecialchars($images->image_intro); ?>');"></div> -->
	<?php // endif; ?>
<?php endif; ?>
<div class="card_item_content">
	<div>
	<?php if ($params->get('item_title')) : ?>

		<<?php echo $item_heading; ?> class="h2 newsflash-title<?php echo $params->get('moduleclass_sfx'); ?>">
		<?php // if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
			<a href="<?php echo $item->link; ?>">
				<?php echo $item->title; ?>
			</a>
		<?php // else : ?>
			<?php // echo $item->title; ?>
		<?php // endif; ?>
		</<?php echo $item_heading; ?>>

	<?php endif; ?>

	<?php if (!$params->get('intro_only')) : ?>
		<?php echo $item->afterDisplayTitle; ?>
	<?php endif; ?>

	<?php echo $item->beforeDisplayContent; ?>

	<?php if ($params->get('show_introtext', '1')) : ?>
		<?php // echo $item->introtext; ?>

		<?php
			$introtext  = strip_tags($item->introtext);

			if (strlen($introtext) > 200) {
				$introtext = $introtext." ";
				$introtext = substr($introtext,0,200);
				$introtext = substr($introtext,0,strrpos($introtext,' '));
				$introtext = $introtext." [...]";
			}

			echo '<p>'.$introtext.'</p>';
		?>

	<?php endif; ?>

	<?php echo $item->afterDisplayContent; ?>

	</div>

	<footer>
	<?php // if (isset($item->link) && $item->readmore != 0 && $params->get('readmore')) : ?>
		<?php echo '<p class="readmore"><a class="btn" href="' . $item->link . '"><i class="fa fa-chevron-right" aria-hidden="true"></i></a></p>'; ?>
	<?php // endif; ?>
	</footer>

</div>
