<!DOCTYPE html>
<html lang="en">
<head>
  <title>CART</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
	<table class="table table-striped" id="table1">
    <thead>
      <tr>
        <th>Product</th>
        <th>Value</th>
        <th>Increment</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Apple</td>
        <td class="value">200</td>
        <td><button type="button" class="btn btn-success addVal">ADD</button></td>
      </tr>
      <tr>
        <td>Samsung</td>
        <td class="value">400</td>
        <td><button type="button" class="btn btn-success addVal">ADD</button></td>
      </tr>
      <tr>
        <td>Ipad</td>
        <td class="value">600</td>
        <td><button type="button" class="btn btn-success addVal">ADD</button></td>
      </tr>
    </tbody>
  </table>

  <!-- extend here all value -->
	<table class="table table-striped" id="table2">
	    <thead>
	      <tr>
	        <th>Product</th>
	        <th>Value</th>
	        <th>Decrement</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<tr></tr>
	    </tbody>
	 </table>

	 <div class="well"><button type="button" class="btn btn-info submit">SUBMIT</button></div>
  
</div>
<script type="text/javascript">
jQuery(document).ready(function($) {

	// Dom ready render html from JSON
	render();

	// add on click
	$('#table1 .addVal').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		var getTxt = $(this).closest('tr').html();		
			
		$('#table2 tbody').append("<tr>"+ getTxt +"	<td><button type=\"button\" class=\"btn btn-danger RemV\">Remove</button></td></tr>");			
		$('#table2 tbody .addVal').closest('td').remove();
	});
	
	// remove on click
	$(document).on('click','.RemV',function(event) {
		event.preventDefault();
		/* Act on the event */
		$(this).closest('tr').remove();
	});

	// Submit button
	$('.submit').on('click', function(event) {
		event.preventDefault();
		/* Act on the event */
		var view = localStorage.getItem("content");
		var objParse = $.parseJSON(view);

		$.ajax({
			url: 'post.php',
			type: 'POST',
			// dataType: 'json',
			data: objParse,
		})
		.done(function(success) {
			alert(success);
		})
		.fail(function() {
			console.log("error");
		})
		.always(function() {
			console.log("complete");
		});
		
	});
});
	
	// Render array here
	setInterval(function() {
		getTable()
	},1000);

	function getTable(argument) {
		var arr = [];
		// body...
		var getTb = $('#table2 tbody tr');
		var mapTd = $(getTb).map(function(index, elem) {
			return $(elem).html();
		}).get();
		arr.push(mapTd);
		console.log(arr);
		strArr = JSON.stringify(arr);
		localStorage.setItem("content", strArr);
	}

	function render(argument) {
		// body...
		var view = localStorage.getItem("content");
		var objParse = $.parseJSON(view);
		var viewBuild = $('#table2 tbody');

		for (var i = 0; i < objParse.length; i++) {
			// Things[i]
			var j = objParse[i];
			for (var g = 0; g < j.length; g++) {
				console.log('<tr>'+ j[g] +'</tr>');
				$(viewBuild).append('<tr>'+ j[g] +'</tr>')
			}
			
		}
				
	}
</script>
</body>
</html>