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
  ex3.sqlQuery=sqltext
  ex3.dataProvider="ricoXMLquery.aspx"
  settingsCtl.ApplyGridSettings(ex3)
End Sub

</script>



<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Rico LiveGrid-Example 3</title>

<link href="../client/css/demo.css" type="text/css" rel="stylesheet" />
<script src="../../src/prototype.js" type="text/javascript"></script>
<script src="../../src/rico.js" type="text/javascript"></script>
<script type='text/javascript'>
<%= settingsCtl.StyleInclude %>
</script>
<Rico:ChkLang runat='server' id='translation' />

<script type="text/javascript">
var lastVal=[];
function keyfilter(txtbox,idx) {
  if (typeof lastVal[idx] != 'string') lastVal[idx]='';
  if (lastVal[idx]==txtbox.value) return;
  lastVal[idx]=txtbox.value;
  Rico.writeDebugMsg("keyfilter: "+idx+' '+txtbox.value);
  if (txtbox.value=='')
    ex3['grid'].columns[idx].setUnfiltered();
  else
    ex3['grid'].columns[idx].setFilter('LIKE',txtbox.value+'*',Rico.TableColumn.USERFILTER,function() {txtbox.value='';});
}
</script>

<style type="text/css">
input { font-weight:normal;font-size:8pt;}
th div.ricoLG_cell { height:1.5em; }  /* the text boxes require a little more height than normal */
</style>

</head>



<body>

<Rico:DemoMenu runat='server' id='DemoMenuCtl' />

<table id='explanation' border='0' cellpadding='0' cellspacing='5' style='clear:both'><tr valign='top'><td>

<form method='post' id='settings' runat='server'>
<Rico:DemoSettings runat='server' id='settingsCtl' FilterEnabled='false' FrozenEnabled='false' />
</form>

</td><td>This grid demonstrates how filters can be applied as the user types.
</td></tr></table>

<Rico:LiveGrid runat='server' id='ex3' frozenColumns='1' canFilterDefault='false'>
  <HeadingTop>
	  <tr>
	  <th class='ricoFrozen'>ID</th>
	  <th>ID</th>
	  <th colspan='3'>Shipment</th>
	  <th colspan='2'>Date</th>
	  </tr>
  </HeadingTop>
  <GridColumns>
    <Rico:Column runat='server' heading='Order#' width='60' />
    <Rico:Column runat='server' heading='Customer#' width='60' />
    <Rico:Column runat='server' heading='Ship Name' width='150' />
    <Rico:Column runat='server' heading='Ship City' width='80' />
    <Rico:Column runat='server' heading='Ship Country' width='90' />
    <Rico:Column runat='server' heading='Order Date' datatype='date' width='100' />
    <Rico:Column runat='server' heading='Ship Date' datatype='date' width='100' />
  </GridColumns>
  <HeadingBottom>
    <tr class='dataInput'>
	  <th class='ricoFrozen'><input type='text' onkeyup='keyfilter(this,0)' size='5'></th>
	  <th><input type='text' onkeyup='keyfilter(this,1)' size='5'></th>
	  <th><input type='text' onkeyup='keyfilter(this,2)'></th>
	  <th><input type='text' onkeyup='keyfilter(this,3)'></th>
	  <th><input type='text' onkeyup='keyfilter(this,4)'></th>
	  <th>&nbsp;</th>
	  <th>&nbsp;</th>
    </tr>
  </HeadingBottom>
</Rico:LiveGrid>

</body>
</html>
