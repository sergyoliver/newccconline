<script language="VB" runat="server">

public scripts() As String = New String (10) {"ex1.aspx","ex2.aspx","ex2edit.aspx","ex3.aspx","ex4.aspx","ex4edit.aspx","ex4btn.aspx","ex5.aspx","ex6.aspx","ex7.aspx","ex8.aspx"}

sub CreateMenu()
  Dim ScriptName as string, i as integer, k as integer, v as string, ShortName as string
  
  ScriptName=trim(Request.ServerVariables("SCRIPT_NAME"))
  i=InStrRev(ScriptName,"/")
  if (i>0) then ScriptName=mid(ScriptName,i+1)
  response.write("<strong><a href='http://www.openrico.org'>Rico 2.0</a></strong>")
  response.write("<table border='0' cellpadding='7'><tr>")
  response.write("<td><a href='../'>Home</a></td>")
  for k=0 to ubound(scripts)
    v=scripts(k)
    ShortName=mid(v,3)
    i=InStrRev(ShortName,".")
    if (i>0) then ShortName=left(ShortName,i-1)
    if (v=ScriptName) then
      response.write("<td><strong style='border:1px solid brown;color:brown;'>Ex " & ShortName & "</strong></td>")
    else
      response.write("<td><a href='" & v & "'>Ex " & ShortName & "</a></td>")
    end if
  next
  response.write("</tr></table>")
end sub

</script>

<% CreateMenu %>