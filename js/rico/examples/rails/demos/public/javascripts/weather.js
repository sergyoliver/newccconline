
// This is a little hack. Need to add post processing to request completion to
// do whatever -- in this case fixing the transparency of pngs for IE.
ajaxEngine._onRequestComplete = function(request) {
   //!!TODO: error handling infrastructure??
   if (request.status != 200)
     return;
   var response = request.responseXML.getElementsByTagName("ajax-response");
   if (response == null || response.length != 1)
      return;
   this._processAjaxResponse( response[0].childNodes );

   fixImage( $('ccImg'), 64, 64 );
   fixImage( $('moonImg'), 64, 64 );
   fixImage( $('sunImg'), 64, 64 );
}

function handleEnterKey(e) {
   if ( e.keyCode == 13 )
      getWeatherInfo();
}

function getWeatherInfo() {
   $('checkanother').style.visibility='visible';
   Rico.animate(new Rico.Effect.Position( $('zipinput'), 200, 100));
   Rico.animate(new Rico.Effect.FadeOut( $('frontdoor'), {toValue: 0}),
                {onFinish: function() {$('frontdoor').hide()}});
   ajaxEngine.sendRequest( 'getWeatherInfo', "zip=" + $('zip').value);
}

function resetWeather() {
   $('zipinput').style.left = '12px';
   $('checkanother').style.visibility='hidden';

   $('frontdoor').show();
   $('zip').focus();
   Rico.animate(new Rico.Effect.FadeIn( $('frontdoor'), {toValue: .99999}), {onFinish:emptyContents});
}

function emptyContents() {
   ['ccInfo', 'moonInfo', 'sunInfo'].each(function(e){$(e).innerHTML = "Loading..."});
}