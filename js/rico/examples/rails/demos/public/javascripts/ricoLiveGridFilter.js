Rico.LiveGridFilter = Class.create();
Rico.LiveGridFilter.prototype = {
  initialize: function(filterRow, liveGrid){
    this.filterRow = filterRow;
    this.filterElements =  $A(filterRow.getElementsByClassName('ricoLG_cell'))
    this.saveHeight = this.filterElements[0].offsetHeight;
    this.liveGrid = liveGrid;
  },
  toggle: function() {
     if ( this.filterRow.visible() )
        this.slideMenuUp();
     else
        this.slideMenuDown();
  },
  slideMenuUp: function() {
    this.filterRow.makeClipping();
    Rico.animate( new Rico.Effect.Height(this.filterElements, 0), {onFinish: function(){this.filterRow.hide(); this.liveGrid.resizeWindow();}.bind(this)})

    $('filterLink').innerHTML = '<img src="/images/tableFilterExpand.gif" border="0">';
  },
  slideMenuDown: function() {
    this.filterRow.show();
    Rico.animate(new Rico.Effect.Height( this.filterElements, this.saveHeight), {onFinish: function() { this.filterRow.undoClipping(); this.liveGrid.resizeWindow();}.bind(this)}); 
     
    $('filterLink').innerHTML = '<img src="/images/tableFilterCollapse.gif" border="0">';
  }
}