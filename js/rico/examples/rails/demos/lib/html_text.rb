

  #
   # $Id: sanitize.rb 3 2005-04-05 12:51:14Z dwight $
   #
   # Copyright (c) 2005 Dwight Shih
   # A derived work of the Perl version:
   # Copyright (c) 2002 Brad Choate, bradchoate.com
   # 
   # Permission is hereby granted, free of charge, to
   # any person obtaining a copy of this software and
   # associated documentation files (the "Software"), to
   # deal in the Software without restriction, including
   # without limitation the rights to use, copy, modify,
   # merge, publish, distribute, sublicense, and/or sell
   # copies of the Software, and to permit persons to
   # whom the Software is furnished to do so, subject to
   # the following conditions:
   # 
   # The above copyright notice and this permission
   # notice shall be included in all copies or
   # substantial portions of the Software.
   # 
   # THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY
   # OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT
   # LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
   # FITNESS FOR A PARTICULAR PURPOSE AND
   # NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
   # COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES
   # OR OTHER LIABILITY, WHETHER IN AN ACTION OF
   # CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF
   # OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
   # OTHER DEALINGS IN THE SOFTWARE.
   #

module HTMLText
   
   def HTMLText.sanitize( html)
      if html.class != String then
         html = html.to_s
      end
      
     result = html.gsub( /(<.*?>)/m ) do | element |
       if element =~ /\A<\/(\w+)/ then
         # </tag>
         tag = $1.downcase
       elsif element =~ /\A<(\w+)\s*\/>/
         # <tag />
         tag = $1.downcase
       elsif element =~ /\A<(\w+)/ then
         # <tag ...>
         tag = $1.downcase
       end
     end
     
    # result.gsub!(/&[^amp;]/, "&amp;")
     
     result.gsub!(/&/, "&amp;")
     
     # eat up unmatched leading >
     while result.sub!(/\A([^<]*)>/m) { $1 } do end

     # eat up unmatched trailing <
     while result.sub!(/<([^>]*)\Z/m) { $1 } do end


     result
   end
end
