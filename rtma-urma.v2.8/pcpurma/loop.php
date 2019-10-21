<html>
<head>
<title>pcpURMA</title>
<script language="javascript", src="js/animate.js"></script>
</head>
<body onLoad="launch()">
<center>
<h2><b>pcpURMA - Daily Loops</b></h2>
<br>
<TABLE ALIGN=CENTER BORDER=1 CELLPADDING=1 CELLSPACING=1>
  <TR>
    <FORM>
      <td>
        <FONT SIZE=-1 COLOR="#000000"><B>Loop Mode:</B></FONT><BR>
        <INPUT TYPE=BUTTON VALUE="Fwd" onClick="change_mode(1);fwd()">
        <INPUT TYPE=BUTTON VALUE="Swp" onClick="sweep()">
      </td>
      <td>
        <FONT SIZE=-1 COLOR="#000000"><B>Animation Mode:</B></FONT><BR>
        <INPUT TYPE=BUTTON VALUE="<<" onClick="change_mode(1);rev()">
        <INPUT TYPE=BUTTON VALUE="Stop" onClick="stop()">
        <INPUT TYPE=BUTTON VALUE=">>" onClick="change_mode(1);fwd()">
      </td>
      <td>
        <FONT SIZE=-1 COLOR="#000000"><B>Speed:</B></FONT><BR>
        <INPUT TYPE=BUTTON VALUE="Slow" onClick="change_speed(delay_step)">
        <INPUT TYPE=BUTTON VALUE="Fast" onClick="change_speed(-delay_step)">
      </td>
      <td>
        <FONT SIZE=-1 COLOR="#000000"><B>Advance:</B></FONT><BR>
        <INPUT TYPE=BUTTON VALUE=" < " onClick="decrementImage(--current_image)">
        <INPUT TYPE=BUTTON VALUE=" > " onClick="incrementImage(++current_image)">
      </td>
    </FORM>
      <td>
    <FORM METHOD="POST" NAME="control_form">
        <FONT SIZE=-1 COLOR="#000000">Frame No:</FONT>
        <INPUT TYPE="text" NAME="frame_nr" VALUE=9 SIZE="2" onFocus="this.select()"                                    onChange="go2image(this.value)"> 
    </FORM>
      </td>
  </TR>
  <TR>
    <a name="img" href="#img"></a>
    <IMG NAME="animation" BORDER=0 WIDTH=800 HIGHT=400 SRC="loop-images/1_pcpurma2.png" ONERROR="this.src='default-thumb.gif';" ALT="   " >
  </TR>
</TABLE>
<HR>
    <IMG SRC="loop-images/1_pcpurma2.png">
<P>
</center>
</body>
</html>
