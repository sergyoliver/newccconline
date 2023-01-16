class AjaxDemoController < ApplicationController
  layout "demos", :except => [:ajax_person_info, :ajax_person_info_xml];   
  after_filter :mark_ajax, :only => [:ajax_person_info, :ajax_person_info_xml];   
  
  def inner_ajax_HTML
  end              

  def complex_ajax
  end
  
  def ajax_person_info       
     @person = Person.find_by_name(params[:firstName], params[:lastName]);
  end

  def ajax_person_info_xml       
     @person = Person.find_by_name(params[:firstName], params[:lastName]);
  end
end
