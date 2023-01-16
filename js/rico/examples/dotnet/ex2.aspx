<%@ Page Language="VB" ResponseEncoding="iso-8859-1" Debug="true" %>
<%@ Register TagPrefix="Rico" TagName="DemoSettings" Src="settings.ascx" %>
<%@ Register TagPrefix="Rico" TagName="DemoMenu" Src="menu.ascx" %>
<%@ Register TagPrefix="Rico" TagName="ChkLang" Src="chklang.ascx" %>
<%@ Register TagPrefix="Rico" TagName="LiveGrid" Src="../../plugins/dotnet/LiveGrid.ascx" %>
<%@ Register TagPrefix="Rico" TagName="Column" Src="../../plugins/dotnet/GridColumn.ascx" %>


<script runat="server">

Sub Page_Load(Sender As object, e As EventArgs)
  Session.Timeout=60
  dim CustomerID as string=trim(request.querystring("id"))
  dim sqltext as string="select OrderID,CustomerID,ShipName,ShipCity,ShipCountry,OrderDate,ShippedDate from orders order by OrderID"
  if len(CustomerID)=5 then sqltext &= " where CustomerID='" & CustomerID & "'"
  ex2.sqlQuery=sqltext
  ex2.dataProvider="ricoXMLquery.aspx"
  settingsCtl.ApplyGridSettings(ex2)
End Sub

</script>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Rico LiveGrid-Example 2</title>

<link href="../client/css/demo.css" type="text/css" rel="stylesheet" />
<script src="../../src/prototype.js" type="text/javascript"></script>
<script src="../../src/rico.js" type="text/javascript"></script>
<script type='text/javascript'>
<%= settingsCtl.StyleInclude %>
</script>
<Rico:ChkLang runat='server' id='translation' />

</head>
<body>

<Rico:DemoMenu runat='server' id='DemoMenuCtl' />

<table id='explanation' border='0' cellpadding='0' cellspacing='5' style='clear:both'><tr valign='top'><td>

<form method='post' id='settings' runat='server'>
<Rico:DemoSettings runat='server' id='settingsCtl' FilterEnabled='true' />
</form>

</td><td>This example uses AJAX to fetch order data as required. 
It also demonstrates how the number of rows can be set automatically based
on the size of the window.
</td></tr></table>

<Rico:LiveGrid runat='server' id='ex2'>
<GridColumns>
  <Rico:Column runat='server' heading='Order#' width='60' />
  <Rico:Column runat='server' heading='Customer#' width='60' />
  <Rico:Column runat='server' heading='Ship Name' width='150' />
  <Rico:Column runat='server' heading='Ship City' width='80' />
  <Rico:Column runat='server' heading='Ship Country' width='90' />
  <Rico:Column runat='server' heading='Order Date' datatype='date' width='100' />
  <Rico:Column runat='server' heading='Ship Date' datatype='date' width='100' />
</GridColumns>
</Rico:LiveGrid>

</body>
</html>
