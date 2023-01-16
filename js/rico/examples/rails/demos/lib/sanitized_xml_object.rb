require 'html_text'

class SanitizedXMLObject < DynamicXMLElement
   
   def inititalize(element)
      super element;
   end

	def create(element)
		SanitizedXMLObject.new(element)
	end
	
	def to_s() 
	   HTMLText.sanitize(super.to_s) 
	end 
end