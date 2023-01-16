Partial Class GridColumn
Inherits System.Web.UI.UserControl

' ----------------------------------------------------
' Properties
' ----------------------------------------------------

Public onchange as String
Public DataType as String
Public canSort as Boolean = True
Public control as String
Public format as String
Public visible as Boolean = True
Public TxtAreaRows as Integer = 4
Public TxtAreaCols as Integer = 80
Public ColName as String
Public ColData as String
Public SelectSql as String
Public SelectCtl as String
Public SelectFilter as String
Public Formula as String
Public TableIdx as Integer = 0
Public FilterFlag as Boolean = False
Public FieldName as String
Public ClassName as String
Public isNullable as Boolean = False
Public Writeable as Boolean = True
Public FixedLength as Boolean
Public isKey as Boolean = False
Public Length as Integer = -1
Public TypeName as String  ' .net type
Public panelIdx as Integer = -1
Public ConfirmDeleteColumn as Boolean = False
Public InsertOnly as Boolean = False
Public UpdateOnly as Boolean = False
Public FormView as String
Public AddQuotes as Boolean = True

Private _EntryType as String
Private _colHeading As String
Private _width As Integer = -1


Public Property Heading() As String
  Get
    Return _colHeading
  End Get
  Set
    _colHeading = value
  End Set
End Property

Public Property Width() As Integer
  Get
    Return _width
  End Get
  Set
    _width = value
  End Set
End Property

Public Property EntryType() As String
  Get
    Return _EntryType
  End Get
  Set
    select case value
      case "TA","tinyMCE","R","RL","S","SL","CL","N","B","T":
      case "I":   onchange="CheckInt"
      case "D":   DataType="date"
      case "DT":  DataType="datetime"
      case "H":   visible=false
      case else:  Throw New Exception("Invalid EntryType")
    end select
    _EntryType = value
  End Set
End Property


Public ReadOnly Property script() As String
  Get
    dim a as New ArrayList()
    if not IsNothing(Me.DataType) then a.Add("type: '" & Me.DataType & "'")
    if not IsNothing(Me.control) then a.Add("control: " & Me.control)
    if not IsNothing(Me.onchange) then a.Add("onchange: '" & Me.onchange & "'")
    if not IsNothing(Me.format) then a.Add("format: '" & Me.format & "'")
    if not Me.canSort then a.Add("canSort: false")
    if not Me.visible then a.Add("visible: false")
    if Me._width >= 0 then a.Add("width: " & Me._width)
    if not IsNothing(Me.ColName) then a.Add("ColName: '" & Me.ColName & "'")
    if not IsNothing(Me.FieldName) then a.Add("FieldName: '" & Me.FieldName & "'")
    if not IsNothing(Me.ClassName) then a.Add("ClassName: '" & Me.ClassName & "'")
    if Me.panelIdx >= 0 then a.Add("panelIdx: " & Me.panelIdx)
    if not IsNothing(Me.EntryType) then
      a.Add("EntryType: '" & Me.EntryType & "'")
      if Me.EntryType="D" and ucase(Me.ColData)="TODAY" then
        a.Add("ColData: '" & DateTime.Today.ToString("s") & "'")
      else
        a.Add("ColData: '" & replace(Me.ColData,"'","\'") & "'")
      end if
      if Me.EntryType="TA" or Me.EntryType="tinyMCE" then
        a.Add("TxtAreaRows: " & Me.TxtAreaRows)
        a.Add("TxtAreaCols: " & Me.TxtAreaCols)
      end if
      if not IsNothing(Me.FormView) then a.Add("FormView: '" & Me.FormView & "'")
      if not IsNothing(Me.SelectCtl) then a.Add("SelectCtl: '" & Me.SelectCtl & "'")
      if Me.Length >= 0 then a.Add("Length: " & Me.Length)
      if Me.isNullable then a.Add("isNullable: true")
      if Me.isKey then a.Add("isKey: true")
      a.Add("Writeable: " & LCase(Me.Writeable))
      if Me.InsertOnly then a.Add("InsertOnly: true")
      if Me.UpdateOnly then a.Add("InsertOnly: true")
    end if
    Return " {" & String.Join("," & vbCrLf & "  ", a.ToArray(Type.GetType("System.String"))) & " }"
  End Get
End Property

End Class
