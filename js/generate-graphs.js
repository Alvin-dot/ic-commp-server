var modebar_config = {
		modeBarButtonsToRemove: ['lasso2d','select2d','sendDataToCloud','toggleHover', 'hoverClosestCartesian', 'toggleSpikelines']
	}

$(document).ready(function() {
	change_pmu_port();
	window.setInterval(function() {
		toggleViews(get_status());
		get_graphs();
		getPmuPort();
	}, 1000);

	$("#select-pmu").change(function() {
		change_pmu_port();
	})

	$("#pmu-off").hide();
})

function change_pmu_port() {
	$.ajax({
        url: 'graphs.php',
        data: {action : 'change_pmu_port', pmu : $("#select-pmu").val()},
        method: 'GET',
        dataType: 'json',
        success: function(response) {
        	if(response['success'] == true) console.log(response);
       	}
  	});
}

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

	$.ajax({
        url: 'graphs.php',
        data: {action : 'graph3'},
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(response) {
        	if(response['success'] == true) draw_graph3(response);
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

function toggleViews(status) {
	switch(status) {
		case 'working':
			$("#graph1").show();
	    	$("#graph2").show();
	    	$("#graph3").show();
	    	$("#pmu-off").hide();
	    	$("#loading").hide();
	    	break;
		case 'unavailable':
	    	$("#graph1").hide();
	    	$("#graph2").hide();
	    	$("#graph3").hide();
	    	$("#pmu-off").show();
			$("#loading").hide();
			$("#last-update").hide();	
	    	break;
		case 'loading':
	    	$("#graph1").hide();
	    	$("#graph2").hide();
	    	$("#graph3").hide();
	    	$("#pmu-off").hide();
			$("#loading").show();	
			$("#last-update").hide();
	    	break;
	}
}


function getPmuPort() {
	$.ajax({
        url: 'graphs.php',
        data: {action : 'get_pmu_port'},
        method: 'GET',
        dataType: 'json',
        async: false,
        success: function(response) {
        	if(response['success'] == true) $("#select-pmu").val(response['port']);
    	}
	});
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

function draw_graph3(data) {
	var trace = [];

	for(var i in data) {
		if(i != "linha_vertical") {
			trace.push({
				x: data[i].x,
				y: data[i].y,
				mode: 'markers',
				type: 'scatter',
				marker: {
					symbol: (i == "centroide" ? "x" : "circle"),
					size: (i == "centroide" ? 15 : 7),
					line: {
				      color: 'rgb(0, 0, 0)',
				      width: 1
				    }
				},
				name: i
			})
		}
	}

	var layout = {
		title: 'Clusterização dos polos no plano complexo',
		xaxis: {
			range: [-1.2, 0.7],
			title: 'Atenuação média [1/s]'
		},
		yaxis: {
			range: [0, 2],
			title: 'Frequência [Hz]'
		},
		shapes: [{
	      type: 'line',
	      x0: data["linha_vertical"][0],
	      y0: 0,
	      x1: data["linha_vertical"][0],
	      y1: 2,
	      line: {
	        color: 'rgb(57, 59, 64)',
	        width: 3
	      }
	    }]
	}

	Plotly.newPlot('graph3', trace, layout, modebar_config);

}