$(document).ready(function() {
	d3.json("student-quiz.json", function(json1){
		student_quiz = json1;
		d3.json("quiz.json", function(json2){
			quiz = json2;
			loadData();
			addSelectQuiz();
			buildChartBase();
			buildInfoBase();
			addScale();
			addXText();
			addYText();
			generateBars();
			selectQuiz();
			selectMode();
			drawLegend();
			toggleButton();
			addQuizInfo();
		});
	});
});

function loadData() {
	timeSpentAll = [];
	allCurQuiz = [];
	dateCurQuiz = [];
	resultAll = [];
	indAll = [];
	average = [];
	
	listUQ = student_quiz.children;
	for (var i=0; i<listUQ.length; i++) {
		if (listUQ[i].id == currentUser) {
			var obj = { "date" : (new Date(listUQ[i].date)), "quizid" : listUQ[i].quizid };
			allCurQuiz.push(obj);
		}
	}
	
	allCurQuiz.sort(function(a, b) {
		return b.date.getTime() - a.date.getTime();
	});
	
	currentQuiz = allCurQuiz[curQInd].quizid;
	currentQuizDate = allCurQuiz[curQInd].date;
	
	listQ = quiz.children;
	for (var i=0; i<listQ.length; i++) {
		if (listQ[i].id == currentQuiz) {
			numQuiz = listQ[i].count;
		}
	}
	
	var timeSpentSum = [];
	for (var i=0; i<numQuiz; i++) {
		timeSpentSum[i] = 0;
	}
	
	for (var i=0; i<listUQ.length; i++) {
		if (listUQ[i].id == currentUser && listUQ[i].quizid == currentQuiz) {
			curUQInd = i;
			timeSpent = listUQ[i].time_each;
			result = listUQ[i].correct;
		}
		if (listUQ[i].quizid == currentQuiz) {
			timeSpentAll.push(listUQ[i].time_each);
			resultAll.push(listUQ[i].correct);
			indAll.push(i);
			for (var j=0; j<numQuiz; j++) {
				timeSpentSum[j] += listUQ[i].time_each[j];
			}
		}
	}
	
	for (var i=0; i<numQuiz; i++) {
		average[i] = timeSpentSum[i] / timeSpentAll.length;
	}
	
	var mergedArr = [];
	for (var k=0; k<timeSpentAll.length; k++) {
		for (var i=0; i<numQuiz; i++) {
			mergedArr = mergedArr.concat(timeSpentAll[k][i]);
		}
	}
	for (var i=0; i<numQuiz; i++) {
		mergedArr = mergedArr.concat(average[i]);
	}
	minData = d3.min(mergedArr);
	maxData = d3.max(mergedArr);
	maxData += (maxData - minData) * 0.2;
	minData = 0;
}

function addSelectQuiz() {
	var str = "";
	str += "<dl>";
	for (var i=0; i<allCurQuiz.length; i++) {
		str += "<dt>" + allCurQuiz[i].date.toString().split("00:00:00")[0] + "</dt>";
		var active = (i == curQInd) ? "quiz-active" : "";
		str += "<dd><a href='#' class='quiz-links " + active + "' id='quiz-link-" + i +"'>" + "> " + allCurQuiz[i].quizid + "</a></dd>";
	}
	str += "</dl>";

	$("#left-nav").append(str);
}

function buildChartBase() {
	var svg = d3.select("#chart")
		.append("svg")
		.attr("width", w)
		.attr("height", h);
	
	chartBody = svg.append("g")
		.attr("id", "chartbody");
}

/* svg base for the info area */
function buildInfoBase() {
	var info = d3.select("#legend-svg")
		.append("svg")
		.attr("width", w_info)
		.attr("height", h);
	
	infoBody = info.append("g")
		.attr("id", "infobody");
	
	var meaninfo = d3.select("#legend-svg-mean")
		.append("svg")
		.attr("width", w_info)
		.attr("height", h);
	
	meaninfoBody = meaninfo.append("g")
		.attr("id", "meaninfoBody");
}

function addScale() {
	yScale = d3.scale.linear()
		.domain([minData, maxData])
		.nice()
		.range([h-margin.bottom, margin.top])
		.nice();
		
	yAxis = d3.svg.axis()
		.scale(yScale)
		.orient("left")
		.tickSize(-w);
		
	chartBody.append("g")
		.attr("class", "y axis")
		.call(yAxis)
		.attr("transform", "translate("+margin.left/2+", "+0+")");
}

function addXText() {
	chartBody.selectAll(".quiz-no")
		.data(timeSpent)
		.enter().append("text")
		.attr("class", "quiz-no")
		.attr("text-anchor", "middle")
		.attr("transform", function(d, i) {
			var x = margin.left + i * (w-margin.left-margin.right) / timeSpent.length;
			var y = h-margin.bottom/2;
			var width = (w-margin.left-margin.right)/timeSpent.length - barPadding;
			return "translate("+(x+width/2)+", "+y+")";
		})
		.text(function(d, i) {
			return "Q"+(i+1);
		});
}

function addYText() {
	chartBody.append("text")
		.attr("class", "y label")
		.text("Time Spent (seconds)")
		.attr("transform", "translate(" + (40-margin.left/2) + "," + (h/2+margin.bottom) + ")rotate(-90)");
}

function selectQuiz() {
	$(".quiz-links").click(function() {
		var ind = $(this).attr("id").split("-")[2];
		if (ind == curQInd) return;
		$("#quiz-link-"+curQInd).toggleClass("quiz-active");
		$(this).toggleClass("quiz-active");
		curQInd = ind;
		loadData();
		$("#chart svg").remove();
		buildChartBase();
		addScale();
		addXText();
		addYText();
		generateBars();
		removeBars();
		if (curMode == 0) generateBars();
		if (curMode == 1) generateScatters();
		if (!$("#legend-svg-mean").is(":hidden")) addMean();
		addQuizInfo();
	});
}

function selectMode() {
	$("#switch-img").click(function() {
		if (curMode == 0) curMode = 1;
		else curMode = 0;
		if (curMode == 0) changeToBarMode();
		else changeToScatterMode();
	});
	
	$("#switch-bar").click(function() {
		if (curMode == 0) return;
		curMode = 0;
		changeToBarMode();
	});
	
	$("#switch-scatter").click(function() {
		if (curMode == 1) return;
		curMode = 1;
		changeToScatterMode();
	});
}

function changeToBarMode() {
	$("#switch-img>img").attr("src", "assets/images/switch_flipped-small.jpg");
	$("#switch-bar").css("font-weight", "bold");
	$("#switch-scatter").css("font-weight", "normal");
	removeOtherLegend();
	removeScatters();
	generateBars();
}

function changeToScatterMode() {
	$("#switch-img>img").attr("src", "assets/images/switch-small.jpg");
	$("#switch-bar").css("font-weight", "normal");
	$("#switch-scatter").css("font-weight", "bold");
	addOtherLegend();
	removeBars();
	generateScatters();
}

function generateBars() {
	bars = chartBody.selectAll(".bars").data(timeSpent);
	
	bars.enter().append("rect")
		.attr("class", "bars")
		.attr("x", function(d, i) {
			return margin.left + i * (w-margin.left-margin.right) / timeSpent.length;
		})
		.attr("y", function(d) {
			return yScale(0);
		})
		.attr("rx", 6)
		.attr("ry", 6)
		.attr("width", (w-margin.left-margin.right)/timeSpent.length - barPadding)
		.attr("height", 0)
		.style("fill", function(d, i) {
			return barColor[result[i]];
		});
	
	bars.enter().append("text")
		.attr("class", "bar-values")
		.text(String)
		.attr("text-anchor", "middle")
		.attr("transform", function(d, i) {
			var x = margin.left + i * (w-margin.left-margin.right) / timeSpent.length;
			var y = yScale(0);
			var width = (w-margin.left-margin.right)/timeSpent.length - barPadding;
			return "translate("+(x+width/2)+", "+y+")";
		})
		.attr("font-size", "0px")
		.attr("font-weight", "bold")
		.style("fill", "white");
		
	d3.selectAll(".bars")
		.each(function(d, i) {
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("y", function(d) {
					return yScale(d);
				})
				.attr("height", function(d) {
					return yScale(0)-yScale(d);
				})
		});
	
	d3.selectAll(".bar-values")
		.each(function(d, i) {
			var n = i;
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("font-size", "small")
				.attr("transform", function(d, i) {
					var x = margin.left + n * (w-margin.left-margin.right) / timeSpent.length;
					var y = yScale(d)+20;
					var width = (w-margin.left-margin.right)/timeSpent.length - barPadding;
					return "translate("+(x+width/2)+", "+y+")";
				})
		});
}

function removeBars() {
	d3.selectAll(".bars")
		.each(function(d, i) {
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("y", function(d) {
					return yScale(0);
				})
				.attr("height", 0)
		});
	
	d3.selectAll(".bar-values")
		.each(function(d, i) {
			var n = i;
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("font-size", "0px")
				.attr("transform", function(d, i) {
					var x = margin.left + n * (w-margin.left-margin.right) / timeSpent.length;
					var y = yScale(0);
					var width = (w-margin.left-margin.right)/timeSpent.length - barPadding;
					return "translate("+(x+width/2)+", "+y+")";
				})
		});
}

function generateScatters() {
	var me;

	for (var k=0; k<timeSpentAll.length; k++) {
		if (indAll[k] == curUQInd) {
			me = k;
			continue;
		}
		
		chartBody.selectAll(".scatters-"+k)
			.data(timeSpentAll[k])
			.enter().append("path")
			.attr("class", "scatters-"+k)
			.attr("d", function(d, i) {
				if (resultAll[k][i] == 1) return "NaN";
				var leftx = margin.left + i * (w-margin.left-margin.right) / timeSpent.length;
				var width = (w-margin.left-margin.right)/timeSpent.length - barPadding;
				var posx = leftx + width/2;
				var posy = yScale(0);
				return "M"+posx+","+posy+"L"+posx+","+posy+"L"+posx+","+posy+"L"+posx+","+posy+"L"+posx+","+posy;
			})
			.style("stroke", "black")
			.style("fill", "yellow")
			.style("opacity", 0.5);
		
		d3.selectAll(".scatters-"+k)
			.each(function(d, i) {
				var n = i;
				if (resultAll[k][i] == 1) return;
				d3.select(this).transition()
					.duration(1000).delay(100*i).ease("elastic")
					.attr("d", function(d, i) {
						var leftx = margin.left + n * (w-margin.left-margin.right) / timeSpent.length;
						var width = (w-margin.left-margin.right)/timeSpent.length - barPadding;
						var centerx = leftx + width/2;
						var centery = yScale(d);
						var posx1 = centerx - 0.15 * width;
						var posy1 = centery;
						var posx2 = centerx;
						var posy2 = centery - 0.15 * width;
						var posx3 = centerx + 0.15 * width;
						var posy3 = centery;
						var posx4 = centerx;
						var posy4 = centery + 0.15 * width;
						return "M"+posx1+","+posy1+"L"+posx2+","+posy2+"L"+posx3+","+posy3+"L"+posx4+","+posy4+"L"+posx1+","+posy1;
					})
			});
	}
	
	chartBody.selectAll(".scatter-me-bars")
		.data(timeSpent)
		.enter().append("path")
		.attr("class", "scatters-"+me+" scatter-me-bars")
		.attr("d", function(d, i) {
			var posxl = margin.left + i * (w-margin.left-margin.right) / timeSpent.length;
			var posxr = margin.left + i * (w-margin.left-margin.right) / timeSpent.length + ((w-margin.left-margin.right)/timeSpent.length - barPadding);
			var posy = yScale(0);
			return "M" + posxl + "," + posy + "L" + posxr + "," + posy;
		})
		.style("stroke", function(d, i) {
			return barColor[result[i]];
		})
		.style("stroke-width", 2)
		.style("fill", "none");
	
	chartBody.selectAll(".scatters-me-marks")
		.data(timeSpent)
		.enter().append("circle")
		.attr("class", "scatters-"+me+" scatters-me-marks")
		.attr("cx", function(d, i) {
			return margin.left + i * (w-margin.left-margin.right) / timeSpent.length + ((w-margin.left-margin.right)/timeSpent.length - barPadding)/2;
		})
		.attr("cy", yScale(0))
		.attr("r", 0)
		.style("fill", function(d, i) {
			return barColor[result[i]];
		});
		
	d3.selectAll(".scatter-me-bars")
		.each(function(d, i) {
			var n = i;
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("d", function(d) {
					var posxl = margin.left + n * (w-margin.left-margin.right) / timeSpent.length;
					var posxr = margin.left + n * (w-margin.left-margin.right) / timeSpent.length + ((w-margin.left-margin.right)/timeSpent.length - barPadding);
					var posy = yScale(d);
					return "M" + posxl + "," + posy + "L" + posxr + "," + posy;
				})
		});
	
	d3.selectAll(".scatters-me-marks")
		.each(function(d, i) {
			var n = i;
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("cy", function(d) {
					return yScale(d);
				})
				.attr("r", function(d) {
					var width = (w-margin.left-margin.right)/timeSpent.length - barPadding;
					return 0.15 * width; 
				})
		});
}

function removeScatters() {
	var me;
	
	for (var k=0; k<timeSpentAll.length; k++) {
		if (indAll[k] == curUQInd) {
			me = k;
			continue;
		}
		
		d3.selectAll(".scatters-"+k)
			.each(function(d, i) {
				var n = i;
				d3.select(this).transition()
					.duration(1000).delay(100*i).ease("elastic")
					.attr("d", function(d, i) {
						var leftx = margin.left + n * (w-margin.left-margin.right) / timeSpent.length;
						var width = (w-margin.left-margin.right)/timeSpent.length - barPadding;
						var posx = leftx + width/2;
						var posy = yScale(0);
						return "M"+posx+","+posy+"L"+posx+","+posy+"L"+posx+","+posy+"L"+posx+","+posy+"L"+posx+","+posy;
					})
			});
	}
		
	d3.selectAll(".scatter-me-bars")
		.each(function(d, i) {
			var n = i;
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("d", function(d) {
					var posxl = margin.left + i * (w-margin.left-margin.right) / timeSpent.length;
					var posxr = margin.left + i * (w-margin.left-margin.right) / timeSpent.length + ((w-margin.left-margin.right)/timeSpent.length - barPadding);
					var posy = yScale(0);
					return "M" + posxl + "," + posy + "L" + posxr + "," + posy;
				})
		});
	
	d3.selectAll(".scatters-me-marks")
		.each(function(d, i) {
			var n = i;
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("cy", yScale(0))
				.attr("r", 0)
		});
}

function addMean() {
	meanBars = chartBody.selectAll(".mean-bars").data(average);
	meanMarks = chartBody.selectAll(".mean-marks").data(average);
		
	meanBars.enter().append("path")
		.attr("class", "mean-bars")
		.attr("d", function(d, i) {
			var posxl = margin.left + i * (w-margin.left-margin.right) / timeSpent.length;
			var posxr = margin.left + i * (w-margin.left-margin.right) / timeSpent.length + ((w-margin.left-margin.right)/timeSpent.length - barPadding);
			var posy = yScale(0);
			return "M" + posxl + "," + posy + "L" + posxr + "," + posy;
		})
		.style("stroke", "blue")
		.style("stroke-width", 2)
		.style("fill", "none");
	
	meanMarks.enter().append("circle")
		.attr("class", "mean-marks")
		.attr("cx", function(d, i) {
			return margin.left + i * (w-margin.left-margin.right) / timeSpent.length + ((w-margin.left-margin.right)/timeSpent.length - barPadding)/2;
		})
		.attr("cy", yScale(0))
		.attr("r", 0)
		.style("fill", "blue");
		
	d3.selectAll(".mean-bars")
		.each(function(d, i) {
			var n = i;
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("d", function(d) {
					var posxl = margin.left + n * (w-margin.left-margin.right) / timeSpent.length;
					var posxr = margin.left + n * (w-margin.left-margin.right) / timeSpent.length + ((w-margin.left-margin.right)/timeSpent.length - barPadding);
					var posy = yScale(d);
					return "M" + posxl + "," + posy + "L" + posxr + "," + posy;
				})
		});
		
	d3.selectAll(".mean-marks")
		.each(function(d, i) {
			var n = i;
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("cy", function(d) {
					return yScale(d);
				})
				.attr("r", function(d) {
					var width = (w-margin.left-margin.right)/timeSpent.length - barPadding;
					return 0.1 * width;
				})
		});
}

function removeMean() {
	d3.selectAll(".mean-bars")
		.each(function(d, i) {
			var n = i;
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("d", function(d) {
					var posxl = margin.left + n * (w-margin.left-margin.right) / timeSpent.length;
					var posxr = margin.left + n * (w-margin.left-margin.right) / timeSpent.length + ((w-margin.left-margin.right)/timeSpent.length - barPadding);
					var posy = yScale(0);
					return "M" + posxl + "," + posy + "L" + posxr + "," + posy;
				})
		});
	
	d3.selectAll(".mean-marks")
		.each(function(d, i) {
			d3.select(this).transition()
				.duration(1000).delay(100*i).ease("elastic")
				.attr("cy", yScale(0))
				.attr("r", 0)
		});
}

/* draw legend in the info area */
function drawLegend() {
	var legend = infoBody.selectAll(".legend")
		.data(legendData)
		.enter().append("g")
		.attr("class", "legend")
		.attr("transform", "translate(" + 0.02*(w_info) + ", " + 10 + ")");
	
	legend.append("rect")
		.attr("id", "legend")
		.attr("width", 0.9 * (w_info))
		.attr("height", 30 * (legendData.length-1))
		.style("stroke", "black")
		.style("fill", "none");
	
	legend.append("rect")
		.attr("class", "legend-color")
		.attr("rx", 6)
		.attr("ry", 6)
		.attr("width", function(d, i) { if (i < 2) return 20; })
		.attr("height", function(d, i) { if (i < 2) return 20; })
		.attr("transform", function(d, i) {
			return "translate(" + 0.045*(w_info) + ", " + (5+30*i) + ")";
		})
		.style("fill", function(d, i) {
			return barColor[i];
		});
	
	legend.append("text")
		.attr("class", "legend-text")
		.attr("transform", function(d, i) {
			return "translate(" + (20+0.09*(w_info)) + ", " + (20+30*i) + ")";
		})
		.text(String)
		.style("fill", function(d, i) {
			return barColor[i];
		})
		.style("display", function(d, i) {
			if (i >= 2) return "none";
		});
		
	var meanlegend = meaninfoBody.selectAll(".legend")
		.data(legendData)
		.enter().append("g")
		.attr("class", "legend")
		.attr("transform", "translate(" + 0.02*(w_info) + ", " + 10 + ")");
	
	meanlegend.append("rect")
		.attr("id", "legend")
		.attr("width", 0.9 * (w_info))
		.attr("height", 30)
		.style("stroke", "black")
		.style("fill", "none");
	
	meanlegend.append("path")
		.attr("id", "mean-bar-legend")
		.attr("d", function(d, i) {
			if (i < 2) return;
			var posxl = 0.045*(w_info);
			var posxr = posxl + 20;
			var posy = 5 + 10;
			return "M" + posxl + "," + posy + "L" + posxr + "," + posy;
		})
		.style("stroke", "blue")
		.style("stroke-width", 2)
		.style("fill", "none");
	
	meanlegend.append("circle")
		.attr("id", "mean-mark-legend")
		.attr("cx", 0.045*(w_info)+10)
		.attr("cy", 5+10)
		.attr("r", function(d, i) { if (i < 2) return 0; else return 3; })
		.style("fill", "blue");
	
	meanlegend.append("text")
		.attr("class", "legend-text")
		.attr("transform", "translate(" + (20+0.09*(w_info)) + ", " + 20 + ")")
		.text(String)
		.style("fill", function(d, i) {
			return barColor[i];
		})
		.style("display", function(d, i) {
			if (i < 2) return "none";
		});
}

function addOtherLegend() {
	var legend = d3.select("#infobody").append("g")
		.attr("class", "legend")
		.attr("id", "legend-others-id")
		.attr("transform", "translate(" + 0.02*(w_info) + ", " + 10 + ")");
		
	legend.append("path")
		.attr("class", "legend-color")
		.attr("id", "legend-others")
		.attr("d", "M"+w_info/2+","+(5+10)+"L"+(w_info/2+10)+","+5+"L"+(w_info/2+20)+","+(5+10)+"L"+(w_info/2+10)+","+(5+10+10)+"L"+w_info/2+","+(5+10))
		.style("stroke", "black")
		.style("fill", "yellow")
		.style("opacity", 0.5);
	
	legend.append("text")
		.attr("class", "legend-other-text")
		.attr("transform", "translate(" + (w_info/2+20+0.09*w_info-10) + "," + 20 + ")")
		.text("Others")
		.style("fill", "black")
		.style("opacity", 0.5);
}

function removeOtherLegend() {
	d3.select("#legend-others-id").remove();
}

/* toggle the average data viewing */
function toggleButton() {
	$("a#toggle-avg").click(function() {
		$(this).toggleClass("down");
		if ($("#legend-svg-mean").is(":hidden")) {
			$("#legend-svg-mean").slideDown("slow");
			addMean();
		} else {
			$("#legend-svg-mean").slideUp("slow");
			removeMean();
		}
	});
}

function addQuizInfo() {
	var overallTime = 0;
	var numWrong = 0;
	for (var i=0; i<timeSpent.length; i++) {
		overallTime += timeSpent[i];
		numWrong += result[i];
	}
	
	$(".info-label").remove();

	var str = "";
	str += "<div class='info-label' id='info-quizid'><b>QuizID: </b>" + currentQuiz + "</div>";
	str += "<div class='info-label' id='info-date'><b>Date Taken: </b>" + currentQuizDate.toString().split("00:00:00")[0] + "</div>";
	str += "<div class='info-label' id='info-overalltime'><b>Time Spent: </b>" + overallTime + " seconds</div>";
	str += "<div class='info-label' id='info-correct'><b>Correct: </b>" + (numQuiz-numWrong) + "</div>";
	str += "<div class='info-label' id='info-incorrect'><b>Incorrect: </b>" + numWrong + "</div>";
	str += "<div class='info-label' id='info-verdict'><b>Our Verdict: </b>" + "</div>";

	$("#quiz-info").append(str);
}