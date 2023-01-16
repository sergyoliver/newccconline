
var FormLetterUpdater = Class.create();

FormLetterUpdater.attributes = [ "fullName", "title", "firstName", "lastName", "streetAddress",
"city", "state", "zipcode", "occupation", "phoneNumber", "mobileNumber", "personNotes"  ];

FormLetterUpdater.prototype = {
   initialize: function() {
      this.useHighlighting    = true;
      this.lastPersonSelected = null;
   },
   ajaxUpdate: function(ajaxResponse) {
      this.setPerson(ajaxResponse.childNodes[0]);
   },
   setPerson: function(aPerson) {
      this.lastPersonSelected = aPerson;
      FormLetterUpdater.attributes.each(function(attr){
        val = this.emphasizedHTML( aPerson.getAttribute(attr))
        $$("span." + attr).each(function(e){ e.innerHTML = val})
      }.bind(this));
   },
   reset: function() {
      this.lastPersonSelected = null;
      FormLetterUpdater.attributes.each(function(attr){
        val = this.emphasizedHTML("[" + attr + "]") 
        $$("span." + attr).each(function(e){ e.innerHTML = val})
      }.bind(this));
   },
   emphasizedHTML: function(aValue) {
      if ( this.useHighlighting )
         return "<span class='substitutedText'>" + aValue + "</span>";
      else
         return  aValue;
   },
   setUseHighligthing: function(v) {
      this.useHighlighting = v;
      if ( this.lastPersonSelected == null )
         this.reset();
      else
         this.setPerson(this.lastPersonSelected);
   }
};