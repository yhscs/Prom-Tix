<?php
	if (isset($_COOKIE['promPass']))
	{
		if ($_COOKIE['promPass'] !== 'HASHED_PASS_HERE')
		{
			$content = "<!DOCTYPE html>\n<body>\n<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>\n<script>window.jQuery || document.write('<script src=\"js/vendor/jquery-1.9.0.min.js\"><\/script>')</script>\n<script>function log(){var pass=document.getElementById('pass').value;$.post('index.php',{promPass: pass},function(data){if (data.indexOf('Yorkville') == -1) alert(data);location.reload();});}</script>\n<label>Password </label><input id='pass' type='password' size='14'>\n<br><button type='button' onclick='javascript:log();'>Enter Prom Ticket Site</button></body>\n</html>";
			exit($content);	
		}
	}
	else if (isset($_POST['promPass']))
	{
		if (sha1($_POST['promPass']) !== 'HASHED_PASS_HERE')
			exit('You cannot access the prom ticket site without the correct password. Please talk to one of the prom coordinators for access.');
		else
		{
			setcookie('promPass',sha1($_POST['promPass']), mktime().time()+60*30);
			header("Refresh:0");
		}
	}
	else
	{
		$content = "<!DOCTYPE html>\n<body>\n<script src='//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js'></script>\n<script>window.jQuery || document.write('<script src=\"js/vendor/jquery-1.9.0.min.js\"><\/script>')</script>\n<script>function log(){var pass=document.getElementById('pass').value;$.post('index.php',{promPass: pass},function(data){if (data.indexOf('Yorkville') == -1) alert(data);location.reload();});}</script>\n<label>Password </label><input id='pass' type='password' size='14'>\n<br><button type='button' onclick='javascript:log();'>Enter Prom Ticket Site</button></body>\n</html>";
		exit($content);
	}
		
?>
<!DOCTYPE html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7"> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8"> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js"> <!--<![endif]-->
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
        <title>Yorkville Prom Tickets</title>
        <meta name="description" content="">
        <meta name="viewport" content="width=device-width">

        <link rel="stylesheet" href="css/normalize.css">
        <link rel="stylesheet" href="css/main.css">
        <link href="css/structure.css" rel="stylesheet">
		<link href="css/form.css" rel="stylesheet">
    </head>
    <body>
        <!--[if lt IE 7]>
            <p class="chromeframe">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> or <a href="http://www.google.com/chromeframe/?redirect=true">activate Google Chrome Frame</a> to improve your experience.</p>
        <![endif]-->
        
    <form id="frmProm" name="frmProm" class="wufoo topLabel page" autocomplete="off" enctype="multipart/form-data" method="post" novalidate action="javascript:void(0);">
        
            <header id="header" class="info">
                <h1>Yorkville High School Prom</h1>
                <div>All YHS students must purchase their tickets individually<br>ID is required at prom<br>No refunds</div>
            </header>
            
            <ul>
                <li id="foli7" class="notranslate first section">
                    <section><h2>Student/Payment Information</h2></section>
                </li>
                
                <li id="foli1" class="notranslate">
                <label class="desc" id="title1" for="Field1">Student Name (Legal Name)<span id="req_1" class="req">*</span></label>
            <span>
            <input id="Field1" name="Field1" type="text" class="field text fn" value="" size="8" tabindex="1" required>
            <label for="Field1">First</label>
            </span>
            <span>
            <input id="Field2" name="Field2" type="text" class="field text ln" value="" size="14" tabindex="2" required>
            <label for="Field2">Last</label>
            </span>
            </li>
            <li id="foli5" class="notranslate">
            <label class="desc" id="title5" for="Field5">
            Student ID
            <span id="req_6" class="req">*</span>
            </label>
            <div>
            <input id="Field5" name="Field5" type="text" class="field text small" value="" maxlength="7" tabindex="3" onKeyUp="validateRange(5, 'character');" required>
            <label for="Field5">Maximum Allowed: <var id="rangeMaxMsg5">7</var> numbers.&nbsp;&nbsp;&nbsp; <em class="currently">Currently Used: <var id="rangeUsedMsg5">0</var> numbers.</em></label>
            </div>
            </li>
            <li id="foli99" class="notranslate">
            <label class="desc" id="title99" for="Field99">
            Ticket Number
            <span id="req_5" class="req">*</span>
            </label>
            <div>
            <input id="Field99" name="Field99" type="text" class="field text small" value="" maxlength="7" tabindex="4" required>
            </div>
            </li>
            <li id="foli21" class="notranslate  notStacked">
            <fieldset>
            <![if !IE | (gte IE 8)]>
            <legend id="title21" class="desc">
            Student T-Shirt Size
            </legend>
            <![endif]>
            <!--[if lt IE 8]>
            <label id="title21" class="desc">
            Student T-Shirt Size
            </label>
            <![endif]-->
            <div>
            <input id="radioDefault_21" name="Field21" type="hidden" value="">
            <span>
            <input id="Field21_5" name="Field21" type="radio" class="field radio" value="xs" tabindex="15">
            <label class="choice" for="Field21_5" >
            Extra Small</label>
            </span>
            <span>
            <input id="Field21_0" name="Field21" type="radio" class="field radio" value="s" tabindex="16" checked="checked">
            <label class="choice" for="Field21_0" >
            Small</label>
            </span>
            <span>
            <input id="Field21_1" name="Field21" type="radio" class="field radio" value="m" tabindex="17">
            <label class="choice" for="Field21_1" >
            Medium</label>
            </span>
            <span>
            <input id="Field21_2" name="Field21" type="radio" class="field radio" value="l" tabindex="18">
            <label class="choice" for="Field21_2" >
            Large</label>
            </span>
            <span>
            <input id="Field21_3" name="Field21" type="radio" class="field radio" value="xl" tabindex="19">
            <label class="choice" for="Field21_3" >
            Extra Large</label>
            </span>
            <span>
            <input id="Field21_4" name="Field21" type="radio" class="field radio" value="xxl" tabindex="20">
            <label class="choice" for="Field21_4" >
            XXL</label>
            </span>
            </div>
            </fieldset>
            </li>
            <li id="foli3" class="notranslate">
            <label class="desc" id="title3" for="Field3">
            Name of Person Paying
            </label>
            <span>
            <input id="Field3" name="Field3" type="text" class="field text fn" value="" size="8" tabindex="8">
            <label for="Field3">First</label>
            </span>
            <span>
            <input id="Field4" name="Field4" type="text" class="field text ln" value="" size="14" tabindex="9">
            <label for="Field4">Last</label>
            </span>
            </li>
            <li id="foli9" class="notranslate  notStacked">
            <fieldset>
            <![if !IE | (gte IE 8)]>
            <legend id="title9" class="desc">
            Method of Payment
            <span id="req_9" class="req">*</span>
            </legend>
            <![endif]>
            <!--[if lt IE 8]>
            <label id="title9" class="desc">
            Method of Payment
            <span id="req_9" class="req">*</span>
            </label>
            <![endif]-->
            <div>
            <input id="radioDefault_9" name="Field9" type="hidden" value="">
            <span>
            <input id="Field9_0" name="Field9" type="radio" class="field radio" value="Cash" tabindex="10" checked="checked"  
            required>
            <label class="choice" for="Field9_0" >
            Cash</label>
            </span>
            <span>
            <input id="Field9_1" name="Field9" type="radio" class="field radio" value="Check" tabindex="11" required>
            <label class="choice" for="Field9_1" >
            Check</label>
            </span>
            <span>
            <input id="Field9_2" name="Field9" type="radio" class="field radio" value="Credit" tabindex="12" required>
            <label class="choice" for="Field9_2" >
            Credit</label>
            </span>
            </div>
            </fieldset>
            </li>
            <li id="foli10" class="notranslate  notStacked">
            <fieldset onChange="javascript:guestFirst();">
            <![if !IE | (gte IE 8)]>
            <legend id="title10" class="desc">
            Are you taking a guest?
            <span id="req_10" class="req">*</span>
            </legend>
            <![endif]>
            <!--[if lt IE 8]>
            <label id="title10" class="desc">
           Are you taking a guest?
            <span id="req_10" class="req">*</span>
            </label>
            <![endif]-->
            <div>
            <input id="radioDefault_90" name="Field90" type="hidden" value="">
            <span>
            <input id="Field90_1" name="Field90" type="radio" class="field radio" value="Guest" tabindex="11" required>
            <label class="choice" for="Field90_1" >
            Yes</label>
            </span>
            <span>
            <input id="Field90_2" name="Field90" type="radio" class="field radio" value="None" tabindex="13"  
            required>
            <label class="choice" for="Field90_2" >
            No</label>
            </span>
            </div>
            </fieldset>
            
            
            </li>
            </li>
            
            
            
            <li class="hide">
            <label for="comment">Do Not Fill This Out</label>
            <textarea name="comment" id="comment" rows="1" cols="1"></textarea>
            <input type="hidden" id="idstamp" name="idstamp" value="Xe4Qnl0LloaRMZO72hFuES7+ZxzFy5isGE/TIPzEA40=">
            </li>
            </ul>
        </form>

		<div id="layout">
        	<?php
				include('php/loadTables.php');
		  	?>
        </div>
        
        
        <div id="guestInfo"><form><ul></ul></form></div>
        <div id="bigTable"></div>
        <div id="receipt"></div>

    	<script src="//ajax.googleapis.com/ajax/libs/jquery/1.9.0/jquery.min.js"></script>
        <script>window.jQuery || document.write('<script src="js/vendor/jquery-1.9.0.min.js"><\/script>')</script>
        <script src="js/plugins.js"></script>
        <script src="js/main.js"></script>
        <script src="js/vendor/wufoo.js"></script>
    </body>
</html>
