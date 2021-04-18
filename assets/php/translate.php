<?php
	if (session_status() == PHP_SESSION_NONE) {
		session_start();
	}

	include("connect.php");

	if(!isset($_SESSION["email"]) ){
		$translate_id = "EN";
	} else {
		
		$sql="SELECT * FROM members WHERE username='".$_SESSION["email"]."'";
		$rs=mysqli_query($con,$sql);
		$row=mysqli_fetch_array($rs);

		if(!$row["lang"] == ""){
			$translate_id = $row["lang"];
		} else {
			$translate_id = "EN";
		}
	}

	if(isset($_GET["lang"])){
		$sql="UPDATE members SET lang='" . $_GET['lang'] . "' WHERE username='".$_SESSION["email"]."'";
		$rs=mysqli_query($con,$sql);
		$_SESSION["message"] = "Language changed successfully!";
		header("location:/profile");
		exit;
	}


	if($translate_id == "EN"){ //English -------------------------------------
		
		$display_gems = "You have";
		$menu_home = "Home";
		$menu_make_gems = "Make money";
		$menu_get_reward = "Payout";
		$menu_profile = "Profile";
		$menu_logout = "Logout";
                $menu_partners = "Partners";
                $menu_fill = "Fill Captcha";

		$profile_change_settings = "Change settings:";
		$profile_statistics = "statistics:";
		$profile_user_information = "User information:";

		$profile_change_email = "Change Email";
		$profile_change_password = "Change Password";
		$profile_change_language = "Change language";
		$profile_email_adress = "Email adress:";
		$profile_last_password_change = "Last password change:";
		$profile_product_token = "Product token:";
                $profile_account = "Account";
                $profile_note = "";

		$make_gems_title = "Here are all the things you can make money on.";
		$make_gems_watch_ads = "Watch advertisements";
		$make_gems_masterpartner = "Send discord advertisements(MasterPartner).";
		$make_gems_minilinks = "URL shortener";
		$make_gems_iplayit = "Play games while making gems(iPlay.it).";
		$make_gems_tip = "<b>Tip:</b> If you have a youtube channel use MiniLinks to redirect members to your soical media.";


	} else if($translate_id == "NL"){ //Dutch -------------------------------------
		$display_gems = "U heeft";
		$menu_home = "Home";
		$menu_make_gems = "Geld verdienen";
		$menu_get_reward = "Uitbetaling";
		$menu_profile = "Profiel";
		$menu_logout = "Afmelden";
                $menu_partners = "Partnere";
                $menu_fill = "Fyld Captcha";

		$profile_change_settings = "Verander instellingen:";
		$profile_statistics = "statistieken:";
		$profile_user_information = "Gebruikers informatie:";

		$profile_change_email = "Verander email";
		$profile_change_password = "Verander wachtword";
		$profile_change_language = "Verander taal";
		$profile_email_adress = "Email adres:";
		$profile_last_password_change = "Laste wachtword wijziging:";
		$profile_product_token = "Product token:";
                $profile_account = "Account";
                $profile_note = "";

		$make_gems_title = "Hier zijn alle dingen waar je geld mee kan maken.";
		$make_gems_watch_ads = "Kijk advertenties";
		$make_gems_masterpartner = "Verstuur Discord advertenties(MasterPartner)";
		$make_gems_minilinks = "Link verklijner";
		$make_gems_iplayit = "Speel games en verdien Gems(iPlay.it).";
		$make_gems_tip = "<b>Tip:</b> Als je een Youtube kanaal hebt gebruik dan Minilinks om mensen naar uw soical media te stuuren.";

	} else if($translate_id == "RO"){ //Romania -------------------------------------
		$display_gems = "Aveți";
		$menu_home = "Acasă";
		$menu_make_gems = "Câștigați bani";
		$menu_get_reward = "Recompense";
		$menu_profile = "Profil";
		$menu_logout = "Delogare";
                $menu_partners = "Parteneri";
                $menu_fill = "Completeaza Captcha";

		$profile_change_settings = "Schimbare setări:";
		$profile_statistics = "Statistici:";
		$profile_user_information = "Informații utilozator:";

		$profile_change_email = "Modificați adresa de e-mail";
		$profile_change_password = "Modificați parola";
		$profile_change_language = "Modificați limba";
		$profile_email_adress = "Adresă de e-mail";
		$profile_last_password_change = "Parola a fost schimbată ultima oară pe:";
		$profile_product_token = "Cod unic:";
                $profile_account = "Cont";
                $profile_note = "";

		$make_gems_title = "Aici sunt toate modalitățile prin care puteți obține bani.";
		$make_gems_watch_ads = "Lăsați o pagină să ruleze cu anunțuri";
		$make_gems_masterpartner = "Trimiteți anunțuri pe Discord (MasterPartner)";
		$make_gems_minilinks = "Scurtați linkuri (MiniLinks).";
		$make_gems_iplayit = "Jucați jocuri (iPlay.it).";
		$make_gems_tip = "<b>Pont:</b> Dacă aveți un canal de YouTube, puteți folosi <i>MiniLinks</i> pentru a scurta linkurile către rețelele sociale din descrierile clipurilor.";
       } else if($translate_id == "PL"){ //Polish -------------------------------------
		
		$display_gems = "Posiadasz: ";
		$menu_home = "Strona Glowna";
		$menu_make_gems = "Zarabiaj pieniadze";
		$menu_get_reward = "Wyplata";
		$menu_profile = "Profil";
		$menu_logout = "Wyloguj sie";
                $menu_partners = "Partnerzy";
                $menu_fill = "Wypelnij Captcha";

		$profile_change_settings = "Zmien ustawienia:";
		$profile_statistics = "Statystyki:";
		$profile_user_information = "Informacje o uzytkowniku:";

		$profile_change_email = "Zmien adres e-mail";
		$profile_change_password = "Zmien haslo";
		$profile_change_language = "Zmien jezyk";
		$profile_email_adress = "Adres e-mail:";
		$profile_last_password_change = "Ostatnia zmiana hasla:";
		$profile_product_token = "Token produktu:";
                $profile_account = "Konto";
                $profile_note = "";

		$make_gems_title = "Oto wszystkie rzeczy, na kt�rych mozesz zarabiac pieniadze.";
		$make_gems_watch_ads = "Ogladaj reklamy";
		$make_gems_masterpartner = "Wysylaj reklamy discord (MasterPartner).";
		$make_gems_minilinks = "Skracacz URL";
		$make_gems_iplayit = "Graj w gry, zdobywajac klejnoty (iPlay.it).";
		$make_gems_tip = "<b>Wskaz�wka:</b> Jesli masz kanal na youtube, uzyj Skracacz URL, aby przekierowac czlonk�w na Twoje socialmedia.";

	}
?>