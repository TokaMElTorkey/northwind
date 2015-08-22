<?php

	// incHeader.php
	$Translation['membership management'] = "Membership Management";
	$Translation['password mismatch'] = "Password doesn\'t match.";
	$Translation['error'] = "Error";
	$Translation['invalid email'] = "Invalid Email Address";
	$Translation['sending mails'] = "Sending mails might take some time. Please don't close this page until you see the 'Done' message.";
	$Translation['complete step 4'] = "Please complete step 4 by selecting the member you want to transfer records to.";
	$Translation['info'] = "Info";
	
	$Translation['sure move member'] = 'Are you sure you want to move member \'<MEMBER>\' and his data from group \'<OLDGROUP>\' to group \'<NEWGROUP>\'?';
	$Translation['sure move data of member'] = 'Are you sure you want to move data of member \'<OLDMEMBER>\' from group \'<OLDGROUP>\' to member \'<NEWMEMBER>\' from group \'<NEWGROUP>\'?';
	
	$Translation['sure move all members'] = 'Are you sure you want to move all members and data from group \'<OLDGROUP>\' to group \'<NEWGROUP>\'?';
	$Translation['sure move data of all members'] = 'Are you sure you want to move data of all members of group \'<OLDGROUP>\' to member \'<MEMBER>\' from group \'<NEWGROUP>\'?';
		
	$Translation['toggle navigation'] = "Toggle navigation";
	$Translation['admin area'] = "Admin Area";
	$Translation['groups'] = "Groups";
	$Translation['view groups'] = "View Groups";
	$Translation['add group'] = "Add Group";
	$Translation['edit anonymous permissions'] = "Edit Anonymous Permissions";
	$Translation['members'] = "Members";
	$Translation['view members'] = "View Members";
	$Translation['add member'] = "Add Member";
	$Translation["view members' records"] = "View Members\' Records";  
	$Translation["utilities"] = "Utilities"; 
	$Translation["admin settings"] = "Admin Settings"; 
	$Translation["rebuild thumbnails"] = "Rebuild Thumbnails"; 
	$Translation['rebuild fields'] = "Rebuild fields";
	$Translation['import CSV'] = "Import CSV data";
	$Translation['batch transfer'] = "Batch Transfer Wizard";
	$Translation['mail all users'] = "Mail All Users";
	$Translation['AppGini forum'] = "AppGini Community Forum";
	$Translation["user's area"] = "User\'s area";
	$Translation["sign out"] = "Sign out";
	
	$Translation["attention"] = "Attention!";
	$Translation['security risk admin'] = 'You are using the default admin username and password. This is a huge security risk. Please change at least the admin password from the <a href="pageSettings.php">Admin Settings</a> page <em>immediately</em>.';
	$Translation['security risk'] = 'You are using the default admin password. This is a huge security	risk. Please change the admin password from the <a href="pageSettings.php">Admin Settings</a> page <em>immediately</em>.' ;
	
	
	//pageAssignOwners.php
	$Translation["assigned table records to group"] = "Assigned <NUMBER> records of table '<TABLE>' to group '<GROUP>'";
	$Translation["assigned table records to group and member"] = "Assigned <NUMBER> records of table '<TABLE>' to group '<GROUP>' , member '<MEMBERID>'";
	
	$Translation['data ownership assign'] = "Assign ownership to data that has no owners";
	$Translation['records ownership done'] = "All records in all tables have owners now.<br>Back to <a href='pageHome.php'>Admin homepage</a>.";
	$Translation['select group'] = "Select group";
	$Translation['data ownership'] = "Sometimes, you might have tables with data that were entered before implementing this AppGini membership management system, or entered using other applications unaware of AppGini ownership system. This data currently has no owners. This page allows you to assign owner groups and owner members to this data.";
	
	$Translation["table"] = "Table";
	$Translation["records with no owners"] = "Records with no owners";
	$Translation["new owner group"] = "New owner group";
	$Translation["new owner member"] = "New owner member*";	
	$Translation["cancel"] = "Cancel";
	$Translation["assign new owners"] = "Assign new owners";
	$Translation["please wait"] = "Please wait ...";	
	$Translation["if no owner member assigned"] = '* If you assign no owner member here, you can still use the <a href="pageTransferOwnership.php">Batch Transfer Wizard</a> later to do so.';
	
	//pageDeleteGroup.php
	$Translation["can not delete group remove members"] = "Can\'t delete this group. Please remove members first.";
	$Translation["can not delete group transfer records"] = "Can\'t delete this group. Please transfer its data records to another group first..";
	
	//pageEditGroup.php
	$Translation["group exists error"] = "Error: Group name already exists. You must choose a unique group name.";
	$Translation["group not found error"] = "Error: Group not found!";								 	
	$Translation["edit group"] = "Edit Group '<GROUPNAME>'";
	$Translation["add new group"] = "Add New Group";
	$Translation["anonymous group attention"] = "Attention! This is the anonymous group.";
	$Translation["show tool tips"] = "Show tool tips as mouse moves over options";
	$Translation["group name"] = "Group name";
	$Translation["readonly"] = "readonly";
	$Translation["readonly group name"] = "The name of the anonymous group is read-only here.";
	$Translation["anonymous group name"] = "If you name the group '<ANONYMOUSGROUP>', it will be considered the anonymous group<br>that defines the permissions of guest visitors that do not log into the system.";
	
	$Translation["description"] = "Description";
	$Translation["allow visitors sign up"] = 'Allow visitors to sign up?';
	$Translation["admin add users"] = "No. Only the admin can add users.";
	$Translation["admin approve users"] = "Yes, and the admin must approve them.";
	$Translation["automatically approve users"] = "Yes, and automatically approve them.";
	$Translation["group table permissions"] = "Table permissions for this group";
	$Translation["no"] = "No";
	$Translation["owner"] = "Owner";
	$Translation["group"] = "Group";
	$Translation["all"] = "All";
	$Translation["insert"] = "Insert";
	$Translation["view"] = "View";
	$Translation["edit"] = "Edit";
	$Translation["delete"] = "Delete";
	$Translation["customers"] = "Customers";
	$Translation["employees"] = "Employees";
	$Translation["orders"] = "Orders";
	$Translation["order items"] = "Order Items";
	$Translation["products"] = "Products";
	$Translation["product categories"] = "Product Categories";
	$Translation["suppliers"] = "Suppliers";
	$Translation["shippers"] = "Shippers";
	$Translation["save changes"] = "Save changes";
	

?>
