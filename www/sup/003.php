<?PHP

 define('SUPPORT_TITLE', 'What do KiB/MiB/GiB mean?');
 
 define('SUPPORT_BTITLE', 'What do KiB/MiB/GiB mean?');
 
 if (!defined('LIB_ACCOUNT')) { require('lib/account.php'); }
 
 addDashboardItem('Useful links', 'Site overview', 'sites');
 
 if (!defined('UID')) {

   addDashboardItem('Useful links', 'Login', 'login');

 }
 
 addDashboardItem('External pages', 'physics.nist.gov: binary prefixes', 'http://physics.nist.gov/cuu/Units/binary.html');
 addDashboardItem('External pages', 'Wikipedia: IEC standard prefixes', 'http://en.wikipedia.org/wiki/Binary_prefix#IEC_standard_prefixes ');
 addDashboardItem('External pages', 'IEC 60027', 'http://www.iec.ch/cgi-bin/procgi.pl/www/iecwww.p?wwwlang=E&wwwprog=sea22.p&search=iecnumber&header=IEC&pubno=60027&part=&se=&number=&searchfor=&ics= ');

 $sbody = <<<SUPPORT
<p>
 <abbr title="Kibibyte">KiB</abbr>, <abbr title="Mebibyte">MiB</abbr> and
 <abbr title="Gibibyte">GiB</abbr> are all standard international units of
 storage. Most users will be familiar with 'Kilobytes' (KB), 'Megabytes' (MB), 
 etc; however, there is a lot of confusion about what values these represent.
 The SI prefixes for 'K' (actually 'k'), 'M' and 'G' are all multiples of 10 &mdash; 
 1000, 1000000 and 1000000000, respectively. When measuring computing storing
 capacity, however, it is often more useful to count in base 2. So the prefixes
 are often (incorrectly) associated with powers of 2 that have a similar value:
 A Kilobyte becomes 1024 Bytes, a Megabyte becomes 1024x a Kilobyte, etc.
</p>
<p>
 To combat this confusion, the International Electrotechnical Commission issued
 a new standard &mdash; K, M and G prefixes should be used in accordance with the SI
 units, Ki, Mi and Gi should be used for 'binary' prefixes. A comparison of
 these units is given below:
</p>
<table>
 <tr>
  <th>Prefix</th><th>SI unit</th><th>Size (Bytes)</th><th>IEC binary unit</th><th>Size (Bytes)</th>
 </tr>
 <tr><td>Kilo</td><td>KB</td><td>1000</td><td>KiB</td><td>1024</td></tr>
 <tr><td>Mega</td><td>MB</td><td>1000000</td><td>MiB</td><td>1048576</td></tr>
 <tr><td>Giga</td><td>GB</td><td>1000000000</td><td>GiB</td><td>1073741824</td></tr>
</table>
<p>
 All units used in the UTD-Hosting control panel use the IEC format. Units
 on the main UTD-Hosting site (including bandwidth/hard drive limits) use SI
 units, which is the standard for ISPs and storage manufacturers.
</p>
SUPPORT;
 
 define('SUPPORT_BODY', $sbody);

?>
