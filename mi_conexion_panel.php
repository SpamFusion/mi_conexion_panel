<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Archivo : Mi_Conexion_Panel.php
| Autor : SpaM
+--------------------------------------------------------*
| This program is released as free software under the
| Affero GPL license. You can redistribute it and/or
| modify it under the terms of this license which you
| can read by viewing the included agpl.txt or online
| at www.gnu.org/licenses/agpl.html. Removal of this
| copyright header is strictly prohibited without
| written permission from the original author(s).
+--------------------------------------------------------*/
if (!defined("IN_FUSION")) { die("Acceso Denegado"); }

if (file_exists(INFUSIONS."mi_conexion_panel/locale/".$settings['locale'].".php")) {
    include INFUSIONS."mi_conexion_panel/locale/".$settings['locale'].".php";
} else {
    include INFUSIONS."mi_conexion_panel/locale/Spanish.php";
}

if (iMEMBER) {
  $msg_count = dbcount("(message_id)", DB_MESSAGES, "message_to='".$userdata['user_id']."' AND message_read='0' AND message_folder='0'");

	openside($userdata['user_name']);
	
	if ($msg_count) {

		echo "<strong><a href='".BASEDIR."messages.php' class='side'>".sprintf($locale['msg_con_0'], $msg_count);
		echo ($msg_count == 1 ? $locale['msg_con_1'] : $locale['msg_con_2'])."</a></strong>\n";

	echo"<div style='border-top: 0px solid #ccc; border-bottom: 1px solid #ccc; padding-top: 4px;  padding-bottom: 4px; margin-top: 0px; margin-bottom: 5px;'></div>";
	}
	
      if ($userdata['user_avatar'] != "") {
	echo " <div class=\"avataras\" >
	<a href='".BASEDIR."edit_profile.php'><img border='0'  src='".BASEDIR."images/avatars/".$userdata['user_avatar']."'></p></a>
</div>\n";
} else {
echo "<div class=\"avataras\" >
	<a href='".BASEDIR."edit_profile.php'><img border='0'  src='".INFUSIONS."mi_conexion_panel/images/no-avatar.png'></div></a>\n";
}
	echo THEME_BULLET." <a href='".BASEDIR."edit_profile.php' class='side'>".$locale['global_120']."</a><br />\n";
     echo THEME_BULLET." <a href='".INFUSIONS."avatar_studio/avatar_studio.php' class='side'>".$locale['zl_con_av']."</a><br />\n";
	echo THEME_BULLET." <a href='".BASEDIR."messages.php' class='side'>".$locale['global_121']."</a><br />\n";
	echo THEME_BULLET." <a href='".BASEDIR."members.php' class='side'>".$locale['global_122']."<br /></a>\n";
	echo THEME_BULLET." <a href='".INFUSIONS."mi_conexion_panel/mis_stats.php' class='side'>".$locale['zl_con_est']."</a>\n";
	if (iADMIN && (iUSER_RIGHTS != "" || iUSER_RIGHTS != "C")) {
		echo "<br />".THEME_BULLET." <a href='".ADMIN."index.php".$aidlink."' class='side'>".$locale['global_123']."</a>\n";
	}

   echo"<div style='border-top: 0px solid #ccc; border-bottom: 1px solid #ccc; padding-top: 4px;  padding-bottom: 4px; margin-top: 5px; margin-bottom: 5px;'></div>";

add_to_head("<style type='text/css'> 
.cerrar
{
padding: 5px 0px 10px 0px;}
		.cerrar { 
border: 0px solid; padding: 2px 0px 2px 3px;
		background-repeat: no-repeat; background-position: 7px center;
		 background-color: #A5C5FD;
		border-radius: 5px; -moz-border-radius: 5px; -webkit-border-radius: 5px;
 } 
</style>");

    echo"<div class='cerrar'>\n
	<div class='cerrar'>\n";
   echo THEME_BULLET." <a href='".BASEDIR."index.php?logout=yes' class='side'>".$locale['global_124']."</a><br />\n";
echo"</div>\n</div>\n";

   echo"<div style='border-top: 0px solid #ccc; border-bottom: 1px solid #ccc; padding-top: 4px;  padding-bottom: 4px; margin-top: 5px; margin-bottom: 5px;'></div>";


   if (iADMIN && checkrights("SU")) {
      $subm_count = dbcount("(submit_id)", DB_SUBMISSIONS);

      if ($subm_count) {
         echo "<div style='text-align:left;margin-top:15px;'>\n";
         echo "<strong><a href='".ADMIN."submissions.php".$aidlink."' class='side'>".sprintf($locale['global_125'], $subm_count);
         echo ($subm_count == 1 ? $locale['global_128'] : $locale['global_129'])."</a></strong>\n";
         echo "</div>\n";
      }
   }
   closeside();
} else {
   if (!preg_match('/login.php/i',FUSION_SELF)) {
      $action_url = FUSION_SELF.(FUSION_QUERY ? "?".FUSION_QUERY : "");
      if (isset($_GET['redirect']) && strstr($_GET['redirect'], "/")) {
         $action_url = cleanurl(urldecode($_GET['redirect']));
      }

		openside($locale['global_100']);

	echo "<div style='text-align: center; padding: 4px;'><strong>".$locale['zl_con_in']."</strong></div>";

   echo"<div style='border-top: 0px solid #ccc; border-bottom: 1px solid #ccc; padding-top: 4px;  padding-bottom: 4px; margin-top: 5px; margin-bottom: 5px;'></div>";

		echo "<div style='text-align:center'>\n";
		echo "<form name='loginform' method='post' action='".$action_url."'>\n";
		echo $locale['global_101']."<br />\n<input type='text' name='user_name' class='textbox' style='width:100px' /><br />\n";
		echo $locale['global_102']."<br />\n<input type='password' name='user_pass' class='textbox' style='width:100px' /><br />\n";
		echo "<label><input type='checkbox' name='remember_me' value='y' title='".$locale['global_103']."' style='vertical-align:middle;' /></label>\n";
		echo "<input type='submit' name='login' value='".$locale['global_104']."' class='button' /><br />\n";
		echo "</form>\n<br />\n";

		if ($settings['enable_registration']) {
			echo $locale['global_105']."<br /><br />\n";
		}
		echo $locale['global_106']."\n</div>\n";
		closeside();
	}
}
?>
