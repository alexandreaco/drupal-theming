<?php
// $Id: template.php,v 1.17.2.1 2009/02/13 06:47:44 johnalbin Exp $

/**
 * @file
 * Contains theme override functions and preprocess functions for the theme.
 *
 * ABOUT THE TEMPLATE.PHP FILE
 *
 *   The template.php file is one of the most useful files when creating or
 *   modifying Drupal themes. You can add new regions for block content, modify
 *   or override Drupal's theme functions, intercept or make additional
 *   variables available to your theme, and create custom PHP logic. For more
 *   information, please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/theme-guide
 *
 * OVERRIDING THEME FUNCTIONS
 *
 *   The Drupal theme system uses special theme functions to generate HTML
 *   output automatically. Often we wish to customize this HTML output. To do
 *   this, we have to override the theme function. You have to first find the
 *   theme function that generates the output, and then "catch" it and modify it
 *   here. The easiest way to do it is to copy the original function in its
 *   entirety and paste it here, changing the prefix from theme_ to schoolyardResponsive_.
 *   For example:
 *
 *     original: theme_breadcrumb()
 *     theme override: schoolyardResponsive_breadcrumb()
 *
 *   where schoolyardResponsive is the name of your sub-theme. For example, the
 *   zen_classic theme would define a zen_classic_breadcrumb() function.
 *
 *   If you would like to override any of the theme functions used in Zen core,
 *   you should first look at how Zen core implements those functions:
 *     theme_breadcrumbs()      in zen/template.php
 *     theme_menu_item_link()   in zen/template.php
 *     theme_menu_local_tasks() in zen/template.php
 *
 *   For more information, please visit the Theme Developer's Guide on
 *   Drupal.org: http://drupal.org/node/173880
 *
 * CREATE OR MODIFY VARIABLES FOR YOUR THEME
 *
 *   Each tpl.php template file has several variables which hold various pieces
 *   of content. You can modify those variables (or add new ones) before they
 *   are used in the template files by using preprocess functions.
 *
 *   This makes THEME_preprocess_HOOK() functions the most powerful functions
 *   available to themers.
 *
 *   It works by having one preprocess function for each template file or its
 *   derivatives (called template suggestions). For example:
 *     THEME_preprocess_page    alters the variables for page.tpl.php
 *     THEME_preprocess_node    alters the variables for node.tpl.php or
 *                              for node-forum.tpl.php
 *     THEME_preprocess_comment alters the variables for comment.tpl.php
 *     THEME_preprocess_block   alters the variables for block.tpl.php
 *
 *   For more information on preprocess functions and template suggestions,
 *   please visit the Theme Developer's Guide on Drupal.org:
 *   http://drupal.org/node/223440
 *   and http://drupal.org/node/190815#template-suggestions
 */


/*
 * Add any conditional stylesheets you will need for this sub-theme.
 *
 * To add stylesheets that ALWAYS need to be included, you should add them to
 * your .info file instead. Only use this section if you are including
 * stylesheets based on certain conditions.
 */
/* -- Delete this line if you want to use and modify this code
// Example: optionally add a fixed width CSS file.
if (theme_get_setting('schoolyardResponsive_fixed')) {
  drupal_add_css(path_to_theme() . '/layout-fixed.css', 'theme', 'all');
}
// */


/**
 * Implementation of HOOK_theme().
 */
function schoolyardResponsive_theme(&$existing, $type, $theme, $path) {
  $hooks = zen_theme($existing, $type, $theme, $path);
  // Add your theme hooks like this:
  /*
  $hooks['hook_name_here'] = array( // Details go here );
  */
  // @TODO: Needs detailed comments. Patches welcome!
  return $hooks;
}

/**
 * Override or insert variables into all templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered (name of the .tpl.php file.)
 */
/* -- Delete this line if you want to use this function
function schoolyardResponsive_preprocess(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the page templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("page" in this case.)
 */
/* -- Delete this line if you want to use this function
function schoolyardResponsive_preprocess_page(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the node templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("node" in this case.)
 */
/* -- Delete this line if you want to use this function
function schoolyardResponsive_preprocess_node(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the comment templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("comment" in this case.)
 */
/* -- Delete this line if you want to use this function
function schoolyardResponsive_preprocess_comment(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

/**
 * Override or insert variables into the block templates.
 *
 * @param $vars
 *   An array of variables to pass to the theme template.
 * @param $hook
 *   The name of the template being rendered ("block" in this case.)
 */
/* -- Delete this line if you want to use this function
function schoolyardResponsive_preprocess_block(&$vars, $hook) {
  $vars['sample_variable'] = t('Lorem ipsum.');
}
// */

  
function schoolyardResponsive_preprocess_page(&$vars, $hook) {
  if ($vars['node']->type != "") {
    $vars['template_files'][] = "page-node-" . $vars['node']->type;
  }

  foreach (taxonomy_node_get_terms($vars['node']) as $term) {
    $terms[] = l($term->name, 'taxonomy/term/'. $term->tid);
  }
  $vars['terms'] = theme('item_list', $terms);
}




	/**
	* Override or insert PHPTemplate variables into the search_theme_form template.
	*
	* @param $vars
	*   A sequential array of variables to pass to the theme template.
	* @param $hook
	*   The name of the theme function being called (not used in this case.)
	*/
	  
	function schoolyardResponsive_preprocess_search_theme_form(&$vars, $hook) {
	  
	  // Modify elements of the search form
	  $vars['form']['search_theme_form']['#title'] = t('Search mysite.com');
	  
	  // Set a default value for the search box
	  $vars['form']['search_theme_form']['#value'] = t('search');
	  
	  // Add a custom class to the search box
	  $vars['form']['search_theme_form']['#attributes'] = array('class' => t('cleardefault'), 'onfocus' => "if (this.value == 'search') {this.value = '';}", 'onblur' => "if (this.value == '') {this.value = 'search';}" );
	  
	  // Change the text on the submit button
	  $vars['form']['submit']['#value'] = t('search');
	  
	  // Rebuild the rendered version (search form only, rest remains unchanged)
	  unset($vars['form']['search_theme_form']['#printed']);
	  $vars['search']['search_theme_form'] = drupal_render($vars['form']['search_theme_form']);
	  
	  // Rebuild the rendered version (submit button, rest remains unchanged)
	  unset($vars['form']['submit']['#printed']);
	  $vars['search']['submit'] = drupal_render($vars['form']['submit']);
	  
	  // Collect all form elements to make it easier to print the whole form.
	  $vars['search_form'] = implode($vars['search']);
	}


/* The following function removes the ':' from labels in forms - originally found here: http://drupal.org/node/293908 */
function schoolyardResponsive_form_element($element, $value) {
  // This is also used in the installer, pre-database setup.
  $t = get_t();

  $output = '<div class="form-item"';
  if (!empty($element['#id'])) {
    $output .= ' id="'. $element['#id'] .'-wrapper"';
  }
  $output .= ">\n";
  $required = !empty($element['#required']) ? '<span class="form-required" title="'. $t('This field is required.') .'">*</span>' : '';

  if (!empty($element['#title'])) {
    $title = $element['#title'];
    if (!empty($element['#id'])) {
      $output .= ' <label for="'. $element['#id'] .'">'. $t('!title !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
    else {
      $output .= ' <label>'. $t('!title !required', array('!title' => filter_xss_admin($title), '!required' => $required)) ."</label>\n";
    }
  }

  $output .= " $value\n";

  if (!empty($element['#description'])) {
    $output .= ' <div class="description">'. $element['#description'] ."</div>\n";
  }

  $output .= "</div>\n";

  return $output;
}



/**
 * Primary theme function (modified from upload.module)
 */
function shiny_upload_upload_attachments($files) {
  $header = array(t('Attachment'), t('Size'));
  $file_output = array();
  foreach ($files as $file) {
    $file = (object)$file;
    if ($file->list && empty($file->remove)) {
			$file_url = file_create_url($file->filepath);
      $text = shiny_upload_file_icon($file) . $file->description ? $file->description : $file->filename;
      $file_link = '<div class="file-link">'.  l(shiny_upload_file_icon($file) . $text, $file_url, array('attributes' => array('target' => '_blank'), 'html' => 'true')) . '</div>';
      $file_metadata = '<div class="file-metadata"><span class="file-name">' . $file->filename . ' <span class="file-size" >' . format_size($file->filesize) . 
      '</span></div>';
      
      $file_output[] = '<div class="file-file">' . $file_link . $file_metadata . '</div>';
    }
  }
  
  if (count($file_output)) {
    return '<div class="file-uploads"><h3>Downloads</h3>' .  implode("\n", $file_output) . '</div>';
  }
}




// The following has been modified from the filefield module
// $Id: filefield.module,v 1.138 2008/08/01 04:58:59 dopry Exp $

/**
 * Return an image with an appropriate icon for the given file.
 * Remember to pass a file object and not an array.
 */
function shiny_upload_file_icon($file) {
  if (is_object($file)) {
    $file = (array) $file;
  }
  $mime = check_plain($file['filemime']);

  $dashed_mime = strtr($mime, array('/' => '-'));

  if ($icon_url = _shiny_upload_icon_url($file)) {
    $icon = '<img class="field-icon-'. $dashed_mime .'"  alt="'. $mime .' icon" src="'. $icon_url .'" />';
  }
  return '<span class="filefield-icon field-icon-'. $dashed_mime .'">'. $icon .'</span>';
}

function _shiny_upload_icon_url($file) {
  global $base_url;
  $theme = 'protocons';  //default to the default icons

  if ($iconpath = _shiny_upload_icon_path($file, $theme)) {
    return $base_url .'/'. $iconpath;
  }
  return FALSE;
}

function _shiny_upload_icon_path($file, $theme = 'protocons') {
  // If there's an icon matching the exact mimetype, go for it.
  $dashed_mime = strtr($file['filemime'], array('/' => '-'));
  if ($iconpath = _shiny_upload_create_icon_path($dashed_mime, $theme)) {
    return $iconpath;
  }
  // For a couple of mimetypes, we can "manually" tell a generic icon.
  if ($generic_name = _shiny_upload_generic_icon_map($file)) {
    if ($iconpath = _shiny_upload_create_icon_path($generic_name, $theme)) {
      return $iconpath;
    }
  }
  // Use generic icons for each category that provides such icons.
  foreach (array('audio', 'image', 'text', 'video') as $category) {
    if (strpos($file['filemime'], $category .'/') === 0) {
      if ($iconpath = _shiny_upload_create_icon_path($category .'-x-generic', $theme)) {
        return $iconpath;
      }
    }
  }
  // Try application-octet-stream as last fallback.
  if ($iconpath = _shiny_upload_create_icon_path('application-octet-stream', $theme)) {
    return $iconpath;
  }
  // Sorry, no icon can be found...
  return FALSE;
}

function _shiny_upload_create_icon_path($iconname, $theme = 'protocons') {
  $iconpath = path_to_theme()
    .'/shiny_upload/file-icons/'. $theme .'/16x16/mimetypes/'. $iconname .'.png';
    
  if (file_exists($iconpath)) {
    return $iconpath;
  }
  return FALSE;
}

/* functions for document attachment icons */

function _shiny_upload_generic_icon_map($file) {
  switch ($file['filemime']) {
    // Word document types.
    case 'application/msword':
    case 'application/vnd.ms-word.document.macroEnabled.12':
    case 'application/vnd.oasis.opendocument.text':
    case 'application/vnd.oasis.opendocument.text-template':
    case 'application/vnd.oasis.opendocument.text-master':
    case 'application/vnd.oasis.opendocument.text-web':
    case 'application/vnd.openxmlformats-officedocument.wordprocessingml.document':
    case 'application/vnd.stardivision.writer':
    case 'application/vnd.sun.xml.writer':
    case 'application/vnd.sun.xml.writer.template':
    case 'application/vnd.sun.xml.writer.global':
    case 'application/vnd.wordperfect':
    case 'application/x-abiword':
    case 'application/x-applix-word':
    case 'application/x-kword':
    case 'application/x-kword-crypt':
      return 'x-office-document';

    // Spreadsheet document types.
    case 'application/vnd.ms-excel':
    case 'application/vnd.ms-excel.sheet.macroEnabled.12':
    case 'application/vnd.oasis.opendocument.spreadsheet':
    case 'application/vnd.oasis.opendocument.spreadsheet-template':
    case 'application/vnd.openxmlformats-officedocument.spreadsheetml.sheet':
    case 'application/vnd.stardivision.calc':
    case 'application/vnd.sun.xml.calc':
    case 'application/vnd.sun.xml.calc.template':
    case 'application/vnd.lotus-1-2-3':
    case 'application/x-applix-spreadsheet':
    case 'application/x-gnumeric':
    case 'application/x-kspread':
    case 'application/x-kspread-crypt':
      return 'x-office-spreadsheet';

    // Presentation document types.
    case 'application/vnd.ms-powerpoint':
    case 'application/vnd.ms-powerpoint.presentation.macroEnabled.12':
    case 'application/vnd.oasis.opendocument.presentation':
    case 'application/vnd.oasis.opendocument.presentation-template':
    case 'application/vnd.openxmlformats-officedocument.presentationml.presentation':
    case 'application/vnd.stardivision.impress':
    case 'application/vnd.sun.xml.impress':
    case 'application/vnd.sun.xml.impress.template':
    case 'application/x-kpresenter':
      return 'x-office-presentation';

    // Compressed archive types.
    case 'application/zip':
    case 'application/x-zip':
    case 'application/stuffit':
    case 'application/x-stuffit':
    case 'application/x-7z-compressed':
    case 'application/x-ace':
    case 'application/x-arj':
    case 'application/x-bzip':
    case 'application/x-bzip-compressed-tar':
    case 'application/x-compress':
    case 'application/x-compressed-tar':
    case 'application/x-cpio-compressed':
    case 'application/x-deb':
    case 'application/x-gzip':
    case 'application/x-java-archive':
    case 'application/x-lha':
    case 'application/x-lhz':
    case 'application/x-lzop':
    case 'application/x-rar':
    case 'application/x-rpm':
    case 'application/x-tzo':
    case 'application/x-tar':
    case 'application/x-tarz':
    case 'application/x-tgz':
      return 'package-x-generic';

    // Script file types.
    case 'application/ecmascript':
    case 'application/javascript':
    case 'application/mathematica':
    case 'application/vnd.mozilla.xul+xml':
    case 'application/x-asp':
    case 'application/x-awk':
    case 'application/x-cgi':
    case 'application/x-csh':
    case 'application/x-m4':
    case 'application/x-perl':
    case 'application/x-php':
    case 'application/x-ruby':
    case 'application/x-shellscript':
    case 'text/vnd.wap.wmlscript':
    case 'text/x-emacs-lisp':
    case 'text/x-haskell':
    case 'text/x-literate-haskell':
    case 'text/x-lua':
    case 'text/x-makefile':
    case 'text/x-matlab':
    case 'text/x-python':
    case 'text/x-sql':
    case 'text/x-tcl':
      return 'text-x-script';

    // HTML aliases.
    case 'application/xhtml+xml':
      return 'text-html';

    // Executable types.
    case 'application/x-macbinary':
    case 'application/x-ms-dos-executable':
    case 'application/x-pef-executable':
      return 'application-x-executable';

    default:
      return FALSE;
  }
}

//remove (all day) label provided by date module for dates that dont have an hour set. MUST HAVE SPAN TAG
function schoolyardResponsive_date_all_day_label() {
  return '<span></span>';
}