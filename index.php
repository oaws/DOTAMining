<?php
    require ('steamauthOOP.class.php');  
    $steam = new steamauthOOP();
    if (isset($_GET["logout"])) {
        $steam->logout();
    }
	include "database_config.php"; 

?>

<html>
	<head>
		<title>DOTA2Mining</title>
		<meta charset="utf-8" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />
		<!--[if lte IE 8]><script src="assets/js/ie/html5shiv.js"></script><![endif]-->
		<link rel="stylesheet" href="assets/css/main.css" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css">
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
    <style>
        .table {
            table-layout: fixed;
            word-wrap: break-word;
        }
    </style>
	</head>
	<body>

		<!-- Header -->
			<section id="header">
				<header>
					<span class="image avatar"><img src="images/avatar.jpg" alt="" /></span>
					<h1 id="logo"><a href="#">DOTA2Mining</a></h1>
					<p>Recommendation Engine</p>
				</header>
				<nav id="nav">
					<ul>
						<li><a href="#one" class="active">Recommendation Engine</a></li>
						<li><a href="#two">About Project</a></li>
						<li><a href="https://github.com/oaws/DOTAMining">Source Code</a></li>
						<li><a href="#">Report</a></li>
	
					</ul>
				</nav>
				<footer>
					<ul class="icons">
						<li><a href="#" class="icon fa-github"><span class="label">Github</span></a></li>
						<li><a href="#" class="icon fa-envelope"><span class="label">Email</span></a></li>
					</ul>
				</footer>
			</section>

		<!-- Wrapper -->
			<div id="wrapper">

				<!-- Main -->
					<div id="main">

						<!-- One -->
							<section id="one">
    <div class="container" style="margin-top: 30px; margin-bottom: 30px; padding-bottom: 10px; background-color: #FFF;">
		<h1>Steam API Data</h1>
		<span class="small pull-left" style="padding-right: 10px;">for DOTA2Mining CSE293</span>
		<hr>
		<?php
if(!$steam->loggedIn()) {
    echo "<div style='margin: 30px auto; text-align: center;'>Welcome Guest! <a href='";
    echo $steam->loginUrl();
    echo "'>Please log in!</a></div>";
	} else {
    echo "<h4 style='margin-bottom: 3px; float:left;'>Steam API-Output: <small>There are more variables ready to use but not listed here as they are not always available.</small></h4><span style='float:right;'><a href='index.php?logout'>Log out</a></span>
	<table class='table table-striped'><tr><td><b>Variable name</b></td><td><b>Value</b></td><td><b>Description</b></td></tr>
	<tr><td>\$steam->loggedIn()</td><td>".$steam->loggedIn()."</td><td>1 (true) - Logged in, 0 (false) - not</td></tr>
	<tr><td>\$steam->steamid</td><td>".$steam->steamid."</td><td>SteamID64 of the user</td></tr>
	<tr><td>\$steam->communityvisibilitystate</td><td>".$steam->communityvisibilitystate."</td><td>1 - Account not visible; 3 - Account is public (Depends on the relationship of your account to the others)</td></tr>
	<tr><td>\$steam->profilestate</td><td>".$steam->profilestate."</td><td>1 - The user has a Steam Community profile; 0 - if not</td></tr>
	<tr><td>\$steam->personaname</td><td>".$steam->personaname."</td><td>Public name of the user</td></tr>
	<tr><td>\$steam->lastlogoff</td><td>".$steam->lastlogoff."</td><td><a href='http://www.unixtimestamp.com/' target='_blank'>Unix timestamp</a> of the user's last logoff</td></tr>
	<tr><td>\$steam->profileurl</td><td>".$steam->profileurl."</td><td>Link to the user's profile</td></tr>
	<tr><td>\$steam->personastate</td><td>".$steam->personastate."</td><td>0 - Offline, 1 - Online, 2 - Busy, 3 - Away, 4 - Snooze, 5 - looking to trade, 6 - looking to play</td></tr>
	<tr><td>\$steam->realname</td><td>".$steam->realname."</td><td>\"Real\" name</td></tr>
	<tr><td>\$steam->primaryclanid</td><td>".$steam->primaryclanid."</td><td>The ID of the user's primary group</td></tr>
	<tr><td>\$steam->timecreated</td><td>".$steam->timecreated."</td><td><a href='http://www.unixtimestamp.com/' target='_blank'>Unix timestamp</a> for the time the user's account was created</td></tr>
	<tr><td>\$steam->avatar</td><td><img src='".$steam->avatar."'><br>".$steam->avatar."</td><td>Adress of the user's 32x32px avatar</td></tr>
	<tr><td>\$steam->avatarmedium</td><td style=''><img src='".$steam->avatarmedium."'><br>".$steam->avatarmedium."</td><td>Adress of the user's 64x64px avatar</td></tr>
	<tr><td>\$steam->avatarfull</td><td><img src='".$steam->avatarfull."'><br>".$steam->avatarfull."</td><td>Adress of the user's 184x184px avatar</td></tr>
	</table>";
   

	echo "<h4>Please Select Hero</h4>

    <form action='index.php' enctype='multipart/form-data' name='myform' id='myform' method='post'>
        <fieldset >


				<input type='text' name='hero1' list='test' style='width: 500px;' size='64'>
		        <datalist id='test' name='test'>";
            
            
			$cdquery="SELECT HeroLink as hero1 FROM heroref";
            $cdresult=mysql_query($cdquery) or die ("Query to get data from firsttable failed: ".mysql_error());
            
            while ($cdrow=mysql_fetch_array($cdresult)) {
            $hero1=$cdrow["hero1"];
                echo "<option>
                    $hero1
                </option>";
            
            }           


    echo "
        </datalist>
		</input>
		</br></br>	
	
        <input type='submit' name='submit' id='submit' style='width: 200px;' value='Submit' />
         
        </fieldset>
        </form></br>";
		
// Parse the form data and add inventory item to the system
if (isset($_POST['submit'])) {
	$hero1 = mysql_real_escape_string($_POST['hero1']);
	//echo $hero1;
	$sql = mysql_query("SELECT HeroID as id FROM heroref where HeroLink = '$hero1'") or die (mysql_error());
	while ($cdrow=mysql_fetch_array($sql)) {
	$h1=$cdrow["id"];
	//echo $h1; 		
}
	$hex = dechex($steam->steamid);
	$hex = dechex($steam->steamid);
	//echo $hex;
	//echo "\n";
	$hex8= substr($hex, -8);
	//echo $hex8;
	//echo "\n";
	$theid = hexdec($hex8);
	echo $theid;
	echo "\n";
	$url ="https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=1E4BBF540F140DD0A5854881B2BEDF10&account_id=76561198068418756&hero_id=$h1";
	echo $url;
	$json = file_get_contents($url);
	$data = json_decode($json);
	echo "\n";
			$num= $data->{'result'}->{'num_results'};
		print $num;
						echo "\n";

for ($x = 0	; $x <= $num; $x++) {
			//for($j = 0; $j <= 10; $j++){
			//foreach ($data->{'result'}->{'matches'}[$x]->{'players'}[$j]->{'account_id'} as $a)
			//print $data->{'result'}->{'matches'}[0]->{'players'}[0]->{'account_id'};
			foreach ($data->{'result'}->{'matches'}[$x] as $a)
			{
				//print $a;
				//echo "Tamatar11";
				$urlx ="https://api.steampowered.com/IDOTA2Match_570/GetMatchDetails/V001?match_id=$a&key=1E4BBF540F140DD0A5854881B2BEDF10";
				echo $urlx;
				//echo "Tamatar0";
				$jsonx = file_get_contents($urlx);
				$datax = json_decode($jsonx);
				//echo $data1;
				
				for ($y = 0	; $y <= 10; $y++) {
				$playerId = $datax->{'result'}->{'players'}[$y]->{'account_id'};
				if($playerId==$theid){
				//	echo "Mallesh";
				$upgrade = "|";
				$a = $datax->{'result'}->{'players'}[$y]->{'account_id'};
				$gpm = $datax->{'result'}->{'players'}[$y]->{'gold_per_min'};				
				$hid = $datax->{'result'}->{'players'}[$y]->{'hero_id'};
				$sqlx = mysql_query("SELECT HeroLink as link FROM heroref where HeroID = $hid") or die (mysql_error());
					while ($cdrow=mysql_fetch_array($sqlx)) {
						$hero=$cdrow["link"];
						}
				$d = $datax->{'result'}->{'players'}[$y]->{'deaths'};								
				$gold = 0;
				$level = $datax->{'result'}->{'players'}[$y]->{'level'};	

				
				//echo "tamatar";
				
				for ($z = 0	; $z <= $level; $z++) {
								//	echo "tamatar1";

					$up=$datax->{'result'}->{'players'}[$y]->{'ability_upgrades'}[$z]->{'ability'};
													//	echo "tamatar2";

					echo $up;
					if (isset($up)) {

					echo "SELECT aname as an FROM afinal where aid = $up";
					$sqly = mysql_query("SELECT aname as an FROM afinal where aid = $up");
									if(mysql_errno()){echo "Payjamaq";
					echo "MySQL error ".mysql_errno().": "
						.mysql_error()."\n<br>When executing <br>\n$query\n<br>";
				}
					while ($cdrow=mysql_fetch_array($sqly)) {
						$an=$cdrow["an"];
						$upgrade=$upgrade.trim($an)."|";
						}
						echo "\n";
						echo $upgrade;
					//exit;
					}
				}
				if($upgrade!="|"){
				$k = $datax->{'result'}->{'players'}[$y]->{'kills'};
				$ddet=0;
				$lh =  $datax->{'result'}->{'players'}[$y]->{'last_hits'};
				$xpm = $datax->{'result'}->{'players'}[$y]->{'xp_per_min'};
				$win = 0;
				$duration = $datax->{'result'}->{'duration'};
				//echo "\n";
				//echo $playerId;
				$result = mysql_query("INSERT INTO featuress (playerID, upgradeSeq, hero, a, gpm, d, gold, level, k, ddet, lh, xpm, win, duration) VALUES ('$playerId','$upgrade','$hero','$a','$gpm','$d','$gold','$level','$k','$ddet','$lh','$xpm','$win','$durations')");
				if(mysql_errno()){echo "Payjama";
					echo "MySQL error ".mysql_errno().": "
						.mysql_error()."\n<br>When executing <br>\n$query\n<br>";
				}
				break;
				}
				}				
				}
				/*$a = $obj->{'features'}->{'a'};
				$gpm = $obj->{'features'}->{'gpm'};
				$hero = $obj->{'features'}->{'hero'};
				$d = $obj->{'features'}->{'d'};
				$gold = $obj->{'features'}->{'gold'};
				$level = $obj->{'features'}->{'level'};
				$k = $obj->{'features'}->{'k'};
				$ddet = $obj->{'features'}->{'ddet'};
				$lh = $obj->{'features'}->{'lh'};
				$xpm = $obj->{'features'}->{'xpm'};
				$win = $obj->{'features'}->{'win'};
				$duration = $obj->{'features'}->{'duration'};*/
	
				/*$query = "INSERT INTO featuress (`playerID`, `upgradeSeq`, `hero`, `a`, `gpm`, `d`, `gold`, `level`, `k`, `ddet`, `lh`, `xpm`, `win`, `duration`) VALUES ('".mysql_real_escape_string($playerId)."','".mysql_real_escape_string($upgrade)."','".mysql_real_escape_string($hero)."','".mysql_real_escape_string($a)."','".mysql_real_escape_string($gpm)."','".mysql_real_escape_string($d)."','".mysql_real_escape_string($gold)."','".mysql_real_escape_string($level)."','".mysql_real_escape_string($k)."','".mysql_real_escape_string($ddet)."','".mysql_real_escape_string($lh)."','".mysql_real_escape_string($xpm)."','".mysql_real_escape_string($win)."','".mysql_real_escape_string($duration)."')";
				$result = mysql_query($query);
				if(mysql_errno()){
					echo "MySQL error ".mysql_errno().": "
						.mysql_error()."\n<br>When executing <br>\n$query\n<br>";
				}*/
				
				
				
				echo "\n\n ";
				//echo "Tamatar";
				//echo "\n\n";
				break;
			}
			//}
			}
}
	} 
?>
		
	<hr>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>
 
							</section>

						<!-- Two -->
							<section id="two">
								<div class="container">
									<h3>About Project</h3>
									<p>DOTA2 Recommendation Engine</p>
									<ul class="feature-icons">
										<li class="fa-book">Research Papers:</li>
										<li class="fa-database">Data Set:</li>
										<li class="fa-share">Approach:</li>
										<li class="fa-check-square">Results:</li>
									</ul>
								</div>
							</section>


					</div>

				<!-- Footer -->
					<section id="footer">
						<div class="container">
							<ul class="copyright">
								<li>CSE 293 Project</li>
							</ul>
						</div>
					</section>

			</div>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.scrollzer.min.js"></script>
			<script src="assets/js/jquery.scrolly.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>