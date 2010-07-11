<?php
 $sql = 'SELECT isea_id, isea_name FROM issues_searches WHERE user_id = \'\'';
 $searchesdashboard = mysql_query($sql);
 while ($searchdatadashboard = mysql_fetch_assoc($searchesdashboard)) {
  addDashboardItem('Searches', $searchdatadashboard['isea_name'] ,'search/'.$searchdatadashboard['isea_id']);
 }
 $sql = 'SELECT isea_id, isea_name FROM issues_searches WHERE user_id = \''.m(getUserID($_SERVER['REDIRECT_REMOTE_USER'])).'\'';
 $searchesdashboard = mysql_query($sql);
 while ($searchdatadashboard = mysql_fetch_assoc($searchesdashboard)) {
  addDashboardItem('Saved Searches', $searchdatadashboard['isea_name'] ,'search/'.$searchdatadashboard['isea_id']);
 }
?>