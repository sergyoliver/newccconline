<%@ Control Language="vb" debug="true"%>
<%@ Import Namespace="System.Data" %>
<script runat="server">

Public Class HeadingCellClass
  Public content As String, span As Integer

  Public Sub New(Optional contentParm As String = "", Optional spanParm As Integer = 1)
    content=contentParm
    span=spanParm
  End Sub
End Class

class SimpleGridCell
  public content as String
  private attr As New Hashtable()

  Public Function HeadingCell() as object
    Dim s as String, span as Integer
    s="<td"
    span=1
    If attr.contains("colspan") Then
      span=CInt(attr("colspan"))
      s &= " colspan='" & span & "'"
    End If
    dim content as String=s & "><div class='ricoLG_col'>" & DataCell("") & "</div></td>"
    dim result() as object = {content,span}
    HeadingCell = result
  End Function

  Public Function DataCell(rowclass as String) as String
    dim s as String, k as String
    s = "<div"
    attr("class")=trim("ricoLG_cell " & attr("class") & " " & rowclass)
    for each k in attr.keys
      If k<>"colspan" Then s=s & " " & k & "='" & attr(k) & "'"
    next
    s=s & ">" & content & "</div>"
    DataCell=s
  End Function

  Public Sub SetAttr(name as String, value as String)
    attr(name)=value
  End Sub
End class


class SimpleGridRow
  public cells as New ArrayList()
  private attr As New Hashtable()
  private CurrentCell as SimpleGridCell

  Public Sub AddCell(ByVal content as String)
    CurrentCell=new SimpleGridCell()
    cells.Add(CurrentCell)
    CurrentCell.content=content
  End Sub
  
  Public Function HeadingRow(ByVal c1 as Integer, ByVal c2 as Integer) as String
    dim s as String, a
    dim cellidx as Integer=0
    dim colidx as Integer=0
    while colidx < c1 and cellidx < cells.count
      a=cells(cellidx).HeadingCell()
      colidx+=CInt(a(1))
      cellidx+=1
    end while
    while (colidx <= c2 or c2=-1) and cellidx < cells.count
      a=cells(cellidx).HeadingCell()
      s &= a(0)
      colidx+=CInt(a(1))
      cellidx+=1
    end while
    HeadingRow = s
  End Function
  
  Public Function HeadingClass()
    HeadingClass=trim("ricoLG_hdg " & attr("class"))
  End Function
  
  Public Function CellCount()
    CellCount=cells.count
  End Function

  Public Function GetRowAttr(ByVal name)
    GetRowAttr=attr(name)
  End Function

  Public Sub SetRowAttr(ByVal name, ByVal value)
    attr(name)=value
  End Sub

  Public Sub SetCellAttr(ByVal name, ByVal value)
    CurrentCell.SetAttr(name,value)
  End Sub
end class


public rows as New ArrayList()
public FrozenCols as Integer
private LastRow,LastHeadingRow,ResizeRowIdx

Public Function AddHeadingRow(ResizeRowFlag as Boolean)
  LastHeadingRow=AddDataRow()
  if ResizeRowFlag then ResizeRowIdx=LastHeadingRow
  AddHeadingRow=LastHeadingRow
End Function

Public Function AddDataRow()
  rows.Add(new SimpleGridRow())
  LastRow=rows.count-1
  AddDataRow=LastRow
End Function

Public Sub AddCell(ByVal content as String)
  rows(LastRow).AddCell(content)
End Sub

Public Sub AddCellToRow(ByVal RowIdx as Integer, ByVal content as String)
  LastRow=RowIdx
  AddCell(content)
End Sub

Public Sub SetRowAttr(ByVal name as String, ByVal value as String)
  rows(LastRow).SetRowAttr(name,value)
End Sub

Public Sub SetCellAttr(ByVal name as String, ByVal value as String)
  rows(LastRow).SetCellAttr(name,value)
End Sub

Private Function RenderColumns(writer as HTMLTextWriter, c1 as Integer, c2 as Integer)
  dim r as Integer, c as Integer
  for c=c1 to c2
    writer.Write("<td><div class='ricoLG_col'>")
    for r=LastHeadingRow+1 to rows.count-1
      writer.Write(rows(r).cells(c).DataCell(rows(r).GetRowAttr("class")))
    next
    writer.WriteLine("</div></td>")
  next
End Function

Protected Overrides Sub Render(writer as HTMLTextWriter)
  dim colcnt as Integer, r as Integer, c as Integer
  if IsNothing(ResizeRowIdx) then exit sub
  colcnt=rows(ResizeRowIdx).CellCount
  writer.Write("<div id='" & Me.UniqueId & "_outerDiv'>")

  '-------------------
  ' frozen columns
  '-------------------
  writer.WriteLine("<div id='" & Me.UniqueId & "_frozenTabsDiv'>")

  ' upper left
  writer.WriteLine("<table id='" & Me.UniqueId & "_tab0h' class='ricoLG_table ricoLG_top ricoLG_left' cellspacing='0' cellpadding='0'><thead>")
  for r=0 to LastHeadingRow
    writer.Write("<tr class='" & rows(r).HeadingClass() & "'")
    if r=ResizeRowIdx then writer.Write(" id='" & Me.UniqueId & "_tab0h_main'")
    writer.WriteLine(">")
    writer.Write(rows(r).HeadingRow(0,FrozenCols-1))
    writer.Write("</tr>")
  next
  writer.WriteLine("</thead></table>")

  ' lower left
  writer.Write("<table id='" & Me.UniqueId & "_tab0' class='ricoLG_table ricoLG_bottom ricoLG_left' cellspacing='0' cellpadding='0'>")
  writer.WriteLine("<tr>")
  RenderColumns(writer,0,FrozenCols-1)
  writer.Write("</tr>")
  writer.WriteLine("</table>")

  writer.WriteLine("</div>")


  '-------------------
  ' scrolling columns
  '-------------------

  ' upper right
  writer.Write("<div id='" & Me.UniqueId & "_innerDiv'>")
  writer.Write("<div id='" & Me.UniqueId & "_scrollTabsDiv'>")
  writer.WriteLine("<table id='" & Me.UniqueId & "_tab1h' class='ricoLG_table ricoLG_top ricoLG_right' cellspacing='0' cellpadding='0'><thead>")
  for r=0 to LastHeadingRow
    writer.Write("<tr class='" & rows(r).HeadingClass & "'")
    if r=ResizeRowIdx then writer.Write(" id='" & Me.UniqueId & "_tab1h_main'")
    writer.Write(">")
    writer.Write(rows(r).HeadingRow(FrozenCols,-1))
    writer.Write("</tr>")
  next
  writer.Write("</thead></table>")
  writer.Write("</div>")
  writer.WriteLine("</div>")

  ' lower right
  writer.Write("<div id='" & Me.UniqueId & "_scrollDiv'>")
  writer.Write("<table id='" & Me.UniqueId & "_tab1' class='ricoLG_table ricoLG_bottom ricoLG_right' cellspacing='0' cellpadding='0'>")
  writer.WriteLine("<tr>")
  RenderColumns(writer,FrozenCols,colcnt-1)
  writer.Write("</tr>")
  writer.Write("</table>")
  writer.Write("</div>")

  writer.WriteLine("</div>")
End Sub

</script>
