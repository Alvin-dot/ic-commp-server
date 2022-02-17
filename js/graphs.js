const modebar_config = {
	modeBarButtonsToRemove: ['lasso2d',
		'select2d',
		'sendDataToCloud',
		'toggleHover',
		'hoverClosestCartesian',
		'toggleSpikelines']
}

let time_window = 60;
let sample_frequency = 15;
let segmentWindow = 100;
let segmentOverlap = 50;
let filterLower = 0.3;
let filterHigher = 7.0;
let outlierConstant = 3.5;
let view = 'simplificada';

toggleViews('loading');

window.addEventListener('load', () => {
	// Page first load
	startup();

	// Refresh page every five minutes
	window.setInterval(() => startup(), 300000);
})


// This function works at page change
function startup() {

	toggleViews('loading');

	const params = {
		action: 'startup', 
		pmu: $("#select-pmu").text(),
		time_w: time_window,
		sample_freq: sample_frequency,
		segment_window: segmentWindow,
		segment_overlap: segmentOverlap,
		filter_lower: filterLower,
		filter_higher: filterHigher,
		outlier_constant: outlierConstant,
		view: view
	};

	$.ajax({
		url: 'graphs.php',
		data: params,
		method: 'GET',
		dataType: 'json',
		async: true,
		success: function (response) {
			// Check de falha na requisição
			if (response === null) {
				toggleViews('unavailable');
				return;
			}
			
			const res = JSON.parse(response);
			
			console.log(res);

			draw_graph1(res.date, res.freq);
			draw_graph2(res.welch_freq, res.welch);



			// Preprocessed signal graph logic
			if (res.freq_process) {
				draw_graph_processed(res.date, res.freq_process);
				toggleViews('working-complete');
			} else {
				toggleViews('working');
			}

			//Updates time and informs user
			$("#last-update-time").html(new Date().toLocaleDateString() + " " +
				new Date().toLocaleTimeString('en-GB', {
					hour: "numeric",
					minute: "numeric",
					second: "numeric"
				}));
		}
	});
}

// Dashboard view selection button click
$('#dashboard-select-div').on('click', () => {
	const checkbox = document.getElementById('dashboard-select-checkbox');
	const form = document.getElementById('page-form');
	// Complete dashboard
	if (checkbox.checked) {
		form.classList.remove('d-none');
		view = 'complete';
	} 
	// Simplified dashboard
	else {
		form.classList.add('d-none');
		view = 'simplified';
	}
})

// Update button click
$('#button_id').on('click', function () {

	// Checks time window value
	if ($("#time_window_select").val() !== "")
		time_window = parseInt($("#time_window_select").val());

	// Checks sample frequency value
	if ($("#sample_frequency_select").val() !== "")
		sample_frequency = parseInt($("#sample_frequency_select").val());

	// Checks welch segment window
	if ($("#segment_window_select").val() !== "")
		segmentWindow = parseInt($("#segment_window_select").val());

	// Checks welch overlap percentage
	if ($("#segment_overlap_select").val() !== "")
		segmentOverlap = parseInt($("#segment_overlap_select").val());

	// filter lower frequency
	if ($("#filter_lower_select").val() !== "") 
		filterLower = parseFloat($("#filter_lower_select").val());

	// filter higher frequency
	if ($("#filter_higher_select").val() !== "")
		filterHigher = parseFloat($("#filter_higher_select").val());

	// filter lower frequency
	if ($("#outliner_select").val() !== "")
		outlierConstant = parseFloat($("#outliner_select").val());

	console.log('cheguei até aqui');

	if (5 <= time_window && time_window <= 60 &&
		15 <= sample_frequency && sample_frequency <= 30) {
		startup();
		console.log('e aqui?');
	}
});

// Utility function for switching between page views
function toggleViews(status) {
	console.log(status);

	switch (status) {
		case 'working':
			show('graph1');
			show('graph2');
			hide('graph_processed');
			hide('loading');
			show('last-update');
			show('pmu-location');
			hide('pmu-error');
			break;

		case 'working-complete':
			show('graph1');
			show('graph2');
			show('graph_processed');
			hide('loading');
			show('last-update');
			show('pmu-location');
			hide('pmu-error');
			break;

		case 'unavailable':
			hide('graph1');
			hide('graph2');
			hide('graph_processed');
			hide('loading');
			hide('last-update');
			show('pmu-location');
			show('pmu-error');
			break;

		case 'loading':
			hide('graph1');
			hide('graph2');
			hide('graph_processed');
			show('loading');
			hide('last-update');
			hide('pmu-location');
			hide('pmu-error');
			break;
	}
}

function draw_graph1(data_x, data_y) {
	var layout;
	var trace = [];

	layout = {
		title: 'Power grid operating frequency',
		xaxis: {
			title: 'Time'
		},
		yaxis: {
			title: 'Frequency [Hz]'
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
		title: 'Welch periodogram',
		xaxis: {
			title: 'Frequency [Hz]'
		},
		yaxis: {
			title: 'Module'
		}
	}

	trace.push({
		x: data_x,
		y: data_y,
		mode: 'lines',
		type: 'scatter'
	})

	Plotly.newPlot('graph2', trace, layout, modebar_config);
}

function draw_graph_processed(data_x, data_y) {
	var layout;
	var trace = [];

	layout = {
		title: 'Preprocessed frequency',
		xaxis: {
			title: 'Time'
		},
		yaxis: {
			title: 'Frequency [Hz]'
		}
	}

	trace.push({
		x: data_x,
		y: data_y,
		mode: 'lines',
		type: 'scatter'
	})

	Plotly.newPlot('graph_processed', trace, layout, modebar_config);
}

// DOM Manipulation functions
function show(elementId) {
	const element = document.getElementById(elementId);
	if (!element) return;
	if (element.classList.contains('d-none')) {
		element.classList.remove('d-none');
	}
}

function hide(elementId) {
	const element = document.getElementById(elementId);
	if (!element) return;
	if (!element.classList.contains('d-none')) {
		element.classList.add('d-none');
	}
}
