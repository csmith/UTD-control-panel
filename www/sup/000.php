<?PHP

 define('SUPPORT_TITLE', 'Main');

 require_once('lib/common.php');
 
 define('SUPPORT_BTITLE', 'Support');
 
 $sbody = <<<SUPPORT
<p class="blurb">Welcome to the UTD-Hosting support center</p> 
<div style="float: left; width: 50%; padding: 0px;">
 <h3>Frequently asked</h3>
 <ul>
SUPPORT;
arsort($stats); $i = 5;
foreach ($stats as $k => $v) {
 $i--;
 $fh = file('sup/'.$k.'.php');
 foreach ($fh as $line) {
  if (preg_match("#.*define\('SUPPORT_TITLE',\s*'(.*)'\);.*#",$line,$m)) {
   $title = stripslashes($m[1]);
   break;
  }
 }
 $sbody .= '<li><a href="'.CP_PATH.'support/'.$k.'">'.$title.'</a></li>';
 if ($i <= 0) { break; }
}
$sbody .= '
 </ul>
</div>
<div style="margin-left: 50%;">
 <h3>For new users</h3>
 <ul>
  <li><a href="'.CP_PATH.'support/002">What do I do if my site isn\'t working?</a></li>
  <li><a href="'.CP_PATH.'support/007">What do I do if I forget my username?</a></li>
  <li><a href="'.CP_PATH.'support/010">How to raise a ticket</a></li>
  <li><a href="'.CP_PATH.'support/013">Ticket reply time promise</a></li>
  <li><a href="'.CP_PATH.'support/008">How do I pay outstanding bills?</a></li>
 </ul>
</div>
<div class="blurb" style="clear: left; border-bottom: 1px solid #aaa; height: 10px;"></div>
<div style="float: left; width: 50%;">
 <h3>Getting support</h3>
 <ul>
  <li><a href="'.CP_PATH.'support/010">How to raise a ticket</a></li>
  <li><a href="'.CP_PATH.'support/013">Ticket reply time promise</a></li>
  <li><a href="'.CP_PATH.'support/005">Can I get support using e-mail?</a></li>
  <li><a href="'.CP_PATH.'support/014">How do I reopen a ticket?</a></li>
  <li><a href="'.CP_PATH.'support/019">How to add a site</a></li>
 </ul>
</div>
<div style="margin-left: 50%;">
 <h3>Control panel features</h3>
 <ul>
  <li><a href="'.CP_PATH.'support/019">How to add a site</a></li>
  <li><a href="'.CP_PATH.'support/020">MySQL users and databases</a></li>
  <li><a href="'.CP_PATH.'support/021">About site statistics</a></li>
  <li><a href="'.CP_PATH.'support/008">Paying bills</a></li>
  <li><a href="'.CP_PATH.'support/001">PHP settings</a></li>
 </ul>
</div>
<div style="clear: left;"></div>
';
 
 define('SUPPORT_BODY', $sbody);

?>
