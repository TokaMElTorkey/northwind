<?php
	$currDir = dirname(__FILE__);
	require("{$currDir}/incCommon.php");
	include("{$currDir}/incHeader.php");

	if($_GET['searchGroups'] != ""){
		$searchSQL = makeSafe($_GET['searchGroups']);
		$searchHTML = htmlspecialchars($_GET['searchGroups']);
		$where = "where name like '%$searchSQL%' or description like '%$searchSQL%'";
	}else{
		$searchSQL = '';
		$searchHTML = '';
		$where = "";
	}

	$numGroups = sqlValue("select count(1) from membership_groups $where");
	if(!$numGroups && $searchSQL != ''){
		echo "<div class=\"status\">{$Translation['no matching results found']}</div>";
		$noResults = true;
		$page = 1;
	}else{
		$noResults = false;
	}

	$page = intval($_GET['page']);
	if($page < 1){
		$page = 1;
	}elseif($page > ceil($numGroups / $adminConfig['groupsPerPage']) && !$noResults){
		redirect("admin/pageViewGroups.php?page=" . ceil($numGroups / $adminConfig['groupsPerPage']));
	}

	$start = ($page - 1) * $adminConfig['groupsPerPage'];

?>
<div class="page-header"><h1><?php echo $Translation['groups'] ; ?></h1></div>

<table class="table table-striped">
<thead>
	<tr>
		<td colspan="5" align="center">
			<form method="get" action="pageViewGroups.php" class="form-inline">
				<div class="form-group">
					<label><?php echo $Translation['search groups'] ; ?></label>
					<input class="form-control" type="text" style="width: auto !important;" name="searchGroups" value="<?php echo $searchHTML; ?>">
				</div>
				<button type="submit" class="btn btn-primary"><?php echo $Translation['find'] ; ?></button>
				<button type="button" class="btn btn-warning" onClick="window.location='pageViewGroups.php';"><?php echo $Translation['reset'] ; ?></button>
				<input type="hidden" name="page" value="1">
				</form>
			</td>
		</tr>
	<tr>
		<td class="tdHeader">&nbsp;</td>
		<td class="tdHeader"><div class="ColCaption"><?php echo $Translation["group"]  ; ?></div></td>
		<td class="tdHeader"><div class="ColCaption"><?php echo $Translation["description"] ; ?></div></td>
		<td class="tdHeader"><div class="ColCaption"><?php echo $Translation['members count'] ; ?></div></td>
		<td class="tdHeader">&nbsp;</td>
		</tr>
		</thead>
<?php

	$res = sql("select groupID, name, description from membership_groups $where limit $start, ".$adminConfig['groupsPerPage'], $eo);
	while( $row = db_fetch_row($res)){
		$groupMembersCount = sqlValue("select count(1) from membership_users where groupID='$row[0]'");
		?>
		<tr>
			<td class="tdCaptionCell" align="left">
				<a href="pageEditGroup.php?groupID=<?php echo $row[0]; ?>"><i class="glyphicon glyphicon-edit" title="<?php echo $Translation['Edit group'] ; ?>"></i></a>
				<?php
					if(!$groupMembersCount){
						?>
						<a href="pageDeleteGroup.php?groupID=<?php echo $row[0]; ?>" onClick="return confirm('<?php echo $Translation['confirm delete group'] ; ?>');"><i class="glyphicon glyphicon-trash" title="<?php echo $Translation['delete group'] ; ?>"></i></a>
						<?php
					}else{
						echo "&nbsp; &nbsp;";
					}
				?>
				</td>
			<td class="tdCell" align="left"><a href="pageEditGroup.php?groupID=<?php echo $row[0]; ?>"><?php echo $row[1]; ?></a></td>
			<td class="tdCell" align="left"><?php echo thisOr($row[2]); ?></td>
			<td align="right" class="tdCell">
				<?php echo $groupMembersCount; ?>
				</td>
			<td class="tdCaptionCell" align="left">
				<a href="pageEditMember.php?groupID=<?php echo $row[0]; ?>"><i class="glyphicon glyphicon-plus-sign" title="<?php echo $Translation["add new member"] ; ?>"></i></a>
				<a href="pageViewRecords.php?groupID=<?php echo $row[0]; ?>"><i class="glyphicon glyphicon-th" title="<?php echo $Translation['view group records'] ; ?>"></i></a>
				<?php if($groupMembersCount){ ?>
				<a href="pageViewMembers.php?groupID=<?php echo $row[0]; ?>"><i class="glyphicon glyphicon-user" title="<?php echo $Translation['view group members'] ; ?>"></i></a>
				<a href="pageMail.php?groupID=<?php echo $row[0]; ?>"><i class="glyphicon glyphicon-envelope" title="<?php echo $Translation['send message to group'] ; ?>"></i></a>
				<?php } ?>
				</td>
			</tr>
		<?php
	}
	?>
	<tfoot>
	<tr>
		<td colspan="5" class="noTop">
			<table width="100.4%" cellspacing="0">
				<tr>
				<td align="left" class="tdFooter">
					<input type="button" onClick="window.location='pageViewGroups.php?searchGroups=<?php echo $searchHTML; ?>&page=<?php echo ($page>1 ? $page-1 : 1); ?>';" value="<?php echo $Translation['previous'] ; ?>">
					</td>
				<td align="center" class="tdFooter">
					<?php 
						$originalValues =  array ('<GROUPNUM1>','<GROUPNUM2>','<GROUPS>' );
						$replaceValues = array ( $start+1 , $start+db_num_rows($res) , $numGroups );
						echo str_replace ( $originalValues , $replaceValues , $Translation['displaying groups'] );
					?>
				</td>
				<td align="right" class="tdFooter">
					<input type="button" onClick="window.location='pageViewGroups.php?searchGroups=<?php echo $searchHTML; ?>&page=<?php echo ($page<ceil($numGroups/$adminConfig['groupsPerPage']) ? $page+1 : ceil($numGroups/$adminConfig['groupsPerPage'])); ?>';" value="<?php echo $Translation['next'] ; ?>">
				</td>
			</tr></table></td>
		</tr>
		</tfoot>
	</table>
	
	<div class="row">
	<div class="heading">
		<b><?php echo $Translation['key'] ; ?></b>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-12"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span>  <?php echo $Translation['edit group details'] ; ?></div>
			<div class="col-sm-6 col-xs-12"><span class="glyphicon glyphicon-trash" aria-hidden="true"></span>  <?php echo $Translation['delete group'] ; ?></div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-12"><span class="glyphicon glyphicon-plus-sign" aria-hidden="true"></span>  <?php echo $Translation['add member to group'] ; ?></div>
			<div class="col-sm-6 col-xs-12"><span class="glyphicon glyphicon-th" aria-hidden="true"></span>  <?php echo $Translation['view data records'] ; ?></div>
		</div>
		<div class="row">
			<div class="col-sm-6 col-xs-12"><span class="glyphicon glyphicon-user" aria-hidden="true"></span>  <?php echo $Translation['list group members'] ; ?></div>
			<div class="col-sm-6 col-xs-12"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span>  <?php echo $Translation['send email to all members'] ; ?></div>
		</div>
	</div>
	
	<style>
		.row {
			line-height:3;
			margin-left:0px !important;
			margin-right:0px !important;
		}
		.noTop{
			padding-top:0px !important;
		}
	</style>
<?php
	include("{$currDir}/incFooter.php");
?>