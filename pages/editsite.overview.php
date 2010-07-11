<div class="block">
 <h2>General settings and information</h2>
 <table class="innerblock righthead">
  <tr>
   <th>Site name</th>
   <td><?PHP echo h(SITE_NAME); ?></td>
  </tr>
  <tr>
   <th>Document root</th>
   <td><?PHP echo h(substr(SITE_DOCROOT,strlen('/home/'.SUSER))); ?></td>
  </tr>
 </table>
</div>
