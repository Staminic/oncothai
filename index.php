<?php defined( '_JEXEC' ) or die;

include_once JPATH_THEMES.'/'.$this->template.'/inc/logic.php';

?><!doctype html>
<html lang="<?php echo $this->language; ?>">
<head>
<jdoc:include type="head" /><?php include_once JPATH_THEMES.'/'.$this->template.'/inc/head.php'; ?>
</head>

<body id="origin" class="<?php
  echo (($menu->getActive() == $menu->getDefault()) ? ('front') : ('site'))
  . ' ' .$active->alias . ' ' . $pageclass;
  echo ' ' . $option
  . ' view-' . $view
  // . ($layout ? ' layout-' . $layout : ' no-layout')
  // . ($task ? ' task-' . $task : ' no-task')
  . ($itemid ? ' itemid-' . $itemid : '');
  ?>" role="document">

  <header>
    <div class="navbar-header">
      <button type="button" class="navbar-toggle offcanvas-toggle" data-toggle="offcanvas" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <i class="fa fa-bars" aria-hidden="true"></i>
      </button>

      <a class="navbar-brand" href="/"><img src="images/onco-thai-logo.png" alt="logo Onco ThAI" /></a>

      <div class="navbar-misc hidden-xs">
        <jdoc:include type="modules" name="navbar-slogan" />

        <div class="navbar-tools">
          <jdoc:include type="modules" name="navbar-tools" />
        </div>
      </div>
    </div>

    <div id="navbar" class="navbar-offcanvas navbar-offcanvas-fade navbar-offcanvas-touch">
      <div class="visible-xs">
        <jdoc:include type="modules" name="offcanvas-panel-above" />
      </div>
      <jdoc:include type="modules" name="navbar" />
      <div class="clearfix"></div>
    </div>
  </header>

  <div class="main-content">
    <jdoc:include type="message" />
    <jdoc:include type="modules" name="content-above" style="html5"/>
    <jdoc:include type="component" />
    <jdoc:include type="modules" name="content-below" />
  </div>

  <footer>
    <div class="container">
      <div class="flex">
        <div>
          <jdoc:include type="modules" name="footer-1" />
        </div>
        <div>
          <jdoc:include type="modules" name="footer-2" />
        </div>
        <div>
          <jdoc:include type="modules" name="footer-3" />
        </div>
      </div>
    </div>
  </footer>
  <div class="footer-below">
    <div class="container">
      <div class="flex">
        <jdoc:include type="modules" name="footer-below" />
      </div>
    </div>
  </div>

	<jdoc:include type="modules" name="debug" />
</body>

</html>
