var modebar_config = {
		modeBarButtonsToRemove: ['lasso2d','select2d','sendDataToCloud','toggleHover', 'hoverClosestCartesian', 'toggleSpikelines']
	}

$(document).ready(function() 
{
	// Page first load
	toggleViews('loading');
	startup();
	toggleViews('working');	
	
	// Refresh page every five minutes
	window.setInterval(function() 
	{
		toggleViews('loading');
		if ((10 < $("#time_window_select").val()) && ($("#time_window_select").val() < 960))
			change_time_window();
		else
			startup();
		toggleViews('working');
	}, 
	300000);

})  

// This function works at page change
function startup() {
	$.ajax({
        url: 'graphs.php',
        data: {action : 'startup', pmu : $("#select-pmu").text(), time_w : 60},
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(response) {
        	draw_graph1(response.date, response.freq);
        	draw_graph2(response.welch_freq, response.welch);

        	//Updates time and informs user
			$("#last-update-time").html(new Date().toLocaleDateString() + " " +
										new Date().toLocaleTimeString('en-GB', { hour: "numeric", 
                                             									 minute: "numeric",
                                             									 second: "numeric"}));
        }
	});

}

// This function works when user wishes to define time window
function change_time_window() {
	$.ajax({
        url: 'graphs.php',
        data: {action : 'startup', pmu : $("#select-pmu").text(), time_w : $("#time_window_select").val()},
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(response) {
        	draw_graph1(response.date, response.freq);
        	draw_graph2(response.welch_freq, response.welch);

        	//Updates time and informs user
			$("#last-update-time").html(new Date().toLocaleDateString() + " " +
										new Date().toLocaleTimeString('en-GB', { hour: "numeric", 
                                             									 minute: "numeric",
                                             									 second: "numeric"}));
        }
	});

}

// Function that activates at button click
$('#button_id').on('click', function() 
{
	if ((10 < $("#time_window_select").val()) && ($("#time_window_select").val() < 960))
	{
		toggleViews('loading');
	  	change_time_window();
		toggleViews('working');
	}
});

// Utility function for switching between page views
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

function draw_graph1(data_x, data_y) {
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
		x: data_x,
		y: data_y,
		mode: 'lines',
		type: 'scatter'
	})

	Plotly.newPlot('graph1', trace, layout, modebar_config);
}

function draw_graph2(data_x, data_y) {
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
		x: data_x,
		y: data_y,
		mode: 'markers',
		type: 'scatter'
	})

	Plotly.newPlot('graph2', trace, layout, modebar_config);
}