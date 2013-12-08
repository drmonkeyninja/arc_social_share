<?php
$plugin['name'] = 'arc_social_share';
$plugin['version'] = '1.0';
$plugin['author'] = 'Andy Carter';
$plugin['author_uri'] = 'http://andy-carter.com/';
$plugin['description'] = 'Social media share links';
$plugin['order'] = '5';
$plugin['type'] = '0';

if (!defined('txpinterface'))
	@include_once('zem_tpl.php');

# --- BEGIN PLUGIN CODE ---
global $prefs, $txpcfg;

function arc_social_share_delicious($atts, $thing=null)
{
	global $thisarticle;

	extract(lAtts(array(
		'class' => '',
		'title' => null,
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on Delicious' : parse($thing);
	
	$url = $url===null || !empty($thisarticle['thisid']) ? urlencode(permlinkurl_id($thisarticle['thisid'])) : urlencode($url);
	$title = $title===null || !empty($thisarticle['title']) ? urlencode($thisarticle['title']) : urlencode($title);
	
	$link = "http://delicious.com/post?url=$url&amp;title=$title";

	$html = href($thing, $link, ' class="'.$class.'"');
		
	return $html;
}

function arc_social_share_facebook($atts, $thing=null)
{
	global $thisarticle;

	extract(lAtts(array(
		'class' => '',
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on Facebook' : parse($thing);
	
	$url = $url===null ? urlencode(permlinkurl_id($thisarticle['thisid'])) : $url;
	$title = urlencode($thisarticle['title']);

	$html = href($thing, "http://www.facebook.com/share.php?u=$url&amp;title=$title"
		, ' class="'.$class.'"');
		
	return $html;
}

function arc_social_share_gplus($atts, $thing=null)
{
	global $thisarticle;

	extract(lAtts(array(
		'class' => '',
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on Google+' : parse($thing);
	
	$url = $url===null ? urlencode(permlinkurl_id($thisarticle['thisid'])) : $url;

	$html = href($thing, "https://plus.google.com/share?url=$url"
		, ' class="'.$class.'"');
		
	return $html;
}

function arc_social_share_linkedin($atts, $thing=null)
{
	global $thisarticle, $prefs;

	extract(lAtts(array(
		'class' => '',
		'source' => null,
		'summary' => null,
		'title' => null,
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on LinkedIn' : parse($thing);
	
	$url = $url===null || !empty($thisarticle['thisid']) ? urlencode(permlinkurl_id($thisarticle['thisid'])) : urlencode($url);
	$title = $title===null || !empty($thisarticle['title']) ? urlencode($thisarticle['title']) : urlencode($title);
	$source = $source===null || !empty($prefs['sitename']) ? urldecode($prefs['sitename']) : urlencode($source);

	$link = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$url&amp;title=$title&amp;source=$source";

	if (!empty($summary)) {
		$link .= "&amp;summary=$summary";
	}

	$html = href($thing, $link, ' class="'.$class.'"');
		
	return $html;
}

function arc_social_share_twitter($atts, $thing=null)
{
	global $thisarticle;

	extract(lAtts(array(
		'class' => '',
		'url' => null
	), $atts));
	
	$thing = ($thing===null) ? 'Share on Twitter' : parse($thing);
	
	$url = $url===null ? urlencode(permlinkurl_id($thisarticle['thisid'])) : $url;
	$title = urlencode($thisarticle['title']);

	$html = href($thing, "http://twitter.com/home?status=$title+$url"
		, ' class="'.$class.'"');
		
	return $html;
}


# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---

h1. arc_social_share

Easily add links for sharing content with numerous social networks.

h2. Installation

To install go to 'Plugins' under 'Admin' and paste the plugin code into the 'Install plugin' box, 'upload' and then 'install'.

h2. Usage

h3. Delicious

bc. <txp:arc_social_share_delicious />

h3. Facebook

bc. <txp:arc_social_share_facebook />

h3. Google+

bc. <txp:arc_social_share_gplus />

h3. LinkedIn

bc. <txp:arc_social_share_linkedin />

h3. Twitter

bc. <txp:arc_social_share_twitter />


# --- END PLUGIN HELP ---
-->
<?php
}
?>
