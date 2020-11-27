var modebar_config = {
		modeBarButtonsToRemove: ['lasso2d','select2d','sendDataToCloud','toggleHover', 'hoverClosestCartesian', 'toggleSpikelines']
	}

var last_status = 'undefined';
var current_status = 'undefined';
var initial_status;

initial_status = get_status();

toggleViews('loading');
change_pmu_port();

function main_routine()
{
	current_status = get_status();
	if((current_status == 'working' && last_status == 'loading') || (initial_status == 'working'))
	{
		get_graphs();
		toggleViews('working')
	}
	else if((current_status == 'loading' && last_status == 'working') || initial_status == 'loading')
	{
		toggleViews('loading');
	}

	last_status = current_status;
	initial_status = 'undefined';

}


$(document).ready(function() 
{
	window.setInterval(function() 
	{
		main_routine();
	}, 
	500);
})

function get_graphs() {
	$.ajax({
        url: 'graphs.php',
        data: {action : 'graph1'},
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(response) {
        	if(response['success'] == true) draw_graph1(response.data, response.update);
        }
  	});

	$.ajax({
        url: 'graphs.php',
        data: {action : 'graph2'},
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(response) {
			if(response['last_update'] != -1) {
				$("#last-update-time").html(response['last_update']);
				$("#last-update").show();
			}
			else $("#last-update").hide();
        	if(response['success'] == true) draw_graph2(response.data, response.update);
        }
  	});
}

function get_status() {
	var status = 'loading';
	$.ajax({
        url: 'graphs.php',
        data: {action : 'status'},
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(response) {
        	if(response['success'] == true) status = response['status'];
        }
    });
    return status;
}

function change_pmu_port() {
	$.ajax({
        url: 'graphs.php',
        data: {action : 'change_pmu_port', pmu : $("#select-pmu").text()},
        method: 'GET',
        dataType: 'json',
        success: function(response) {
        	if(response['success'] == true) console.log(response);
       	}
  	});
}

function toggleViews(status) {
	switch(status) {
		case 'working':
			$("#graph1").show();
	    	$("#graph2").show();
	    	$("#loading").hide();
			$("#last-update").show();

	    	break;
		case 'unavailable':
	    	$("#graph1").hide();
	    	$("#graph2").hide();
	   		$("#loading").hide();
			$("#last-update").hide();	
	    	break;
		case 'loading':
	    	$("#graph1").hide();
	    	$("#graph2").hide();
	    	$("#loading").show();	
			$("#last-update").hide();
	    	break;
	}
}

function draw_graph1(data, update) {
	var layout;
	var trace = [];

	layout = {
		title: 'Frequência de operação do SEP',
		xaxis: {
			title: 'Tempo'
		},
		yaxis: {
			title: 'Frequência [Hz]'
		}
	}

	trace.push({
		x: data.x,
		y: data.y,
		mode: 'lines',
		type: 'scatter'
	})

	Plotly.newPlot('graph1', trace, layout, modebar_config);
}

function draw_graph2(data, update) {
	var layout;
	var trace = [];

	layout = {
		title: 'Transformada de Welch',
		xaxis: {
			title: 'Frequência [Hz]'
		},
		yaxis: {
			title: 'Módulo'
		}
	}
	
	trace.push({
		x: data.x,
		y: data.y,
		mode: 'markers',
		type: 'scatter'
	})

	Plotly.newPlot('graph2', trace, layout, modebar_config);
}