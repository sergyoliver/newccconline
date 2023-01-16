ActionController::Routing::Routes.draw do |map|
  # Add your own custom routes here.
  # The priority is based upon order of creation: first created -> highest priority.
  
  map.connect '', :action =>'index_content', 
              :controller => 'rico'
  
  map.connect '/', 
              :action =>'index_content', 
              :controller => 'rico'          
    
  map.connect 'rico',
              :controller=>'rico',
              :action=>'map_to_rico',
              :page=>'home.page'
              
  map.connect 'rico/download_file/:version/:file',
              :controller=>'downloads',
              :action=>'download_file'
  
  map.connect 'downloads',
              :action =>'index',
              :controller =>'downloads'

  map.connect 'demos',
              :action =>'index',
              :controller =>'demos'
              
  map.connect 'resources',
              :action =>'index',
              :controller =>'resources'
              
  map.connect 'demos/livegrid',
              :action=>'index',
              :controller =>'livegrid_demo'                     

  map.connect 'demos/yahoo_search',
              :action=>'index',
              :controller =>'yahoo_demo'          

  map.connect 'demos/weather_demo', 
              :action=>'index',
              :controller =>'weather_demo'

  map.connect 'demos/complex_ajax',
              :action=>'complex_ajax',
              :controller =>'ajax_demo'
              
  map.connect 'demos/inner_ajax_HTML',
              :action=>'inner_ajax_HTML',
              :controller =>'ajax_demo'

#support old urls
            
  map.connect 'rico/home.page',
             :action =>'index_content',
             :controller =>'rico'
  
  map.connect 'rico/features.page',
               :action =>'ajax_features',
               :controller =>'rico'               
               
  map.connect 'rico/dragdrop_features.page',
              :action =>'dragdrop_features',
              :controller =>'rico'

  map.connect 'rico/ajax_features.page',
              :action =>'ajax_features',
              :controller =>'rico'          
                    
  map.connect 'rico/cinematic_features.page',
              :action =>'cinematic_features',
              :controller =>'rico'               

  map.connect 'rico/behavior_features.page',
              :action =>'behavior_features',
              :controller =>'rico'                         
  
  map.connect 'rico/docs.page',
              :action =>'documentation',
              :controller =>'rico'  

  map.connect 'rico/downloads.page',
              :action =>'index',
              :controller =>'downloads'                           

  map.connect 'rico/about.page',
              :action =>'about',
              :controller =>'rico'                            

  map.connect 'rico/demos.page',
              :action =>'index',
              :controller =>'demos'                         

  map.connect 'rico/livegrid.page',
              :action =>'index',
              :controller =>'livegrid_dmo'                           

  map.connect 'rico/yahooSearch.page',
              :action =>'index',
              :controller =>'yahoo_demo'           
                
  map.connect 'ricoWeather.page', 
              :action=>'index',
              :controller =>'rico_weather'
                              
  map.connect ':page',
              :controller =>'demos',
              :action=>'demo'
              

                                      
 
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
