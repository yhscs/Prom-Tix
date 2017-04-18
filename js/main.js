$('#adminCheck').click(function(){adminCheck('table');});
$('#adminList').click(function(){adminCheck('list');});
$('#adminShirts').click(function(){adminCheck('shirts');});
$('.table').click(function(){bigTable($(this));});

var receipt = '';
var activeScreen = '';
var guest = false;
var myChair = 0;
var guestChoose = false;

function guestFirst()
{
	var first = $("[name='Field90']:checked").val();
	if (first == 'Guest')
	{
		var info = ' <fieldset onChange="javascript:guestInfo();" type="hidden"><![if !IE | (gte IE 8)]><legend id="title11" class="desc">Is your guest a current student at Yorkville High School?<span id="req_11" class="req">*</span></legend><![endif]><!--[if lt IE 8]><label id="title11" class="desc">Is your guest a current student at Yorkville High School?<span id="req_11" class="req">*</span></label><![endif]--><div><input id="radioDefault_99" name="Field99" type="hidden" value=""><span><input id="Field99_1" name="Field99" type="radio" class="field radio" value="Guest" tabindex="11" required><label class="choice" for="Field99_1" >Yes</label></span><span><input id="Field99_0" name="Field99" type="radio" class="field radio" value="Non-YHS" tabindex="12"  required><label class="choice" for="Field99_0" >No</label></span></div></fieldset>';
		$('html, body').animate({scrollTop:$(document).height()}, 'slow');
		$('#guestInfo form ul').html(info);
	}
	else
	{
		$('html, body').animate({scrollTop:$(document).height()}, 'slow');
		$('#guestInfo form ul').html('<li class="buttons "><div><div id="saveForm" class="btTxt submit button">Choose Seat</div></div>');	
		$('#saveForm').click(function(){validate();});
		guestChoose = false;
	}
}

function guestInfo()
{
	var info = '<li id="foli8" class="notranslate section"><section><h2 id="title8">Guest Information</h2></section></li><li id="foli16" class="notranslate"><label class="desc" id="title16" for="Field16">Guest Name (Legal Name)</label><span><input id="Field16" name="Field16" type="text" class="field text fn" value="" size="8" tabindex="13"><label for="Field16">First</label></span><span><input id="Field17" name="Field17" type="text" class="field text ln" value="" size="14" tabindex="14"><label for="Field17">Last</label></span></li><li id="foli22" class="notranslate  notStacked"><fieldset><![if !IE | (gte IE 8)]><legend id="title22" class="desc">Guest T-Shirt Size</legend><![endif]><!--[if lt IE 8]><label id="title22" class="desc">Guest T-Shirt Size</label><![endif]--><div><input id="radioDefault_22" name="Field22" type="hidden" value=""><span><input id="Field22_5" name="Field22" type="radio" class="field radio" value="xs" tabindex="19" checked="checked"><label class="choice" for="Field22_5" >Extra Small</label></span><span><input id="Field22_0" name="Field22" type="radio" class="field radio" value="s" tabindex="20" checked="checked"><label class="choice" for="Field22_0" >Small</label></span><span><input id="Field22_1" name="Field22" type="radio" class="field radio" value="m" tabindex="21"><label class="choice" for="Field22_1" >Medium</label></span><span><input id="Field22_2" name="Field22" type="radio" class="field radio" value="l" tabindex="22"><label class="choice" for="Field22_2" >Large</label></span><span><input id="Field22_3" name="Field22" type="radio" class="field radio" value="xl" tabindex="23"><label class="choice" for="Field22_3" >Extra Large</label></span><span><input id="Field22_4" name="Field22" type="radio" class="field radio" value="xxl" tabindex="24"><label class="choice" for="Field22_4" >XXL</label></span></div></fieldset></li><li class="buttons "><div><div id="saveForm" class="btTxt submit button">Choose Seats</div></div>'
	
	var first = $("[name='Field99']:checked").val();
	if (first == 'Non-YHS')
	{
		$('html, body').animate({scrollTop:$(document).height()}, 'slow');
		$('#guestInfo form ul').html(info);
		$('#saveForm').click(function(){validate();});
		guestChoose = true;
	}
	else if (first == 'Guest')
	{
		$('html, body').animate({scrollTop:$(document).height()}, 'slow');
		$('#guestInfo form ul').html('<li>Your guest must use this website to enter their information and choose their own seat.</li><li class="buttons "><div><div id="saveForm" class="btTxt submit button">Choose Seat</div></div>');	
		$('#saveForm').click(function(){validate();});
		guestChoose = false;
	}
}

function validate()
{
   	var first = $('#Field1').val();
	var last = $('#Field2').val();
	if (first == '' || last == '')
	{
		alert('Please enter your first and last name.');
		if (first == '')
			$('#Field1').css('background-color','red');
		if (last == '')
			$('#Field2').css('background-color','red');
		return;
	}
	
	var id = $('#Field5').val();
	if (id == '')
	{
		alert('Please enter your ID number.');
		$('#Field5').css('background-color','red');
		return;
	}
	
	var ticket = $('#Field99').val();
	if (ticket == '')
	{
		alert('Please enter your ticket number.');
		$('#Field99').css('background-color','red');
		return;
	}

	var guestInfo = $("[name='Field90']:checked").val();

	if (guestInfo == 'Guest')
	{
		var guestFirst = $('#Field16').val();
		var guestLast = $('#Field17').val();
	}
	var payerFirst = $('#Field3').val();
	var payerLast = $('#Field4').val();
	$.post("php/validate.php", {first: first, last: last, id: id, guestFirst: guestFirst, guestLast: guestLast, payerFirst: payerFirst, payerLast: payerLast}, function(data){
		if (data!='OK')
			alert(data);
		else
		{
			var payment = $("[name='Field9']:checked").val();
			var tShirt = $("[name='Field21']:checked").val();
			var guestTShirt = $("[name='Field22']:checked").val();
			receipt=first+'##'+last+'##'+id+'##'+guestFirst+'##'+guestLast+'##'+payerFirst+'##'+payerLast+'##'+''+'##'+payment+'##'+tShirt+'##'+guestTShirt+'##'+ticket;
			
			showLayout();
		}
	});
}

function showLayout()
{
	activeScreen = 'layout';
	$('#guestInfo').hide();
	$('#layout').show();
	$("html, body").animate({ scrollTop: 0 });
	$('.closeButton').click(function(){$('#layout').hide();$('#guestInfo').show();});
}

function bigTable(table)
{
	if (activeScreen == 'layout')
	{
		if (table.attr('class').indexOf('inactive') != -1)
		{
			alert('There are no seats available at that table.');
			return;
		}
		table = table.attr('id').substring(1);
		
		$.post("php/loadChairs.php", {table: table}, function(data){
			activeScreen = 'table';
			$('#bigTable').html(data);												  
			$('#bigTable').show();
			$('.chair').click(function(){pickSeat($(this),table);});
			$('.closeButton').click(function(){activeScreen='layout';$('#bigTable').hide();});
		});
	}
}

function pickSeat(chair,table)
{
	if (activeScreen == 'table')
	{
		if (chair.attr('class').indexOf('inactive') != -1)
		{
			alert('That seat is already taken.');
			return;
		}
		
		var info = receipt.split('##');
		if (guest==false)
		{
			chair.html(info[0]+' '+info[1]);
			chair = chair.attr('id').substring(1);
			myChair = chair;	
		}
		else
		{
			chair.html(info[3]+' '+info[4]);
			chair = chair.attr('id').substring(1);
		}
		
		if (guest==false && guestChoose==true && (info[3] != '' || info[4] != ''))
		{
			
			alert('Pick a seat for your guest.');
			guest=true;
		}
		else if (info[3] != '' || info[4] != '')
		{
			
			var formatted = formatReceipt(table,myChair,chair,info);
			$('#receipt').html(formatted);
			showReceipt(table,chair,myChair);
		}
		else
		{
			var formatted = formatReceipt(table,chair,0,info);
			$('#receipt').html(formatted);
			showReceipt(table,chair,0);
		}
	}
}

function formatReceipt(table, chair, guestChair, info)
{
	var cost = 65;
	var returnValue = '<a href="javascript:void(0)" class="closeButton"><img src="images/close.png" alt="Close Window"></a><h2>Confirm Your Information</h2>';
	returnValue += '<div style="margin-left: 10px;"><h3>'+info[0]+' '+info[1]+'</h3>';
	
	if (info[5] != '')
		returnValue += '<h4>Paid for by '+info[5]+' '+info[6]+'</h4>';
		
	returnValue += '<h4>Payment Method: '+info[8]+'</h4>';
	
	if (info[9] == 's')
		info[9] = 'Small';
	else if (info[9] == 'm')
		info[9] = 'Medium';
	else if (info[9] == 'l')
		info[9] = 'Large';
	else if (info[9] == 'xl')
		info[9] = 'Extra Large';
	else if (info[9] == 'xxl')
		info[9] = 'XXL';
	returnValue += '<h4>T-Shirt Size: '+info[9]+'</h4>';
	
	if (guestChoose==true)
	{
		cost *= 2;
		returnValue += '<h4>Guest: '+info[3]+' '+info[4]+'</h4>';
		if (info[10] == 's')
			info[10] = 'Small';
		else if (info[10] == 'm')
			info[10] = 'Medium';
		else if (info[10] == 'l')
			info[10] = 'Large';
		else if (info[10] == 'xl')
			info[10] = 'Extra Large';
		else if (info[10] == 'xxl')
			info[10] = 'XXL';
		returnValue += '<h4>Guest T-Shirt: '+info[10]+'</h4>';
	}
	
	returnValue += '<h4>Table '+table+' Seat '+chair+'</h4>';
	if (guestChoose==true)
		returnValue += '<h4>Guest: Table '+table+' Seat '+guestChair+'</h4>';
	returnValue += '<h3>Total Cost: $'+cost+'</h3>';
	
	return returnValue+'<div id="confirmInfo" name="confirmInfo" class="btTxt submit button">Confirm</div></div></div>';
}

function showReceipt(table, chair, guest)
{	
	activeScreen = 'receipt';
	$('#receipt').show();
	$('#confirmInfo').click(function(){confirmInfo(table, chair, guest);});
	$('.closeButton').click(function(){$('#receipt').hide();});
}

function confirmInfo(table, chair, guest)
{
	$.post("php/confirmInfo.php", {table: table, chair: chair, guestChair: guest, receipt: receipt}, function(data){
		if (data=='OK')
		{
			receipt = '';
			alert('You seat has been confirmed.');
			location.reload();
		}
		else
			alert(data);
	});
}

function adminCheck(type)
{
	var pass = $('#Field2').val();
	if (pass == '')
	{
		alert('Please enter the password.');
		$('#Field1').css('background-color','red');
		return;
	}
	
	$.post("php/adminCheck.php", {pass: pass}, function(data){
		if (data!='OK')
			alert(data);
		else if (type == 'table')
			showInfo(pass);
		else if (type == 'list')
			showList(pass);
		else if (type == 'shirts')
			showShirts(pass);
	});
}

function showInfo(pass)
{
	$.post("php/promInfo.php", {pass: pass}, function(data){
		$('#info').html(data);
		$('#info').show();
	});
	
}

function showList(pass)
{
	$.post("php/promList.php", {pass: pass}, function(data){
		$('#info').html(data);
		$('#info').show();
	});
}

function showShirts(pass)
{
	$.post("php/shirts.php", {pass: pass}, function(data){
		$('#info').html(data);
		$('#info').show();
	});
}

function move(pass, studentID, type)
{
	$.post("php/moveSeat.php", {pass: pass}, function(data) {
		var openSeats = data.split('##');
		
		var output = "<select id='newSeat"+studentID+"'><option value='0-0'>Choose a Seat...</option>";
		for (i=0;i<openSeats.length-1;i++)
		{
			seat = openSeats[i].split('-');
			output+="<option value='"+openSeats[i]+"'>Table "+seat[0]+", Seat "+seat[1]+"</option>";
		}
		
		output+="</select>";
		$('#stud'+studentID).html(output);
		
		$('#newSeat'+studentID).change(function(){changeSeat(pass, studentID, type);});
	});
}

function changeSeat(pass, studentID, type)
{
	var seat = $('#newSeat'+studentID).val();
	if (seat == '0-0')
		alert('Please select a new seat.');
	else
	{
		$.post("php/updateSeat.php", {pass: pass, id: studentID, type: type, seat: seat}, function(data) {
			alert(data);
			showInfo(pass);
		});
	}
}

function edit(pass, studentID)
{
	$.post("php/loadInfo.php", {pass: pass, id: studentID}, function(data) {
		var info = data.split('##');
		
		var output = '<label>'+info[0]+'</label><br><label>Payment</label><input type="text" value="'+info[1]+'"><br><label>Shirt Size</label><input type="text" value="'+info[2]+'"><br><label>Ticket No.</label><input type="text" value="'+info[3]+'"><p style="text-align:center"><a href="javascript:void(0);" onclick="editInfo(\''+pass+'\','+studentID+');">Update Student Info</a></p>';
		
		$('#info').html('<h2>Edit Student Info</h2>'+output);
	});
}

function editInfo(pass, studentID)
{
	var payment = $('input:eq(1)').val();
	var shirt = $('input:eq(2)').val();
	var ticket = $('input:eq(3)').val();
	
	$.post("php/editInfo.php", {pass: pass, id: studentID, payment: payment, shirt: shirt, ticket: ticket}, function(data) {
		$('#info').hide();
		alert(data);
	});
}

function deleteStud(pass, studentID, type)
{
	$('#info').html('<h2>Delete '+type+'</h2><p>Please confirm that your action. The '+type.toLowerCase()+' will be permanently deleted from the prom list.</p><p style="text-align:center"><a href="javascript:void(0);" onclick="deleteConfirm(\''+pass+'\','+studentID+',\''+type+'\');">Delete '+type+'</a></p>');
}

function deleteConfirm(pass, studentID, type)
{
	$.post("php/deleteStudent.php", {pass: pass, id: studentID, type: type}, function(data) {
		$('#info').hide();
		alert(data);
	});
}