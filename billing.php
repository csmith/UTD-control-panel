<?PHP

 require_once('lib/dashboard.php');
 require_once('lib/common.php');
 require_once('lib/database.php');
 require_once('lib/account.php');
 
 define('TITLE', 'Billing');
 
 addDashboardItem('Frequently asked questions', 'How do I pay outstanding bills?', 'support/008');

 function foo() {
  if (!isset($_POST['code']) || m($_POST['code']) != $_POST['code']) {
   return;
  }
  $sql = 'SELECT discount_id, discount_time, discount_money, discount_start, discount_end, discount_type, discount_message FROM discounts WHERE discount_code = \''.$_POST['code'].'\''; 
  $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
  if (mysql_num_rows($res) == 0) {
   define('MESSAGE', 'That discount code does not exist.');
   l('Non-existant discount code used: '.$_POST['code']);
   return;
  } 
  $row = mysql_fetch_array($res);
  if ($row['discount_start'] > time()) {
   define('MESSAGE', 'That discount is not yet valid.'); 
   l('Discount code used prematurely: '.$_POST['code']);
   return;
  }
  if ($row['discount_end'] < time()) {
   define('MESSAGE', 'That discount is no longer valid.');
   l('Discount code expired: '.$_POST['code']);
   return;
  }
  if ($row['discount_type'] != 'general') {
   define('MESSAGE', 'That discount is for new signups only.');
   l('Signup discount code used: '.$_POST['code']);
   return;
  }
  $sql2 = 'SELECT du_id FROM discountusers WHERE discount_id = '.$row['discount_id'].' AND user_id = '.UID;
  $res2 = mysql_query($sql2) or mf(__FILE__, __LINE__, $sql2);
  if (mysql_num_rows($res2) > 0) {
   define('MESSAGE', 'You have already claimed that discount.');
   l('Already used discount code: '.$_POST['code']);
   return;
  }
  $sql2 = 'SELECT bill_id, bill_due, bill_amount FROM billing WHERE user_id = '.UID.' AND bill_paid <> 2';
  $res2 = mysql_query($sql2) or mf(__FILE__, __LINE__, $sql2);
  $row2 = mysql_fetch_array($res2);
  $row2['bill_due'] += $row['discount_time'];
  $row2['bill_amount'] -= $row['discount_money'];
  $sql2 = 'UPDATE billing SET bill_due = '.$row2['bill_due'].', bill_amount = '.$row2['bill_amount'].', bill_paid = 0 WHERE bill_id = '.$row2['bill_id'];
  mysql_query($sql2) or mf(__FILE__, __LINE__, $sql2);
  $sql2 = 'INSERT INTO discountusers (discount_id, user_id) VALUES ('.$row['discount_id'].','.UID.')';
  mysql_query($sql2) or mf(__FILE__, __LINE__, $sql2);
  l('Discount code applied: '.$_POST['code']);
  if ($row['discount_time'] > 0 && $row['discount_money'] == 0) {
   define('MESSAGE', 'Your current billing period has been extended by '.round($row['discount_time']/2629728,2).' month(s). '.$row['discount_message']);
  } elseif ($row['discount_time'] == 0) {
   define('MESSAGE', 'Your next bill has been reduced by £'.($row['discount_money']/100).'. '.$row['discount_message']);
  } else {
   define('MESSAGE', 'Your current billing period has been extended by '.round($row['discount_time']/2629728,2).' month(s), and the next bill has been reduced bby £'.($row['discount_money']/100).'. '.$row['discount_message']);
  }
 }
 
 foo();

 require_once('lib/header.php');
 
 require_once('pages/billing.php');
 if (!defined('NODISCOUNT')) { require_once('pages/discount.php'); }
  
 require_once('lib/footer.php');


?>
