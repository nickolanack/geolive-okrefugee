<?php
/**
 * @package     Joomla.Site
 * @subpackage  Templates.protostar
 *
 * @copyright   Copyright (C) 2005 - 2015 Open Source Matters, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */
defined('_JEXEC') or die();

error_reporting(E_ERROR | E_PARSE);

$app = JFactory::getApplication();
$doc = JFactory::getDocument();
$user = JFactory::getUser();
$this->language = $doc->language;
$this->direction = $doc->direction;

// Getting params from template
$params = $app->getTemplate(true)->params;

// Detecting Active Variables
$option = $app->input->getCmd('option', '');
$view = $app->input->getCmd('view', '');
$layout = $app->input->getCmd('layout', '');
$task = $app->input->getCmd('task', '');
$itemid = $app->input->getCmd('Itemid', '');
$sitename = $app->get('sitename');

if ($task == "edit" || $layout == "form") {
    $fullWidth = 1;
} else {
    $fullWidth = 0;
}

// Add JavaScript Frameworks
JHtml::_('bootstrap.framework');
$doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/template.js');

// Add Stylesheets
$doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/template.css');

if ($this->countModules('position-7')) {
    $doc->addScript($this->baseurl . '/templates/' . $this->template . '/js/pushmenu.js');
    $doc->addStyleSheet($this->baseurl . '/templates/' . $this->template . '/css/pushmenu.css');
}

// Load optional RTL Bootstrap CSS
JHtml::_('bootstrap.loadCss', false, $this->direction);

// Adjusting content width
if ($this->countModules('position-8')) {
    $span = "span6";
} else {
    $span = "span12";
}

// Logo file or site title param
if ($this->params->get('logoFile')) {
    $logo = '<img src="' . JUri::root() . $this->params->get('logoFile') . '" alt="' . $sitename . '" />';
} elseif ($this->params->get('sitetitle')) {
    $logo = '<span class="site-title" title="' . $sitename . '">' . htmlspecialchars($this->params->get('sitetitle')) .
         '</span>';
} else {
    $logo = '<span class="site-title" title="' . $sitename . '">' . $sitename . '</span>';
}

$googleFont = str_replace(' + ', ' ', $this->params->get('
		 googleFontName '));

?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml"
	xml:lang="<?php echo $this->language; ?>"
	lang="<?php echo $this->language; ?>"
	dir="<?php echo $this->direction; ?>">
<head>
<meta name="viewport" content="width=device-width, initial-scale=1.0" />
<jdoc:include type="head" />
	<?php // Use of Google Font ?>
	<?php if ($this->params->get('googleFont')) : ?>
		<link
	href='//fonts.googleapis.com/css?family=<?php echo $this->params->get('googleFontName'); ?>'
	rel='stylesheet' type='text/css' />
<style type="text/css">
h1, h2, h3, h4, h5, h6, .site-title {
	font-family: '<?php echo $googleFont; ?>', sans-serif;
}
</style>
	<?php endif; ?>
	<?php // Template color ?>
	<?php if ($this->params->get('templateColor')) : ?>
	<style type="text/css">
body.site {
	border-top: 3px solid<?php echo$this->params->get('templateColor'); ?>;
	background-color: <?php echo$this->params->get('templateBackgroundColor');
	?>
}

a {
	color: <?php echo$this->params->get('templateColor');
	?>;
}

.navbar-inner, .nav-list>.active>a, .nav-list>.active>a:hover,
	.dropdown-menu li>a:hover, .dropdown-menu .active>a, .dropdown-menu .active>a:hover,
	.nav-pills>.active>a, .nav-pills>.active>a:hover, .btn-primary {
	background: <?php echo$this->params->get('templateColor');
	?>;
}

.navbar-inner {
	-moz-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0
		rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
	-webkit-box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0
		rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
	box-shadow: 0 1px 3px rgba(0, 0, 0, .25), inset 0 -1px 0
		rgba(0, 0, 0, .1), inset 0 30px 10px rgba(0, 0, 0, .2);
}
</style>
	<?php endif; ?>
	<!--[if lt IE 9]>
		<script src="<?php echo JUri::root(true); ?>/media/jui/js/html5.js"></script>
	<![endif]-->


	<script>
	  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
	  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
	  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
	  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');

	  ga('create', 'UA-77656703-1', 'auto');
	  ga('send', 'pageview');

	</script>
</head>

<body
	class="site <?php

echo $option . ' view-' . $view . ($layout ? ' layout-' . $layout : ' no-layout') .
     ($task ? ' task-' . $task : ' no-task') . ($itemid ? ' itemid-' . $itemid : '') .
     ($params->get('fluidContainer') ? ' fluid' : '');
echo ($this->direction == 'rtl' ? ' rtl' : '');
?>">

	<!-- Body -->
	<div class="body">
		<div
			class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<!-- Header -->
			<header class="header" role="banner">
				<div class="header-inner clearfix">
					<a class="brand pull-left" href="<?php echo $this->baseurl; ?>/">
						<?php echo $logo; ?>
						<?php if ($this->params->get('sitedescription')) : ?>
							<?php echo '<div class="site-description">' . htmlspecialchars($this->params->get('sitedescription')) . '</div>'; ?>
						<?php endif; ?>
					</a>
					<div class="header-search pull-right">
						<jdoc:include type="modules" name="position-0" style="none" />

						<?php

    if ($this->countModules('position-7')) {

        ?>
        <button class="btn btn-primary" id="pushmenu-btn"><?php echo  (JFactory::getUser()->guest?'login - add content':'logout'); ?></button>

        <?php
    }
    ?>

					</div>
				</div>
			</header>
			<?php if ($this->countModules('position-1')) : ?>
				<nav class="navigation" role="navigation">
				<div class="navbar pull-left">
					<a class="btn btn-navbar collapsed" data-toggle="collapse"
						data-target=".nav-collapse"> <span class="icon-bar"></span> <span
						class="icon-bar"></span> <span class="icon-bar"></span>
					</a>
				</div>
				<div class="nav-collapse">
					<jdoc:include type="modules" name="position-1" style="none" />
				</div>
			</nav>
			<?php endif; ?>
			<jdoc:include type="modules" name="banner" style="xhtml" />
			<div class="row-fluid">
				<?php if ($this->countModules('position-8')) : ?>
					<!-- Begin Sidebar -->
				<div id="sidebar" class="span3">
					<div class="sidebar-nav">
						<jdoc:include type="modules" name="position-8" style="xhtml" />
					</div>
				</div>
				<!-- End Sidebar -->
				<?php endif; ?>
				<main id="content" role="main" class="<?php echo $span; ?>"> <!-- Begin Content -->
				<jdoc:include type="modules" name="position-3" style="xhtml" /> <jdoc:include
					type="message" /> <jdoc:include type="component" /> <jdoc:include
					type="modules" name="position-2" style="none" /> <!-- End Content -->
				</main>
				<?php if ($this->countModules('position-7')) : ?>
				<div id="pushmenu-parent"
					style="visibility: hidden; pointer-events: none;">
					<div id="pushmenu" class="row-fluid span3" style="width:350px; overflow:hidden;">

						<div id="aside" class="span3">
							<h3 id="pushmenu-message"></h3>
							<!-- Begin Right Sidebar -->
							<jdoc:include type="modules" name="position-7" style="well" />
							<!-- End Right Sidebar -->
						</div>

					</div>
				</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
	<!-- Footer -->
	<footer class="footer" role="contentinfo">
		<div
			class="container<?php echo ($params->get('fluidContainer') ? '-fluid' : ''); ?>">
			<hr />
			<jdoc:include type="modules" name="footer" style="none" />
			<p class="pull-right">
				<a href="#top" id="back-top">
					<?php echo JText::_('TPL_PROTOSTAR_BACKTOTOP'); ?>
				</a>
			</p>
			<p>
				&copy; <?php echo date('Y'); ?> <?php echo $sitename; ?>
			</p>
		</div>
	</footer>
	<jdoc:include type="modules" name="debug" style="none" />
</body>
</html>
