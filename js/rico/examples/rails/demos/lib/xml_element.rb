class DynamicXMLElement
   
   def initialize( element)
      @element = element
   end
   
   def method_missing(method_id)
      DynamicXMLElement.new(@element.elements[method_id.to_s]);
   end
   
   def to_s() text end
end