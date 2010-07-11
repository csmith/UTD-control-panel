<?PHP

define('PIE_MAX_SEGS',6); // Maximum number of segments

function pieSort ($item1, $item2) {
 
 return ($item2 - $item1);
 
}


function doPie ($title, $items) {
 
 assert(is_array($items));
 
 uasort($items,'pieSort');
 
 if (count($items) > PIE_MAX_SEGS) {
  
  $other = 0;
  
  $i = PIE_MAX_SEGS - 1;
  
  foreach ($items as $key => $value) {
   $i--;
   
   if ($i < 0) {
    
    $other += $value;
    unset($items[$key]);
    
   }
   
  }
  
  $items['Other'] = $other;
  
 }
 
 $im = imagecreate(500,315);
 
 $white = imagecolorallocate($im,255,255,255);
 
 imagefill($im,0,0,$white);
 
 $total = 0;
 
 foreach ($items as $name => $value) {
  
  $total += $value;
  
 }
 
 $colours = array('138-103-173', '000-000-128', '030-144-255', '000-100-000',
                  '060-179-113', '173-173-047', '189-183-107', '255-215-000',
                  '205-092-092', '205-133-063', '255-000-000', '255-069-000',
                  '255-105-180', '148-000-211', '147-112-219', '112-138-144',
                  '100-100-100'); 
                  
 $black = imagecolorallocate($im,0,0,0);
 
 if ($total != 0) { $dpv = 360/$total; } else { $dpv = 360; }
 
 $last = 0;
 
 $keypos = 0;
 
 foreach ($items as $name => $value) {
  
  $colour = explode('-',array_shift($colours));
  
  $colour = imagecolorallocate($im, $colour[0], $colour[1], $colour[2]);
  
  $cur = $dpv * $value;
  
  imagefilledarc($im, 250, 160, 175, 175, $last, $last+$cur, $colour, IMG_ARC_PIE);
  imagefilledarc($im, 250, 160, 175, 175, $last, $last+$cur, $black, IMG_ARC_EDGED | IMG_ARC_NOFILL);
  
  $mid = ($last + $last + $cur)/2;
  
  $multX = $multY = 1;
  
  if ($mid >= 180) { $multY = -1; }
  
  if ($mid >= 90 && $mid < 270) { $multX = -1; }
  
  $deltaX = abs(cos(deg2rad($mid)))*(175/3.5)*$multX;
   
  $deltaY = abs(sin(deg2rad($mid)))*(175/3.5)*$multY;
   
  $posX = 250 + $deltaX; $posY = 160 + $deltaY;
   
  $endX = 250 + ($deltaX * 2.3); $endY = 160 + ($deltaY * 2.3);
   
  if (($value/$total)*100 > 2.3) {   
   
   imageline($im, $posX, $posY, $endX, $endY, $black);
   
   imageline($im, $endX, $endY, $endX + $multX * (imagefontwidth(2)*strlen($name)+5), $endY, $black);
  
   if ($multX == 1) {
    imagestring($im, 2, $endX + 2, $endY - 12, $name, $black);
    imagestring($im, 1, $endX + 2, $endY + 2, '['.round($value*100/$total,1).'%]',$black);
   } else {
    imagestring($im, 2, $endX - 2 - imagefontwidth(2)*strlen($name), $endY - 12, $name, $black);
    imagestring($im, 1, $endX - (imagefontwidth(1)*strlen('['.round($value*100/$total,1).'%]')) , $endY + 2, '['.round($value*100/$total,1).'%]',$black);
   }
   
  } else {
   
   if ($keypos == 0) {
    
    imagestring($im,1,5,303,'Key:',$black);
    $keypos += imagefontwidth(1)*4 + 10;
    
   }
   
   imagestring($im,1,$keypos,303,$name.' ['.round($value*100/$total,1).'%]',$colour);
   $keypos += imagefontwidth(1)*strlen($name.' ['.round($value*100/$total,1).'%]') + 10;
   
  }
   
  $last += $cur;
  
 }
 
 imagestring($im, 3, 250 - imagefontwidth(3)*strlen($title)/2, 5, $title, $black);
 
 return $im;
 
}

?>
