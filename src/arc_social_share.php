<?php
$plugin['name'] = 'arc_social_share';
$plugin['version'] = '1.3.2';
$plugin['author'] = 'Andy Carter';
$plugin['author_uri'] = 'http://andy-carter.com/';
$plugin['description'] = 'Social media share links';
$plugin['order'] = '5';
$plugin['type'] = '0';

if (!defined('txpinterface')) {
    @include_once('zem_tpl.php');
}

# --- BEGIN PLUGIN CODE ---
global $prefs, $txpcfg;

function arc_social_share_delicious($atts, $thing = null)
{
    extract(lAtts(array(
        'class' => '',
        'title' => null,
        'url' => null,
        'utm' => false
    ), $atts));

    $thing = ($thing===null) ? 'Share on Delicious' : parse($thing);

    $utmSource = $utm ? 'delicious.com' : null;

    $url = _arc_social_share_url($url, $utmSource);
    $title = _arc_social_share_title($title);

    $link = "http://delicious.com/post?url=$url&amp;title=$title";

    $html = href($thing, $link, ' class="' . $class . '"');

    return $html;
}

function arc_social_share_facebook($atts, $thing = null)
{
    extract(lAtts(array(
        'class' => '',
        'url' => null,
        'utm' => false
    ), $atts));

    $thing = ($thing===null) ? 'Share on Facebook' : parse($thing);

    $utmSource = $utm ? 'facebook.com' : null;

    $url = _arc_social_share_url($url, $utmSource);

    $html = href($thing, "https://www.facebook.com/sharer/sharer.php?u=$url", ' class="' . $class . '"');

    return $html;
}

function arc_social_share_gplus($atts, $thing = null)
{
    extract(lAtts(array(
        'class' => '',
        'url' => null,
        'utm' => false
    ), $atts));

    $thing = ($thing === null) ? 'Share on Google+' : parse($thing);

    $utmSource = $utm ? 'gplus' : null;

    $url = _arc_social_share_url($url, $utmSource);

    $html = href($thing, "https://plus.google.com/share?url=$url", ' class="' . $class . '"');

    return $html;
}

function arc_social_share_linkedin($atts, $thing = null)
{
    global $prefs;

    extract(lAtts(array(
        'class' => '',
        'source' => null,
        'summary' => null,
        'title' => null,
        'url' => null,
        'utm' => false
    ), $atts));

    $thing = ($thing === null) ? 'Share on LinkedIn' : parse($thing);

    $utmSource = $utm ? 'linkedin' : null;

    $url = _arc_social_share_url($url, $utmSource);
    $title = _arc_social_share_title($title);
    $source = $source === null && !empty($prefs['sitename']) ? urldecode($prefs['sitename']) : urlencode($source);

    $link = "http://www.linkedin.com/shareArticle?mini=true&amp;url=$url&amp;title=$title&amp;source=$source";

    if (!empty($summary)) {
        $link .= "&amp;summary=$summary";
    }

    $html = href($thing, $link, ' class="' . $class . '"');

    return $html;
}

function arc_social_share_pinterest($atts, $thing = null)
{
    extract(lAtts(array(
        'class' => '',
        'image' => null,
        'title' => null,
        'url' => null,
        'utm' => false
    ), $atts));

    $thing = ($thing === null) ? 'Share on Pinterest' : parse($thing);

    $utmSource = $utm ? 'pinterest' : null;

    $url = _arc_social_share_url($url, $utmSource);
    $title = _arc_social_share_title($title);
    $image = _arc_social_share_image($image);

    $link = "http://www.pinterest.com/pin/create/button/?url=$url&amp;description=$title";
    if ($image) {
        $link .= "&amp;media=$image";
    }

    $html = href($thing, $link, ' class="' . $class . '"');

    return $html;
}

function arc_social_share_pocket($atts, $thing = null)
{
    extract(lAtts(array(
        'class' => '',
        'title' => null,
        'url' => null,
        'utm' => false
    ), $atts));

    $thing = ($thing === null) ? 'Add to Pocket' : parse($thing);

    $utmSource = $utm ? 'getpocket.com' : null;

    $url = _arc_social_share_url($url, $utmSource);
    $title = _arc_social_share_title($title);

    $link = "https://getpocket.com/save?url=$url&amp;title=$title";

    $html = href($thing, $link, ' class="' . $class . '"');

    return $html;
}

function arc_social_share_reddit($atts, $thing = null)
{
    global $thisarticle;

    extract(lAtts(array(
        'class' => '',
        'title' => null,
        'url' => null,
        'utm' => false
    ), $atts));

    $thing = ($thing === null) ? 'Share on Reddit' : parse($thing);

    $utmSource = $utm ? 'reddit' : null;

    $url = _arc_social_share_url($url, $utmSource);
    $title = _arc_social_share_title($title);

    $link = "http://www.reddit.com/submit?url=$url&amp;title=$title";

    $html = href($thing, $link, ' class="' . $class . '"');

    return $html;
}

function arc_social_share_stumbleupon($atts, $thing = null)
{
    extract(lAtts(array(
        'class' => '',
        'title' => null,
        'url' => null,
        'utm' => false
    ), $atts));

    $thing = ($thing === null) ? 'Share on StumbleUpon' : parse($thing);

    $utmSource = $utm ? 'stumbleupon' : null;

    $url = _arc_social_share_url($url, $utmSource);
    $title = _arc_social_share_title($title);

    $link = "http://www.stumbleupon.com/submit?url=$url&amp;title=$title";

    $html = href($thing, $link, ' class="' . $class . '"');

    return $html;
}

function arc_social_share_tumblr($atts, $thing = null)
{
    extract(lAtts(array(
        'class' => '',
        'title' => null,
        'url' => null,
        'utm' => false
    ), $atts));

    $thing = ($thing === null) ? 'Share on Tumblr' : parse($thing);

    $utmSource = $utm ? 'tumblr' : null;

    $url = _arc_social_share_url($url, $utmSource);
    $title = _arc_social_share_title($title);

    $link = "http://www.tumblr.com/share?v=3&amp;u=$url&amp;t=$title";

    $html = href($thing, $link, ' class="' . $class . '"');

    return $html;

}

function arc_social_share_twitter($atts, $thing = null)
{
    global $thisarticle;

    extract(lAtts(array(
        'class' => '',
        'mention' => null,
        'title' => null,
        'url' => null,
        'utm' => false
    ), $atts));

    $thing = ($thing === null) ? 'Share on Twitter' : parse($thing);

    $utmSource = $utm ? 'twitter.com' : null;

    $url = _arc_social_share_url($url, $utmSource);
    $title = _arc_social_share_title($title);

    $link = "http://twitter.com/home?status=$title+$url";

    if (!empty($mention)) {
        $link .= urlencode(" /@$mention");
    }

    $html = href($thing, $link, ' class="' . $class . '"');

    return $html;
}

function _arc_social_share_title($title = null)
{
    global $thisarticle;

    $title = $title === null && !empty($thisarticle['title']) ? urlencode($thisarticle['title']) : urlencode($title);

    return $title;
}

function _arc_social_share_url($url, $source = null)
{
    global $thisarticle;

    $url = $url === null && !empty($thisarticle['thisid']) ? permlinkurl_id($thisarticle['thisid']) : $url;

    if (!empty($url) && !empty($source)) {
        // Add Google Analytics urchin tracking module to the URL
        $query = "utm_source=$source&utm_medium=social&utm_campaign=arc_social_share";
        $query .= !empty($thisarticle['thisid']) ? '&utm_content=txp:' . $thisarticle['thisid'] : '';
        $separator = (parse_url($url, PHP_URL_QUERY) == null) ? '?' : '&';
        $url .= $separator . $query;

    }

    if (!empty($url)) {
        // Encode the URL
        $url = urlencode($url);
    }

    return $url;
}

function _arc_social_share_image($image = null)
{
    global $thisarticle;

    if ($image === null && !empty($thisarticle['article_image'])) {
        $image = $thisarticle['article_image'];

        if (intval($image)) {
            if ($rs = safe_row('*', 'txp_image', 'id = ' . intval($image))) {
                $image = urlencode(imagesrcurl($rs['id'], $rs['ext']));
            } else {
                $image = null;
            }

        }

    }

    return $image;
}


# --- END PLUGIN CODE ---
if (0) {
?>
<!--
# --- BEGIN PLUGIN HELP ---

h1. arc_social_share

Easily add links for sharing content with numerous social networks.

h2. Installation

To install go to 'Plugins' under 'Admin' and paste the plugin code into the 'Install plugin' box, 'upload' and then 'install'. You will then need to activate the plugin.

h2. The Tags

All tags have the following attributes:-

* class: class name to be applied to the link tag
* url: URL to share, use this to override the article's permlink
* utm: pass '1' to enable UTM parameters for Google Analytics (off by default)

All tags apart from @arc_social_share_facebook@ and @arc_social_share_gplus@ have a 'title' attribute for overridding the article's title to be included in the share link.

h3. Delicious

bc. <txp:arc_social_share_delicious />

h3. Facebook

bc. <txp:arc_social_share_facebook />

h3. Google+

bc. <txp:arc_social_share_gplus />

h3. LinkedIn

bc. <txp:arc_social_share_linkedin />

h4. Additional Attributes

* source: by default this is your site's name
* summary: pass some summary text to LinkedIn (LinkedIn will truncate summaries greater than 256 characters long)

h3. Pinterest

bc. <txp:arc_social_share_pinterest />

h4. Additional Attributes

* image: URL to an image, by default this is the article's image

h3. Pocket

bc. <txp:arc_social_share_pocket />

h3. Reddit

bc. <txp:arc_social_share_reddit />

h3. StumbleUpon

bc. <txp:arc_social_share_stumbleupon />

h3. Tumblr

bc. <txp:arc_social_share_tumblr />

h3. Twitter

bc. <txp:arc_social_share_twitter />

h4. Additional Attributes

* mention: adds a Twitter username to the end of a tweet (__e.g.__ /@drmonkeyninja)

h2. Usage

The majority of the tags work the same, with a few exceptions where there are additional parameters available.

They can all be used as either a single tag or a wrapper tag. For example:-

bc. <txp:arc_social_share_twitter />

or,

bc. <txp:arc_social_share_twitter>Tweet This</txp:arc_social_share_twitter>

They're intended to work within an individual article context, so used in an article form. The URL used for sharing will be the default permlink created by Textpattern. However, you can override the URL:-

bc. <txp:arc_social_share_twitter url='http://www.example.com' />

All links created by the tags are URL encoded.

The plugin won't do anything fancy with the way the links work when clicked. So if you want to open the links in a new window you will need to put in place some JavaScript to do this yourself. You can easily add a class to the links to help target them with your JavaScript:-

bc. <txp:arc_social_share_twitter class='bookmarklet' />

h2. Author

"Andy Carter":http://andy-carter.com. For other Textpattern plugins by me visit my "Plugins page":http://andy-carter.com/txp.

h2. License

The MIT License (MIT)

Copyright (c) 2015 Andy Carter

Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions:

The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.

THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

# --- END PLUGIN HELP ---
-->
<?php
}
?>
