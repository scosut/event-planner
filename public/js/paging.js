(function() {
	function deactivateLinks(links) {
		for (var i=0; i<links.length; i++) {
			links[i].className = "";
		}
	}
	
	function hidePages(pages) {	
		for (var i=0; i<pages.length; i++) {
			pages[i].style.display = "none";
		}
	}

	function displayPage(num, links, pages, e) {
		if (e) {
			e.preventDefault();
		}

		hidePages(pages);
		deactivateLinks(links);
		
		var tbl = document.getElementById("page-"+num.toString());

		if (tbl) {
			tbl.style.display = "table";
			e.target.className = "active";
		}
	}

	var links = document.querySelectorAll(".dashboard-pages li a");	
	var pages = document.querySelectorAll("[id^=page-]");

	for (var i=0; i<links.length; i++) {
		var num = links[i].getAttribute("data-page");
		links[i].addEventListener("click", displayPage.bind(this, num, links, pages));
	}

	links[0].click();
})();