#!/opt/python/current/bin/python

   import os
   import cgi

  print "Content-type: text/html"
  print

  print """<!DOCTYPE html PUBLIC
     "-//W3C//DTD XHTML 1.0 Transitional//EN"
     "DTD/xhtml1-transitional.dtd">"""
 print """
 <html xmlns = "http://www.w3.org/1999/xhtml" xml:lang="en"
    lang="en">
    <head><title>Environment Variables</title></head>
    <body><table style = "border: 0">"""
rowNumber = 0
for item in os.environ.keys():
    rowNumber += 1
    if rowNumber % 2 == 0:
       backgroundColor = "white"
    else:
       backgroundColor = "lightgrey"
   print """<tr style = "background-color: %s">
    <td>%s</td><td>%s</td></tr>""" \
       % ( backgroundColor, item,
          cgi.escape( os.environ[ item ] ) )
print """</table></body></html>"""
