(function() {
	// object for storing participants attending event
	var data = {};
	data.assigned   = {};
	data.unassigned = {};
	
	// participant class
	function Participant(id, first, last, table, seat) {
		this.id    = id;
		this.first = first;
		this.last  = last;
		this.table = table;
		this.seat  = seat;
	}
	
	// assigns participant to table and seat
	// removes name from unordered list
	Participant.prototype.assign = function(seat, data) {
		var table = seat.parentElement;
		var span  = seat.firstElementChild;
		var icon  = span.firstElementChild;
		var text  = document.createTextNode(this.first + " " + this.last);
		
		span.appendChild(text);
		icon.className = "fas fa-minus-circle";
		seat.setAttribute("title", "unassign");
		seat.setAttribute("data-id", this.id);
		
		this.table = table.id.replace("table-", "");
		this.seat  = seat.className.replace("seat-", "");
		
		data.assigned[this.id] = this;
		delete data.unassigned[this.id];
	}
	
	// removes participant from table and seat
	// returns name to unordered list
	Participant.prototype.unassign = function(seat, data) {
		var span  = seat.firstElementChild;
		var icon  = span.firstElementChild;
		
		span.removeChild(span.lastChild);
		icon.className = "fas fa-plus-circle";
		seat.setAttribute("title", "assign");
		seat.removeAttribute("data-id");
		this.table = null;
		this.seat  = null;
		
		data.unassigned[this.id] = this;
		delete data.assigned[this.id];
	}	
	
	// json data from server
	json.forEach(function(dancer) {
		// initial assignment of seats from database
		if (dancer.table_number && dancer.seat_number) {
			var p    = new Participant(dancer.ID, dancer.first, dancer.last, dancer.table_number, dancer.seat_number);
			var seat = document.querySelector("#table-"+dancer.table_number+" .seat-"+dancer.seat_number);
			p.assign(seat, data);
		}
		// initial values for unordered list from database
		else {
			data.unassigned[dancer.ID] = new Participant(dancer.ID, dancer.first, dancer.last, null, null);
		}
	});
	
	// fills unordered list with latest unassigned participants
	// called each time participant is assigned or unassigned
	function fillList(list, obj) {
		// clear all unordered list items except first (unassigned heading)
		for (var i=list.children.length-1; i>0; i--) {
			list.removeChild(list.children[i]);
		}

		// get array of unassigned object values
		var arr = Object.values(obj);

		// sort array by last name, then first name
		arr.sort(function(a, b) {
			a = a.last.toLowerCase();
			b = b.last.toLowerCase();
			
			if (a === b) {
				a = a.first.toLowerCase();
				b = b.first.toLowerCase();
				if (a > b) return 1;
				if (a < b) return -1;
				return 0;
			}
			else {
				if (a > b) return 1;
				if (a < b) return -1;
			}
		});

		// add unassigned participants to unordered list as list item containing radio button and label
		arr.forEach(function(obj, ndx) {
			var li   = document.createElement("li");
			var lbl  = document.createElement("label");
			var rb   = document.createElement("input");
			rb.type  = "radio";
			rb.name  = "participants"
			rb.id    = "rb" + ndx;
			rb.value = obj.id;
			
			// check first radio button by default to make it highlighted
			if (ndx === 0) {
				rb.checked = true;
			}
			
			lbl.setAttribute("for", rb.id);
			lbl.innerHTML = obj.first + " " + obj.last;			
			li.appendChild(rb);
			li.appendChild(lbl);
			list.appendChild(li);
		});
		
		// hide unordered list when all participants are assigned
		if (arr.length > 0) {
			list.style.display = "block";
		}
		else {
			list.style.display = "none";
		}		
		
		// hidden field for storing assignments to post to server
		var hdn = document.getElementById("seating");
		hdn.value = encodeURIComponent(JSON.stringify(Object.assign(data.assigned, data.unassigned)));
	}
	
	// method that determines seat assignment or unassignment of participant
	function toggleSeat(seat, list) {
		var title   = seat.getAttribute("title");
		var checked = list.querySelector('input[name=participants]:checked');
		var id      = title === "assign" ? (checked ? checked.value : "") : seat.getAttribute("data-id");

		// exit if no participant selected prior to clicking assignment
		if (id.length === 0) {
			return;
		}
		
		var participant = title === "assign" ? data.unassigned[id] : data.assigned[id];
		
		// call assign or unassign method of Participant class
		participant[title](seat, data);

		// update unordered list with remaining unassigned participants
		fillList(list, data.unassigned);
	}

	var list  = document.getElementById("unassigned");
	var seats = document.querySelectorAll("[class^='seat-']");

	// add click event to all seats
	for (var i=0; i<seats.length; i++) {
		seats[i].addEventListener("click", toggleSeat.bind(this, seats[i], list));
	}

	// display all unassigned participants
	fillList(list, data.unassigned);
})();