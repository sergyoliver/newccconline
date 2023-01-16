<%
ScriptName=trim(Request.ServerVariables("SCRIPT_NAME"))
i=InStrRev(ScriptName,"/")
if (i>0) then ScriptName=mid(ScriptName,i+1)

scripts=array("ex1.asp","ex2.asp","ex2edit.asp","ex3.asp","ex4.asp","ex4edit.asp","ex4btn.asp","ex5.asp","ex6.asp","ex7.asp","ex8.asp")
response.write "<strong><a href='http://www.openrico.org'>Rico 2.0</a></strong>"
response.write "<table border='0' cellpadding='7'><tr>"
response.write "<td><a href='../'>Home</a></td>"
for k=0 to ubound(scripts)
  v=scripts(k)
  ShortName=mid(v,3)
  i=InStrRev(ShortName,".")
  if (i>0) then ShortName=left(ShortName,i-1)
  if (v=ScriptName) then
    response.write "<td><strong style='border:1px solid brown;color:brown;'>Ex " & ShortName & "</strong></td>"
  else
    response.write "<td><a href='" & v & "'>Ex " & ShortName & "</a></td>"
  end if
next
response.write "</tr></table>"
%>
