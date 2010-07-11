<div class="block">
 <h2>Invoices</h2>
 <table class="innerblock">
  <tr>
   <th>&nbsp;</th>
   <th>Date issued</th>
   <th>Date due</th>
   <th>Value</th> 
   <th>Paid</th>
   <th>Actions</th>
  </tr>
<?PHP

 $sql = 'SELECT bill_id, bill_due, bill_generated, bill_total, bill_paid FROM bills WHERE user_id = '.UID.' ORDER BY bill_due';
 $res = mysql_query($sql) or mf(__FILE__, __LINE__, $sql);
 $i = 0;
 if (mysql_num_rows($res) == 0) {
  echo '<tr><td style="font-style: italic; text-align: center;" colspan="6">There are no invoices on record for your account</td></tr>';
 }
 while ($row = mysql_fetch_array($res)) {
  $i++;
  ?>
  <tr class="<?PHP echo ($i % 2 == 1) ? 'even' : 'odd'; ?>">
   <td><?PHP echo $i; ?>.</td>
   <td><?PHP echo date('r',$row['bill_generated']); ?></td>
   <td><?PHP echo date('r',$row['bill_due']); ?></td>
   <td>&pound;<?PHP echo money_format('%i',$row['bill_total']/100); ?></td>
   <td><?PHP echo ($row['bill_paid'] == 0) ? 'Outstanding' : 'Paid'; ?></td>
   <td>
    <a href="<?PHP echo CP_PATH; ?>viewinvoice/<?PHP echo $row['bill_id']; ?>">View</a>
   </td>
  </tr>
  <?PHP
 }
?> 
 </table>
</div>
