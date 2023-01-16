ActionController::Routing::Routes.draw do |map|
  # Add your own custom routes here.
  # The priority is based upon order of creation: first created -> highest priority.
  
  map.connect '', :action =>'index', 
              :controller => 'demos'
  
  map.connect '/', 
              :action =>'index', 
              :controller => 'demos'          
              
  map.connect 'demos',
              :action =>'index',
              :controller =>'demos'
              
  map.connect 'livegrid',
              :action=>'index',
              :controller =>'livegrid_demo'                     

  map.connect 'yahoo_search',
              :action=>'index',
              :controller =>'yahoo_demo'          

  map.connect 'weather_demo', 
              :action=>'index',
              :controller =>'weather_demo'

  map.connect 'complex_ajax',
              :action=>'complex_ajax',
              :controller =>'ajax_demo'
              
  map.connect 'inner_ajax_HTML',
              :action=>'inner_ajax_HTML',
              :controller =>'ajax_demo'
                                      
 
  # Here's a sample route:
  # map.connect 'products/:id', :controller => 'catalog', :action => 'view'
  # Keep in mind you can assign values other than :controller and :action

  # You can have the root of your site routed by hooking up '' 
  # -- just remember to delete public/index.html.
  # map.connect '', :controller => "welcome"

  # Allow downloading Web Service WSDL as a file with an extension
  # instead of a file named 'wsdl'
  map.connect ':controller/service.wsdl', :action => 'wsdl'

  # Install the default route as the lowest priority.
  map.connect ':controller/:action/:id'
  

end
