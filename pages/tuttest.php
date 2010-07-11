<div class="tutbox" id="tut1">
 <p>This is a tutorial box! zomg!</p>
 <p>To do stuff, you do stuff and then stuff.</p>
</div>
<img src="<?PHP echo CP_PATH; ?>res/overlay.png" id="overlay">
<script type="text/javascript">
 tut = document.getElementById('tut1');
 tut.style.position = 'absolute';
 tut.style.left = document.getElementById('delete').offsetLeft + 150 + 'px'; 
 tut.style.top = document.getElementById('delete').offsetTop - 40 + 'px';
 tut.style.zIndex = 2;
 img = document.getElementById('overlay');
 img.style.position = 'absolute';
 img.style.left = 0 + 'px';
 img.style.top = 0 +'px';
 var arrayPageSize = getPageSize();
 img.style.height = (arrayPageSize[1] + 'px'); 
 img.style.width = '100%'; 
</script>
