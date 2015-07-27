<?php
/*
 * @author     Flip
 * @package    FreifunkInstaller
 * @version    1.0
 
 provides access to the json data
 */
function getCommunityJSON($community)
{
    $json = null;

	switch ($community) {
		case 'Stuttgart':
			$json = 'http://gw01.freifunk-stuttgart.de/gluon/firmwares_s.json';
			break;

		default:
			break;
	}

	return $json == null ? null : file_get_contents($json);
}

if(isset($_GET['echo']) && $_GET['echo'] == 'true')
{
    header('Content-type: application/json'); // Always talk JSON

    header('Cache-Control: no-cache, must-revalidate');
    header('Expires: Mon, 26 Jul 1997 05:00:00 GMT');

    echo getCommunityJSON($_GET['community']);
}

?>