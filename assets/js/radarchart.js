$(document).ready(function() {
	loadData();
	buildChartBase();
	buildInfoBase();
	setScales();
	addAxes();
	changeTopic();
	addSlider();
	drawLegend();
	toggleButton();
	setTimeout(firstAnimation, 2000);
});

/* Load and update data and variables to show the current data at the selected time and topics */
function loadData() {
	if (level == 0) { // All subjects level
		numCurSeries = 1; // Only self first
		numSides = 3; // Math, Physics, and Chemistry
	} else {
		if (level == 1) {
			switch (topicIndex[1]) { // Have only math right now
				case 0: topics = syllabus_math.children; break;
				case 1: topics = syllabus_phys.children; break;
				case 2: topics = syllabus_chem.children; break;
				default: topics = syllabus_math.children;
			}
		} else {
			// Update topics
			topics = syllabus_math.children;
			for (var i=1; i<level; i++) {
				if (topics[topicIndex[i+1]].children == undefined) {
					alert("Oops! " + topics[topicIndex[i+1]].name + " has no sub-topics.");
					return;
				} else {
					topics = topics[topicIndex[i+1]].children;
				}
			}
		}
		
		numSides = topics.length;
		console.log(topics);
		console.log(numSides);
	}
	
	data = [];
	sides = [];
	time = timeLength-1; // set current selected time to maximum
	prevtime = time;
	
	// input data
	for (var k=0; k<timeLength; k++) {
		series = [];
		
		for (var i=0; i<numSeries; i++) {
			var tmp = [];
			for (var j=0; j<numSides; j++) {
				tmp[j] = randomFromTo(5, 15);
			}
			series[i] = tmp;
		}
		
		for (var i=0; i<series.length; i++) {
			series[i].push(series[i][0]);
		}
		
		data.push(series);
	}
	
	// for formatting the scales/axes
	for (var i=0; i<numSides; i++) {
		if (level == 0) sides[i] = subjects[i];
		else sides[i] = topics[i].name;
	}
	
	// find max and min values
	var mergedArr = [];
	for (var k=0; k<timeLength; k++) {
		for (var i=0; i<numSeries; i++) {
			mergedArr = mergedArr.concat(data[k][i]);
		}
	}
	minData = d3.min(mergedArr);
	maxData = d3.max(mergedArr);
	maxData += (maxData - minData) * 0.25;
	minData = 0;
}

/* svg base for the chart area */
function buildChartBase() {
	var svg = d3.select("#chart")
		.append("svg")
		.attr("width", w_chart)
		.attr("height", h);
	
	chartBody = svg.append("g")
		.attr("id", "chartbody");
}

/* svg base for the info area */
function buildInfoBase() {
	var info = d3.select("#legend-svg")
		.append("svg")
		.attr("width", w-w_chart)
		.attr("height", h);
	
	infoBody = info.append("g")
		.attr("id", "infobody");
}

/* set the radial scale of the chart */
function setScales() {
	var widthConstraint = w_chart - padding.left - padding.right,
		heightConstraint = h - padding.top - padding.bottom;
	var constraint = d3.min([widthConstraint, heightConstraint]),
		centerX = widthConstraint/2 + padding.left,
		centerY = heightConstraint/2 + padding.top;
	
	chartBody.attr("transform", "translate(" + centerX + ", " + centerY + ")");
	
	radius = d3.scale.linear()
		.domain([minData, maxData])
		.range([0, constraint/2]);
	radiusLength = radius(maxData);
}

/* generate axes grid on the chart */
function addAxes() {
	var radialTicks = radius.ticks(5);
	
	chartBody.selectAll(".chart-ticks")
		.remove();
	chartBody.selectAll(".line-ticks")
		.remove();
	
	var chartAxes = chartBody.selectAll(".chart-ticks")
		.data(radialTicks)
		.enter().append("g")
		.attr("class", "chart-ticks");
	
	var lineAxes = chartBody.selectAll(".line-ticks")
		.data(sides)
		.enter().append("g")
		.attr("transform", function(d, i) {
			return "rotate(" + (i/sides.length*360 - 90) + ")translate(" + radius(maxData) + ")";
		})
		.attr("class", "line-ticks");
	
	addPolygonChartSkeleton(chartAxes);
	addLineChartSkeleton(lineAxes);
	addPolygonTextTicks(chartAxes);
	addLineTextTicks(lineAxes);
}

/* change the data and look when going up and down the syllabus tree */
function changeTopic() {
	// drill down the tree by clicking the links on the chart
	// May add some sliding feature to the side bands later
	$(".link-topic").click(function() {
		var classes = $(this).attr("class").split(/\s+/);
		var ind = parseInt(classes[0].split("topic-")[1]);
		var handle = $("#topic-band-link");
		var add = "<div class='topic-band-"+(level+1)+" link-topic-band' style='width:" + (w-w_chart) + "; background-color:" + bandColor[(level+1)%3] + "'>";
		if (level == 0) add += subjects[ind-1];
		else add += topics[ind-1].name;
		add += "</div>";
		handle.append(add);
		level++;
		topicIndex.push(ind-1);
		loadData();
		setScales();
		transformChartSkeleton();
		transformPolygonRadar();
		changeTopic();
	});
	
	// roll up the tree by clicking the links on the side bands
	$(".link-topic-band").click(function() {
		var classes = $(this).attr("class").split(/\s+/);
		var lev = classes[0].split("-")[2];
		while (level > lev) {
			topicIndex.pop();
			$(".topic-band-"+level).remove();
			level--;
		}
		loadData();
		setScales();
		transformChartSkeleton();
		transformPolygonRadar();
		changeTopic();
	});
}

/* use in addAxes */
function addPolygonChartSkeleton(chartAxes) {
	chartAxes.append("polygon")
		.attr("class", "chart-skeleton-polygon")
		.attr("points", function(d, i) {
			coord_str = "";
			for (var j=0; j<numSides; j++) {
				var angle = (j/numSides) * 2 * Math.PI - Math.PI / 2;
				coord_str += radius(d)*Math.cos(angle) + "," + radius(d)*Math.sin(angle) + " ";
			}
			return coord_str;
		})
		.style("stroke", "#BBB")
		.style("fill", "none");
}

/* use in addAxes */
function addLineChartSkeleton(lineAxes) {
	lineAxes.append("line")
		.attr("class", "chart-skeleton-line")
		.attr("x2", -1 * radius(maxData))
		.style("stroke", "#BBB")
		.style("fill", "none");
}

/* use in changeTopic, do the animation of the axes */
function transformChartSkeleton() {
	var t = 0;
	var intdl = setInterval(function() {
		if (t < 1) {
			d3.selectAll(".chart-skeleton-polygon")
				.each(function(d, i) {
					d3.select(this).transition()
						.duration(100).ease("sin") // set duration time for animation
						.attr("points", function(d, i) {
							coord_str = "";
							// reduce to center and roll back radially
							for (var j=0; j<numSides; j++) {
								var angle = (j/numSides) * 2 * Math.PI - Math.PI / 2;
								coord_str += t*radius(d)*Math.cos(angle) + "," + t*radius(d)*Math.sin(angle) + " ";
							}
							return coord_str;
						})
				});
			t = t + 0.25;
		} else {
			clearInterval(intdl);
		}
	}, 100);  // set duration between states of animation
	
	// change and animate the value axes
	chartBody.selectAll(".line-ticks")
		.remove();
	var lineAxes = chartBody.selectAll(".line-ticks")
		.data(sides)
		.enter().append("g")
		.attr("transform", function(d, i) {
			return "translate(0,0)";
		})
		.attr("class", "line-ticks");
	lineAxes.transition()
		.duration(500).ease("sin") // set duration time for the animation
		.attr("transform", function(d, i) {
			return "rotate(" + (i/sides.length*360 - 90) + ")translate(" + radius(maxData) + ")";
		});
	addLineChartSkeleton(lineAxes);
	addLineTextTicks(lineAxes);
}

/* add topic labels */
function addPolygonTextTicks(chartAxes) {
	chartAxes.append("text")
		.text(String)
		.attr("text-anchor", "middle")
		.attr("dy", function(d) {
			return -1 * radius(d);
		});
}

/* add value labels */
function addLineTextTicks(lineAxes) {
	lineAxes.append("a")
		.attr("class", function(d, i) {
			if (level != 0 && topics[i].children == undefined) return "topic-"+(i+1)+" link-disabled";
			else return "topic-"+(i+1)+" link-topic";
		})
		.append("text")
		.text(String)
		.attr("text-anchor", "middle")
		.attr("transform", function(d, i) {
			return "rotate(" + (90 - i/sides.length*360) + ")";
		});
}

/* use in changeTopic to animate the colored polygon */
function transformPolygonRadar() {
	var t = 0 ;
	var intdl = setInterval(function() {
		var radialLine = d3.svg.line.radial()
			.radius(function(d, i) {
				return 2*t*radius(d);
			})
			.angle(function(d, i) {
				if (i == numSides) i = 0;
				return (i/numSides) * 2 * Math.PI;
			});
		
		if (t < 1) {
			// transform the boundaries
			d3.selectAll(".line").each(function(d, i) {
				var n = i;
				var val = data[time][n];
				d3.select(this).transition()
					.duration(100).ease("sin")
					.attr("d", radialLine(val))
			});
			
			// transform the inside area
			d3.selectAll(".polygon").each(function(d, i) {
				var n = i;
				d3.select(this).transition()
					.duration(100).ease("sin")
					.attr("points", function(d, i) {
						coord_str = "";
						// reduce to center and roll back radially
						for (var j=0; j<numSides; j++) {
							var angle = (j/numSides) * 2 * Math.PI - Math.PI / 2;
							coord_str += t*radius(data[time][n][j])*Math.cos(angle) + "," + t*radius(data[time][n][j])*Math.sin(angle) + " ";
						}
						return coord_str;
					})
			});
			t = t + 0.5;
		} else {
			clearInterval(intdl);
		}
	}, 200);
}

/* add the time slider and select element */
function addSlider() {
	var str = "<select name='valueAA' id='valueAA'>";
	var numYears = curDate.getFullYear() - startDate.getFullYear();
	for (var i=0; i<=numYears; i++) {
		var curYear = startDate.getFullYear() + i;
		str += "<optgroup label='" + curYear + "'>";
		var stam = (i == 0) ? startDate.getMonth() : 0;
		var endm = (i == numYears-1) ? curDate.getMonth()+1 : 12;
		for (var j=stam; j<endm; j++) {
			var val = "" + (j+1) + "/" + curYear.toString().substring(2,4);
			str += "<option value='" + val + "'>" + val + "</option>";
		}
	}
	$("#timepick").append(str);
	
	$('select#valueAA').selectToUISlider({
		labels: 12,
	});
}

/* draw legend in the info area */
function drawLegend() {
	var legend = infoBody.selectAll(".legend")
		.data(data[time])
		.enter().append("g")
		.attr("class", "legend")
		.attr("transform", "translate(" + 0.02*(w-w_chart) + ", " + 10 + ")");
	
	legend.append("rect")
		.attr("id", "legend")
		.attr("width", 0.9 * (w-w_chart))
		.attr("height", 30 * numSeries)
		.style("stroke", "black")
		.style("fill", "none");
	
	legend.append("rect")
		.attr("class", "legend-color")
		.attr("rx", 6)
		.attr("ry", 6)
		.attr("width", 20)
		.attr("height", 20)
		.attr("transform", function(d, i) {
			return "translate(" + 0.045*(w-w_chart) + ", " + (5+30*i) + ")";
		})
		.style("fill", function(d, i) {
			return polygonColor[i];
		});
	
	legend.append("text")
		.attr("class", "legend-text")
		.attr("transform", function(d, i) {
			return "translate(" + (20+0.09*(w-w_chart)) + ", " + (20+30*i) + ")";
		})
		.text(function(d, i) {
			return legends[i];
		})
		.style("fill", function(d, i) {
			return polygonColor[i];
		});
}

/* toggle the average data viewing */
function toggleButton() {
	$("a#toggle-avg").click(function() {
		$(this).toggleClass("down");
		if ($("#legend-svg").is(":hidden")) {
			$("#legend-svg").slideDown("slow");
			$("#seriesid1").show();
			numCurSeries = 2;
		} else {
			$("#legend-svg").slideUp("slow");
			$("#seriesid1").hide();
			numCurSeries = 1;
		}
		drawPolygon();
	});
}

/* draw the data polygons, used in the first animation */
function drawPolygon() {
	var chartData = chartBody.selectAll(".series")
		.data(data[prevtime], function(d) {
			return d;
		})
	
	chartData.exit().remove();
	
	var groups = chartData.enter().append("g")
		.attr("class", "series")
		.attr("id", function(d, i) {
			return "seriesid"+i;
		})
		.style("fill", function(d, i) {
			if (i < numCurSeries) return polygonColor[i];
			else return "none";
		})
		.style("stroke", function(d, i) {
			if (i < numCurSeries) return polygonColor[i];
			else return "none";
		});
	
	// draw boundary paths
	var lines = groups.append("path")
		.attr("class", "line")
		.attr("d", d3.svg.line.radial()
			.radius(function(d) {
				return radius(d);
			})
			.angle(function(d, i) {
				if (i == numSides) i = 0;
				return (i/numSides) * 2 * Math.PI;
			}))
		.style("stroke-width", 2)
		.style("fill", "none")
		.each(function(d, i) {
			var n = i;
			d3.select(this).transition()
				.duration(100).ease("sin")
				.attr("d", d3.svg.line.radial()
					.radius(function(d, i) {
						return radius(data[time][n][i]);
					})
					.angle(function(d, i) {
						if (i == numSides) i = 0;
						return (i/numSides) * 2 * Math.PI;
					}))
		});
	
	// draw inside areas
	var polygons = groups.append("polygon")
		.attr("class", "polygon")
		.attr("points", function(d) {
			return d.map(function(d, i) {
				var angle = (i/numSides) * 2 * Math.PI - Math.PI / 2;
				return [radius(d)*Math.cos(angle), radius(d)*Math.sin(angle)].join(",");
			}).join(" ");
		})
		.style("stroke", "none")
		.style("fill", function(d, i) {
			if (i < numCurSeries) return polygonColor[i];
			else return "none";
		})
		.transition()
		.duration(100).ease("sin")
		.attr("points", function(d, i) {
			var n = i;
			return d.map(function(d, i) {
				var angle = (i/numSides) * 2 * Math.PI - Math.PI / 2;
				return [radius(data[time][n][i])*Math.cos(angle), radius(data[time][n][i])*Math.sin(angle)].join(",");
			}).join(" ");
		});
}

/* First animation, running through the whole time interval.
 * Animate the slider and the radar chart
 */
function firstAnimation() {
	var handle = $("#valueAA");
	var sliderhandle = $("#handle_valueAA");
	
	// try to disable the slider during the animation (user cannot click), but doesn't work
	sliderhandle.parents(".ui-slider:eq(0)").slider("option", "disabled", true);
	
	// animation, the link to chart animation is done in selectedToUISlider.jQuery.js file (added some code in that file)
	var t = 0;
	var intdl = setInterval(function() {
		if (t < timeLength) {
			handle.find("option").eq(t).attr("selected", "selected");
			var ind = sliderhandle.data("handleNum");
			sliderhandle.parents(".ui-slider:eq(0)").slider("values", ind, t);
			prevtime = time;
			time = t;
			if (time != prevtime) drawPolygon();
			t++;
		} else {
			clearInterval(intdl);
		}
	}, 200); // set the interval time between each step
	
	sliderhandle.parents(".ui-slider:eq(0)").slider("option", "disabled", false);
}