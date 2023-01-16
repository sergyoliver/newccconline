
var CustomDropzone = Class.create();

CustomDropzone.prototype = Object.extend(new Rico.Dropzone(), {

   initialize: function( htmlElement, header, acceptRange ) {
      this.htmlElement  = $(htmlElement);
      this.header       = $(header);
      this.absoluteRect = null;
      this.from = acceptRange[0];
      this.to   = acceptRange[1];
      this.acceptedObjects = [];

      this.offset = navigator.userAgent.toLowerCase().indexOf("msie") >= 0 ? 0 : 1;
   },

   activate: function() {
      Rico.animate(new Rico.Effect.FadeTo( this.htmlElement, 0.5), { duration: 250, steps: 4 });
   },

   deactivate: function() {
      Rico.animate(new Rico.Effect.FadeTo( this.htmlElement, 1), { duration: 250, steps: 4 })
   },

   showHover: function() {
      if ( this.showingHover )
         return;
      this.header.style.color = "#000000";
      Rico.animate(new Rico.Effect.FadeTo( this.htmlElement, .1), {duration: 250, steps: 4});
      this.showingHover = true;
   },

   hideHover: function() {
      if ( !this.showingHover )
         return;
      this.header.style.color = "#5b5b5b";
      Rico.animate(new Rico.Effect.FadeTo( this.htmlElement, .5), {duration: 250, steps: 4});
      this.showingHover = false;
   },

   accept: function(draggableObjects) {

      n = draggableObjects.length;
      for ( var i = 0 ; i < n ; i++ )
         this._insertSorted(draggableObjects[i]);
   },

   canAccept: function(draggableObjects) {
      for ( var i = 0 ; i < draggableObjects.length ; i++ ) {
         if ( draggableObjects[i].type != "Custom" )
            return false;
         var firstChar = draggableObjects[i].name.substring(0,1).toLowerCase();
         if ( firstChar < this.from || firstChar > this.to )
            return false;
      }

      return true;
   },

   _insertSorted: function( aDraggable ) {
      var theGUI = aDraggable.getDroppedGUI();
      var thisName = aDraggable.name;
      var position = this._getInsertPosition(aDraggable);
      if ( position == "append" )
         this.htmlElement.appendChild(theGUI);
      else
         this.htmlElement.insertBefore( theGUI, this.htmlElement.childNodes[position+this.offset]  );
      this.acceptedObjects[ this.acceptedObjects.length ] = aDraggable.name;
      this.acceptedObjects.sort();
   },

   _getInsertPosition: function(aDraggable) {
      for( var i = 0 ; i < this.acceptedObjects.length ; i++ )
         if ( aDraggable.name < this.acceptedObjects[i] ) {
            return i;
         }
       return "append";
   }

} );