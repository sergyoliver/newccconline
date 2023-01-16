class DynamicXMLElement
   
   def initialize( element)
      @element = element
      @cache = {}
   end
   
   def method_missing(method_id)
     # if  cache[method_id]  then
     #    return cache[method_id]
     # end
       elem = @element.elements[method_id.to_s];

      if  elem == nil && @element.attributes != nil then
         return @element.attributes[method_id.to_s] 
      end

      if elem == nil || (elem.attributes.empty? && elem.elements.empty? && elem.text == nil)then
         return nil;
      end
      
      wrap(elem);
   end
   
   def [](index)
      DynamicXMLElement.new(@element.elements[index]);
   end
   
   def name() @element.name end
   
   def each
      @element.elements.each{|e| yield DynamicXMLElement.new(e);}
   end
   
   def each(name)
      name = name.to_s;
      @element.elements.each{|e| yield wrap(e) if e.name == name}
   end
   
   def wrap(element) 
      @cache[element] = create(element) if @cache[element] == nil;
      @cache[element]
   end
   
   def create(element) DynamicXMLElement.new(element) end
   
   def to_xml() @element end
   
   def to_s() @element.text end
      
   def to_f() @element.text.to_f end
      
   def to_i() @element.text.to_i end
end