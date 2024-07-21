<?php
$N='wittepeper'; //WikiMind 2022.04
$P='$2a$15$8weKzeQC2XeWnnwxsBwe4ORvOoccoxJWzwLdk9OCs8O0EL09ZGa3W';
function p($r){return preg_match('/^<\/?(ul|ol|li|h|p|bl)/',trim($r[1]))?"\n".$r[1]."\n": sprintf("\n<p>%s</p>\n",trim($r[1]));}
function u($r){return sprintf("\n<ul>\n\t<li>%s</li>\n</ul>",trim($r[1]));}
function o($r){return sprintf("\n<ol>\n\t<li>%s</li>\n</ol>",trim($r[1]));}
function q($r){return sprintf("\n<blockquote>%s</blockquote>",trim($r[2]));}
function v($r){return sprintf("\n<div id=v>%s</div>",trim($r[2]));}
function h($r){list($z,$c,$h)=$r;return sprintf('<a name="%s"></a><h%d>%s</h%d>',trim($h),strlen($c),trim($h),strlen($c));}
function r($t){$t="\n".$t."\n";$l=['/\n(#+)(.*)/'=>'h','/\n-{3,}/'=>"\n<hr/>",'/!\[([^\[]+)\]\(([^\)]+)\)/'=>'<img src=\'\2\' alt=\'\1\'>','/\[([^\]]+)\]\(([^\)]+)\)/'=>'<a href=\'\2\'>\1</a>','/\[\[([^\]]+)\]\]/'=>'<a href=\'?\1\'>\1</a>','/(\*\*)(.*?)\1/'=>'<b>\2</b>','/\n\*(.*)/'=>'u','/\n\-(.*)/'=>'u','/\n[0-9]+\.(.*)/'=>'o','/(\*)(.*?)\1/'=>'<i>\2</i>','/\n(&gt;|\>)(.*)/'=>'q','/\n(&gt;|\!!!)(.*)/'=>'v','/\n([^\n]+)\n/'=>'p','/<\/ul>\s?<ul>/'=>'','/<\/ol>\s?<ol>/'=>'','/<\/blockquote><blockquote>/'=>"<br>"];foreach ($l as $r=>$s)$t=is_callable($s)?preg_replace_callback($r,$s,$t):preg_replace($r,$s,$t);return trim($t);}
function f($f){return @file_get_contents("$f.w");}
function e($p){echo "</p>\n<form action=?$p method=post><textarea autofocus rows=25 name=c placeholder='Syntax: #title, *i*, **b**, * or 1. list, &#62; quote, [[page]], [name](url), ![img](url), --- line, !!! note.'>".htmlspecialchars(f($p))."</textarea>\n<br><input type=password autocomplete=current-password name=P placeholder=pwd><input type=submit value=save accesskey=e></form>\n";}
$p=preg_replace('~(e|b)=(.*)~','',$_SERVER['QUERY_STRING']);
$e=@$_GET['e'];
$p=!$p?"home":$p;
$p=isset($e)?$e:urldecode($p);
$f="$p.w";
$c=@$_POST['c']; ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1">
       <meta name="description" content="wittepeper"/>
    <meta name="image" content="https://wittepeper/favicon/sharecard.png"/>
    <meta name="theme-color" content="#000000"/>
    <meta name="twitter:card" content="summary_large_image"/>
    <meta name="twitter:site" content="wittepeper"/>
    <meta name="twitter:title" content="wittepeper"/>
    <meta name="twitter:description" content="wittepeper"/>
    <meta name="twitter:image" content="https://wittepeper/favicon/sharecard.png"/>
    <meta property="og:type" content="website"/>
    <meta property="og:title" content="wittepeper"/>
    <meta property="og:url" content="https://www.wittepeper.nl"/>
    <meta property="og:image" content="https://wittepeper/favicon/sharecard.png"/>
    <meta property="og:description" content="wittepeper"/>
    <meta property="og:site_name" content="wittepeper"/>
    <link rel="apple-touch-icon" sizes="16x16" href="/favicon/favicon-16x16.png"/>
    <link rel="apple-touch-icon" sizes="32x32" href="/favicon/favicon-32x32.png"/>
    <link rel="apple-touch-icon" sizes="192x192" href="/favicon/favicon-192x192.png"/>
    <link href="https://fonts.googleapis.com/css?display=swap&amp;family=PT+Serif:700,700italic" rel="stylesheet" type="text/css">
    <title><?php echo $N." | ".$p?></title>
    
    <style>body{background-color: #F3EFE4; color: #575757; font-family: 'Courier New', monospace; font-size: 1em; line-height:2; font-weight: 400;max-width:34em;margin:0 auto;padding:0 1em}h1{color:#575757; font-family: 'PT Serif'; font-size: 2.25em; line-height: 2; font-weight: 700;}textarea{width:100%;font:1em "PT Serif"}h1 a{color:#575757; text-decoration:none;}a{color:#575757;}p{color: #575757; font-family: 'Courier New', monospace; font-size: 1em; line-height: 2; font-weight: 400;}blockquote{font-family:monospace;background:#EEE;margin:0;padding:1px 1em}div#v {background:#fdf5e6;padding:1em}</style>
    
  </head>
  <body>
  <h1><a href=./><?php echo $N?></a></h1>
    <p>
    <?php if(@password_verify($_POST['P'],$P))
    {
    	if(!empty($c))
    	{
    		@file_put_contents($f,htmlspecialchars_decode($c));
    		header("Location: ?$p");
    	}
	   elseif(empty($c))
	   {
	    	unlink($f);
	    	header("Location: ?home");
	   }
    }
    elseif(!isset($e))
    {
    	echo file_exists($f)?"<a style='float:right' href=\"?e=$p\" accesskey=e>edit</a></p>\n".r(f($p))."<hr>":e($p);
    }
    else e($e); ?>
  </body>
</html>