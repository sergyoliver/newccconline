class WeatherDemoController < ApplicationController
  
  layout "demos", :except => [:ajax_weather_info];   
  after_filter :mark_ajax, :only => [:ajax_weather_info];   

  def index
  end              

  def ajax_weather_info 
     @weather = get_object_response(
                        "xoap.weather.com",  
                        "/weather/local/#{params[:zip]}?cc=*&link=xoap&prod=xoap&par=1009298273&key=#{WEATHER_KEY}",
                        false);  
     render :ajax_error_weather  if @weather.nil?;  
  end    
  
end
