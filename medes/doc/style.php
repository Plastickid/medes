<?php
require_once("../config.php");
$pp->pageTitle = "Style";
//$pp->Dump();
include($pp->medesPath . "/inc/header.php");
?>

<article>
<h1>Style</h1>

<p>Change of style in phpmedes will be an issue of creating a stylesheet. There will be a set
of stylesheets available to choose from. The flexibility of changing stylesheets must be one of 
the key features of phpmedes.

<p>Use the stylechooser (see the top right corner of this page) to choose from the avilable styles. 
Currently there are 4 available styles that changes the color.

<p>Silver, color1-6:
<div class=color style="background:#222"></div>
<div class=color style="background:#444"></div>
<div class=color style="background:#999"></div>
<div class=color style="background:#aaa"></div>
<div class=color style="background:#ccc"></div>
<div class=color style="background:#eee"></div>

<p style="clear:both;padding-top:1em;">Red, color1-6:
<div class=color style="background:#300"></div>
<div class=color style="background:#500"></div>
<div class=color style="background:#f55"></div>
<div class=color style="background:#f88"></div>
<div class=color style="background:#faa"></div>
<div class=color style="background:#fee"></div>

<p style="clear:both;padding-top:1em;">Green, color1-6:
<div class=color style="background:#030"></div>
<div class=color style="background:#050"></div>
<div class=color style="background:#5f5"></div>
<div class=color style="background:#8f8"></div>
<div class=color style="background:#afa"></div>
<div class=color style="background:#efe"></div>

<p style="clear:both;padding-top:1em;">Blue, color1-6:
<div class=color style="background:#003"></div>
<div class=color style="background:#005"></div>
<div class=color style="background:#55f"></div>
<div class=color style="background:#88f"></div>
<div class=color style="background:#aaf"></div>
<div class=color style="background:#eef"></div>
</article>
        

<?php include($pp->medesPath . "/inc/footer.php"); ?>