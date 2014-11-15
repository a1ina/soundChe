<?php defined('_JEXEC') or die('Restricted access'); // no direct access ?>

<style>
.ajaxsearch .inputbox {
	width: <?php echo $width_input?>px;
}

#suggestions{ 
	width: <?php echo $width_suggestions?>px;
}

#searchresults li.advanced_search a { 
	background-position: <?php echo ($width_suggestions-20) ?>px center;
}

#loading{
    left: <?php echo ($width_input+2)?>px;
}

#loading-not{
    left: <?php echo ($width_input+2)?>px;
}

</style>

<script type="text/javascript" language="javascript">

window.addEvent('domready', function() {
  Element.implement({
    fancyShow: function() {
      this.fade('in');
    },
    fancyHide: function() {
      this.fade('out');
    }
  });
});

var delayTimer;
function doSearch(inputString) {
	
	$('loading-not').fancyShow();

	if(inputString.length>2){
		document.getElementById('loading-not').style.visibility = "hidden";
		document.getElementById('loading').style.display = "block";
	
		clearTimeout(delayTimer);
		delayTimer = setTimeout(function() {
			lookup(inputString);
		}, <?php echo (int) $delay_timer; ?>); // Will do the ajax stuff after 1000 ms, or 1 s
	}else{
		$('suggestions').fancyHide();
	}
}

function lookup(value){
	
	var data = "";
	var curtime = new Date();
	var url = "<?php echo JURI::root(); ?>";
	url = url + "index.php?option=com_search&view=search&layout=ajaxsearch&searchphrase=<?php echo $searchphrase; ?>&ordering=<?php echo $ordering; ?>&limit=<?php echo $limit; ?>&searchword="+value+"&tmpl=component";
	url = url + '&r=' + curtime.getTime();
	var myAjax = new Request({
		method: "get", 
		data: data,
		url: url,
		onComplete: addSuggestions 
	}).send();
	
}

function addSuggestions(response){

	document.getElementById('suggestions_tmp').innerHTML = response;
	document.getElementById('suggestions').innerHTML = document.getElementById('tmp_ajax_results').innerHTML;
	
	document.getElementById('loading-not').style.visibility = "visible";
	document.getElementById('loading').style.display = "none";
	$('suggestions').fancyShow();
}
</script>

<form class="ajaxsearch">

	<input type="text" size="30" id="inputString" class="inputbox" onkeyup="doSearch(this.value);" autocomplete="off" value="<?php echo $text ?>" onblur="if (this.value=='') {this.value='<?php echo $text ?>'}" onfocus="if (this.value=='<?php echo $text ?>') {this.value=''}" />
    <div id="loading" style="display: none;"></div>
    <input id="loading-not" value="" type="reset" onclick="$('suggestions').fancyHide();$('loading-not').fancyHide();"/>
	<div id="suggestions_tmp"></div>
    <div id="suggestions"></div>
    
    <input type="hidden" name="searchphrase" value=""/>
	<input type="hidden" name="limit" id="search_limit" value="<?php echo $limit; ?>" />
	<input type="hidden" name="ordering" value="<?php echo $ordering; ?>" />
	<input type="hidden" name="view" value="search" />
	<input type="hidden" name="Itemid" value="99999999" />
	<input type="hidden" name="option" value="com_search" />
</form>



