#!/opt/perl/current/bin/perl
print "Content-type: text/html\n\n";
print "<HTML><HEAD>";
print "<TITLE>CGI Test</TITLE>";
print "</head>";
print "<BODY><h2>Perl Enviroment Info</h2>";
foreach $key (sort keys(%ENV)) {
      print "$key = $ENV{$key}<p>";
   } 
print "</BODY></HTML>";
