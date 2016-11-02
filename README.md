Welcome to **browser-spy**. This is a plugin intended to monitorize the activity of a user in his browser through screenshots and keylogging (it is still being developed, but it is functional as it is).

**Requirements & Installation**

 - **Backend**
	 - **PHP**
		 - _Requirements:_
			 - An [Apache](https://www.apache.org/) working installation.
			 - A [PHP](http://php.net/) working installation.
			 - Note: you can accomplish both requirements installing some bundle like [XAMPP](https://www.apachefriends.org/es/index.html) for example.
		 - _Installation_:
			 - Put the content of   `server/php` in a folder where could be reachable through a browser. 
			 - The data collected by the plugin (installed in one or more browsers and pointing at least one of them to this PHP backend installation) will be saved in the `server/php/db/users` folder (one folder per nick/user registered).
 - **Plugin**
	 - **Google Chrome**
		 - In the file `plugin/chrome/main.js`, initialize the array variable `hosts`with a list of base URLs where the collected data is going to be sent to. Initialize the `id_u` variable with a unique nickname for you monitorized browser user.
		 - Check the instructions given in this [link](https://developer.chrome.com/extensions/getstarted#unpacked) and apply them to the `plugin/chrome` folder.