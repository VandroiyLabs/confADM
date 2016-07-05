$(document).ready(function() {
	
	var toggle = function(direction, display) {
	return function() {
		var self = this;
		var ul = $("ul", this);
		if( ul.css("display") == display && !self["block" + direction] ) {
				self["block" + direction] = true;
				ul["slide" + direction]("slow", function() {self["block" + direction] = false;});
		}
	 };
	}
	$("li.menu").hover(toggle("Down", "none"), toggle("Up", "block"));
	$("li.menu ul").hide();
});

$(document).ready(function(){
/*	
	$("a").click(function(event){
		alert("As you can see, the link no longer took you to jquery.com");
		event.preventDefault();
	});
*/
});
