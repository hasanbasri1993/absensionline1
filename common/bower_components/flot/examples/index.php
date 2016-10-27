<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<title>Flot Examples</title>
	<link href="examples.css" rel="stylesheet" type="text/css">
	<style>

	h3 {
		margin-top: 30px;
		margin-bottom: 5px;
	}

	</style>
	<script language="javascript" type="text/javascript" src="../jquery.js"></script>
	<script language="javascript" type="text/javascript" src="../jquery.flot.js"></script>
	<script type="text/javascript">

	$(function() {

		// Add the Flot version string to the footer

		$("#footer").prepend("Flot " + $.plot.version + " &ndash; ");
	});

	</script>
</head>
<body>

	<div id="header">
		<h2>Flot Examples</h2>
	</div>

	<div id="content">

		<p>Here are some examples for <a href="http://www.flotcharts.org">Flot</a>, the Javascript charting library for jQuery:</p>

		<h3>Basic Usage</h3>

		<ul>
			<li><a href="../../../../bower_components/flot/examples/basic-usage/index.html">Basic example</a></li>
			<li><a href="../../../../bower_components/flot/examples/series-types/index.html">Different graph types</a> and <a href="../../../../bower_components/flot/examples/categories/index.html">simple categories/textual data</a></li>
			<li><a href="../../../../bower_components/flot/examples/basic-options/index.html">Setting various options</a> and <a href="../../../../bower_components/flot/examples/annotating/index.html">annotating a chart</a></li>
			<li><a href="../../../../bower_components/flot/examples/ajax/index.html">Updating graphs with AJAX</a> and <a href="../../../../bower_components/flot/examples/realtime/index.html">real-time updates</a></li>
		</ul>

		<h3>Interactivity</h3>

		<ul>
			<li><a href="../../../../bower_components/flot/examples/series-toggle/index.html">Turning series on/off</a></li>
			<li><a href="../../../../bower_components/flot/examples/selection/index.html">Rectangular selection support and zooming</a> and <a href="../../../../bower_components/flot/examples/zooming/index.html">zooming with overview</a> (both with selection plugin)</li>
			<li><a href="../../../../bower_components/flot/examples/interacting/index.html">Interacting with the data points</a></li>
			<li><a href="../../../../bower_components/flot/examples/navigate/index.html">Panning and zooming</a> (with navigation plugin)</li>
			<li><a href="../../../../bower_components/flot/examples/resize/index.html">Automatically redraw when window is resized</a> (with resize plugin)</li>
		</ul>

		<h3>Additional Features</h3>

		<ul>
			<li><a href="../../../../bower_components/flot/examples/symbols/index.html">Using other symbols than circles for points</a> (with symbol plugin)</li>
			<li><a href="../../../../bower_components/flot/examples/axes-time/index.html">Plotting time series</a>, <a href="../../../../bower_components/flot/examples/visitors/index.html">visitors per day with zooming and weekends</a> (with selection plugin) and <a href="../../../../bower_components/flot/examples/axes-time-zones/index.html">time zone support</a></li>
			<li><a href="../../../../bower_components/flot/examples/axes-multiple/index.html">Multiple axes</a> and <a href="../../../../bower_components/flot/examples/axes-interacting/index.html">interacting with the axes</a></li>
			<li><a href="../../../../bower_components/flot/examples/threshold/index.html">Thresholding the data</a> (with threshold plugin)</li>
			<li><a href="../../../../bower_components/flot/examples/stacking/index.html">Stacked charts</a> (with stacking plugin)</li>
			<li><a href="../../../../bower_components/flot/examples/percentiles/index.html">Using filled areas to plot percentiles</a> (with fillbetween plugin)</li>
			<li><a href="../../../../bower_components/flot/examples/tracking/index.html">Tracking curves with crosshair</a> (with crosshair plugin)</li>
			<li><a href="../../../../bower_components/flot/examples/image/index.html">Plotting prerendered images</a> (with image plugin)</li>
			<li><a href="../../../../bower_components/flot/examples/series-errorbars/index.html">Plotting error bars</a> (with errorbars plugin)</li>
			<li><a href="../../../../bower_components/flot/examples/series-pie/index.html">Pie charts</a> (with pie plugin)</li>
			<li><a href="../../../../bower_components/flot/examples/canvas/index.html">Rendering text with canvas instead of HTML</a> (with canvas plugin)</li>
		</ul>

	</div>

	<div id="footer">
		Copyright &copy; 2007 - 2013 IOLA and Ole Laursen
	</div>

</body>
</html>
