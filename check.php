<?php if (!isset($_GET["id"]) || $_GET["id"] != "237172") die() ?>
<!DOCTYPE html>
<html>
<body style="font-size:2em;">
<p>You have:</p>
<ul id="list">
</ul>
<audio id="audio" src="http://www.soundjay.com/button/button-7.wav" autostart="false" ></audio>
<script type="text/javascript">
    function getMilliseconds(minutes) {
		return minutes * 60 * 1000;
	}
	function Group(name,gender) {
		var groupId = name + gender;
		var name = name;
		var gender = gender;
		var count = 0;
		this.getGroupId = function() { return groupId },
		this.getName = function() { return name },
		this.getGender = function() { return gender },
		this.getCount = function() { return count },
		this.setCount = function(newCount) { count = newCount };
	}
	function getIndex(group,groups) {
		for (i = 0; i < groups.length; i++) {
			if (groups[i].getGroupId() == group.getGroupId()) return i;
		}
		return -1;
	}
	
	var groupsName = ["game","website"];
	var groups = [];
	var j = 0;
	for (i = 0; i < groupsName.length; i++) {
		groups[j++] = new Group(groupsName[i],"men");
		groups[j++] = new Group(groupsName[i],"women");
	}
	list = document.getElementById("list");

	getValues();
	setInterval(function() {
		getValues();
	}, getMilliseconds(5));
	function getValues() {
		for (i = 0; i < groups.length; i++) {
			getValue(groups[i]);
		}
	}
	function getValue(group) {
		index = getIndex(group,groups);
		column = index + 4;
		url = "https://spreadsheets.google.com/feeds/cells/1cxCYMQik_bZEyYzhTOk_C3A8uEtdfJ4YV87eEgYI5mI/od6/public/values/R1C" + column + "?alt=json-in-script&callback=sheetLoaded"
		var http = new XMLHttpRequest();
		http.open("GET",url,true);
		http.send();
		http.onreadystatechange = function () {
			if (http.readyState == 4 && http.status == 200) {
				str = http.responseText
				sheet = str.substr(28,str.length - 30);
				obj = JSON.parse(sheet);
				if (obj.entry.content.$t > group.getCount()) {
					count = obj.entry.content.$t;
					group.setCount(count);
					item = document.getElementById(group.getGroupId());
					if (item == null) {
						item = document.createElement('li');
						item.id = group.getGroupId();
						list.appendChild(item);
					}
					else item = document.createElement('li');
					text = group.getCount() + " " + group.getGender() + " in the " + group.getName() + " group.";
					item.textContent = text;
					document.getElementById("audio").play();
				}
			} 
		};
	}
	function sheetLoaded(spreadsheetdata) {
		return true;
	}
</script>
 
</body>
</html>
