<script language="VB" runat="server">

' -------------------------------------------------------------
' Check languages accepted by browser
' and see if there is a match
' -------------------------------------------------------------

public lang2 as string, filename as string
public jsPath as string = "../../src/"  ' MAKE SURE THIS PATH IS CORRECT FOR YOUR APPLICATION!

public readonly property LangInclude as string
  get
    if IsNothing(filename) then
      return ""
    else
      return "<script type='text/javascript'>Rico.include('" & filename & "');</" & "script>"
    end if
  end get
end property

sub Page_Load()
  dim lang as string, i as integer, arLang() as string
  
  lang=lcase(Request.ServerVariables("HTTP_ACCEPT_LANGUAGE"))
  arLang=split(lang,",")
  for i=0 to ubound(arLang)
    lang2=lcase(left(trim(arLang(i)),2))
    if lang2="en" then exit for
    filename="translations/livegrid_" & lang2 & ".js"
    if System.IO.File.Exists(Server.MapPath(jsPath & filename)) then exit sub
  next
  filename=Nothing
end sub

</script>

<%=Me.LangInclude %>
