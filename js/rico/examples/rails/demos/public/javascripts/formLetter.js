var formLetterUpdater;

Event.observe(window, 'load', function(){ 
   formLetterUpdater = new FormLetterUpdater();
   ajaxEngine.registerRequest( 'getPersonInfo', '/ajax_demo/ajax_person_info_xml' );
   ajaxEngine.registerAjaxObject( 'formLetterUpdater', formLetterUpdater );
   formLetterUpdater.reset();
})

function getPersonInfo(selectBox) {
   if ( selectBox.value == "none" )
      formLetterUpdater.reset();
   else {
      var nameToLookup = selectBox.value.split(",");
      var firstName = nameToLookup[1].substring(1);
      var lastName  = nameToLookup[0];

      ajaxEngine.sendRequest( 'getPersonInfo',
                              "firstName=" + firstName,
                              "lastName=" + lastName );
   }
}

function turnOffHighlighting() {
   formLetterUpdater.setUseHighligthing(false);
}

function turnOnHighlighting() {
   formLetterUpdater.setUseHighligthing(true);
}