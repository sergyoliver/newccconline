module LivegridDemoHelper
  
  def livegrid_results(objects, columns)
    n = @params[:offset].to_i + 1
    results = ""
    objects.each_with_index do |obj, i|
      results << "<tr>"
      results << "<td>" + (n + i).to_s + "</td>"
      results << columns.map{|c| "<td>" + obj.send(c).to_s + "</td>"}.to_s 
      results << "</tr>"
    end
    results
  end
end

