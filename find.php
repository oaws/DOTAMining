<?php

	function extractNameFromJson($json) {				echo "test1";

    foreach ($json->result->matches->players as $i => $matches) {				echo "test2";

        if (isset($players['account_id']) && $attribute['account_id'] == '135905765') {
				echo "test3";

            return $i;
        }
    }
}

	$id = 76561198068418756;
	//$hex = dechex($steam->steamid);
	$hex = dechex($id);
	//echo $hex;
	//echo "\n";
	$hex8= substr($hex, -8);
	//echo $hex8;
	//echo "\n";
	//echo hexdec($hex8);	
	$json = file_get_contents('https://api.steampowered.com/IDOTA2Match_570/GetMatchHistory/V001/?key=1E4BBF540F140DD0A5854881B2BEDF10&account_id=76561198068418756&hero_id=72');
	$obj = json_decode($json);	
	$index = extractNameFromJson($obj);
	echo $index;
	echo "Haule";
	echo $json->result->matches->players[$index]['account_id'];

	?>
