
<h2>Internationalisation</h2>

<p>Localisation of the presentation layer is important for any software package, and I aim to make this normally arduous task as easy as possible in DataTables. To this end, a number of contributors have kindly translated the language strings used is DataTables into various different languages. If you translate DataTables into any other languages, please <a href="/contact">let me know</a> and I'll happily include the translation here.</p>

<ul>
	<li><a href="#how_to">How to use DataTables internalisation options</a></li>
	<li><a href="#functions">Translations</a></li>
</ul>


<a name="how_to"></a>
<h3>How to use DataTables internalisation options</h3>

<p>There are two methods by which you can include internalisation options in DataTables - loading the language file through an Ajax request, or at initialisation time using the <a href="/usage/i18n">oLanguage</a> property. The following example shows how to include the <a href="#German">German translation</a> as an Ajax file (<a href="/examples/advanced_init/language_file.html">live example</a> - a <a href="/examples/basic_init/language.html">live example</a> for oLanguage control is also available):</p>

<pre class="brush: html">&lt;script type="text/javascript" src="jquery.dataTables.js"&gt;&lt;/script&gt;
&lt;script type="text/javascript"&gt;
	$(document).ready(function() {
		$('#example').dataTable( {
			"oLanguage": {
				"sUrl": "dataTables.german.txt"
			}
		} );
	} );
&lt;/script&gt;
</pre>	
				
				
<a name="functions"></a>
<h3>Translations</h3>

include(`build.1.inc')
