const modebar_config = {
	modeBarButtonsToRemove: ['lasso2d',
		'select2d',
		'sendDataToCloud',
		'toggleHover',
		'hoverClosestCartesian',
		'toggleSpikelines']
}

let time_window = 20;
let sample_frequency = 100;
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
			

			let res;
			if (typeof response === "object") {
				res = response;
			} else {
				res = JSON.parse(response);
			}

			
			console.log(res);

			draw_graph1(res.date, res.freq);
			draw_graph2(res.welch_freq, res.welch);
				draw_graph_processed(res.date, res.freq_process);
				toggleViews('working');

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
$('#toggle-btn').on('click', () => {
	const btn = document.getElementById("toggle-btn");
	const form = document.getElementById('page-form');
	const isActive = btn.classList.contains("active");
	// Complete dashboard
	if (!isActive) {
		btn.innerText = "Complete dashboard";
		btn.classList.remove("btn-primary");
		btn.classList.add("btn-secondary");

		form.classList.remove('d-none');
		setPlaceholder();
		toggleViews('working-complete');
	} 
	// Simplified dashboard
	else {
		btn.innerText = "Simplified dashboard";
		btn.classList.remove("btn-secondary");
		btn.classList.add("btn-primary");

		form.classList.add('d-none');
		toggleViews('working');
	}
});

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

	startup();
});

// Utility function for switching between page views
function toggleViews(status) {
	console.log(status);

	switch (status) {
		case 'working':
			hide('graph1');
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

	// Blocks application buttons if loading 
	const btn = document.getElementById("toggle-btn");
	const updateBtn = document.getElementById("button_id");
	if (elementId === "loading") {
		btn.disabled = true;
		updateBtn.disabled = true;
	} else {
		btn.disabled = false;
		updateBtn.disabled = false;
	}
}

function hide(elementId) {
	const element = document.getElementById(elementId);
	if (!element) return;
	if (!element.classList.contains('d-none')) {
		element.classList.add('d-none');
	}
}

function setPlaceholder() {
	// Checks time window value
	$("#time_window_select").attr("placeholder", time_window);

	// Checks sample frequency value
	$("#sample_frequency_select").attr("placeholder", sample_frequency);

	// Checks welch segment window
	$("#segment_window_select").attr("placeholder", segmentWindow);

	// Checks welch overlap percentage
	$("#segment_overlap_select").attr("placeholder", segmentOverlap);

	// filter lower frequency
	$("#filter_lower_select").attr("placeholder", filterLower);

	// filter higher frequency
	$("#filter_higher_select").attr("placeholder", filterHigher);

	// filter lower frequency
	$("#outliner_select").attr("placeholder", outlierConstant);
}