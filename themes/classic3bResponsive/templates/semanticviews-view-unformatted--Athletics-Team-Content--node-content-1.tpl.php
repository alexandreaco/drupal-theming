<?php
// $Id: semanticviews-view-unformatted.tpl.php,v 1.1.2.3 2009/09/19 22:33:48 bangpound Exp $
/**
 * @file views-view-unformatted.tpl.php
 * Default simple view template to display a list of rows.
 *
 * @ingroup views_templates
 */
 
 /* set initial record variables */
 $team_wins = 0;
 $team_losses = 0; 
 $team_ties = 0;
 
?>
<?php foreach ($rows as $id => $row): ?>
  <?php 
  	if(strpos($row, 'Win') > 0) {
  		$team_wins++;
  		//print 'WIN';
  	} else if(strpos($row, 'Loss') > 0) {
  		$team_losses++;
  		//print 'LOSS';
  	} else if(strpos($row, 'Tie') > 0) {
  		$team_ties++;
  		//print 'TIE';
  	}
  ?>
<?php endforeach; ?>
<div class="team_record team_wins">
	<label>Wins</label>
	<b class="wlt_count"><?php print $team_wins; ?></b>
</div>
<div class="team_record team_losses">
	<label>Losses</label>
	<b class="wlt_count"><?php print $team_losses; ?></b>
</div>
<div class="team_record team_ties">
	<label>Ties</label>
	<b class="wlt_count"><?php print $team_ties; ?></b>
</div>
