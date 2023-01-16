<? 

class SimpleGridCell {
  var $content;
  var $attr;

  function SimpleGridCell() {
    $this->attr=array();
  }

  function Class_Terminate() {
    $this->attr=NULL; // WARNING: class_terminate will not be automatically called
  }

  function HeadingCell() {
    $s="<td";
    $span=1;
    if (array_key_exists("colspan",$this->attr)) {
      $span=$this->attr["colspan"];
      $s.=" colspan='".$span."'";
    }
    return array($s."><div class='ricoLG_col'>".$this->DataCell("")."</div></td>", $span);
  }

  function DataCell($rowclass) {
    $s="<div";
    $this->attr["class"]=trim("ricoLG_cell ".$this->attr["class"]." ".$rowclass);
    foreach ($this->attr as $k => $v) {
      if ($k != "colspan") {
        $s.=" ".$k."='".$v."'";
      }
    }
    $s.=">".$this->content."</div>";
    return $s;
  }

  function SetAttr($name, $value) {
    $this->attr[$name]=$value;
  }
}

class SimpleGridRow {
  var $cells;
  var $attr;
  var $CurrentCell;

  function SimpleGridRow() {
    $this->cells=array();
    $this->attr=array();
  }

  function Class_Terminate() {
    $this->attr=NULL; // WARNING: class_terminate will not be automatically called
  }

  function AddCell($content) {
    array_push($this->cells, new SimpleGridCell());
    $this->CurrentCell=&$this->cells[count($this->cells)-1];
    $this->CurrentCell->content=$content;
  }

  function HeadingRow($c1, $c2) {
    $cellidx=0;
    $colidx=0;
    while ($colidx < $c1 && $cellidx < count($this->cells)) {
      $a=$this->cells[$cellidx]->HeadingCell();
      $colidx+=intval($a[1]);
      $cellidx++;
    }
    while (($colidx <= $c2 || $c2 == -1) && $cellidx <= count($this->cells)-1) {
      $a=$this->cells[$cellidx]->HeadingCell();
      $s.=$a[0];
      $colidx+=intval($a[1]);
      $cellidx++;
    }
    return $s;
  }

  function HeadingClass() {
    return trim("ricoLG_hdg ".$this->attr["class"]);
  }

  function CellCount() {
    return count($this->cells);
  }

  function GetRowAttr($name) {
    return $this->attr[$name];
  }

  function SetRowAttr($name, $value) {
    $this->attr[$name]=$value;
  }

  function SetCellAttr($name, $value) {
    $this->CurrentCell->SetAttr($name, $value);
  }
}

class SimpleGrid {
  var $rows;
  var $LastRow;
  var $LastHeadingRow;
  var $ResizeRowIdx=-1;

  function SimpleGrid() {
    $this->rows=array();
  }

  function AddHeadingRow($ResizeRowFlag) {
    $this->LastHeadingRow=$this->AddDataRow();
    if ($ResizeRowFlag) {
      $this->ResizeRowIdx=$this->LastHeadingRow;
    }
    return $this->LastHeadingRow;
  }

  function AddDataRow() {
    array_push($this->rows, new SimpleGridRow());
    $this->LastRow=count($this->rows)-1;
    return $this->LastRow;
  }

  function AddCell($content) {
    $this->rows[$this->LastRow]->AddCell($content);
  }

  function AddCellToRow($RowIdx, $content) {
    $this->LastRow=$RowIdx;
    $this->AddCell($content);
  }

  function SetRowAttr($name, $value) {
    $this->rows[$this->LastRow]->SetRowAttr($name, $value);
  }

  function SetCellAttr($name, $value) {
    $this->rows[$this->LastRow]->SetCellAttr($name, $value);
  }

  function RenderColumns($c1, $c2) {
    for ($c=$c1; $c<=$c2; $c++) {
      echo "\n<td><div class='ricoLG_col'>";
      for ($r=$this->LastHeadingRow + 1; $r<count($this->rows); $r++) {
        echo $this->rows[$r]->cells[$c]->DataCell($this->rows[$r]->GetRowAttr("class"));
      }
      echo "</div></td>";
    }
  }

  function Render($id, $FrozenCols) {
    if ($this->ResizeRowIdx < 0) {
      return;
    }
    $colcnt=$this->rows[$this->ResizeRowIdx]->CellCount();
    echo "\n<div id='".$id."_outerDiv'>";
    //-------------------
    // frozen columns
    //-------------------
    echo "\n<div id='".$id."_frozenTabsDiv'>";
    // upper left
    echo "\n<table id='".$id."_tab0h' class='ricoLG_table ricoLG_top ricoLG_left' cellspacing='0' cellpadding='0'><thead>";
    for ($r=0; $r<=$this->LastHeadingRow; $r++) {
      echo "\n<tr class='".$this->rows[$r]->HeadingClass."'";
      if ($r == $this->ResizeRowIdx) {
        echo " id='".$id."_tab0h_main'";
      }
      echo ">";
      echo $this->rows[$r]->HeadingRow(0, $FrozenCols-1);
      echo "</tr>";
    }
    echo "\n</thead></table>";
    // lower left
    echo "\n<table id='".$id."_tab0' class='ricoLG_table ricoLG_bottom ricoLG_left' cellspacing='0' cellpadding='0'>";
    echo "\n<tr>";
    $this->RenderColumns(0, $FrozenCols-1);
    echo "</tr>";
    echo "\n</table>";
    echo "</div>";
    //-------------------
    // scrolling columns
    //-------------------
    // upper right
    echo "\n<div id='".$id."_innerDiv'>";
    echo "\n<div id='".$id."_scrollTabsDiv'>";
    echo "\n<table id='".$id."_tab1h' class='ricoLG_table ricoLG_top ricoLG_right' cellspacing='0' cellpadding='0'><thead>";
    for ($r=0; $r<=$this->LastHeadingRow; $r++) {
      echo "\n<tr class='".$this->rows[$r]->HeadingClass."'";
      if ($r == $this->ResizeRowIdx) {
        echo " id='".$id."_tab1h_main'";
      }
      echo ">";
      echo $this->rows[$r]->HeadingRow($FrozenCols, -1);
      echo "\n</tr>";
    }
    echo "\n</thead></table>";
    echo "\n</div>";
    echo "\n</div>";
    // lower right
    echo "\n<div id='".$id."_scrollDiv'>";
    echo "\n<table id='".$id."_tab1' class='ricoLG_table ricoLG_bottom ricoLG_right' cellspacing='0' cellpadding='0'>";
    echo "\n<tr>";
    $this->RenderColumns($FrozenCols, $colcnt-1);
    echo "\n</tr>";
    echo "\n</table>";
    echo "\n</div>";
    echo "\n</div>";
  }
}
?>
