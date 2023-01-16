Partial Class sqlParse
Inherits System.Web.UI.UserControl

Public Class sqlColumn
  Public sql As String, name As String

  Public Sub New(Optional sqlParm As String = "", Optional nameParm As String = "")
    if sqlParm<>"" then sql=sqlParm
    if nameParm<>"" then name=nameParm
  End Sub
End Class

'********************************************************************************************************
' Parse SQL a statement
'********************************************************************************************************

Public SelectList As New ArrayList()
Public GroupBy As New ArrayList()
Public OrderBy As New ArrayList()
Public FromClause As String, WhereClause As String, HavingClause As String

' -------------------------------------------------------------
' Rebuilds a SQL select statement that was parsed by ParseSelect
' -------------------------------------------------------------
Public function UnparseSelect() As String
  dim sqltext As String
  sqltext="SELECT " & UnparseColumnList & " FROM " & FromClause
  if not IsNothing(WhereClause) then sqltext &= " WHERE " & WhereClause
  if GroupBy.count > 0 then sqltext &= " GROUP BY " & join(GroupBy.ToArray(),",")
  if not IsNothing(HavingClause) then sqltext &= " HAVING " & HavingClause
  if OrderBy.count > 0 then sqltext &= " ORDER BY " & join(OrderBy.ToArray(),",")
  UnparseSelect=sqltext
end Function


Public function UnparseColumnList() As String
  dim sqltext As String, i as integer
  for i=0 to SelectList.count-1
    if not IsNothing(sqltext) then sqltext &= ","
    sqltext &= SelectList(i).sql
    if not IsNothing(SelectList(i).name) then sqltext &= " AS " & SelectList(i).name
  next
  UnparseColumnList=sqltext
end Function


' returns a "windowed" select query
' includeAS should be true for SQL Server 2005 and false for Oracle
Public function UnparseWithRowNumber(offset as Integer, numrows as Integer, includeAS as Boolean) as String
  dim unparseText as String
  if OrderBy.count = 0 then Throw New Exception("an OrderBy clause is required")
  unparseText="SELECT ROW_NUMBER() OVER (ORDER BY " & join(OrderBy.ToArray(),",") & ") AS rico_rownum,"
  unparseText &= UnparseColumnList() & " FROM " & FromClause
  if not IsNothing(WhereClause) then unparseText &= " WHERE " & WhereClause
  if GroupBy.count > 0 then unparseText &= " GROUP BY " & join(GroupBy.ToArray(),",")
  if not IsNothing(HavingClause) then unparseText &= " HAVING " & HavingClause
  unparseText="SELECT * FROM (" & unparseText & ")"
  if includeAS then unparseText &= " AS rico_Main"
  unparseText &= " WHERE rico_rownum > " & offset & " AND rico_rownum <= " & CStr(offset+numrows)
  UnparseWithRowNumber=unparseText
end Function


Public sub Init()
  SelectList.Clear()
  GroupBy.Clear()
  OrderBy.Clear()
  FromClause=Nothing
  WhereClause=Nothing
  HavingClause=Nothing
end sub


' -------------------------------------------------------------
' Parse a SQL select statement into its major components
' Does not handle:
' 1) union queries
' 2) select into
' 3) more than one space between "group" and "by", or "order" and "by"
' If distinct is specified, it will be part of the first item in SelectList
' -------------------------------------------------------------
Public function ParseSelect(ByVal sqltext as String) As Boolean
  dim i As Integer, j As Integer, l As Integer, idx As Integer, parencnt As Integer
  dim clause As String, ch As String, curfield As String, nexttoken As String, inquote As Boolean
  Init()
  ParseSelect=false
  sqltext=replace(sqltext,vbLf," ")
  sqltext=" " & replace(sqltext,vbCr," ") & " SELECT "   ' SELECT suffix forces last curfield to be saved
  'response.write "<p>ParseSelect: " & sqltext & "</p>"
  l=len(sqltext)
  parencnt=0
  inquote=false
  i=1
  curfield=""
  while i<l
    ch=mid(sqltext,i,1)
    if inquote then
      if ch="'" then
        if mid(sqltext,i,2)="''" then
          curfield=curfield & "'"
          i=i+1
        else
          inquote=false
        end if
      end if
      curfield=curfield & ch
    elseif ch="'" then
      inquote=true
      curfield=curfield & ch
    elseif ch="(" then
      parencnt=parencnt+1
      curfield=curfield & ch
    elseif ch=")" then
      if parencnt=0 then exit function  ' sql statement has a syntax error
      parencnt=parencnt-1
      curfield=curfield & ch
    elseif parencnt > 0 then
      curfield=curfield & ch
    elseif ch="," then
      'response.write "<p>" & clause & ": " & server.htmlencode(curfield) & "</p>"
      select case clause
        case "SELECT":
          AddColumn(curfield)
          curfield=""
        case "AS":
          SelectList(SelectList.count-1).name=curfield
          curfield=""
          clause="SELECT"
        case "GROUP BY": ArrayPush(GroupBy,curfield)
        case "ORDER BY": ArrayPush(OrderBy,curfield)
        case else: curfield=curfield & ch
      end select
    elseif ch=" " then
      j=InStr(i+1,sqltext," ")
      if j<1 then
        curfield=curfield & ch
      else
        if ucase(mid(sqltext,j+1,3))="BY " then j=j+3
        nexttoken=ucase(mid(sqltext,i+1,j-i-1))
        'wscript.echo "'" & nexttoken & "'"
        'response.write "<p>" & clause & " : " & nexttoken & " : " & server.htmlencode(curfield) & "</p>"
        select case nexttoken
          case "SELECT","AS","INTO","FROM","WHERE","GROUP BY","HAVING","ORDER BY":
            select case clause
              case "SELECT":
                AddColumn(curfield)
                curfield=""
              case "AS":
                SelectList(SelectList.count-1).name=curfield
                curfield=""
              case "FROM":     SetParseField(FromClause,curfield)
              case "WHERE":    SetParseField(WhereClause,curfield)
              case "GROUP BY": ArrayPush(GroupBy,curfield)
              case "HAVING":   SetParseField(HavingClause,curfield)
              case "ORDER BY": ArrayPush(OrderBy,curfield)
            end select
            clause=nexttoken
            i=j
          case else: if curfield<>"" then curfield=curfield & ch
        end select
      end if
    else
      curfield=curfield & ch
    end if
    i=i+1
  end while
  ParseSelect=true
end function


Private Sub ArrayPush(s as ArrayList, ByRef newvalue as string)
  s.add(newvalue)
  newvalue=""
end sub

Private Sub SetParseField(ByRef f as string, ByRef newvalue as string)
  f=newvalue
  newvalue=""
end sub


Public Sub AddColumn(sqlParm as String, Optional nameParm As String = "")
  SelectList.add(new sqlColumn(sqlParm,nameParm))
End Sub


' -------------------------------------------------------------
' Add a join to the from clause
' -------------------------------------------------------------
Public Sub AddJoin(ByVal JoinClause As String)
  if InStr(FromClause," join ")>0 then FromClause="(" & FromClause & ")"  ' required by Access
  FromClause=FromClause & " " & JoinClause
end sub

' -------------------------------------------------------------
' Add sort criteria to the order by clause
' -------------------------------------------------------------
Public Sub AddSort(ByVal NewSort As String)
  OrderBy.insert(0,NewSort)
end sub

' -------------------------------------------------------------
' Add a condition to the where clause
' -------------------------------------------------------------
Public Sub AddWhereCondition(ByVal NewCondition)
  AddCondition(WhereClause,NewCondition)
end sub

' -------------------------------------------------------------
' Add a condition to the having clause
' -------------------------------------------------------------
Public Sub AddHavingCondition(ByVal NewCondition)
  AddCondition(HavingClause,NewCondition)
end sub

Private Sub AddCondition(ByRef Clause, ByVal NewCondition)
  if IsNothing(NewCondition) then exit sub
  If IsNothing(Clause) Then
    Clause="(" & NewCondition & ")"
  Else
    Clause &= " AND (" & NewCondition & ")"
  End If
End Sub

End Class
