# The methods added to this helper will be available to all templates in the application.
module ApplicationHelper

  def rico_javascript
     ["prototype", "rico", "util"];
  end
  
  def on_link?(link)
    link_map = {'rico'=>/rico/, 'downloads'=>/downloads/, 'resources'=>/resources/, 
                'demos'=>/demos/,'livegrid_demo'=>/demos/, 'yahoo_demo'=>/demos/}
    link_map[params[:controller]] =~ link 
  end
  
  def menu_link(text, link)
    "<a class='#{on_link?(link) ? 'selectedMenuLink' : 'menuLink'}' href='#{link}'>#{text}</a>"
  end
    
   def bytes_to_Mbytes(bytes)
      sprintf("%1.1f", (bytes / 1024) / 1024) 
   end
   
   def feature_hover_image_name(feature, selection)
      if(feature == selection) 
      	"/images/#{feature}-selected.gif";
      else
         "/images/#{feature}-hover.gif"
      end
   end
   
   def feature_image_name(feature, selection)
      if(feature == selection) 
      	"/images/#{feature}-selected.gif";
      else
         "/images/#{feature}.gif"
      end
   end
   
   def link_to_feature_image (feature, selection)
      %{<td>
         <a href=\"#{feature}_features.page\"
            onmouseover=\"document.images[\'#{feature}\'].src=\'#{feature_hover_image_name feature, selection}\';\"
            onmouseout=\"document.images[\'#{feature}\'].src=\'#{feature_image_name feature, selection}\';\">
         <img name=\"#{feature}\" src=\"#{feature_image_name feature, selection}\" border=\"0\" alt=\"\"></a>
      </td>}
   end
   
   
   def feature_header(selection)
     %{
      <table style="margin-top:6px;"><tr>
         #{link_to_feature_image 'ajax', selection}
         #{link_to_feature_image 'dragdrop', selection}
         #{link_to_feature_image 'cinematic', selection}
         #{link_to_feature_image 'behavior', selection}
      </tr></table>
    }
   end
end
