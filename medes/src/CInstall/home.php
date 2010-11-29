<?php

//$pp = CPrinceOfPersia::GetInstance();
$pp->pageStyle .= <<<EOD
span.ok{color:green;text-transform:uppercase;}
span.fail{color:red;text-transform:uppercase;}
p.fix{padding-left:3em;}
EOD;

$check = "";


// ------------------------------------------------------------------------------
//
// Check that the data-directory is writable
//
$case 	= "The directory <code>medes/data</code> is writable by the webserver.";
$class 	= "ok";
$result = "";
$dataDirectoryIsWritable = true;
if(!is_writable(dirname(__FILE__) . "/../../data/")) {
	$dataDirectoryIsWritable = false;
	$result = "Make the directory writable (for example chmod 777) by the webserver.";
	$class = "fail";
} 
$check .= <<<EOD
<p>
<span class={$class}>[{$class}]</span> 
{$case}
<p class=fix><em>{$result}</em></p>
EOD;


// ------------------------------------------------------------------------------
//
// Check if the config file exists and is writable. If it exists then exit the procedure.
//
$case 	= "Fresh install without an existing config-file <code>medes/data/CPrinceOfPersia_config.php</code>.";
$class 	= "ok";
$result = "";
$configFileExists = false;
if(is_readable(dirname(__FILE__) . "/../../data/CPrinceOfPersia_config.php")) {
	$configFileExists = true;
	$result = "A config-file already exists. Remove it 'by hand' before doing a fresh installation.";
	$class = "fail";
} 
$check .= <<<EOD
<p>
<span class={$class}>[{$class}]</span> 
{$case}
<p class=fix><em>{$result}</em></p>
EOD;


// ------------------------------------------------------------------------------
//
// Create a new config file, take a copy of an existing one
//

// ------------------------------------------------------------------------------
//
// Check the current version of medes and display the latest available versions.
// Provide link to download page.
//
//include files from phpmedes.org/latest_version.php, or readfile
//

// ------------------------------------------------------------------------------
//
// Find out the sitelink and display it. Enable to save it and redirect to admin and set admin password.
//
$case 	= "Setting the sitelink to this website (starting from the root of this server).";
$class 	= "ok";
$result = "";
$siteUrl = substr($_SERVER['PHP_SELF'], 0, strlen($_SERVER['PHP_SELF']) - strlen("medes/install.php"));
$pp->config['siteurl'] = $siteUrl;

if($dataDirectoryIsWritable && !$configFileExists) {
	$pp->UpdateConfiguration(array('siteurl'=>$siteUrl));
	$result = "Sitelink = {$siteUrl}";
	$check .= <<<EOD
	<p>
	<span class={$class}>[{$class}]</span> 
	{$case}
	<p class=fix><em>{$result}</em></p>
EOD;
}


// ------------------------------------------------------------------------------
//
// Create default settings for configuration
//
$config['header'] 		= file_get_contents(dirname(__FILE__) . "/../../data/default/header.php");
$config['footer'] 		= file_get_contents(dirname(__FILE__) . "/../../data/default/footer.php");
$config['navbar'] = array(
	"template"=>array("text"=>"template", "url"=>$pp->PrependWithSiteUrl("medes/template.php"), "title"=>"A default template page to start with"),
	"acp"=>array("text"=>"acp", "url"=>$pp->PrependWithSiteUrl("medes/acp.php"), "title"=>"Administrate and configure the site and its addons"),
	"ucp"=>array("text"=>"ucp", "url"=>$pp->PrependWithSiteUrl("medes/ucp.php"), "title"=>"User control panel"),
	"article"=>array("text"=>"article", "url"=>$pp->PrependWithSiteUrl("medes/article.php"), "title"=>"Article editor"),
	"blog"=>array("text"=>"blog", "url"=>$pp->PrependWithSiteUrl("medes/blog.php"), "title"=>"Blog"),
);
$config['relatedsites'] = array(
	"1"=>array("text"=>"phpmedes", "url"=>"http://phpmedes.org/", "title"=>"Home of phpmedes"),
	"2"=>array("text"=>"dbwebb", "url"=>"http://dbwebb.se/", "title"=>"Databases and Webb, it´s all about html, css, php and sql"),
);
$config['styletheme'] = array(
	"name"=>"core",
	"stylesheet"=>"screen_compatibility.css",
	"print"=>"print.css",
	"ie"=>"ie.css",
);
$config['meta'] = array(
	"author"=>"",
	"copyright"=>"",
	"description"=>"",
	"keywords"=>"",
);
$config['tracker'] = "";

if(!isset($pp->config['header'])) {
	$pp->config['header'] = $config['header'];
}

if(!isset($pp->config['footer'])) {
	$pp->config['footer'] = $config['footer'];
}

if(!isset($pp->config['styletheme'])) {
	$pp->config['styletheme'] = $config['styletheme'];
}

if(!isset($pp->config['navbar'])) {
	$pp->config['navbar'] = $config['navbar'];
}

if(!isset($pp->config['relatedsites'])) {
	$pp->config['relatedsites'] = $config['relatedsites'];
}

if(!isset($pp->config['meta'])) {
	$pp->config['meta'] = $config['meta'];
}

if(!isset($pp->config['tracker'])) {
	$pp->config['tracker'] = $config['tracker'];
}

if($dataDirectoryIsWritable && !$configFileExists) {
	$pp->UpdateConfiguration($config);
}


// ------------------------------------------------------------------------------
//
// Set $page to contain html for the page
//
$page = <<<EOD
<h1>Do a fresh installation of medes</h1>
<!-- <h1>Do a fresh (re-)installation of medes</h1> -->
<h2>Checking the environment</h2>
{$check}
<h2>Done</h2>
<p>Proceed to the admin area to set the admin password and start configuring
your medes website.</p>
<p><a href="acp.php?p=changepwd">Admin area: change password</a>.</p>
<p>You can always run this procedure again by by pointing the browser to <code>medes/install.php</code>.
EOD;

