
var names = [ "Holloman, Debbie", "Barnes, Pat", "Dampier, Joan", "Alvarez, Randy",
              "Neil, William", "Hardoway, Kimber", "Story, Leslie", "Lott, Charlie",
              "Patton, Sabrina", "Lopez, Juan" ];

function writeNameSpans() {
   for ( var i = 0 ; i < names.length ; i++ )
      document.write( "<span id='d" + i + "' class='nameSpan' style='border:1px solid #ffffee;display:block'>" + names[i] + "</span>" );
}

function createDraggables() {
   for ( var i = 0 ; i < names.length ; i++ )
      dndMgr.registerDraggable( new CustomDraggable($('d'+i), names[i]) );
}

/**
 *  Sample 'CustomDraggable' object which extends the Rico.Draggable to
 *  override the behaviors associated with a draggable object...
 *
 **/
var CustomDraggable = Class.create();

CustomDraggable.removeOnDrop = false;
CustomDraggable.revereNamesOnDrop = true;

CustomDraggable.prototype = Object.extend(new Rico.Draggable(), {

   initialize: function( htmlElement, name ) {
      this.type        = 'Custom';
      this.htmlElement = $(htmlElement);
      this.name        = name;
   },

   log: function(str) {
      new Insertion.Bottom( $('logger'), "<span class='logMsg'>" + str + "</span>" );
      $('logger').scrollTop = $('logger').lastChild.offsetTop;

   },

   select: function() {
      this.selected = true;
      var el = this.htmlElement;

      // show the item selected.....
      el.style.color           = "#ffffff";
      el.style.backgroundColor = "#08246b";
      el.style.border          = "1px solid blue";
   },

   deselect: function() {
      this.selected = false;
      var el = this.htmlElement;
      el.style.color           = "#2b2b2b";
      el.style.backgroundColor = "transparent";
      el.style.border = "1px solid #ffffee";
   },

   startDrag: function() {
      var el = this.htmlElement;
      this.log("startDrag: [" + this.name +"]");
   },

   cancelDrag: function() {
      var el = this.htmlElement;
      this.log("cancelDrag: [" + this.name +"]");
   },

   endDrag: function() {
      var el = this.htmlElement;
      this.log("endDrag: [" + this.name +"]");
      if ( CustomDraggable.removeOnDrop )
         this.htmlElement.style.display = 'none';

   },

   getSingleObjectDragGUI: function() {
      var el = this.htmlElement;

      var div = document.createElement("div");
      div.className = 'customDraggable';
      div.style.width = (this.htmlElement.offsetWidth - 10) + "px";
      new Insertion.Top( div, this.name );
      return div;
   },

   getMultiObjectDragGUI: function( draggables ) {
      var el = this.htmlElement;

      var names = "";
      for ( var i = 0 ; i < draggables.length ; i++ ) {
         names += draggables[i].name;
         if ( i != (draggables.length - 1) )
            names += ",<br/>";
      }

      var div = document.createElement("div");
      div.className = 'customDraggable';
      div.style.width = (this.htmlElement.offsetWidth - 10) + "px";
      new Insertion.Top( div, names );
      return div;
   },

   getDroppedGUI: function() {
      var el = this.htmlElement;

      var div = document.createElement("div");
      var names = this.name.split(",");
      if ( CustomDraggable.revereNamesOnDrop )
         new Insertion.Top( div, "<span class='nameSpan'>[" + names[1].substring(1) + " " + names[0]+ "]</span>" );
      else
         new Insertion.Top( div, "<span class='nameSpan'>[" + this.name + "]</span>" );
      return div;
   },

   toString: function() {
      return this.name;
   }

} );