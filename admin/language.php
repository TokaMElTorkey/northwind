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
	$Translation["view members' records"] = "View Members' Records";  
	$Translation["utilities"] = "Utilities"; 
	$Translation["admin settings"] = "Admin Settings"; 
	$Translation["rebuild thumbnails"] = "Rebuild Thumbnails"; 
	$Translation['rebuild fields'] = "Rebuild fields";
	$Translation['import CSV'] = "Import CSV data";
	$Translation['batch transfer'] = "Batch Transfer Wizard";
	$Translation['mail all users'] = "Mail All Users";
	$Translation['AppGini forum'] = "AppGini Community Forum";
	$Translation["user's area"] = 'User\'s area';
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
	$Translation["can not delete group remove members"] = 'Can\'t delete this group. Please remove members first.';
	$Translation["can not delete group transfer records"] = 'Can\'t delete this group. Please transfer its data records to another group first..';
	
	//pageEditGroup.php
	$Translation["group exists error"] = "Error: Group name already exists. You must choose a unique group name.";
	$Translation["group not found error"] = "Error: Group not found!";								 	
	$Translation["edit group"] = "Edit Group '<GROUPNAME>'";
	$Translation["add new group"] = "Add New Group";
	$Translation["anonymous group attention"] = "Attention! This is the anonymous group.";
	$Translation["show tool tips"] = "Show tool tips as mouse moves over options";
	$Translation["group name"] = "Group name";
	$Translation["readonly group name"] = "The name of the anonymous group is read-only here.";
	$Translation["anonymous group name"] = "If you name the group '<ANONYMOUSGROUP>', it will be considered the anonymous group<br>that defines the permissions of guest visitors that do not log into the system.";
	
	$Translation["description"] = "Description";
	$Translation["allow visitors sign up"] = 'Allow visitors to sign up?';
	$Translation["admin add users"] = "No. Only the admin can add users.";
	$Translation["admin approve users"] = "Yes, and the admin must approve them.";
	$Translation["automatically approve users"] = "Yes, and automatically approve them.";
	$Translation["group table permissions"] = "Table permissions for this group";
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
	
	
	
	//pageEditMember.php
	$Translation["username error"] = "Error: Username already exists or is invalid. Make sure you provide a username containing 4 to 20 valid characters.";
	$Translation["member not found"] = "Error: Member not found!";
	$Translation["user has special permissions"] = "This user has special permissions that override his group permissions.";
	$Translation["user has group permissions"] = 'This user inherits the <a href="pageEditGroup.php?groupID=<GROUPID>">permissions of his group</a>.';
	$Translation["set user special permissions"] = 'Set special permissions for this user';
	$Translation["sure continue"] = "If you made any changes to this member and did not save them yet, they will be lost if you continue. Are you sure you want to continue?";
	$Translation["edit member"] = "Edit Member <MEMBERID>" ;
	$Translation["add new member"] = "Add New Member";
	$Translation["anonymous guest member"] = "Attention! This is the anonymous (guest) member.";
	$Translation["admin member"] = 'Attention! This is the admin member. You can\'t change the username, password or email of this member here, but you can do so in the <a href="pageSettings.php">admin settings</a> page.';
	
	$Translation["member username"] = "Member username";
	$Translation["read only username"] = "The username of the guest member is read-only.";
	$Translation["password"] = "Password";
	$Translation["change password"] = "Type a password only if you want to change this member\'s<br>password. Otherwise, leave this field empty.";
	$Translation["confirm password"] = "Confirm password";
	$Translation["email"] = "Email";
	$Translation["approved"] = "Approved?";
	$Translation["banned"] = "Banned?";
	$Translation["comments"] = "Comments";
	
	
	//pageEditMemberPermissions.php
	$Translation["member permissions saved"] = "Member permissions have been saved successfully.";
	$Translation["member permissions reset"] = "Member permissions have been reset to the same as his group.";
		
	$Translation["user table permissions"] = "Table permissions for user <a href='pageEditMember.php?memberID=<MEMBER>' title='View member details'><MEMBERID></a> of group <a href='pageEditGroup.php?groupID=<GROUPID>'  title='View group details and permissions'><GROUP></a>";
	
	$Translation["no member permissions"] = 'This member doesn\'t currently have any special permissions. This list shows the permissions of his group.';
	$Translation["reset member permissions"] = "Reset member permissions";
	$Translation["remove special permissions"] = 'This would remove all special permissions of this user and he will have the same permissions as his group. Are you sure you want to do that?';
	
	
	//pageEditOwnership.php
	$Translation["invalid table"] = "Invalid table.";
	$Translation["invalid primary key"] = "Invalid primary key value";
	$Translation["record not found"] = "Record not found ... if it was imported externally, try assigning an owner from the admin area.";
	$Translation["invalid username"] = "Invalid username";
	$Translation["record not found error"] = "Error: Record not found!";
	$Translation["edit Record Ownership"] = "Edit Record Ownership";
	$Translation["owner group"] = "Owner group";
	$Translation["view all records by group"] = "View all records by this group";
	$Translation["owner member"] = "Owner member";
	$Translation["view all records by member"] = "View all records by this member";
	$Translation["switch record ownership"] = "If you want to switch ownership of this record to a member of another group, you must change the owner group and save changes first.";
	$Translation["record created on"] = "Record created on";
	$Translation["record modified on"] = "Record modified on";
	$Translation["view all records of table"] = "View all records of this table";
	$Translation["record data"] = "Record data";
	$Translation["print"] = "Print";
	$Translation["could not retrieve field list"] = "Couldn't retrieve field list from '<TABLENAME>'";
	$Translation["field name"] = "Field name";
	$Translation["value"] = "Value";
	
	
	//pageHome.php
	$Translation["visitor sign up"] = '<a href="../membership_signup.php" target="_blank">Visitor sign up</a> is disabled because there are no groups where visitors can sign up currently. To enable visitor sign-up, set at least one group to allow visitor sign-up.';
	
	$Translation["table data without owner"] = 'You have data in one or more tables that doesn\'t have an owner. To assign an owner group for this data, <a href="pageAssignOwners.php">click here</a>.';
	
	$Translation["membership management homepage"] = "Membership Management Homepage";
	$Translation["newest updates"] = "Newest Updates";
	$Translation["view record details"] = "View record details";
	$Translation["newest entries"] = "Newest Entries";
	$Translation["available add-ons"] = "Available add-ons";
	$Translation["more info"] = "More info";
	$Translation["close"] = "Close";
	$Translation["view add-ons"] = "View all add-ons";
	$Translation["top members"] = "Top Members";
	$Translation["edit member details"] = "Edit member details";
	$Translation["view member records"] = "View member's data records";
	$Translation["records"] = "records";
	$Translation["members stats"] = "Members Stats";
	$Translation["total groups"] = "Total groups";
	$Translation["active members"] = "Active members";
	$Translation["view active members"] = "View active members";
	$Translation["members awaiting approval"] = "Members awaiting approval";
	$Translation["view members awaiting approval"] = "View members awaiting approval";
	$Translation["banned members"] = "Banned members";
	$Translation["view banned members"] = "View banned members";
	$Translation["total members"] = "Total members";
	$Translation["view all members"] = "View all members";
	$Translation["BigProf tweets"]  = "Tweets By BigProf Software";
	$Translation["follow BigProf"] = "Follow @bigprof";
	$Translation["loading bigprof feed"] = "Loading @bigprof feed ...";
	$Translation["remove feed"] = "Remove this feed";
	
	
	
	//pageMail.php
	$Translation["can not send mail"] = "You can not send emails currently. The configured sender email address is not valid.	Please <a href='pageSettings.php'>correct it first</a> then try again.";
	
	$Translation["all groups"] = "All groups";
	$Translation["no recipient"] = "Couldn't find recipient. Please make sure you provide a valid recipient.";
	$Translation["invalid subject line"] = "Invalid subject line.";
	$Translation["no recipient found"] = "Couldn't find any recipients. Please make sure you provide a valid recipient.";
	$Translation["mail queue not saved"] = "Couldn't save mail queue. Please make sure the directory '<CURRDIR>' is writeable (chmod 755 or chmod 777).";
	$Translation["send mail"]  = "Send mail message to a member/group";
	$Translation["send mail to all members"] = "You are sending an email to all members. This could take a lot of time and affect your server performance. If you have a huge number of members, we don't recommend sending an email to all of them at once.";

	$Translation["from"] = "From";
	$Translation["change setting"] = "Change this setting";
	$Translation["to"] = "To";
	$Translation["subject"] = "Subject";
	$Translation["message"] = "Message";
	$Translation["send message"] = "Send Message";
	
	
	
	//pagePrintRecord.php
	$Translation["record details"] = "Membership Management -- Record details";
	$Translation['table name'] = "Table: <TABLENAME>";
	
	
	//pageRebuildFields.php
	$Translation['create or update table'] = "An attempt to <ACTION> the field <i><FIELD></i> in <i><TABLE></i> table was made by executing this query: <pre><QUERY></pre> Results are shown below.";

	$Translation['view or rebuild fields'] = "View/Rebuild fields";
	$Translation['show deviations only'] = "Show deviations only";
	$Translation['show all fields'] = "Show all fields";
	$Translation['compare tables page'] = "This page compares the tables and fields structure/schema as designed in AppGini to the actual database structure and allows you to fix any deviations.";
	
	$Translation['field'] = "Field";
	$Translation['AppGini definition'] = "AppGini definition";
	$Translation['database definition'] = "Current definition in the database";
	$Translation['table name title'] = "<TABLENAME> table";
	$Translation['does not exist'] = "Doesn't exist!";
	$Translation['create field'] = "Create the field by running an ADD COLUMN query.";
	$Translation['create it'] = "Create it";
	$Translation['fix field'] = "Fix the field by running an ALTER COLUMN query so that its definition becomes the same as that in AppGini.";
	$Translation['fix it'] = "Fix it";
	
	$Translation['field update warning'] = "DANGER!! In some cases, this might lead to data loss, truncation, or corruption. It might be a better idea sometimes to update the field in AppGini to match that in the database. Would you still like to continue?";
	
	$Translation['no deviations found'] = "No deviations found. All fields OK!";
	$Translation['error fields'] = "Found <CREATENUM> non-existing fields that need to be created.<br>Found <UPDATENUM> deviating fields that might need to be updated.";
	
	
	//pageRebuildThumbnails.php
	$Translation['rebuild thumbnails'] = "Rebuild thumbnails";
	$Translation['thumbnails utility'] = "Use this utility if you have one or more image fields in a table that don't have thumbnails or have thumbnails with incorrect dimensions.";
	$Translation['rebuild thumbnails of table'] = "Rebuild thumbnails of table";
	$Translation['rebuild'] = "Rebuild";
	
	$Translation['rebuild thumbnails of table_name'] = "Rebuilding thumbnails of '<i><TABLENAME></i>' table ...";
	$Translation['do not close page message'] = "Don't close this page until you see a confirmation message that all thumbnails have been built.";	
	$Translation['rebuild thumbnails status'] = "Status: still rebuilding thumbnails, please wait ...";
	$Translation['building field thumbnails'] =  "Building thumbnails for '<i><FIELD></i>' field...";
	$Translation['done'] = "Done.";
	$Translation['finished status'] = "Status: finished. You can close this page now.";
	
	

?>

