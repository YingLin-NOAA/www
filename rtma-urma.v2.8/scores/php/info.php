<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">

<head>
<meta http-equiv="content-type" content="text/html; charset=utf-8" />
<title>Home</title>
<link href="http://fonts.googleapis.com/css?family=Source+Sans+Pro:200,300,400,600,700,900" rel="stylesheet" />
<link href="main.css" rel="stylesheet" type="text/css" media="all" />
<link href="fonts.css" rel="stylesheet" type="text/css" media="all" />
<script src="https://d3js.org/d3.v4.min.js"></script>
</head>

<?php
$randomtoken = base64_encode( openssl_random_pseudo_bytes(32));
$_SESSION['csrfToken']=$randomtoken;
?>

<body>
<u>All Images:</u>
<br>
The <font style="font-weight: bold" color="red">red line</font> represents v2.8 parallel runs (pcpRTMA2p8 or pcpURMA2p8).<br>
  The <font style="font-weight: bold" color="steelblue">blue line</font> represents current production (pcpRTMA or pcpURMA).
<P>
Analyses are validated against QC'd daily gauge observations.
<P>
<u>Starting time of validation periods</u><br>
Validation for pcpRTMA2p8 began on 1 Aug 2019. <br>
Validation for pcpURMA2p8 began on 14 Sep 2019. <br>
<P>
<u>RMSE:</u><br>
Root mean square error.
<P>
<u>ETS:</u><br>
Equitable threat score.  Higher is better. 
<P>
<u>Bias:</u>
Ratio of analysis events against observed (gauge) eventgs over a given threshold (e.g. >=5mm/day).  Bias=1 is perfect. 
</body>
</html>
