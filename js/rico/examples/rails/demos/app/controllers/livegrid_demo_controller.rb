class LivegridDemoController < ApplicationController
  
  layout "demos", :except => [:ajax_livegrid_content]
  after_filter :mark_ajax, :only => [:ajax_livegrid_content]

  FIELDS = %w{id title genre rating votes year}
  
  def index
  end

  def ajax_livegrid_content
    @movies = find_livegrid_content_for Movie, FIELDS
    @total_rowcount = livegrid_count_for Movie, FIELDS
  end
end
