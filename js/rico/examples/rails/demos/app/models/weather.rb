require 'net/http'
require 'rexml/document'

class Weather 
   
   @@TMC_URL = "http://xoap.weather.com/weather/local/"  
   @@PARMS "?cc=*&link=xoap&prod=xoap&par=1009298273&key=6ac0cd9f8a672680";

   
   def Weather.get_weather(zip)
      xml = REXML::Document.new()
   end
end
