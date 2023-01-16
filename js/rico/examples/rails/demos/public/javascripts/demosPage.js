
   var saveHeight;
   var showing = true;

   function toggleSlide() {
      if ( showing )
         { slideMenuUp(); showing = false; }
      else
         { slideMenuDown(); showing = true; }
   }

   function slideMenuUp() {
      var menu = $('demosMenu');
      saveHeight = menu.offsetHeight;

      menu.style.overflow = "hidden";
      new Rico.Effect.Size( menu, null, 1, 120, 8 );

      $('demoPanelLink').innerHTML = "Show demo panel";
   }

   function slideMenuDown() {
      var menu = $('demosMenu');
      new Rico.Effect.Size( menu, null, saveHeight, 120, 8, {complete:function() { $(menu).style.overflow = "visible"; }} );
      $('demoPanelLink').innerHTML = "Hide demo panel";
   }


Event.observe(window, 'load', function(){ 
   Rico.Corner.round( 'ajaxDemos',     {corners:'tl br',bgColor:'#adba8c'} );
   Rico.Corner.round( 'dragdropDemos', {corners:'tl br',bgColor:'#adba8c'} );
   Rico.Corner.round( 'cinemaDemos',   {corners:'tl br',bgColor:'#adba8c'} );
   Rico.Corner.round( 'extraDemos',    {corners:'tl br',bgColor:'#adba8c'} );
})