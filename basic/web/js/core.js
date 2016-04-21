qwerty.addEventListener("submit", function(e) {
    console.warn("qwerty submit");
    
    var token = document.querySelector('meta[name="csrf-token"]');
    console.warn(token.content);
    
    var req = new XMLHttpRequest();
    req.onprogress = onProgress;
    req.open("POST", "http://mapleframe.ru/site/qwerty.html", true);
    req.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
    req.setRequestHeader("X-CSRF-TOKEN", token.content);
    req.onload = onLoad;
    req.onerror = onError;
    
    req.onreadystatechange = function (aEvt) {
        if (req.readyState == 4) {
            if (req.status == 200) {
                console.log(req.responseText);
            }
            else {
                console.log("Error loading page\n");
            }
        }
    };

    req.send(JSON.stringify({
        title:"qwerty1",
        description:"qwerty description"
    }));

    e.preventDefault();
}, false);




function onProgress(e) {
  var percentComplete = (e.position / e.totalSize) * 100;
}

function onError(e) {
  alert("Error " + e.target.status + " occurred while receiving the document.");
}

function onLoad(e) {}

