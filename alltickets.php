<?PHP

 require_once('lib/dashboard.php');
 
 define('TITLE', ' All Tickets');
 
 addDashboardItem('Useful links', 'Support center', 'support');
 addDashboardItem('Useful links', 'Raise a ticket', 'tickets');
  
 addDashboardItem('Frequently asked questions', 'Can I file support requests without using the control panel?', 'support/005');
 addDashboardItem('Frequently asked questions', 'How do I reopen a ticket?', 'support/014');

 require_once('lib/header.php');
 
 require_once('pages/alltickets.php');
 
 require_once('lib/footer.php');


?>
