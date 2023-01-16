  var saveHeight;
   var showing = true;

   function toggleSlide() {
      if ( showing )
         { slideMenuUp(); showing = false; }
      else
         { slideMenuDown(); showing = true; }
   }

   function slideMenuUp() {
      var notes = $('notes');
      saveHeight = notes.offsetHeight;

      notes.style.overflow = "hidden";
      new Rico.Effect.Size( notes, null, 1, 120, 8 );

      $('hideShowLink').innerHTML = "Show Notes";
   }

   function slideMenuDown() {
      var notes = $('notes');
      new Rico.Effect.Size( notes, null, saveHeight, 120, 8, {complete:function() { notes.style.overflow = "visible"; }} );
      $('hideShowLink').innerHTML = "Hide Notes";

   }