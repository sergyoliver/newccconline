# Filters added to this controller will be run for all controllers in the application.
# Likewise, all the methods added will be available for all controllers.
class ApplicationController < ActionController::Base
  
  def mark_ajax 
     @response.headers["content-type"] = 'text/xml';  
  end
  
  
  def get_object_response(host, path, sanitize)
     response = Net::HTTP.get_response(host, path);

     if (response.message != "OK") then
        flash.now[:notice] = "Could not access server";
        return nil;  #how should we pass error info back
     end;
     if sanitize == nil || sanitize then
        SanitizedXMLObject.new(REXML::Document.new(response.body).root)
     else
        DynamicXMLElement.new(REXML::Document.new(response.body).root)
     end
  #rescue
  #   flash.now[:notice] = "Could not process XML"
  #   return nil;
  end
end