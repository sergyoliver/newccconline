class Movie < ActiveRecord::Base

   def Movie.find_all_in_range( page_size, offset, order_by )
      find( :all, 
            :order  => order_by,
            :limit  => page_size,
            :offset => offset )
   end


end
