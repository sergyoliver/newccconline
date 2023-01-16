<%@ Page Language="VB" ResponseEncoding="iso-8859-1" Debug="true" %>
<%@ Register TagPrefix="Rico" TagName="DemoSettings" Src="settings.ascx" %>
<%@ Register TagPrefix="Rico" TagName="DemoMenu" Src="menu.ascx" %>
<%@ Register TagPrefix="Rico" TagName="ChkLang" Src="chklang.ascx" %>

<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Rico LiveGrid-Example 1</title>

<script src="../../src/prototype.js" type="text/javascript"></script>
<script src="../../src/rico.js" type="text/javascript"></script>
<link href="../client/css/demo.css" type="text/css" rel="stylesheet" />

<script type='text/javascript'>
Rico.loadModule('LiveGrid','LiveGridMenu');
<%= settingsCtl.StyleInclude %>

Rico.onLoad( function() {
  var opts = {  
    <%= settingsCtl.GridSettingsScript %>,
    columnSpecs   : ['specQty']
  };
  var ex1=new Rico.LiveGrid ('ex1', new Rico.Buffer.Base($('ex1').tBodies[0]), opts);
  ex1.menu=new Rico.GridMenu({ menuEvent : '<%= settingsCtl.MenuSetting %>'});
});

</script>
<Rico:ChkLang runat='server' id='translation' />

</head>

<body>

<Rico:DemoMenu runat='server' id='DemoMenuCtl' />

<table id='explanation' border='0' cellpadding='0' cellspacing='5' style='clear:both'><tr valign='top'><td>

<form method='post' id='settings' runat='server'>
<Rico:DemoSettings runat='server' id='settingsCtl' FilterEnabled='false' />
</form>

</td><td>This example demonstrates a pre-filled grid (no AJAX data fetches). 
LiveGrid Plus just provides scrolling, column resizing, and sorting capabilities.
The first column sorts numerically, the others sort in text order.
Filtering is not supported on pre-filled grids.
</td></tr></table>

<p class="ricoBookmark"><span id="ex1_bookmark">&nbsp;</span></p>
<table id="ex1" class="ricoLiveGrid" cellspacing="0" cellpadding="0">
<colgroup>
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
<col style='width:80px;' />
</colgroup>

<thead><tr>
<th>Column 1</th><th>Column 2</th><th>Column 3</th><th>Column 4</th><th>Column 5</th><th>Column 6</th><th>Column 7</th><th>Column 8</th><th>Column 9</th><th>Column 10</th><th>Column 11</th><th>Column 12</th><th>Column 13</th><th>Column 14</th><th>Column 15</th>

</tr></thead><tbody>

<tr><td>1</td><td>Cell 1:2</td><td>Cell 1:3</td><td>Cell 1:4</td><td>Cell 1:5</td><td>Cell 1:6</td><td>Cell 1:7</td><td>Cell 1:8</td><td>Cell 1:9</td><td>Cell 1:10</td><td>Cell 1:11</td><td>Cell 1:12</td><td>Cell 1:13</td><td>Cell 1:14</td><td>Cell 1:15</td></tr>
<tr><td>2</td><td>Cell 2:2</td><td>Cell 2:3</td><td>Cell 2:4</td><td>Cell 2:5</td><td>Cell 2:6</td><td>Cell 2:7</td><td>Cell 2:8</td><td>Cell 2:9</td><td>Cell 2:10</td><td>Cell 2:11</td><td>Cell 2:12</td><td>Cell 2:13</td><td>Cell 2:14</td><td>Cell 2:15</td></tr>
<tr><td>3</td><td>Cell 3:2</td><td>Cell 3:3</td><td>Cell 3:4</td><td>Cell 3:5</td><td>Cell 3:6</td><td>Cell 3:7</td><td>Cell 3:8</td><td>Cell 3:9</td><td>Cell 3:10</td><td>Cell 3:11</td><td>Cell 3:12</td><td>Cell 3:13</td><td>Cell 3:14</td><td>Cell 3:15</td></tr>
<tr><td>4</td><td>Cell 4:2</td><td>Cell 4:3</td><td>Cell 4:4</td><td>Cell 4:5</td><td>Cell 4:6</td><td>Cell 4:7</td><td>Cell 4:8</td><td>Cell 4:9</td><td>Cell 4:10</td><td>Cell 4:11</td><td>Cell 4:12</td><td>Cell 4:13</td><td>Cell 4:14</td><td>Cell 4:15</td></tr>
<tr><td>5</td><td>Cell 5:2</td><td>Cell 5:3</td><td>Cell 5:4</td><td>Cell 5:5</td><td>Cell 5:6</td><td>Cell 5:7</td><td>Cell 5:8</td><td>Cell 5:9</td><td>Cell 5:10</td><td>Cell 5:11</td><td>Cell 5:12</td><td>Cell 5:13</td><td>Cell 5:14</td><td>Cell 5:15</td></tr>
<tr><td>6</td><td>Cell 6:2</td><td>Cell 6:3</td><td>Cell 6:4</td><td>Cell 6:5</td><td>Cell 6:6</td><td>Cell 6:7</td><td>Cell 6:8</td><td>Cell 6:9</td><td>Cell 6:10</td><td>Cell 6:11</td><td>Cell 6:12</td><td>Cell 6:13</td><td>Cell 6:14</td><td>Cell 6:15</td></tr>
<tr><td>7</td><td>Cell 7:2</td><td>Cell 7:3</td><td>Cell 7:4</td><td>Cell 7:5</td><td>Cell 7:6</td><td>Cell 7:7</td><td>Cell 7:8</td><td>Cell 7:9</td><td>Cell 7:10</td><td>Cell 7:11</td><td>Cell 7:12</td><td>Cell 7:13</td><td>Cell 7:14</td><td>Cell 7:15</td></tr>
<tr><td>8</td><td>Cell 8:2</td><td>Cell 8:3</td><td>Cell 8:4</td><td>Cell 8:5</td><td>Cell 8:6</td><td>Cell 8:7</td><td>Cell 8:8</td><td>Cell 8:9</td><td>Cell 8:10</td><td>Cell 8:11</td><td>Cell 8:12</td><td>Cell 8:13</td><td>Cell 8:14</td><td>Cell 8:15</td></tr>
<tr><td>9</td><td>Cell 9:2</td><td>Cell 9:3</td><td>Cell 9:4</td><td>Cell 9:5</td><td>Cell 9:6</td><td>Cell 9:7</td><td>Cell 9:8</td><td>Cell 9:9</td><td>Cell 9:10</td><td>Cell 9:11</td><td>Cell 9:12</td><td>Cell 9:13</td><td>Cell 9:14</td><td>Cell 9:15</td></tr>
<tr><td>10</td><td>Cell 10:2</td><td>Cell 10:3</td><td>Cell 10:4</td><td>Cell 10:5</td><td>Cell 10:6</td><td>Cell 10:7</td><td>Cell 10:8</td><td>Cell 10:9</td><td>Cell 10:10</td><td>Cell 10:11</td><td>Cell 10:12</td><td>Cell 10:13</td><td>Cell 10:14</td><td>Cell 10:15</td></tr>
<tr><td>11</td><td>Cell 11:2</td><td>Cell 11:3</td><td>Cell 11:4</td><td>Cell 11:5</td><td>Cell 11:6</td><td>Cell 11:7</td><td>Cell 11:8</td><td>Cell 11:9</td><td>Cell 11:10</td><td>Cell 11:11</td><td>Cell 11:12</td><td>Cell 11:13</td><td>Cell 11:14</td><td>Cell 11:15</td></tr>
<tr><td>12</td><td>Cell 12:2</td><td>Cell 12:3</td><td>Cell 12:4</td><td>Cell 12:5</td><td>Cell 12:6</td><td>Cell 12:7</td><td>Cell 12:8</td><td>Cell 12:9</td><td>Cell 12:10</td><td>Cell 12:11</td><td>Cell 12:12</td><td>Cell 12:13</td><td>Cell 12:14</td><td>Cell 12:15</td></tr>
<tr><td>13</td><td>Cell 13:2</td><td>Cell 13:3</td><td>Cell 13:4</td><td>Cell 13:5</td><td>Cell 13:6</td><td>Cell 13:7</td><td>Cell 13:8</td><td>Cell 13:9</td><td>Cell 13:10</td><td>Cell 13:11</td><td>Cell 13:12</td><td>Cell 13:13</td><td>Cell 13:14</td><td>Cell 13:15</td></tr>
<tr><td>14</td><td>Cell 14:2</td><td>Cell 14:3</td><td>Cell 14:4</td><td>Cell 14:5</td><td>Cell 14:6</td><td>Cell 14:7</td><td>Cell 14:8</td><td>Cell 14:9</td><td>Cell 14:10</td><td>Cell 14:11</td><td>Cell 14:12</td><td>Cell 14:13</td><td>Cell 14:14</td><td>Cell 14:15</td></tr>
<tr><td>15</td><td>Cell 15:2</td><td>Cell 15:3</td><td>Cell 15:4</td><td>Cell 15:5</td><td>Cell 15:6</td><td>Cell 15:7</td><td>Cell 15:8</td><td>Cell 15:9</td><td>Cell 15:10</td><td>Cell 15:11</td><td>Cell 15:12</td><td>Cell 15:13</td><td>Cell 15:14</td><td>Cell 15:15</td></tr>
<tr><td>16</td><td>Cell 16:2</td><td>Cell 16:3</td><td>Cell 16:4</td><td>Cell 16:5</td><td>Cell 16:6</td><td>Cell 16:7</td><td>Cell 16:8</td><td>Cell 16:9</td><td>Cell 16:10</td><td>Cell 16:11</td><td>Cell 16:12</td><td>Cell 16:13</td><td>Cell 16:14</td><td>Cell 16:15</td></tr>
<tr><td>17</td><td>Cell 17:2</td><td>Cell 17:3</td><td>Cell 17:4</td><td>Cell 17:5</td><td>Cell 17:6</td><td>Cell 17:7</td><td>Cell 17:8</td><td>Cell 17:9</td><td>Cell 17:10</td><td>Cell 17:11</td><td>Cell 17:12</td><td>Cell 17:13</td><td>Cell 17:14</td><td>Cell 17:15</td></tr>
<tr><td>18</td><td>Cell 18:2</td><td>Cell 18:3</td><td>Cell 18:4</td><td>Cell 18:5</td><td>Cell 18:6</td><td>Cell 18:7</td><td>Cell 18:8</td><td>Cell 18:9</td><td>Cell 18:10</td><td>Cell 18:11</td><td>Cell 18:12</td><td>Cell 18:13</td><td>Cell 18:14</td><td>Cell 18:15</td></tr>
<tr><td>19</td><td>Cell 19:2</td><td>Cell 19:3</td><td>Cell 19:4</td><td>Cell 19:5</td><td>Cell 19:6</td><td>Cell 19:7</td><td>Cell 19:8</td><td>Cell 19:9</td><td>Cell 19:10</td><td>Cell 19:11</td><td>Cell 19:12</td><td>Cell 19:13</td><td>Cell 19:14</td><td>Cell 19:15</td></tr>
<tr><td>20</td><td>Cell 20:2</td><td>Cell 20:3</td><td>Cell 20:4</td><td>Cell 20:5</td><td>Cell 20:6</td><td>Cell 20:7</td><td>Cell 20:8</td><td>Cell 20:9</td><td>Cell 20:10</td><td>Cell 20:11</td><td>Cell 20:12</td><td>Cell 20:13</td><td>Cell 20:14</td><td>Cell 20:15</td></tr>
<tr><td>21</td><td>Cell 21:2</td><td>Cell 21:3</td><td>Cell 21:4</td><td>Cell 21:5</td><td>Cell 21:6</td><td>Cell 21:7</td><td>Cell 21:8</td><td>Cell 21:9</td><td>Cell 21:10</td><td>Cell 21:11</td><td>Cell 21:12</td><td>Cell 21:13</td><td>Cell 21:14</td><td>Cell 21:15</td></tr>
<tr><td>22</td><td>Cell 22:2</td><td>Cell 22:3</td><td>Cell 22:4</td><td>Cell 22:5</td><td>Cell 22:6</td><td>Cell 22:7</td><td>Cell 22:8</td><td>Cell 22:9</td><td>Cell 22:10</td><td>Cell 22:11</td><td>Cell 22:12</td><td>Cell 22:13</td><td>Cell 22:14</td><td>Cell 22:15</td></tr>
<tr><td>23</td><td>Cell 23:2</td><td>Cell 23:3</td><td>Cell 23:4</td><td>Cell 23:5</td><td>Cell 23:6</td><td>Cell 23:7</td><td>Cell 23:8</td><td>Cell 23:9</td><td>Cell 23:10</td><td>Cell 23:11</td><td>Cell 23:12</td><td>Cell 23:13</td><td>Cell 23:14</td><td>Cell 23:15</td></tr>
<tr><td>24</td><td>Cell 24:2</td><td>Cell 24:3</td><td>Cell 24:4</td><td>Cell 24:5</td><td>Cell 24:6</td><td>Cell 24:7</td><td>Cell 24:8</td><td>Cell 24:9</td><td>Cell 24:10</td><td>Cell 24:11</td><td>Cell 24:12</td><td>Cell 24:13</td><td>Cell 24:14</td><td>Cell 24:15</td></tr>
<tr><td>25</td><td>Cell 25:2</td><td>Cell 25:3</td><td>Cell 25:4</td><td>Cell 25:5</td><td>Cell 25:6</td><td>Cell 25:7</td><td>Cell 25:8</td><td>Cell 25:9</td><td>Cell 25:10</td><td>Cell 25:11</td><td>Cell 25:12</td><td>Cell 25:13</td><td>Cell 25:14</td><td>Cell 25:15</td></tr>
<tr><td>26</td><td>Cell 26:2</td><td>Cell 26:3</td><td>Cell 26:4</td><td>Cell 26:5</td><td>Cell 26:6</td><td>Cell 26:7</td><td>Cell 26:8</td><td>Cell 26:9</td><td>Cell 26:10</td><td>Cell 26:11</td><td>Cell 26:12</td><td>Cell 26:13</td><td>Cell 26:14</td><td>Cell 26:15</td></tr>
<tr><td>27</td><td>Cell 27:2</td><td>Cell 27:3</td><td>Cell 27:4</td><td>Cell 27:5</td><td>Cell 27:6</td><td>Cell 27:7</td><td>Cell 27:8</td><td>Cell 27:9</td><td>Cell 27:10</td><td>Cell 27:11</td><td>Cell 27:12</td><td>Cell 27:13</td><td>Cell 27:14</td><td>Cell 27:15</td></tr>
<tr><td>28</td><td>Cell 28:2</td><td>Cell 28:3</td><td>Cell 28:4</td><td>Cell 28:5</td><td>Cell 28:6</td><td>Cell 28:7</td><td>Cell 28:8</td><td>Cell 28:9</td><td>Cell 28:10</td><td>Cell 28:11</td><td>Cell 28:12</td><td>Cell 28:13</td><td>Cell 28:14</td><td>Cell 28:15</td></tr>
<tr><td>29</td><td>Cell 29:2</td><td>Cell 29:3</td><td>Cell 29:4</td><td>Cell 29:5</td><td>Cell 29:6</td><td>Cell 29:7</td><td>Cell 29:8</td><td>Cell 29:9</td><td>Cell 29:10</td><td>Cell 29:11</td><td>Cell 29:12</td><td>Cell 29:13</td><td>Cell 29:14</td><td>Cell 29:15</td></tr>
<tr><td>30</td><td>Cell 30:2</td><td>Cell 30:3</td><td>Cell 30:4</td><td>Cell 30:5</td><td>Cell 30:6</td><td>Cell 30:7</td><td>Cell 30:8</td><td>Cell 30:9</td><td>Cell 30:10</td><td>Cell 30:11</td><td>Cell 30:12</td><td>Cell 30:13</td><td>Cell 30:14</td><td>Cell 30:15</td></tr>
<tr><td>31</td><td>Cell 31:2</td><td>Cell 31:3</td><td>Cell 31:4</td><td>Cell 31:5</td><td>Cell 31:6</td><td>Cell 31:7</td><td>Cell 31:8</td><td>Cell 31:9</td><td>Cell 31:10</td><td>Cell 31:11</td><td>Cell 31:12</td><td>Cell 31:13</td><td>Cell 31:14</td><td>Cell 31:15</td></tr>
<tr><td>32</td><td>Cell 32:2</td><td>Cell 32:3</td><td>Cell 32:4</td><td>Cell 32:5</td><td>Cell 32:6</td><td>Cell 32:7</td><td>Cell 32:8</td><td>Cell 32:9</td><td>Cell 32:10</td><td>Cell 32:11</td><td>Cell 32:12</td><td>Cell 32:13</td><td>Cell 32:14</td><td>Cell 32:15</td></tr>
<tr><td>33</td><td>Cell 33:2</td><td>Cell 33:3</td><td>Cell 33:4</td><td>Cell 33:5</td><td>Cell 33:6</td><td>Cell 33:7</td><td>Cell 33:8</td><td>Cell 33:9</td><td>Cell 33:10</td><td>Cell 33:11</td><td>Cell 33:12</td><td>Cell 33:13</td><td>Cell 33:14</td><td>Cell 33:15</td></tr>
<tr><td>34</td><td>Cell 34:2</td><td>Cell 34:3</td><td>Cell 34:4</td><td>Cell 34:5</td><td>Cell 34:6</td><td>Cell 34:7</td><td>Cell 34:8</td><td>Cell 34:9</td><td>Cell 34:10</td><td>Cell 34:11</td><td>Cell 34:12</td><td>Cell 34:13</td><td>Cell 34:14</td><td>Cell 34:15</td></tr>
<tr><td>35</td><td>Cell 35:2</td><td>Cell 35:3</td><td>Cell 35:4</td><td>Cell 35:5</td><td>Cell 35:6</td><td>Cell 35:7</td><td>Cell 35:8</td><td>Cell 35:9</td><td>Cell 35:10</td><td>Cell 35:11</td><td>Cell 35:12</td><td>Cell 35:13</td><td>Cell 35:14</td><td>Cell 35:15</td></tr>
<tr><td>36</td><td>Cell 36:2</td><td>Cell 36:3</td><td>Cell 36:4</td><td>Cell 36:5</td><td>Cell 36:6</td><td>Cell 36:7</td><td>Cell 36:8</td><td>Cell 36:9</td><td>Cell 36:10</td><td>Cell 36:11</td><td>Cell 36:12</td><td>Cell 36:13</td><td>Cell 36:14</td><td>Cell 36:15</td></tr>
<tr><td>37</td><td>Cell 37:2</td><td>Cell 37:3</td><td>Cell 37:4</td><td>Cell 37:5</td><td>Cell 37:6</td><td>Cell 37:7</td><td>Cell 37:8</td><td>Cell 37:9</td><td>Cell 37:10</td><td>Cell 37:11</td><td>Cell 37:12</td><td>Cell 37:13</td><td>Cell 37:14</td><td>Cell 37:15</td></tr>
<tr><td>38</td><td>Cell 38:2</td><td>Cell 38:3</td><td>Cell 38:4</td><td>Cell 38:5</td><td>Cell 38:6</td><td>Cell 38:7</td><td>Cell 38:8</td><td>Cell 38:9</td><td>Cell 38:10</td><td>Cell 38:11</td><td>Cell 38:12</td><td>Cell 38:13</td><td>Cell 38:14</td><td>Cell 38:15</td></tr>
<tr><td>39</td><td>Cell 39:2</td><td>Cell 39:3</td><td>Cell 39:4</td><td>Cell 39:5</td><td>Cell 39:6</td><td>Cell 39:7</td><td>Cell 39:8</td><td>Cell 39:9</td><td>Cell 39:10</td><td>Cell 39:11</td><td>Cell 39:12</td><td>Cell 39:13</td><td>Cell 39:14</td><td>Cell 39:15</td></tr>
<tr><td>40</td><td>Cell 40:2</td><td>Cell 40:3</td><td>Cell 40:4</td><td>Cell 40:5</td><td>Cell 40:6</td><td>Cell 40:7</td><td>Cell 40:8</td><td>Cell 40:9</td><td>Cell 40:10</td><td>Cell 40:11</td><td>Cell 40:12</td><td>Cell 40:13</td><td>Cell 40:14</td><td>Cell 40:15</td></tr>
<tr><td>41</td><td>Cell 41:2</td><td>Cell 41:3</td><td>Cell 41:4</td><td>Cell 41:5</td><td>Cell 41:6</td><td>Cell 41:7</td><td>Cell 41:8</td><td>Cell 41:9</td><td>Cell 41:10</td><td>Cell 41:11</td><td>Cell 41:12</td><td>Cell 41:13</td><td>Cell 41:14</td><td>Cell 41:15</td></tr>
<tr><td>42</td><td>Cell 42:2</td><td>Cell 42:3</td><td>Cell 42:4</td><td>Cell 42:5</td><td>Cell 42:6</td><td>Cell 42:7</td><td>Cell 42:8</td><td>Cell 42:9</td><td>Cell 42:10</td><td>Cell 42:11</td><td>Cell 42:12</td><td>Cell 42:13</td><td>Cell 42:14</td><td>Cell 42:15</td></tr>
<tr><td>43</td><td>Cell 43:2</td><td>Cell 43:3</td><td>Cell 43:4</td><td>Cell 43:5</td><td>Cell 43:6</td><td>Cell 43:7</td><td>Cell 43:8</td><td>Cell 43:9</td><td>Cell 43:10</td><td>Cell 43:11</td><td>Cell 43:12</td><td>Cell 43:13</td><td>Cell 43:14</td><td>Cell 43:15</td></tr>
<tr><td>44</td><td>Cell 44:2</td><td>Cell 44:3</td><td>Cell 44:4</td><td>Cell 44:5</td><td>Cell 44:6</td><td>Cell 44:7</td><td>Cell 44:8</td><td>Cell 44:9</td><td>Cell 44:10</td><td>Cell 44:11</td><td>Cell 44:12</td><td>Cell 44:13</td><td>Cell 44:14</td><td>Cell 44:15</td></tr>
<tr><td>45</td><td>Cell 45:2</td><td>Cell 45:3</td><td>Cell 45:4</td><td>Cell 45:5</td><td>Cell 45:6</td><td>Cell 45:7</td><td>Cell 45:8</td><td>Cell 45:9</td><td>Cell 45:10</td><td>Cell 45:11</td><td>Cell 45:12</td><td>Cell 45:13</td><td>Cell 45:14</td><td>Cell 45:15</td></tr>
<tr><td>46</td><td>Cell 46:2</td><td>Cell 46:3</td><td>Cell 46:4</td><td>Cell 46:5</td><td>Cell 46:6</td><td>Cell 46:7</td><td>Cell 46:8</td><td>Cell 46:9</td><td>Cell 46:10</td><td>Cell 46:11</td><td>Cell 46:12</td><td>Cell 46:13</td><td>Cell 46:14</td><td>Cell 46:15</td></tr>
<tr><td>47</td><td>Cell 47:2</td><td>Cell 47:3</td><td>Cell 47:4</td><td>Cell 47:5</td><td>Cell 47:6</td><td>Cell 47:7</td><td>Cell 47:8</td><td>Cell 47:9</td><td>Cell 47:10</td><td>Cell 47:11</td><td>Cell 47:12</td><td>Cell 47:13</td><td>Cell 47:14</td><td>Cell 47:15</td></tr>
<tr><td>48</td><td>Cell 48:2</td><td>Cell 48:3</td><td>Cell 48:4</td><td>Cell 48:5</td><td>Cell 48:6</td><td>Cell 48:7</td><td>Cell 48:8</td><td>Cell 48:9</td><td>Cell 48:10</td><td>Cell 48:11</td><td>Cell 48:12</td><td>Cell 48:13</td><td>Cell 48:14</td><td>Cell 48:15</td></tr>
<tr><td>49</td><td>Cell 49:2</td><td>Cell 49:3</td><td>Cell 49:4</td><td>Cell 49:5</td><td>Cell 49:6</td><td>Cell 49:7</td><td>Cell 49:8</td><td>Cell 49:9</td><td>Cell 49:10</td><td>Cell 49:11</td><td>Cell 49:12</td><td>Cell 49:13</td><td>Cell 49:14</td><td>Cell 49:15</td></tr>
<tr><td>50</td><td>Cell 50:2</td><td>Cell 50:3</td><td>Cell 50:4</td><td>Cell 50:5</td><td>Cell 50:6</td><td>Cell 50:7</td><td>Cell 50:8</td><td>Cell 50:9</td><td>Cell 50:10</td><td>Cell 50:11</td><td>Cell 50:12</td><td>Cell 50:13</td><td>Cell 50:14</td><td>Cell 50:15</td></tr>
<tr><td>51</td><td>Cell 51:2</td><td>Cell 51:3</td><td>Cell 51:4</td><td>Cell 51:5</td><td>Cell 51:6</td><td>Cell 51:7</td><td>Cell 51:8</td><td>Cell 51:9</td><td>Cell 51:10</td><td>Cell 51:11</td><td>Cell 51:12</td><td>Cell 51:13</td><td>Cell 51:14</td><td>Cell 51:15</td></tr>
<tr><td>52</td><td>Cell 52:2</td><td>Cell 52:3</td><td>Cell 52:4</td><td>Cell 52:5</td><td>Cell 52:6</td><td>Cell 52:7</td><td>Cell 52:8</td><td>Cell 52:9</td><td>Cell 52:10</td><td>Cell 52:11</td><td>Cell 52:12</td><td>Cell 52:13</td><td>Cell 52:14</td><td>Cell 52:15</td></tr>
<tr><td>53</td><td>Cell 53:2</td><td>Cell 53:3</td><td>Cell 53:4</td><td>Cell 53:5</td><td>Cell 53:6</td><td>Cell 53:7</td><td>Cell 53:8</td><td>Cell 53:9</td><td>Cell 53:10</td><td>Cell 53:11</td><td>Cell 53:12</td><td>Cell 53:13</td><td>Cell 53:14</td><td>Cell 53:15</td></tr>
<tr><td>54</td><td>Cell 54:2</td><td>Cell 54:3</td><td>Cell 54:4</td><td>Cell 54:5</td><td>Cell 54:6</td><td>Cell 54:7</td><td>Cell 54:8</td><td>Cell 54:9</td><td>Cell 54:10</td><td>Cell 54:11</td><td>Cell 54:12</td><td>Cell 54:13</td><td>Cell 54:14</td><td>Cell 54:15</td></tr>
<tr><td>55</td><td>Cell 55:2</td><td>Cell 55:3</td><td>Cell 55:4</td><td>Cell 55:5</td><td>Cell 55:6</td><td>Cell 55:7</td><td>Cell 55:8</td><td>Cell 55:9</td><td>Cell 55:10</td><td>Cell 55:11</td><td>Cell 55:12</td><td>Cell 55:13</td><td>Cell 55:14</td><td>Cell 55:15</td></tr>
<tr><td>56</td><td>Cell 56:2</td><td>Cell 56:3</td><td>Cell 56:4</td><td>Cell 56:5</td><td>Cell 56:6</td><td>Cell 56:7</td><td>Cell 56:8</td><td>Cell 56:9</td><td>Cell 56:10</td><td>Cell 56:11</td><td>Cell 56:12</td><td>Cell 56:13</td><td>Cell 56:14</td><td>Cell 56:15</td></tr>
<tr><td>57</td><td>Cell 57:2</td><td>Cell 57:3</td><td>Cell 57:4</td><td>Cell 57:5</td><td>Cell 57:6</td><td>Cell 57:7</td><td>Cell 57:8</td><td>Cell 57:9</td><td>Cell 57:10</td><td>Cell 57:11</td><td>Cell 57:12</td><td>Cell 57:13</td><td>Cell 57:14</td><td>Cell 57:15</td></tr>
<tr><td>58</td><td>Cell 58:2</td><td>Cell 58:3</td><td>Cell 58:4</td><td>Cell 58:5</td><td>Cell 58:6</td><td>Cell 58:7</td><td>Cell 58:8</td><td>Cell 58:9</td><td>Cell 58:10</td><td>Cell 58:11</td><td>Cell 58:12</td><td>Cell 58:13</td><td>Cell 58:14</td><td>Cell 58:15</td></tr>
<tr><td>59</td><td>Cell 59:2</td><td>Cell 59:3</td><td>Cell 59:4</td><td>Cell 59:5</td><td>Cell 59:6</td><td>Cell 59:7</td><td>Cell 59:8</td><td>Cell 59:9</td><td>Cell 59:10</td><td>Cell 59:11</td><td>Cell 59:12</td><td>Cell 59:13</td><td>Cell 59:14</td><td>Cell 59:15</td></tr>
<tr><td>60</td><td>Cell 60:2</td><td>Cell 60:3</td><td>Cell 60:4</td><td>Cell 60:5</td><td>Cell 60:6</td><td>Cell 60:7</td><td>Cell 60:8</td><td>Cell 60:9</td><td>Cell 60:10</td><td>Cell 60:11</td><td>Cell 60:12</td><td>Cell 60:13</td><td>Cell 60:14</td><td>Cell 60:15</td></tr>
<tr><td>61</td><td>Cell 61:2</td><td>Cell 61:3</td><td>Cell 61:4</td><td>Cell 61:5</td><td>Cell 61:6</td><td>Cell 61:7</td><td>Cell 61:8</td><td>Cell 61:9</td><td>Cell 61:10</td><td>Cell 61:11</td><td>Cell 61:12</td><td>Cell 61:13</td><td>Cell 61:14</td><td>Cell 61:15</td></tr>
<tr><td>62</td><td>Cell 62:2</td><td>Cell 62:3</td><td>Cell 62:4</td><td>Cell 62:5</td><td>Cell 62:6</td><td>Cell 62:7</td><td>Cell 62:8</td><td>Cell 62:9</td><td>Cell 62:10</td><td>Cell 62:11</td><td>Cell 62:12</td><td>Cell 62:13</td><td>Cell 62:14</td><td>Cell 62:15</td></tr>
<tr><td>63</td><td>Cell 63:2</td><td>Cell 63:3</td><td>Cell 63:4</td><td>Cell 63:5</td><td>Cell 63:6</td><td>Cell 63:7</td><td>Cell 63:8</td><td>Cell 63:9</td><td>Cell 63:10</td><td>Cell 63:11</td><td>Cell 63:12</td><td>Cell 63:13</td><td>Cell 63:14</td><td>Cell 63:15</td></tr>
<tr><td>64</td><td>Cell 64:2</td><td>Cell 64:3</td><td>Cell 64:4</td><td>Cell 64:5</td><td>Cell 64:6</td><td>Cell 64:7</td><td>Cell 64:8</td><td>Cell 64:9</td><td>Cell 64:10</td><td>Cell 64:11</td><td>Cell 64:12</td><td>Cell 64:13</td><td>Cell 64:14</td><td>Cell 64:15</td></tr>
<tr><td>65</td><td>Cell 65:2</td><td>Cell 65:3</td><td>Cell 65:4</td><td>Cell 65:5</td><td>Cell 65:6</td><td>Cell 65:7</td><td>Cell 65:8</td><td>Cell 65:9</td><td>Cell 65:10</td><td>Cell 65:11</td><td>Cell 65:12</td><td>Cell 65:13</td><td>Cell 65:14</td><td>Cell 65:15</td></tr>
<tr><td>66</td><td>Cell 66:2</td><td>Cell 66:3</td><td>Cell 66:4</td><td>Cell 66:5</td><td>Cell 66:6</td><td>Cell 66:7</td><td>Cell 66:8</td><td>Cell 66:9</td><td>Cell 66:10</td><td>Cell 66:11</td><td>Cell 66:12</td><td>Cell 66:13</td><td>Cell 66:14</td><td>Cell 66:15</td></tr>
<tr><td>67</td><td>Cell 67:2</td><td>Cell 67:3</td><td>Cell 67:4</td><td>Cell 67:5</td><td>Cell 67:6</td><td>Cell 67:7</td><td>Cell 67:8</td><td>Cell 67:9</td><td>Cell 67:10</td><td>Cell 67:11</td><td>Cell 67:12</td><td>Cell 67:13</td><td>Cell 67:14</td><td>Cell 67:15</td></tr>
<tr><td>68</td><td>Cell 68:2</td><td>Cell 68:3</td><td>Cell 68:4</td><td>Cell 68:5</td><td>Cell 68:6</td><td>Cell 68:7</td><td>Cell 68:8</td><td>Cell 68:9</td><td>Cell 68:10</td><td>Cell 68:11</td><td>Cell 68:12</td><td>Cell 68:13</td><td>Cell 68:14</td><td>Cell 68:15</td></tr>
<tr><td>69</td><td>Cell 69:2</td><td>Cell 69:3</td><td>Cell 69:4</td><td>Cell 69:5</td><td>Cell 69:6</td><td>Cell 69:7</td><td>Cell 69:8</td><td>Cell 69:9</td><td>Cell 69:10</td><td>Cell 69:11</td><td>Cell 69:12</td><td>Cell 69:13</td><td>Cell 69:14</td><td>Cell 69:15</td></tr>
<tr><td>70</td><td>Cell 70:2</td><td>Cell 70:3</td><td>Cell 70:4</td><td>Cell 70:5</td><td>Cell 70:6</td><td>Cell 70:7</td><td>Cell 70:8</td><td>Cell 70:9</td><td>Cell 70:10</td><td>Cell 70:11</td><td>Cell 70:12</td><td>Cell 70:13</td><td>Cell 70:14</td><td>Cell 70:15</td></tr>
<tr><td>71</td><td>Cell 71:2</td><td>Cell 71:3</td><td>Cell 71:4</td><td>Cell 71:5</td><td>Cell 71:6</td><td>Cell 71:7</td><td>Cell 71:8</td><td>Cell 71:9</td><td>Cell 71:10</td><td>Cell 71:11</td><td>Cell 71:12</td><td>Cell 71:13</td><td>Cell 71:14</td><td>Cell 71:15</td></tr>
<tr><td>72</td><td>Cell 72:2</td><td>Cell 72:3</td><td>Cell 72:4</td><td>Cell 72:5</td><td>Cell 72:6</td><td>Cell 72:7</td><td>Cell 72:8</td><td>Cell 72:9</td><td>Cell 72:10</td><td>Cell 72:11</td><td>Cell 72:12</td><td>Cell 72:13</td><td>Cell 72:14</td><td>Cell 72:15</td></tr>
<tr><td>73</td><td>Cell 73:2</td><td>Cell 73:3</td><td>Cell 73:4</td><td>Cell 73:5</td><td>Cell 73:6</td><td>Cell 73:7</td><td>Cell 73:8</td><td>Cell 73:9</td><td>Cell 73:10</td><td>Cell 73:11</td><td>Cell 73:12</td><td>Cell 73:13</td><td>Cell 73:14</td><td>Cell 73:15</td></tr>
<tr><td>74</td><td>Cell 74:2</td><td>Cell 74:3</td><td>Cell 74:4</td><td>Cell 74:5</td><td>Cell 74:6</td><td>Cell 74:7</td><td>Cell 74:8</td><td>Cell 74:9</td><td>Cell 74:10</td><td>Cell 74:11</td><td>Cell 74:12</td><td>Cell 74:13</td><td>Cell 74:14</td><td>Cell 74:15</td></tr>
<tr><td>75</td><td>Cell 75:2</td><td>Cell 75:3</td><td>Cell 75:4</td><td>Cell 75:5</td><td>Cell 75:6</td><td>Cell 75:7</td><td>Cell 75:8</td><td>Cell 75:9</td><td>Cell 75:10</td><td>Cell 75:11</td><td>Cell 75:12</td><td>Cell 75:13</td><td>Cell 75:14</td><td>Cell 75:15</td></tr>
<tr><td>76</td><td>Cell 76:2</td><td>Cell 76:3</td><td>Cell 76:4</td><td>Cell 76:5</td><td>Cell 76:6</td><td>Cell 76:7</td><td>Cell 76:8</td><td>Cell 76:9</td><td>Cell 76:10</td><td>Cell 76:11</td><td>Cell 76:12</td><td>Cell 76:13</td><td>Cell 76:14</td><td>Cell 76:15</td></tr>
<tr><td>77</td><td>Cell 77:2</td><td>Cell 77:3</td><td>Cell 77:4</td><td>Cell 77:5</td><td>Cell 77:6</td><td>Cell 77:7</td><td>Cell 77:8</td><td>Cell 77:9</td><td>Cell 77:10</td><td>Cell 77:11</td><td>Cell 77:12</td><td>Cell 77:13</td><td>Cell 77:14</td><td>Cell 77:15</td></tr>
<tr><td>78</td><td>Cell 78:2</td><td>Cell 78:3</td><td>Cell 78:4</td><td>Cell 78:5</td><td>Cell 78:6</td><td>Cell 78:7</td><td>Cell 78:8</td><td>Cell 78:9</td><td>Cell 78:10</td><td>Cell 78:11</td><td>Cell 78:12</td><td>Cell 78:13</td><td>Cell 78:14</td><td>Cell 78:15</td></tr>
<tr><td>79</td><td>Cell 79:2</td><td>Cell 79:3</td><td>Cell 79:4</td><td>Cell 79:5</td><td>Cell 79:6</td><td>Cell 79:7</td><td>Cell 79:8</td><td>Cell 79:9</td><td>Cell 79:10</td><td>Cell 79:11</td><td>Cell 79:12</td><td>Cell 79:13</td><td>Cell 79:14</td><td>Cell 79:15</td></tr>
<tr><td>80</td><td>Cell 80:2</td><td>Cell 80:3</td><td>Cell 80:4</td><td>Cell 80:5</td><td>Cell 80:6</td><td>Cell 80:7</td><td>Cell 80:8</td><td>Cell 80:9</td><td>Cell 80:10</td><td>Cell 80:11</td><td>Cell 80:12</td><td>Cell 80:13</td><td>Cell 80:14</td><td>Cell 80:15</td></tr>
<tr><td>81</td><td>Cell 81:2</td><td>Cell 81:3</td><td>Cell 81:4</td><td>Cell 81:5</td><td>Cell 81:6</td><td>Cell 81:7</td><td>Cell 81:8</td><td>Cell 81:9</td><td>Cell 81:10</td><td>Cell 81:11</td><td>Cell 81:12</td><td>Cell 81:13</td><td>Cell 81:14</td><td>Cell 81:15</td></tr>
<tr><td>82</td><td>Cell 82:2</td><td>Cell 82:3</td><td>Cell 82:4</td><td>Cell 82:5</td><td>Cell 82:6</td><td>Cell 82:7</td><td>Cell 82:8</td><td>Cell 82:9</td><td>Cell 82:10</td><td>Cell 82:11</td><td>Cell 82:12</td><td>Cell 82:13</td><td>Cell 82:14</td><td>Cell 82:15</td></tr>
<tr><td>83</td><td>Cell 83:2</td><td>Cell 83:3</td><td>Cell 83:4</td><td>Cell 83:5</td><td>Cell 83:6</td><td>Cell 83:7</td><td>Cell 83:8</td><td>Cell 83:9</td><td>Cell 83:10</td><td>Cell 83:11</td><td>Cell 83:12</td><td>Cell 83:13</td><td>Cell 83:14</td><td>Cell 83:15</td></tr>
<tr><td>84</td><td>Cell 84:2</td><td>Cell 84:3</td><td>Cell 84:4</td><td>Cell 84:5</td><td>Cell 84:6</td><td>Cell 84:7</td><td>Cell 84:8</td><td>Cell 84:9</td><td>Cell 84:10</td><td>Cell 84:11</td><td>Cell 84:12</td><td>Cell 84:13</td><td>Cell 84:14</td><td>Cell 84:15</td></tr>
<tr><td>85</td><td>Cell 85:2</td><td>Cell 85:3</td><td>Cell 85:4</td><td>Cell 85:5</td><td>Cell 85:6</td><td>Cell 85:7</td><td>Cell 85:8</td><td>Cell 85:9</td><td>Cell 85:10</td><td>Cell 85:11</td><td>Cell 85:12</td><td>Cell 85:13</td><td>Cell 85:14</td><td>Cell 85:15</td></tr>
<tr><td>86</td><td>Cell 86:2</td><td>Cell 86:3</td><td>Cell 86:4</td><td>Cell 86:5</td><td>Cell 86:6</td><td>Cell 86:7</td><td>Cell 86:8</td><td>Cell 86:9</td><td>Cell 86:10</td><td>Cell 86:11</td><td>Cell 86:12</td><td>Cell 86:13</td><td>Cell 86:14</td><td>Cell 86:15</td></tr>
<tr><td>87</td><td>Cell 87:2</td><td>Cell 87:3</td><td>Cell 87:4</td><td>Cell 87:5</td><td>Cell 87:6</td><td>Cell 87:7</td><td>Cell 87:8</td><td>Cell 87:9</td><td>Cell 87:10</td><td>Cell 87:11</td><td>Cell 87:12</td><td>Cell 87:13</td><td>Cell 87:14</td><td>Cell 87:15</td></tr>
<tr><td>88</td><td>Cell 88:2</td><td>Cell 88:3</td><td>Cell 88:4</td><td>Cell 88:5</td><td>Cell 88:6</td><td>Cell 88:7</td><td>Cell 88:8</td><td>Cell 88:9</td><td>Cell 88:10</td><td>Cell 88:11</td><td>Cell 88:12</td><td>Cell 88:13</td><td>Cell 88:14</td><td>Cell 88:15</td></tr>
<tr><td>89</td><td>Cell 89:2</td><td>Cell 89:3</td><td>Cell 89:4</td><td>Cell 89:5</td><td>Cell 89:6</td><td>Cell 89:7</td><td>Cell 89:8</td><td>Cell 89:9</td><td>Cell 89:10</td><td>Cell 89:11</td><td>Cell 89:12</td><td>Cell 89:13</td><td>Cell 89:14</td><td>Cell 89:15</td></tr>
<tr><td>90</td><td>Cell 90:2</td><td>Cell 90:3</td><td>Cell 90:4</td><td>Cell 90:5</td><td>Cell 90:6</td><td>Cell 90:7</td><td>Cell 90:8</td><td>Cell 90:9</td><td>Cell 90:10</td><td>Cell 90:11</td><td>Cell 90:12</td><td>Cell 90:13</td><td>Cell 90:14</td><td>Cell 90:15</td></tr>
<tr><td>91</td><td>Cell 91:2</td><td>Cell 91:3</td><td>Cell 91:4</td><td>Cell 91:5</td><td>Cell 91:6</td><td>Cell 91:7</td><td>Cell 91:8</td><td>Cell 91:9</td><td>Cell 91:10</td><td>Cell 91:11</td><td>Cell 91:12</td><td>Cell 91:13</td><td>Cell 91:14</td><td>Cell 91:15</td></tr>
<tr><td>92</td><td>Cell 92:2</td><td>Cell 92:3</td><td>Cell 92:4</td><td>Cell 92:5</td><td>Cell 92:6</td><td>Cell 92:7</td><td>Cell 92:8</td><td>Cell 92:9</td><td>Cell 92:10</td><td>Cell 92:11</td><td>Cell 92:12</td><td>Cell 92:13</td><td>Cell 92:14</td><td>Cell 92:15</td></tr>
<tr><td>93</td><td>Cell 93:2</td><td>Cell 93:3</td><td>Cell 93:4</td><td>Cell 93:5</td><td>Cell 93:6</td><td>Cell 93:7</td><td>Cell 93:8</td><td>Cell 93:9</td><td>Cell 93:10</td><td>Cell 93:11</td><td>Cell 93:12</td><td>Cell 93:13</td><td>Cell 93:14</td><td>Cell 93:15</td></tr>
<tr><td>94</td><td>Cell 94:2</td><td>Cell 94:3</td><td>Cell 94:4</td><td>Cell 94:5</td><td>Cell 94:6</td><td>Cell 94:7</td><td>Cell 94:8</td><td>Cell 94:9</td><td>Cell 94:10</td><td>Cell 94:11</td><td>Cell 94:12</td><td>Cell 94:13</td><td>Cell 94:14</td><td>Cell 94:15</td></tr>
<tr><td>95</td><td>Cell 95:2</td><td>Cell 95:3</td><td>Cell 95:4</td><td>Cell 95:5</td><td>Cell 95:6</td><td>Cell 95:7</td><td>Cell 95:8</td><td>Cell 95:9</td><td>Cell 95:10</td><td>Cell 95:11</td><td>Cell 95:12</td><td>Cell 95:13</td><td>Cell 95:14</td><td>Cell 95:15</td></tr>
<tr><td>96</td><td>Cell 96:2</td><td>Cell 96:3</td><td>Cell 96:4</td><td>Cell 96:5</td><td>Cell 96:6</td><td>Cell 96:7</td><td>Cell 96:8</td><td>Cell 96:9</td><td>Cell 96:10</td><td>Cell 96:11</td><td>Cell 96:12</td><td>Cell 96:13</td><td>Cell 96:14</td><td>Cell 96:15</td></tr>
<tr><td>97</td><td>Cell 97:2</td><td>Cell 97:3</td><td>Cell 97:4</td><td>Cell 97:5</td><td>Cell 97:6</td><td>Cell 97:7</td><td>Cell 97:8</td><td>Cell 97:9</td><td>Cell 97:10</td><td>Cell 97:11</td><td>Cell 97:12</td><td>Cell 97:13</td><td>Cell 97:14</td><td>Cell 97:15</td></tr>
<tr><td>98</td><td>Cell 98:2</td><td>Cell 98:3</td><td>Cell 98:4</td><td>Cell 98:5</td><td>Cell 98:6</td><td>Cell 98:7</td><td>Cell 98:8</td><td>Cell 98:9</td><td>Cell 98:10</td><td>Cell 98:11</td><td>Cell 98:12</td><td>Cell 98:13</td><td>Cell 98:14</td><td>Cell 98:15</td></tr>
<tr><td>99</td><td>Cell 99:2</td><td>Cell 99:3</td><td>Cell 99:4</td><td>Cell 99:5</td><td>Cell 99:6</td><td>Cell 99:7</td><td>Cell 99:8</td><td>Cell 99:9</td><td>Cell 99:10</td><td>Cell 99:11</td><td>Cell 99:12</td><td>Cell 99:13</td><td>Cell 99:14</td><td>Cell 99:15</td></tr>
<tr><td>100</td><td>Cell 100:2</td><td>Cell 100:3</td><td>Cell 100:4</td><td>Cell 100:5</td><td>Cell 100:6</td><td>Cell 100:7</td><td>Cell 100:8</td><td>Cell 100:9</td><td>Cell 100:10</td><td>Cell 100:11</td><td>Cell 100:12</td><td>Cell 100:13</td><td>Cell 100:14</td><td>Cell 100:15</td></tr>
</tbody></table>


<!--
<textarea id='ex1_debugmsgs' rows='5' cols='80' style='font-size:smaller;'></textarea>
-->

</body>
</html>
