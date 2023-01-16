
Event.observe(window, 'load', function(){ 
  $$('.roundNormal').each(function(e){Rico.Corner.round(e)})
  $$('.roundNormal').each(function(e){Rico.Corner.round(e, {compact:true})})
})

function fixImage(img, width, height) {
   var isIE = navigator.userAgent.toLowerCase().indexOf("msie") >= 0;
   if (!isIE)
      return;

   var currentSrc = img.src;
   var imgStyle = "progid:DXImageTransform.Microsoft.AlphaImageLoader(src='" + currentSrc + "', sizingMethod='scale')";
   img.src = '/images/clearpixel.gif';
   img.style.width  = width + "px";
   img.style.height = height + "px";
   img.style.filter =  imgStyle;
}


Rico.Controls.registerScrollSelectors(['select', 'ul', 'tbody', 'table', 'div'])