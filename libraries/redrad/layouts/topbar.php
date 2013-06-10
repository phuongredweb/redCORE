<?php
/**
 * @package     RedRad
 * @subpackage  Layouts
 *
 * @copyright   Copyright (C) 2005 - 2013 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE
 */

defined('JPATH_REDRAD') or die;

$data = $displayData;

// Component title (html) for the toolbar.
$componentTitle = '';

if (isset($data['component_title']))
{
	$componentTitle = $data['component_title'];
}

// Do we have to display an inner layout ?
$displayTopbarInnerLayout = false;

if (isset($data['topbar_inner_layout_display']))
{
	$displayTopbarInnerLayout = (bool) $data['topbar_inner_layout_display'];
}

$topbarInnerLayout = '';

// The topbar inner layout name.
if ($displayTopbarInnerLayout)
{
	if (!isset($data['topbar_inner_layout']))
	{
		throw new InvalidArgumentException('No topbar inner layout specified in the component layout.');
	}

	$topbarInnerLayout = $data['topbar_inner_layout'];
}

$topbarInnerLayoutData = array();

if (isset($data['topbar_inner_layout_data']))
{
	$topbarInnerLayoutData = $data['topbar_inner_layout_data'];
}

$user = JFactory::getUser();
$userName = $user->name;
$userId = $user->id;
?>
<script type="text/javascript">
	jQuery(document).ready(function () {
		setInterval(function () {
			updateDateTime();
		}, 1000);
	});

	function updateDateTime() {
		var date = new Date();
		jQuery('.datetime').text(date.toLocaleString());
	}
</script>
<header class="navbar navbar-fixed-top">
	<div class="navbar-inner">
		<div class="container-fluid">
			<a class="back2joomla" href="<?php echo JRoute::_('index.php') ?>"><i class="icon-undo"></i> Back to Joomla</a>
			<span class="divider-vertical pull-left"></span>
			<a class="brand" href="#"><?php echo $componentTitle ?></a>
			<?php if ($displayTopbarInnerLayout) : ?>
				<?php echo RLayoutHelper::render($topbarInnerLayout, $topbarInnerLayoutData) ?>
			<?php endif; ?>
			<div class="nav-right pull-right">
				<div class="datetime pull-right"></div>
				<span class="divider-vertical pull-right"></span>

				<div class="welcome pull-right">
					<i class="icon-user"></i>
					Welcome <?php echo $userName ?>
				</div>
			</div>
		</div>
	</div>
</header>