<?php

	// incHeader.php
	$Translation['membership management'] = "إدارة العضوية";
	$Translation['password mismatch'] = "كلمة السر غير مطابقة";
	$Translation['error'] = "خطأ";
	$Translation['invalid email'] = "عنوان البريد الألكتروني غير صحيح";
	$Translation['sending mails'] = "إرسال البريد الإلكتروني قد يستغرق بعض الوقت. برجاء عدم غلق هذه الصفحة لحين ظهور رسالة 'تم'.";
	$Translation['complete step 4'] = "برجاء إستكمال خطوة 4 بإختيار العضوالذي ترغب في تحويل التسجيلات له";
	$Translation['info'] = "المعلومات";	
	$Translation['sure move member'] = 'هل أنت متأكد من رغبتك في نقل العضو \'<MEMBER>\' وبياناته من مجموعة \'<OLDGROUP>\' إلي مجموعة \'<NEWGROUP>\'?';
	$Translation['sure move data of member'] = 'هل أنت متأكد من رغبتك في نقل بيانات العضو \'<OLDMEMBER>\' من مجموعة \'<OLDGROUP>\' إلى العضو \'<NEWMEMBER>\' من مجموعة \'<NEWGROUP>\'?';
	$Translation['sure move all members'] = 'هل أنت متأكد من رغبتك في نقل جميع الأعضاء والبيانات من مجموعة \'<OLDGROUP>\' إلي مجموعة \'<NEWGROUP>\'?';
	$Translation['sure move data of all members'] = 'هل أنت متأكد من رغبتك في نقل بيانات جميع أعضاء مجموعة \'<OLDGROUP>\' إلي العضو \'<MEMBER>\' من مجموعة \'<NEWGROUP>\'?';
	$Translation['toggle navigation'] = "تبديل قائمة التصفح";
	$Translation['admin area'] = "منطقة الإدارة";
	$Translation['groups'] = "مجموعات";
	$Translation['view groups'] = "مشاهدة المجموعات";
	$Translation['add group'] = "إضافة مجموعة";
	$Translation['edit anonymous permissions'] = "تعديل صلاحيات مستخدم  مجهول";
	$Translation['members'] = "أعضاء";
	$Translation['view members'] = "مشاهدة الأعضاء";
	$Translation['add member'] = "إضافة عضو";
	$Translation["view members' records"] = "مشاهدة سجلات الأعضاء";  
	$Translation["utilities"] = "خدمات"; 
	$Translation["admin settings"] = "إعدادات المدير"; 
	$Translation["rebuild thumbnails"] = "إعادة بناء الصور المصغرة"; 
	$Translation['rebuild fields'] = "إعادة بناء الحقول";
	$Translation['import CSV'] = "إستيراد بيانات من ملف CSV";
	$Translation['batch transfer'] = "مساعد نقل ملكية البيانات";
	$Translation['mail all users'] = "إرسال بريد لجميع المستخدمين";
	$Translation['AppGini forum'] = "AppGini منتدى";
	$Translation["user's area"] = 'منطقة المستخدم';
	$Translation["sign out"] = "الخروج";
	$Translation["attention"] = "أنتباه!";
	$Translation['security risk admin'] = 'أنت تستخدم الإسم والرقم السري الإفتراضي لللمدير. هذا خطر أمني هائل. رجاءا تغيير على الأقل الرقم السري للمدير  <a href="pageSettings.php">اعدادات المدير</a> من صفحة <em>فورا</em>.';
	$Translation['security risk'] = 'أنت تستخدم الرقم السري الإفتراضي للمدير. هذا خطر أمني هائل. رجاءا تغيير على الأقل الرقم السري للمدير من صفحة <a href="pageSettings.php">Admin Settings</a> من صفحة <em>فورا</em>.' ;
	
	
	//pageAssignOwners.php
	$Translation["assigned table records to group"] = "تعيين <NUMBER> سجلات جدول '<TABLE>' إلي مجموعة '<GROUP>'";
	$Translation["assigned table records to group and member"] = "تعيين <NUMBER> سجلات جدول '<TABLE>' إلى مجموعة '<GROUP>' , عضو'<MEMBERID>'";
	
	$Translation['data ownership assign'] = "تحديد ملكية للسجلات التي ليس لها مالك";
	$Translation['records ownership done'] = "جميع السجلات بجميع الجداول لها مالك الآن. <br>العودة إلي  <a href='pageHome.php'>الصفحة الرئيسية للمدير</a>.";
	$Translation['select group'] = "إختيار المجموعة";
	$Translation['data ownership'] = "في بعض الأحوال، قد يكون لديك جداول ببيانات تم إدخالها قبل تفعيل نظام AppGini لإدارة العضوية أو تم إدخالها بإستخدام تطبيقات أخرى عن عدم دراية بنظام AppGini للملكية. هذه البيانات ليس لها مالك حاليا. هذه الصفحة تتيح لك تحديد مالك للمجموعة وعضو مالك للبيانات.";
	$Translation["table"] = "جدول";
	$Translation["records with no owners"] = "سجلات بدون مالك";
	$Translation["new owner group"] = "مالك جديد للمجموعة";
	$Translation["new owner member"] = "المستخدم المالك الجديد";	
	$Translation["cancel"] = "إلغاء";
	$Translation["assign new owners"] = "تحديد مالك جديد";
	$Translation["please wait"] = "برجاء الإنتظار...";	
	$Translation["if no owner member assigned"] = '*في حالة عدم تحديدك لمستخدم مالك هنا، فلازال بإمكانك إستخدام <a href="pageTransferOwnership.php">مساعد نقل ملكية البيانات</a> لاحقا';
	
	//pageDeleteGroup.php
	$Translation["can not delete group remove members"] = 'لا يمكن مسح هذه المجموعة. برجاء إزالة الأعضاء أولا';
	$Translation["can not delete group transfer records"] = 'لايمكن مسح هذه المجموعة. برجاء تحويل سجلات البيانات لمجموعة أخرى أولا..';
	
	//pageEditGroup.php
	$Translation["group exists error"] = "خطأ: اسم المجموعة مستخدم بالفعل. يجب إختيار إسم غير مستخدم للمجموعة";
	$Translation["group not found error"] = "خطأ: المجموعة غير موجودة.";								 	
	$Translation["edit group"] = "تعديل مجموعة '<GROUPNAME>'";
	$Translation["add new group"] = "إضافة مجموعة جديدة";
	$Translation["anonymous group attention"] = "إنتباه! هذه هي المجموعة المجهولة.";
	$Translation["show tool tips"] = "عرض التلميحات عند مرور الفأرة على الإختيارات";
	$Translation["group name"] = "اسم المجموعة";
	$Translation["readonly group name"] = "المجموعة المجهولة قراءة فقط هنا.";
	$Translation["anonymous group name"] = "عند تسمية المجموعة <مجموعة مجهولة>, سيتم إعتبارها المجموعة المجهولة,<br> التي تحدد صلاحيات الضيف الزائر الذي لا يقوم بتسجيل دخوله للنظام.";
	$Translation["description"] = "وصف";
	$Translation["allow visitors sign up"] = 'السماح للزائرين بالتسجيل؟';
	$Translation["admin add users"] = "لا. فقط المدير هو من يمكنه إضافة مستخدمين.";
	$Translation["admin approve users"] = "نعم، ويجب على المدير الموافقة عليهم.";
	$Translation["automatically approve users"] = "نعم، ويتم الموافقة عليهم تلقائيا.";
	$Translation["group table permissions"] = "صلاحيات الجدول لهذه المجموعة";
	$Translation["no"] = "لا";
	$Translation["owner"] = "المالك";
	$Translation["group"] = "المجموعة";
	$Translation["all"] = "الكل";
	$Translation["insert"] = "ادخال";
	$Translation["view"] = "مشاهدة";
	$Translation["edit"] = "تعديل";
	$Translation["delete"] = "مسح";
	$Translation["customers"] = "عملاء";
	$Translation["employees"] = "الموظفين";
	$Translation["orders"] = "الأوامر";
	$Translation["order items"] = "عناصر الأمر";
	$Translation["products"] = "المنتجات";
	$Translation["product categories"] = "فئات المنتجات";
	$Translation["suppliers"] = "الموردين";
	$Translation["shippers"] = "شركات الشحن";
	$Translation["save changes"] = "حفظ التغييرات";
	
	
	
	//pageEditMember.php
	$Translation["username error"] = "خطأ: اسم المستخدم موجود بالفعل أو غير صحيح. تأكد من كتابة اسم مستخدم يتكون من 4 إلي 20 حرف صحيح.";
	$Translation["member not found"] = "خطأ: عضو غير موجود!";
	$Translation["user has special permissions"] = "هذا المستخدم لديه صلاحيات خاصة تتجاوز صلاحيات المجموعة التي ينتمي إليها.";
	$Translation["user has group permissions"] = 'هذا المستخدم يرث .<a href="pageEditGroup.php?groupID=<GROUPID>">صلاحيات هذه المجموعة</a>.';
	$Translation["set user special permissions"] = 'تحديد صلاحيات خاصة لهذا المستخدم';
	$Translation["sure continue"] = " إذا كنت قمت بعمل أي تعديلات لهذا العضو ولم تقم بحفظ هذه التعديلات بعد، سيتم فقدها إذا استمريت. هل أنت متأكد من رغبتك في الإستمرار؟";
	$Translation["edit member"] = "تعديل عضو <MEMBERID>" ; ;
	$Translation["add new member"] = "إضافة عضو جديد";
	$Translation["anonymous guest member"] = "إنتباه! هذا هو العضو المجهول(الزائر).";
	$Translation["admin member"] = 'إنتباه! هذا هو العضو المدير. لا يمكن تغيير اسم المستخدم أو كلمة السلا أو البريد الإلكتروني لهذا العضو هنا، ولكن يمكنك فعل ذلك في صفحة<a href="pageSettings.php">اعدادات المدير</a> ';
	$Translation["member username"] = "اسم المستخدم للعضو";
	$Translation["check availability"] = "متاح؟";
	$Translation["read only username"] = "اسم المستخدم للعضو الزائر قراءة فقط.";
	$Translation["password"] = "كلمة السر";
	$Translation["change password"] = "اكتب كلمة السر فقط إذا كنت تريد تغيير كلمة السر لهذا العضو. خلاف ذلك، اترك هذا الحقل فارغا.";
	$Translation["confirm password"] = "تأكيد كلمة السر";
	$Translation["email"] = "بريد إلكتروني";
	$Translation["approved"] = "موافق؟";
	$Translation["banned"] = "حظر";
	$Translation["comments"] = "تعليقات";
	$Translation["back to members"] = "عودة لصفحة الأعضاء";
	$Translation["member added"] = "تم إضافة العضو <USESRNAME> بنجاح";
	

	
	//pageEditMemberPermissions.php
	$Translation["member permissions saved"] = "تم حفظ صلاحيات العضو بنجاح.";
	$Translation["member permissions reset"] = "تم إعادة تحديد صلاحيات العضو لنفس صلاحيات مجموعته.";
	$Translation["user table permissions"] = "صلاحيات الجدول للمستخدم <a href='pageEditMember.php?memberID=<MEMBER>' title='مشاهدة تفاصيل العضو'><MEMBERID></a> لمجموعة <a href='pageEditGroup.php?groupID=<GROUPID>'  title='مشاهدة تفاصيل المجموعة وصلاحياتها'><GROUP></a>";
	$Translation["no member permissions"] = 'هذا العضو ليس له أي صلاحيات خاصة حاليا. هذه القائمة تعرض الصلاحيات الخاصة بمجموعته.';
	$Translation["reset member permissions"] = "إعادة تحديد صلاحيات العضو.";
	$Translation["remove special permissions"] = 'هذا يزيل كافة الصلاحيات الخاصة لهذا المستخدم وسوف يكون له نفس صلاحيات مجموعته. هل أنت متأكد من رغبتك في القيام بهذا؟';
	
	
	//pageEditOwnership.php
	$Translation["invalid table"] = "جدول غير صالح.";
	$Translation["invalid primary key"] = "قيمة المفتاح الرئيسي غير صحيحة.";
	$Translation["record not found"] = "سجل غير موجود.. إذا كان قد تم .استيراده خارجيا، حاول تعيين مالك من منطقة الإدارة";
	$Translation["invalid username"] = "اسم مستخدم غير صحيح";
	$Translation["record not found error"] = "خطأ: سجل غير موجود!";
	$Translation["edit Record Ownership"] = "تعديل ملكية السجل";
	$Translation["owner group"] = "المجموعة المالكة";
	$Translation["view all records by group"] = "مشاهدة جميع السجلات لهذه المجموعة";
	$Translation["owner member"] = "العضو المالك";
	$Translation["view all records by member"] = "مشاهدة جميع السجلات لهذا العضو";
	$Translation["switch record ownership"] = "إذا كنت تريد تحويل ملكية هذا التسجيل لعضو من مجموعة أخرى، يجب تغيير مجموعة المالك وحفظ التعديلات أولا.";
	$Translation["record created on"] = "تم انشاء السجل في";
	$Translation["record modified on"] = "تم تعديل السجل في";
	$Translation["view all records of table"] = "مشاهدة جميع السجلات لهذا الحدول";
	$Translation["record data"] = "بيانات السجل";
	$Translation["print"] = "طباعة";
	$Translation["could not retrieve field list"] = "لم نتمكن من استرجاع قائمة الحقول من ‘<اسم الجدول>‘";
	$Translation["field name"] = "اسم الحقل";
	$Translation["value"] = "القيمة";
	
	
	//pageHome.php
	$Translation["visitor sign up"] = '<a href="../membership_signup.php" target="_blank">تم تعطيل تسجيل دخول الزوار لعدم وجود مجموعات يمكن للزوار التسجيل بها حاليا. لتمكين الزائر من التسجيل، يجب على الأقل تحديد مجموعة واحدة تسمح للزائر بالتسجيل.</a>';
	$Translation["table data without owner"] = ' لديك بيانات ليس لها مالك بأحد الجداول أو أكثر من جدول.لتعيين مالك للمجموعة لهذه البيانات،  <a href="pageAssignOwners.php">اضغط هنا</a>.';
	$Translation["membership management homepage"] = "الصفحة الرئيسية لإدارة العضوية";
	$Translation["newest updates"] = "أجدد التحديثات";
	$Translation["view record details"] = "مشاهدة تفاصيل السجل";
	$Translation["newest entries"] = "أجدد الإدخالات";
	$Translation["available add-ons"] = "الإضافات المتاحة";
	$Translation["more info"] = "مزيد من المعلومات";
	$Translation["close"] = "إغلاق";
	$Translation["view add-ons"] = "مشاهدة جميع الأضافات";
	$Translation["top members"] = "كبار الأعضاء";
	$Translation["edit member details"] = "تعديل تفاصيل العضو";
	$Translation["view member records"] = "مشاهدة بيان سجلات العضو";
	$Translation["records"] = "تسجيلات";
	$Translation["members stats"] = "إحصائيات الأعضاء";
	$Translation["total groups"] = "إجمالي المجموعات";
	$Translation["active members"] = "أعضاء ناشطين";
	$Translation["view active members"] = "مشاهدة الأعضاء النشطين";
	$Translation["members awaiting approval"] = "أعضاء في إنتظار الموافقة";
	$Translation["view members awaiting approval"] = "مشاهدة الأعضاء في إنتظار الموافقة";
	$Translation["banned members"] = "أعضاء محظورين";
	$Translation["view banned members"] = "مشادة الأعضاء المحظورين";
	$Translation["total members"] = "إجمالي الأعضاء ";
	$Translation["view all members"] = "مشاهدة جميع الأعضاء";
	$Translation["BigProf tweets"]  = "تغريدات BigProf Software";
	$Translation["follow BigProf"] = "متابعة @bigprof";
	$Translation["loading bigprof feed"] = " تحميل تغذية @bigprof ...";
	$Translation["remove feed"] = "إزالة هذه التغذية";
	
	
	//pageMail.php
	$Translation["can not send mail"] = "لا يمكن إرسال بريد إلكتروني الأن. تكوين عنوان البريد الإلكتروني للراسل غير صحيح. برجاء  <a href='pageSettings.php'>تصحيحه أولا</a> ثم المحاولة مرة أخرى.";
	$Translation["all groups"] = "جميع المجموعات";
	$Translation["no recipient"] = "لم نتمكن من إيجاد المرسل إليه. برجاء التأكد من صحة المرسل إليه. ";
	$Translation["invalid subject line"] = "سطر الموضوع غير صحيح";
	$Translation["no recipient found"] = "لا يوجد مرسل إليه. برجاء التأكد من إضافة مرسل إليه صحيح.";
	$Translation["mail queue not saved"] = "لا يمكن حفظ قائمة انتظار البريد. برجاء التأكد من أن الدليل قابل للكتابة.'<CURRDIR>' (chmod 755 أو chmod 777).";
	$Translation["send mail"]  = "ارسال بريد إلكتروني للأعضاء/للمجموعة.";
	$Translation["send mail to all members"] = "أنت تقوم بإرسال بريد إلكتروني لجميع الأعضاء. هذا قد يستغرق وقت طويل ويؤثر على أداء السيرفر. إذا كان لديك عدد هائل من الأعضاء فإننا لا ننصح بإرسال بريد إلكتروني لهم جميعا في وقت واحد.";
	$Translation["from"] = "من";
	$Translation["change setting"] = "تغيير هذه الإعدادات";
	$Translation["to"] = "إلي";
	$Translation["subject"] = "عنوان";
	$Translation["message"] = "رسالة";
	$Translation["send message"] = "إرسال رسالة";
	

	//pagePrintRecord.php
	$Translation["record details"] = "إدارة العضوية -- تفاصيل السجل";
	$Translation['table name'] = "الجدول: <TABLENAME>";
	
	
	//pageRebuildFields.php
	$Translation['create or update table'] = "تمت محاولة <ACTION> الحقل <i><FIELD></i> فى جدول <i><TABLE></i> عن طريق تنفيذ هذا الأمر: <pre><QUERY></pre> و النتائج كما يلى.";

	$Translation['view or rebuild fields'] = "مشاهدة / إعادة بناء الحقول";
	$Translation['show deviations only'] = "عرض الإختلافات فقط";
	$Translation['show all fields'] = "عرض جميع الحقول";
	$Translation['compare tables page'] = "هذه الصفحة تقوم بمقارنة هيكل/مخطط الجداول والحقول كما تم تصميمها في AppGini ببنية قاعدة البيانات الفعلية ويسمح لك بإصلاح أي إختلافات.";
	$Translation['field'] = "حقول";
	$Translation['AppGini definition'] = "تعريف AppGini";
	$Translation['database definition'] = "التعريف الحالي في قاعدة البيانات";
	$Translation['table name title'] = "<TABLENAME> جدول";
	$Translation['does not exist'] = "غير موجود";
	$Translation['create field'] = "إنشاء الحقل عن طريق أمر إضافة حقل";
	$Translation['create it'] = "إنشئه";
	$Translation['fix field'] = "إصلاح الحقل عن طريق أمر تعديل حقل بحيث يصبح تعريفه مطابقاً لـAppGini.";
	$Translation['fix it'] = "إصلح الحقل";
	$Translation['field update warning'] = "خطر!! قد يؤدي هذا في بعض الأحوال إلي فقدان البيانات أو اقتطاعها أو افسادها. قد تكون فكرة أفضل أن تقوم بتحديث الحقل في AppGini لتطابق الحقل في قاعدة البيانات.هل لازلت ترغب في الاستمرار؟";
	$Translation['no deviations found'] = "لم يتم العثور على اختلافات. جميع الحقول صحيحة.";
	$Translation['error fields'] = "تم العثور على <CREATENUM> حقول غير معرفة بحاجة للتعريف.<br>تم العثور على <UPDATENUM> حقول مخالفة بحاجة للتحديث.";
	
	
	//pageRebuildThumbnails.php
	$Translation['rebuild thumbnails'] = "اعادة بناء الصور المصغرة";
	$Translation['thumbnails utility'] = "استخدم هذه الأداه إذا كان لديك حقل صورة أو أكثر في الجدول وليس له صور مصغرة أو لديه صور مصغرة بأبعاد غير صحيحة.";
	$Translation['rebuild thumbnails of table'] = "إعادة بناء الصور المصغرة للجدول";
	$Translation['rebuild'] = "اعادة بناء";
	$Translation['rebuild thumbnails of table_name'] = "اعادة بناء الصور المصغرة للجدول '<i><اسم الجدول></i>' ...";
	$Translation['do not close page message'] = "لا تغلق هذه الصفحة حتى ترى رسالة تأكيد بأن جميع الصور المصغرة تم بناؤها.";	
	$Translation['rebuild thumbnails status'] = "الوضع الحالي: جاري اعادة بناء الصور المصغرة، برجاء الانتظار...";
	$Translation['building field thumbnails'] =  "بناء صور مصغرة لحقل...'<i><حقل></i>'";
	$Translation['done'] = "تم.";
	$Translation['finished status'] = "الوضع الحالي: انتهى. يمكنك اغلاق هذه الصفحة الآن.";
	

	//pageSender.php
	$Translation['invalid mail queue'] = "قائمة انتظار البريد غير صحيحة.";
	$Translation['sending message failed'] = " -- ارسال رسالة لـ ‘<بريد إلكتروني>‘: فشل.";
	$Translation['sending message ok'] = " -- ارسال رسالة لـ‘<بريد إلكتروني>‘: تم.";
	$Translation['done!'] = "تم!";
	$Translation['close page'] = "يمكنك اغلاق هذه الصفحة الآن أو التصفح لصفحة أخرى.";
	$Translation['mail log'] = "سجل الارسال:";
	
	
	//pageSettings.php
	$Translation['invalid security token'] = 'الرمز الأمني غير صحيح! برجاء <a href="pageSettings.php">اعادة تحميل الصفحة</a> والمحاولة مرة أخرى.';
	$Translation['unique admin username error'] = "اسم المستخدم الجديد للمدير مأخوذ بالفعل. برجاء التأكد من أن اسم المستخدم الجديد للمدير غير مستخدم.";	
	$Translation['unique anonymous username error'] = 'اسم المستخدم المجهول الجديد مأخوذ بالفعل. برجاء التأكد من أن اسم المستخدم الجديد غير مستخدم.';
	$Translation['unique anonymous group name error'] = 'اسم المجموعة المجهولة الجديدة مستخدم بالفعل من مجموعة أخرى. برجاء التأكد أن اسم المجموعة الجديدة غير مستخدم.';
	$Translation['admin password mismatch'] = '"كلمة السر للمدير" و "تأكيد كلمة السر" غير مطابقين.';
	$Translation['invalid sender email'] = 'غير صحيح "البريد الإلكتروني للراسل".';
	$Translation['errors occurred'] = " الأخطاء التالية ظهرت:";
	$Translation['go back'] = 'برجاء <a href="pageSettings.php" onclick="history.go(-1); return false;">الرجوع</a>لتصحيح الخطأ (الأخطاء)أعلاه والمحاولة مرة أخرى.';
	$Translation['record updated automatically'] = "تم تحديث السجل تلقائيا في <تاريخ>";
	$Translation['admin settings saved'] = "تم حفظ اعدادات المدير بنجاح.<br>الرجوع إلي <a href=\"pageSettings.php\">اعدادات المدير</a>.";
	$Translation['admin settings not saved'] = "اعدادات المدير لم يتم حفظها بنجاح. سبب الأخفاق: <خطأ><br> الرجوع إلى<a href=\"pageSettings.php\" onclick=\"history.go(-1); return false;\">اعدادات المدير</a>.";
	$Translation['show tool tips'] = 'مشاهدة التلميحات عند مرور الفأرة على الاختيارات.';
	$Translation['admin username'] = "اسم المستخدم للمدير";
	$Translation['admin password'] = "كلمة السر للمدير";
	$Translation['change admin password'] = "اكتب كلمة السر فقط في حالة رغبتك في تغيير كلمة السر للمدير.";
	$Translation['sender email'] = "البريد الإلكتروني للراسل";
	$Translation['sender name and email'] = "الاسم والبريد الألكتروني للراسل مستخدمين في حقل ‘إلى‘ عند الإرسال.";
	$Translation['email messages'] = "ارسال بريد إلكتروني للمجموعات والأعضاء.";
	$Translation['admin notifications'] = "اخطارات المدير";
	$Translation['no email notifications'] = "لا يوجد اخطارات ببريد إلكتروني للمدير.";
	$Translation['member waiting approval'] = "اخطر المدير فقط عندما يكون عضو جديد في انتظار موافقة.";
	$Translation['new sign-ups'] = "اخطر المدير بكل تسجيلات الدخول الجديدة.";
	$Translation['sender name'] = "اسم الراسل";
	$Translation['members custom field 1'] = "حقل 1 المخصص للأعضاء";
	$Translation['members custom field 2'] = "حقل 2 المخصص للأعضاء";
	$Translation['members custom field 3'] = "حقل 3 المخصص للأعضاء";
	$Translation['members custom field 4'] = "حقل 4 المخصص للأعضاء";
	$Translation['member approval email subject'] = "الموافقة على العضوية<br>عنوان البريد الألكتروني";
	$Translation['member approval email subject control'] = "عندما يقوم المدير بالوافقة على عضو، يتم اخطار العضو عن طريق<br> بريد إلكتروني بقبول عضويته. يمكنك التحكم في عنوان <br>البريد الألكتروني الخاص بالموافقة من هذا الصندوق، ومضمونه من الصندوق أدناه.";
	$Translation['member approval email message'] = "الموافقة على العضوية<br>رسالة البريد الإلكتروني ";
	$Translation['MySQL date'] = "تاريخ ماى إس كيو إل<br>نص تنسيق";
	$Translation['MySQL reference'] = 'برجاء الرجوع إلى <a href="http://dev.mysql.com/doc/refman/5.0/en/date-and-time-functions.html#function_date-format" target="_blank">مرجع ماى إس كيو إل</a> .للنُسُق الممكن';
	$Translation['PHP short date'] = "نُسُق التاريخ القصير لبى إتش بى<br>نص تنسيق";
	$Translation['PHP manual'] = 'برجاء الرجوع إلى <a href="http://www.php.net/manual/en/function.date.php" target="_blank">كتيب البي إتش بي</a> .للنُسُق الممكن'; 
	$Translation['PHP long date'] = "نُسُق التاريخ الطويل لبى إتش بى<br>نص تنسيق";
	$Translation['groups per page'] = "المجموعات بكل صفحة";
	$Translation['members per page'] = "الأعضاء بكل صفحة";
	$Translation['records per page'] = "السجلات بكل صفحة";
	$Translation['default sign-up mode'] = "صيغة التسجيل الإفتراضية<br>لمجموعات جديدة";
	$Translation['no sign-up allowed'] = "غير مسموح بالتسجيل. فقط المدير يمكنه إضافة اعضاء.";
	$Translation['admin approve members'] = "يسمح بالتسجيل ولكن يجب على المدير قبول العضو.";
	$Translation['automatically approve members'] = "يسمح بالتسجيل ويتم قبول العضو تلقائيا.";
	$Translation['anonymous group'] = "اسم المجموعة المجهولة<br>";
	$Translation['anonymous user name'] = "اسم المستخدم<br>المجهول";
	$Translation['hide twitter feed'] = "اخفاء تغذية التغريدات<br>من الصفحة الرئيسية للمدير؟";
	$Translation['twitter feed'] = "تغذية التغريدات الخاصة بنا تساعدك أن تبقى على دراية بأحدث الأخبار، موارد مفيده، إصدارات جديدةونصائح مفيدة عديدة أخرى.";
	
	
	//pageTransferOwnership.php
	$Translation['invalid source member'] = " المستخدم الأصلي المختار خاطئ.";
	$Translation['invalid destination member'] = "المستخدم الجديد المختار خاطئ.";
	$Translation['moving member'] = "نقل عضو '<MEMBERID>' وبياناته من مجموعة '<SOURCEGROUP>' إلى مجموعة '<DESTINATIONGROUP>' ...";
	$Translation['data records transferred'] = "عضو '<MEMBERID>' ينتمي الآن لمجموعة '<NEWGROUP>'. بيانات السجل تم تحويلها: <DATARECORDS>.";
	$Translation['moving data'] = "تحويل بيانات العضو '<SOURCEMEMBER>' من مجموعة '<SOURCEGROUP>' إلى العضو '<DESTINATIONMEMBER>' من مجموعة '<DESTINATIONGROUP>' ...";
	
	$Translation['member records status'] = "العضو '<SOURCEMEMBER>' من مجموعة '<SOURCEGROUP>' لديه <DATABEFORE> بيانات السجلات. <TRANSFERSTATUS> إلى العضو '<DESTINATIONMEMBER>' من مجموعة '<DESTINATIONGROUP>'.";
	
	$Translation['moving all group members'] = "نقل جميع الأعضاء والبيانات من مجموعة '<SOURCEGROUP>' إلى مجموعة '<DESTINATIONGROUP>' ...";
	$Translation['failed transferring group members'] = "العملية فشلت. لم يتم تحويل أي عضو من مجموعة '<SOURCEGROUP>' إلى  '<DESTINATIONGROUP>'.";
	$Translation['group members transferred'] = "جميع أعضاء مجموعة '<SOURCEGROUP>' ينتمون الآن إلي مجموعة '<DESTINATIONGROUP>'. ";
	$Translation['failed transfer data records'] = "مع ذلك، فشل نقل بيانات السجلات.";
	$Translation['data records were transferred'] = "<DATABEFORE> تم تحويل بيانات السجلات.";
	
	$Translation['moving group data to member'] = "نقل بيانات جميع أعضاء مجموعة '<SOURCEGROUP>' إلى العضو '<DESTINATIONMEMBER>' من مجموعة '<DESTINATIONGROUP>' ...";
	
	$Translation['moving group data to member status'] = "<NUMBER> السجل(ات) تم تحويلها من مجموعة'<SOURCEGROUP>' إلى العضو '<DESTINATIONMEMBER>' من مجموعة '<DESTINATIONGROUP>'";
	$Translation['status'] = "الوضع الحالي:";
	$Translation['batch transfer link'] = 'لأعادة النقل دفعة واحدة مرة أخرى لاحقا يمكنك <a href= "pageTransferOwnership.php?sourceGroupID=<SOURCEGROUP>&amp;sourceMemberID=<SOURCEMEMBER>&amp;destinationGroupID=<DESTINATIONGROUP>&amp;destinationMemberID=<DESTINATIONMEMBER>&amp;moveMembers=<MOVEMEMBERS>">نسخ هذا الرابط أو حفظه كعلامة مرجعية.</a>.';
		
	$Translation['ownership batch transfer'] = "نقل الملكية دفعة واحدة.";
	$Translation['step 1'] = "خطوة 1:";
	$Translation['batch transfer wizard'] = "مساعد نقل الملكية دفعة واحدة يسمح لك بتحويل بيانات السجلات من أحد أعضاء أو كل أعضاء  مجموعة (the <i>source group</i>) إلى عضو من مجموعة أخرى (the <i>destination member</i> of the <i>destination group</i>)";
	$Translation['source group'] = "المجموعة الأصية";
	$Translation['update'] = "تحديث";
	$Translation['next step'] = "الخطوة التالية";
	$Translation['group statistics'] = "هذه المجموعة لها<MEMBERS> أعضاء و <RECORDS> بيانات السجلات.";
	$Translation['step 2'] = "خطوة 2:";
	$Translation['source member message'] = "من الممكن أن يكون العضو الأصلي أحد أو كل أعضاء المجموعة الأصلية.";
	$Translation['source member'] = "العضو الأصلي";
	$Translation['all group members'] = "جميع الأعضاء من '<GROUPNAME>'";
	$Translation['member statistics'] = "هذا العضو لديه <RECORDS> بيانات السجلات.";
	$Translation['step 3'] = "الخطوة 3:";
	$Translation['destination group message'] = "من الممكن أن تكون المجموعة الجديدة مماثلة أو مختلفة عن المجموعة الأصلية. فقط المجموعات التي تحتوي على أعضاء هي الواردة أدناه.";
	$Translation['destination group'] = "المجموعة الجديدة";
	$Translation['step 4'] = "الخطوة 4:";
	$Translation['destination member message'] = "العضو الجديد سيصبح المالك الجديد لبيانات التسجيل الخاصة بالعضو الأصلي.";
	$Translation['destination member'] = "العضو الجديد";
	$Translation['begin transfer'] = "بدء التحويل";	
	$Translation['move records'] = "يمكنك نقل إما السجلات من العضو (الأعضاء) الأصلي (الأصليون)إلي العضو في المجموعة الجديدة، أو نقل العضو (الأعضاء) الأصلي (الأصليون)مع بيانات السجلات الخاصة به للمجموعة الجديدة.";
	$Translation['move data records to member'] = "نقل بيانات السجلات لهذا العضو:";
	$Translation['move source member to group'] = "نقل العضو الأصلي (الأعضاء الأصليين) وجميع بيانات سجلاته (سجلاتهم) إلي مجموعة'<GROUPNAME>'";
	
	
	//pageUploadCSV.php
	$Translation['file not found error'] = "خطأ: الملف'<FILENAME>' غير موجود.";
	$Translation['preview and confirm CSV data'] = "معاينة بيانات CSV ثم التأكيد لتوريده... ";
	$Translation['display csv file rows'] = "عرض العشر أسطر الأولى من ملف CSV .. ";
	$Translation['change CSV settings'] = 'تغيير اعدادات CSV';
	$Translation['import CSV data'] = 'تأكيد واستيراد بيانات CSV &lt;';
	$Translation['apply CSV settings'] = 'تطبيق اعدادات CSV';
	$Translation['importing CSV data'] = 'استيراد بيانات CSV ...';
	$Translation['start at estimated record'] = "بدئا من سجل <رقم السجل> من <سجلات> إجمالي السجلات المقدرة...";
	$Translation['table backed up'] = "جدول '<TABLE>' تم نسخه إحتياطيا إلى '<TABLENAME>'.";
	$Translation['table backup not done'] = "الجدول'<TABLE>' فارغ, لذا لم يتم عمل نسخة إحتياطية.";
	$Translation['importing batch'] = 'استيراد دفعة <BATCH> من <BATCHNUM>: ';
	$Translation['ok'] = 'تمام';
	$Translation['records inserted or updated successfully'] = "<RECORDS> سجلات تم ادخالها/تحديثها في <SECONDS> ثوان.";
	$Translation['mission accomplished'] = "تمت المهمة!";
	$Translation['assign a records owner'] = "تعيين مالك للسجلات المستوردة &lt;";
	$Translation['please wait and do not close'] = "برجاء الإنتظار وعدم اغلاق هذه الصفحة ...";
	$Translation['hide advanced options'] = "اخفاء الخيارات المتقدمة";
	$Translation['show advanced options'] = "عرض الخيارات المتقدمة";
	$Translation['import CSV to database'] = "استيراد ملف CSV لقاعدة البيانات.";
	$Translation['import CSV to database page'] = "هذه الصفحة تتيح لك تحميل ملف CSV (على سبيل المثال ملف مايكروسوفت أكسل) وتصديره لأحد جداول قاعدة البيانات. هذا يجعل تعبئة قاعدة البيانات ببيانات من مصدر آخر سهل للغاية بدلا من ادخال كل السجلات يدويا.";
	$Translation['populate table from CSV'] = "هذا هو الجدول الذي تريد ملئه ببيانات من ملف CSV.";
	$Translation['CSV file'] = "ملف CSV";
	$Translation['preview CSV data'] = "معاينة بيانات CSV &lt;";
	$Translation['no table name provided'] = "لم يتم تقديم اسم للجدول.";
	$Translation['can not open CSV'] = "لم يمكن فتح ملف CSV '<FILENAME>'.";
	$Translation['empty CSV file'] = "ملف CSV '<FILENAME>' فارغ";
	$Translation['no CSV file data'] = "ملف CSV '<FILENAME>' ليس به بيانات تقرأ." ;
	$Translation['field separator'] = "فاصل الحقل";
	$Translation['default comma'] = "الافتراضي هي الفاصلة (،)";
	$Translation['field delimiter'] = "محدد الحقل";
	$Translation['default double-quote'] = 'الافتراضي هو علامة تنصيص مزدوجة (")';
	$Translation['maximum characters per line'] = "الحد الأقصى للحروف في السطر";
	$Translation['trouble importing CSV'] = "إذا كنت تواجه مشكلة في استيراد ملف CSV، حاول زيادة القيمة.";
	$Translation['ignore lines number'] = " عدد الأسطر المراد تجاهلها";
	$Translation['skip lines number'] = "غيَر هذه القيمة إذا كنت تريد تخطي عدد معيين من السطور في ملف الCSV.";
	$Translation['first line field names'] = "السطر الأول من الملف يحتوي على اسم الحقل.";
	$Translation['field names must match'] = "يجب على اسم الحقل أن يكون مماثل <b>تماما</b> للذي في قاعدة البيانات.";
	$Translation['update table records'] = "حدث سجلات الجدول إذا تطابقت قيمه المفتاح الرئيسي له مع أولائك في ملف ال CSV.";
	$Translation['ignore CSV table records'] = "في حالة عدم اختياره، فأن السجلات التي تطابق قيمتها لقيمة المفتاح الرئيسي في سجلات ملف CSV مع التي في الجدول <b>سيتم تجاهلها</b>";
	$Translation['back up the table'] = "نسخ الجدول احتياطيا قبل استيراد بيانات CSV له.";
	
	
	//pageViewGroups.php
	$Translation['no matching results found'] = "لم يتم العثور على نتائج مطابقة.";
	$Translation['search groups'] = "بحث المجموعات";
	$Translation['find'] = "إيجاد";
	$Translation['reset'] = "إعادة تعيين";
	$Translation['members count'] = "إحصاء الأعضاء";
	$Translation['Edit group'] = "تعديل المجموعة";
	$Translation['confirm delete group'] = "هل أنت متأكد من رغبتك في مسح هذه المجموعة تماما؟";
	$Translation['delete group'] = "مسح المجموعة";
	$Translation['view group records'] = "مشاهدة سجلات المجموعة";
	$Translation['view group members'] = "مشاهجة أعضاء المجموعة";
	$Translation['send message to group'] = "إرسال رسالة للمجموعة";
	$Translation['previous'] = "السابق";
	$Translation['displaying groups'] = "عرض مجموعات <GROUPNUM1> إلى <GROUPNUM2> من <GROUPS>";
	$Translation['next'] = "التالي";
	$Translation['key'] = "مفتاح:";	
	$Translation['edit group details'] = "تعديل تفاصيل وصلاحيات المجموعة.";
	$Translation['add member to group'] = "إضافة عضو جديد للمجموعة.";
	$Translation['view data records'] = "عرض جميع بيانات السجلات المدخلة بمعرفة أعضاء المجموعة.";
	$Translation['list group members'] = "إدرج جميع أعضاء المجموعة.";
	$Translation['send email to all members'] = "ارسل بريد إلكتروني لجميع أعضاء المجموعة.";
	

	//pageViewMembers.php
	$Translation['search members'] = "بحث أعضاء <SEARCH> في <HTMLSELECT>";
	$Translation['all fields'] = "جميع الحقول";
	$Translation['any'] = "أي";
	$Translation['waiting approval'] = "في إنتظار الموافقة";
	$Translation['active'] = "نشط";
	$Translation['Banned'] = "محزور";
	$Translation['username'] = "اسم المستخدم";
	$Translation['sign up date'] = "تاريخ التسجيل";
	$Translation['Status'] = "الوضع الحالي";
	$Translation['Edit member'] = "تعديل العضو";	
	$Translation['sure delete user'] = "هل أنت متأكد من رغبتك في مسح المستخدم \‘<اسم المستخدم>‘\؟";
	$Translation['delete member'] = "مسح العضو";
	$Translation["approve this member"] = "قبول هذا العضو";
	$Translation["unban this member"] = "رفع حظر هذا العضو";
	$Translation["ban this member"] = "حظر هذا العضو";
	$Translation["View member records"] = "مشاهدة سجلات العضو";
	$Translation["send message to member"] = "إرسال رسالة للعضو";
	$Translation['displaying members'] = "عرض أعضاء <MEMBERNUM1> إلى <MEMBERNUM2> من <MEMBERS>";
	$Translation['activate member'] = "تفعيل عضو جديد/محظور.";
	$Translation['ban member'] = "حظر (تعليق) عضو.";
	$Translation['view entered member records'] = "مشاهدة جميع بيانات السجلات المدخلة بمعرفة العضو.";
	$Translation['send email to member'] = "إرسال بريد إلتكروني للعضو.";
	
	
	//pageViewRecords.php
	$Translation['data records'] = "بيانات السجلات";
	$Translation['show records'] = "اعرض السجلات من";
	$Translation['all tables'] = "جميع الجداول";
	$Translation['sort records'] = "رتب السجلات حسب ";
	$Translation['date created'] = "تاريخ الإنشاء";
	$Translation['date modified'] = "تاريخ التعديل";
	$Translation['newer first'] = "الأحدث اولا";
	$Translation['older first'] = "الأقدم أولا";
	$Translation['created'] = "تم إنشاؤه";
	$Translation['modified'] = "تم تعديله";
	$Translation['data'] = "بيانات";
	$Translation['change record ownership'] = "تغيير ملكية هذا السجل";
	$Translation['sure delete record'] = "هل أنت متأكد من رغبتك في مسح هذا السجل؟";
	$Translation['delete record'] = "مسح هذا السجل";
	$Translation['displaying records'] = "عرض سجلات <RECORDNUM1> من <RECORDNUM2> إلى <RECORDS>";
	
?>
