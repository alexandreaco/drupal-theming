<?php
// $Id: page.tpl.php,v 1.14.2.10 2009/11/05 14:26:26 johnalbin Exp $

/**
 * @file page.tpl.php
 *
 * Theme implementation to display a single Drupal page.
 *
 * Available variables:
 *
 * General utility variables:
 * - $base_path: The base URL path of the Drupal installation. At the very
 *   least, this will always default to /.
 * - $css: An array of CSS files for the current page.
 * - $directory: The directory the theme is located in, e.g. themes/garland or
 *   themes/garland/minelli.
 * - $is_front: TRUE if the current page is the front page. Used to toggle the mission statement.
 * - $logged_in: TRUE if the user is registered and signed in.
 * - $is_admin: TRUE if the user has permission to access administration pages.
 *
 * Page metadata:
 * - $language: (object) The language the site is being displayed in.
 *   $language->language contains its textual representation.
 *   $language->dir contains the language direction. It will either be 'ltr' or 'rtl'.
 * - $head_title: A modified version of the page title, for use in the TITLE tag.
 * - $head: Markup for the HEAD section (including meta tags, keyword tags, and
 *   so on).
 * - $styles: Style tags necessary to import all CSS files for the page.
 * - $scripts: Script tags necessary to load the JavaScript files and settings
 *   for the page.
 * - $body_classes: A set of CSS classes for the BODY tag. This contains flags
 *   indicating the current layout (multiple columns, single column), the current
 *   path, whether the user is logged in, and so on.
 * - $body_classes_array: An array of the body classes. This is easier to
 *   manipulate then the string in $body_classes.
 * - $node: Full node object. Contains data that may not be safe. This is only
 *   available if the current page is on the node's primary url.
 *
 * Site identity:
 * - $front_page: The URL of the front page. Use this instead of $base_path,
 *   when linking to the front page. This includes the language domain or prefix.
 * - $logo: The path to the logo image, as defined in theme configuration.
 * - $site_name: The name of the site, empty when display has been disabled
 *   in theme settings.
 * - $site_slogan: The slogan of the site, empty when display has been disabled
 *   in theme settings.
 * - $mission: The text of the site mission, empty when display has been disabled
 *   in theme settings.
 *
 * Navigation:
 * - $search_box: HTML to display the search box, empty if search has been disabled.
 * - $primary_links (array): An array containing primary navigation links for the
 *   site, if they have been configured.
 * - $secondary_links (array): An array containing secondary navigation links for
 *   the site, if they have been configured.
 *
 * Page content (in order of occurrance in the default page.tpl.php):
 * - $left: The HTML for the left sidebar.
 *
 * - $breadcrumb: The breadcrumb trail for the current page.
 * - $title: The page title, for use in the actual HTML content.
 * - $help: Dynamic help text, mostly for admin pages.
 * - $messages: HTML for status and error messages. Should be displayed prominently.
 * - $tabs: Tabs linking to any sub-pages beneath the current page (e.g., the view
 *   and edit tabs when displaying a node).
 *
 * - $content: The main content of the current Drupal page.
 *
 * - $right: The HTML for the right sidebar.
 *
 * Footer/closing data:
 * - $feed_icons: A string of all feed icons for the current page.
 * - $footer_message: The footer message as defined in the admin settings.
 * - $footer : The footer region.
 * - $closure: Final closing markup from any modules that have altered the page.
 *   This variable should always be output last, after all other dynamic content.
 *
 * @see template_preprocess()
 * @see template_preprocess_page()
 */
?>
<!doctype html>
<!-- paulirish.com/2008/conditional-stylesheets-vs-css-hacks-answer-neither/ -->
<!--[if lt IE 7 ]> <html class="no-js ie6" lang="en" dir="<?php print $language->dir; ?>" xmlns:fb="http://ogp.me/ns/fb#"> <![endif]-->
<!--[if IE 7 ]>    <html class="no-js ie7" lang="en" dir="<?php print $language->dir; ?>" xmlns:fb="http://ogp.me/ns/fb#"> <![endif]-->
<!--[if IE 8 ]>    <html class="no-js ie8" lang="en" dir="<?php print $language->dir; ?>" xmlns:fb="http://ogp.me/ns/fb#"> <![endif]-->
<!--[if (gte IE 9)|!(IE)]><!--> <html class="no-js" lang="en" dir="<?php print $language->dir; ?>" xmlns:fb="http://ogp.me/ns/fb#"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <!-- Mobile viewport optimized: j.mp/bplateviewport -->
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php print $head_title; ?></title>
  <?php print $head; ?>
  <?php print $styles; ?>
  <link type="text/css" rel="stylesheet" media="all" href="<?php print base_path().path_to_theme().'/assets/css/classic4Responsive.css'; ?>" />
  <?php print $scripts; ?>
  <script type="text/javascript" src="http://fast.fonts.net/jsapi/786f3e13-d24a-46a0-91a0-0e5d41cbd14a.js"></script>
  <link href='http://fonts.googleapis.com/css?family=Raleway:400,700' rel='stylesheet' type='text/css'>
</head>
<body class="<?php print $body_classes; ?>">

  <div id="page"><div id="page-inner">

    <header><div id="header-inner" class="clear-block">
    
      <?php if ($alert): ?>
      <div id="alert"><div id="alert-inner" class="region region-alert">
        <?php print $alert; ?>
      </div></div> <!-- /#alert-inner, /#alert -->
    <?php endif; ?>
    
    <?php if ($toolbar): ?>
      <div id="toolbar"><div id="toolbar-inner" class="region region-toolbar">
        <?php print $toolbar; ?>
      </div></div> <!-- /#toolbar-inner, /#toolbar -->
    <?php endif; ?>
    
    <?php if ($logo): ?>
        <div id="logo-title">

          <?php if ($logo): ?>
            <div id="logo"><?php if($is_front) { ?><img src="<?php print base_path().path_to_theme().'/logo.png'; ?>" alt="<?php print t('Home'); ?>" id="logo-image" /><?php } else { ?><a href="<?php print $front_page; ?>" title="<?php print t('Home'); ?>"><img src="<?php print $logo; ?>" alt="<?php print t('Home'); ?>" id="logo-image" /></a><?php }; ?></div>
          <?php endif; ?>

        </div> <!-- /#logo-title -->
      <?php endif; ?>
      
      <?php if ($header): ?>
        <div id="header-blocks" class="region region-header">
          <?php print $header; ?>
        </div> <!-- /#header-blocks -->
      <?php endif; ?>

     
      
      <div id="navbar"><div id="navbar-inner" class="clear-block region region-navbar">

      <?php if ($primary_links): ?>
        <div id="primary" class="clear-block">
          <?php print theme('links', $primary_links); ?>
        </div> <!-- /#primary -->
      <?php endif; ?>

      <?php if ($secondary_links): ?>
        <div id="secondary" class="clear-block">
          <?php print theme('links', $secondary_links); ?>
        </div> <!-- /#secondary -->
      <?php endif; ?>

      <?php print $navbar; ?>

    </div></div> <!-- /#navbar-inner, /#navbar -->

    </div></header> <!-- /#header-inner, /#header -->    

    <div id="main">
		
      <div id="content-top" class="region region-content_top">
        
        <?php if ($title): ?>
          <h1 class="title"><?php print $title; ?></h1>
        <?php endif; ?>
        <?php if ($content_top): ?>
        	<?php print $content_top; ?>
        <?php endif; ?>
      </div> <!-- /#content-top -->  
    
    <div id="main-inner" class="clear-block<?php if ($search_box || $primary_links || $secondary_links || $navbar) { print ' with-navbar'; } ?>">
		
		<?php if ($left): ?>
        <div id="sidebar-left"><div id="sidebar-left-inner" class="region region-left">
          <?php print $left; ?>
        </div></div> <!-- /#sidebar-left-inner, /#sidebar-left -->
	    <?php endif; ?>


      <div id="content"><div id="content-inner">

        	      
        <?php if ($breadcrumb || $title || $tabs || $help || $messages): ?>
          <div id="content-header">
            <?php if ($breadcrumb): ?>
            <?php print $breadcrumb; ?>
            <?php endif; ?>
            <?php print $messages; ?>
            <?php if ($tabs): ?>
              <div class="tabs"><?php print $tabs; ?></div>
            <?php endif; ?>
            <?php print $help; ?>
          </div> <!-- /#content-header -->
        <?php endif; ?>


        <div id="content-area">
          <?php print $content; ?>
        <div class="clear"></div>
        </div>

        <?php if ($feed_icons): ?>
          <div class="feed-icons"><?php print $feed_icons; ?></div>
        <?php endif; ?>

        <?php if ($content_bottom): ?>
          <div id="content-bottom" class="region region-content_bottom">
            <?php print $content_bottom; ?>
			<div class="clear"></div>
          </div> <!-- /#content-bottom -->
        <?php endif; ?>
      </div></div> <!-- /#content-inner, /#content -->

      
      <?php if ($right): ?>
        <div id="sidebar-right"><div id="sidebar-right-inner" class="region region-right">
          <?php print $right; ?>
        </div></div> <!-- /#sidebar-right-inner, /#sidebar-right -->
      <?php endif; ?>

    </div></div> <!-- /#main-inner, /#main -->

    <?php if ($footer || $footer_message): ?>
      <footer><div id="footer-inner" class="region region-footer">

        <?php if ($footer_message): ?>
          <div id="footer-message"><?php print $footer_message; ?></div>
        <?php endif; ?>

        <?php print $footer; ?>
        
        <?php if ($closure_region): ?>
			    <?php print $closure_region; ?>
			  <?php endif; ?>
        
		<div class="clear">&nbsp;</div>
      </div></footer> <!-- /#footer-inner, /#footer -->
    <?php endif; ?>
<div class="clear">&nbsp;</div>
  </div></div> <!-- /#page-inner, /#page -->

  
  
  <?php print $closure; ?>

</body>
</html>