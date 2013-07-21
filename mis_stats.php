<?php
/*-------------------------------------------------------+
| PHP-Fusion Content Management System
| Copyright © 2002 - 2008 Nick Jones
| http://www.php-fusion.co.uk/
+--------------------------------------------------------+
| Archivo : Mis_Stats.php
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
require_once "../../maincore.php";
require_once THEMES."templates/header.php";

if (file_exists(INFUSIONS."mi_conexion_panel/locale/".$settings['locale'].".php")) {
  include INFUSIONS."mi_conexion_panel/locale/".$settings['locale'].".php";
} else {
	include INFUSIONS."mi_conexion_panel/locale/Spanish.php";
}

opentable($locale['zl_stats_titulo']);

if (iMEMBER) {

add_to_head("<style type='text/css'>
body{
font-family:Arial, Helvetica, sans-serif; 
font-size:13px;
}
.info, .bien, .peligro, .error, .validacion {
border: 1px solid;
margin: 10px 0px;
padding:15px 10px 15px 50px;
background-repeat: no-repeat;
background-position: 10px center;
}
.info {
color: #00529B;
background-color: #BDE5F8;
background-image: url('images/Info.png');
}
.bien {
color: #4F8A10;
background-color: #DFF2BF;
background-image:url('images/Bien.png');
}
.peligro {
color: #9F6000;
background-color: #FEEFB3;
background-image: url('images/Peligro.png');
}
.error {
color: #D8000C;
background-color: #FFBABA;
background-image: url('images/Error.png');
}
.validacion {
color: #D63301;
background-color: #FFCCBA;
background-image: url('images/Infor.png');
}
</style>");

echo "<div align='center'>";

	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/Stats.png'><br />";

	
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_avatar'].".";

	if ($userdata['user_avatar'] != "") {
	echo " <div class=\"avataras\" >
	<a href='".BASEDIR."edit_profile.php'><img border='0'  src='".BASEDIR."images/avatars/".$userdata['user_avatar']."'></p></a>
</div>\n";
} else {
echo "<div class=\"avataras\" >
	<a href='".BASEDIR."edit_profile.php'><img border='0'  src='".INFUSIONS."mi_conexion_panel/images/no-avatar.png'></div></a>\n";
}

echo"<div style='border-top: 0px solid #ccc; border-bottom: 1px solid #ccc; padding-top: 4px;  padding-bottom: 4px; margin-top: 5px; margin-bottom: 5px;'></div><br />";

	add_to_head("<link rel='stylesheet' href='".INFUSIONS."mi_conexion_panel/css/Spamfusion.css' type='text/css' media='screen' />");

	echo "<div class='SpamFusion' ><table ><tr><td>";
	echo "Información Personal";
	echo "</td> ";
	echo "<td >";
	echo "Mis Colaboraciones";
	echo "</td>";
	echo "<td>";
	echo "Info SpamFusion";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td >";
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_nick'].": <strong><span style='color:green;'>".$userdata['user_name']."</span></strong>";
	echo "</td>";
	echo "<td>";
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_foro'].": <strong>".number_format($userdata['user_posts'])."</td></strong>";
	echo "</td>";
	echo "<td>";
	include LOCALE.LOCALESET."photogallery.php";

	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['405'].dbcount("(photo_id)", DB_PHOTOS, "album_id='".$data['album_id']."'")."</span>\n";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td >";
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_ip'].": <strong>".$userdata['user_ip']."</strong>";
	echo "</td>";
	echo "<td>";
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_pub'].": <strong>".number_format(dbcount("(comment_id)", DB_COMMENTS, "comment_name='".$userdata['user_id']."'"))."</td></strong>";
	echo "</td>";
	echo "<td>";
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_miem'].": <strong>".dbcount("(user_id)", DB_USERS)."</strong>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td >";
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_id'].": <strong>".number_format($userdata['user_id'])."</strong>";
	echo "</td>";
	echo "<td>";
	include_once INFUSIONS."shoutbox_panel/infusion_db.php";
	if (dbrows(dbquery("SHOW TABLES LIKE '".DB_SHOUTBOX."'"))) {
		echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_mini'].": <strong>".number_format(dbcount("(shout_id)", DB_SHOUTBOX, "shout_name='".$userdata['user_id']."'"))."</td></strong>"; }
	echo "</td>";
	echo "<td>";
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_not'].":<strong> ".number_format(dbcount("(news_id)", DB_NEWS))."</strong>";
	echo "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td >";
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_reg'].": <strong>".showdate("%d/%m/%Y", $userdata['user_joined'])."</strong>";
	echo "</td>";
	echo "<td>";
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'>".$locale['zl_con_des'].": <strong>".number_format(dbcount("(download_id)", DB_DOWNLOADS, "download_user='".$userdata['user_id']."'"))."</td></strong>";
	echo "</td>";
	echo "<td>";
	echo "<img border='0'  src='".INFUSIONS."mi_conexion_panel/images/bullet.gif'><a href='".BASEDIR."index.php?logout=yes' class='side'>".$locale['global_124']."</a><br />\n";
	echo "</td>";
	echo "</tr>";
	echo "</table>";
	echo "</div><br />\n";
}

echo "\n</div>";
closeside();
require_once THEMES."templates/footer.php";
?>
