<?PHP

 addDashboardItem('Useful links', 'E-mail support', 'support/005');

 if (!isset($_POST['search'])) {

  define('SUPPORT_TITLE', 'Search');
  define('SUPPORT_BTITLE', 'Search support articles');
  
  $sbody = '
   <p class="blurb">Please enter the terms you would like to search the support
    database for.</p>
   <p>
   <form action="'.CP_PATH.'support/999" method="post">
    <input type="text" name="search">
    <input type="submit" value="Search">
   </form>
   </p>
   <p>If you can\'t find the answert to your query, please raise a ticket, or
   contact support via e-mail.</p>
  ';
  
  define('SUPPORT_BODY', $sbody);

 } else {
  if (get_magic_quotes_gpc()) { $_POST['search'] = stripslashes($_POST['search']); }

  $terms = strip_tags(urldecode($_POST['search']));

  define('SUPPORT_TITLE', 'Search :: '.$terms);
  define('SUPPORT_BTITLE', 'Search results for "'.$terms.'"');

  function filter ($terms) {
   $re1 = array('email');
   $re2 = array('e-mail');
   $terms = str_replace($re1, $re2, $terms);
   $terms = preg_replace('/\W/s',' ',$terms);
   $terms = preg_replace('/ {2,}/',' ',$terms);
   return $terms;
  }
  
  $terms = explode(" ", filter($terms));

  $sup = array();
  $titles = array();
  $files = glob('sup/search/*.txt');
  foreach ($files as $file) {
   $id = substr($file,-7,3);
   $data = file($file);
   $titles[$id] = $data[0];
   $sup[$id] = ' '.filter(implode('',$data)).' ';
  }

  $scores = array();
  foreach ($sup as $id => $data) {
   $scores[$id] = 0;
   foreach ($terms as $word) {
    $scores[$id] += preg_match_all('# '.$word.' #i',$data,$m);
   }
   $scores[$id] /= (count($terms)*count(explode("\n",$data)));
  }

  arsort($scores);
  $sbody = '<ol>';
  $done = false;
  foreach (array_slice($scores,0,10,true) as $id => $data) {
   if (round($data,2) == 0) { continue; }
   $done = true;
   $sbody .= '<li><a href="'.CP_PATH.'support/'.$id.'">'.$titles[$id].'</a>';
   $sbody .= '<br>Score: '.round($data,2).'<br></li>';
  }
  $sbody .= '</ol>';
  if (!$done) { $sbody = '<p>Sorry, no matching support articles.</p>'; }
  define('SUPPORT_BODY', $sbody);
 }

?>
