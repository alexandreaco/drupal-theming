<?php
// $Id: simplenews-newsletter-body.tpl.php,v 1.1.2.4 2009/01/02 11:59:33 sutharsan Exp $

/**
 * @file
 * Default theme implementation to format the simplenews newsletter body.
 *
 * Copy this file in your theme directory to create a custom themed body.
 * Rename it to simplenews-newsletter-body--<tid>.tpl.php to override it for a 
 * newsletter using the newsletter term's id.
 *
 * Available variables:
 * - node: Newsletter node object
 * - $body: Newsletter body (formatted as plain text or HTML)
 * - $title: Node title
 * - $language: Language object
 *
 * @see template_preprocess_simplenews_newsletter_body()
 */
 
 if($node->field_sidebar_location[0]['safe'] == 'left') {
 	$sidebar_side = 'left';
 } else {
 	$sidebar_side = 'right';
 }
 
?>
<table cellspacing="0" cellpadding="0" border="0" align="center">
<tr>
    <td id="mail-page" width="100%" align="center">
	  <table cellspacing="0" cellpadding="0" border="0" align="center" id="mail-body">
    <tr>
    <td id="mail-header" align="center" width="800" valign="bottom" style="width:800px;">
		<?php
		$viewName = 'Newsletter_Articles';
		$display_id = 'block_1';
		$myArgs = array($node->nid);
		print views_embed_view($viewName, $display_id, $myArgs);
		?>
		<!--<div id="mail-logo"><img src="<?php print base_path().path_to_theme(); ?>/banner_newsletter.jpg" /></div>-->
	<!-- /mail-header -->
		<table id="newsletter-table" border="0" cellpadding="0" cellspacing="0"
           align="center" width="800">
			<tr valign="top">
				<?php if($sidebar_side == 'left') { ?>
				<td class="newsletter-sidebar">&nbsp;</td>
				<?php }; ?>
				<td class="newsletter-title" valign="top"><h1><?php print
          $title; ?></h1>
				</td>

			</tr>
			<tr valign="top">
				<?php if($sidebar_side == 'right') { ?>
				<td class="newsletter-main <?php if($sidebar_side == 'left') { print
          'sidebar-left'; }
        else { print 'sidebar-right'; } ?>" valign="top">
          <div class="field-field-intro-copy"><?php print $node->field_intro_copy[0]['view']; ?></div>
          <?php
					$viewName = 'Newsletter_Articles';
					$display_id = 'node_content_1';
					$myArgs = array($node->nid);
					print views_embed_view($viewName, $display_id, $myArgs);
					?>
					<?php
					$viewName = 'Newsletter_Articles';
					$display_id = 'node_content_7';
					$myArgs = array($node->nid);
					print views_embed_view($viewName, $display_id, $myArgs);
					?>
					<div class="field-field-bottom-copy"><?php print
            $node->field_bottom_copy[0]['view']; ?></div>
					<div class="clear">&nbsp;</div>
				</td>
				<?php }; ?>
				<td class="newsletter-sidebar <?php if($sidebar_side == 'left') { print 'sidebar-left'; } else { print 'sidebar-right'; } ?>">
          <div class="newsltr_sidebar_block">
      					<?php
      					$viewName = 'Newsletter_Articles';
      					$display_id = 'node_content_2';
      					$myArgs = array($node->nid);
      					print views_embed_view($viewName, $display_id, $myArgs);
      					?>
      		</div>
          <div class="newsltr_sidebar_block">
     					<?php
     					$viewName = 'Newsletter_Articles';
     					$display_id = 'node_content_3';
     					$myArgs = array($node->nid);
     					print views_embed_view($viewName, $display_id, $myArgs);
     					?>
     					</div>
          <div class="newsltr_sidebar_block">
    					<?php
    					$viewName = 'Newsletter_Articles';
    					$display_id = 'node_content_5';
    					$myArgs = array($node->nid);
    					print views_embed_view($viewName, $display_id, $myArgs);
    					?>
    					</div>
    					<div class="newsltr_sidebar_block">
    					<?php
    					$viewName = 'Newsletter_Articles';
    					$display_id = 'node_content_6';
    					$myArgs = array($node->nid);
    					print views_embed_view($viewName, $display_id, $myArgs);
    					?>
    					</div>
				</td>
				<?php if($sidebar_side == 'left') { ?>
				<td class="newsletter-main <?php if($sidebar_side == 'left') { print 'sidebar-left'; } else { print 'sidebar-right'; } ?>">
					<div class="field-field-intro-copy"><?php print $node->field_intro_copy[0]['view']; ?></div>
					<?php
					$viewName = 'Newsletter_Articles';
					$display_id = 'node_content_1';
					$myArgs = array($node->nid);
					print views_embed_view($viewName, $display_id, $myArgs);
					?>
					<?php
					$viewName = 'Newsletter_Articles';
					$display_id = 'node_content_7';
					$myArgs = array($node->nid);
					print views_embed_view($viewName, $display_id, $myArgs);
					?>
					<div class="field-field-bottom-copy"><?php print $node->field_bottom_copy[0]['view']; ?></div>
					<div class="clear">&nbsp;</div>
				</td>
				<?php }; ?>
			</tr>
		</table>

  </td>
  </tr>
</table><!-- /mail-page -->
</td>
</tr>
</table><!-- /mail-body -->
