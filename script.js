function login(){
  var xmlhttp;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
	  if (xmlhttp.responseText === "invalidUserNamePassword"){
		  var a = document.getElementById("loginError");
		  a.innerHTML = "<h3>Invalid user name or password.</h3>";
	  } else {
      window.location.reload();
	  }
    }
  }

  // TODO: 1. Retrieve the input user name and password from the
  //          input elements with id "loginUserName" and "loginPassword". 
	var uname = document.getElementById("loginUserName");
	var upw = document.getElementById("loginPassword");

  // TODO: 2. Send an HTTP GET request to retrieve handleLogin.php, which should carry 2 
  //          key-value pairs corresponding to "userName" and "password". 
	xmlhttp.open("GET", "handleLogin.php?userName="+ uname.value+ "&password="+ upw.value, true);
	xmlhttp.send();
}

 function upload() {
        var params = {
            // Request parameters
            "visualFeatures": "Description",
            "language": "en",
        };
        var fu1 = document.getElementById("FileUpload").value.split(/(\\|\/)/g).pop();
        alert("You selected " + fu1);

        $.ajax({
            url: "https://westus.api.cognitive.microsoft.com/vision/v1.0/analyze?" + $.param(params),
            beforeSend: function(xhrObj){
                // Request headers
                xhrObj.setRequestHeader("Content-Type","application/json");
                xhrObj.setRequestHeader("Ocp-Apim-Subscription-Key","bdfa4eea082d4d759fae63b21b478c6e");
            },
            type: "POST",
            // Request body
            data: "{\"url\":\"http://silverneedle.azurewebsites.net/images/apple.jpg\"}",
        })
        .done(function(data) {
            alert("success");
            var a = document.getElementById("result");
            temp = "<h2 class='heading'>Result</h2><br>";
            temp = temp + "<img src=\"http://silverneedle.azurewebsites.net/images/apple.jpg\" alt=\"Apple\" style=\"width:200px;height:200px;\"><br>";
            temp = temp + "<div class=\"result_text\">"
            temp = temp + "<br>Description: <br>";
            tag = data["description"]["tags"].toString().split(',');
            tag.forEach(function(entry, idx, array){
              temp += "<a onclick=\"query()\">" + entry + "</a>";
              if (idx !== array.length - 1){ 
                temp += ", ";
              }
            });
            temp = temp + "<br><br>";
            temp = temp + "Caption: <br>" + data["description"]["captions"][0]["text"] +"<br><br>";
            temp = temp + "</div>"
            a.innerHTML = temp;
        })
        .fail(function() {
            alert("error");
        });
}

function query(){
  $.get( "http://api.nal.usda.gov/ndb/reports/?ndbno=09003&type=b&format=json&api_key=7zFPyRh49yeSbG1RARODB9db2td0lHf3uoxNecfl", function() {
  })
  .done(function(data) {
    alert("success!");
    var a = document.getElementById("result");
    temp = "<h2 class='heading'>Result</h2><br>";
    temp += "<img src=\"http://silverneedle.azurewebsites.net/images/apple.jpg\" alt=\"Apple\" style=\"width:200px;height:200px;\"><br>";
    temp += "<div class=\"result_text\">"
    temp += data["report"]["food"]["name"] + "<br><br>";
    temp += "<table>"
    for (var i = 0; i < data["report"]["food"]["nutrients"].length; i++){
      var obj = data["report"]["food"]["nutrients"][i];
      temp += "<tr><td>" + obj["name"] + "</td><td>" + obj["value"] + "g</td></tr>"
    }
    temp = temp + "</table></div>"
    a.innerHTML = temp;
  })
  .fail(function() {
    alert("error!");
  });
}
