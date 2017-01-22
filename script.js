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
      Cookies.set('energy', 0, { expires: 7 });
      Cookies.set('protein', 0, { expires: 7 });
      Cookies.set('fat', 0, { expires: 7 });
      Cookies.set('sugar', 0, { expires: 7 });
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

        $.ajax({
            url: "https://westus.api.cognitive.microsoft.com/vision/v1.0/analyze?" + $.param(params),
            beforeSend: function(xhrObj){
                // Request headers
                xhrObj.setRequestHeader("Content-Type","application/json");
                xhrObj.setRequestHeader("Ocp-Apim-Subscription-Key","bdfa4eea082d4d759fae63b21b478c6e");
            },
            type: "POST",
            // Request body
            data: "{\"url\":\"http://silverneedle.azurewebsites.net/images/"+fu1+"\"}",
        })
        .done(function(data) {
            alert("success");
            var a = document.getElementById("result");
            temp = "<h2 class='heading'>Result</h2><br>";
            temp = temp + "<img id=\"target_pic\" style=\"width:200px;height:200px;\" src=\"http://silverneedle.azurewebsites.net/images/"+fu1+"\"><br>";
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
  var fu1 = document.getElementById("target_pic").src;
  if (fu1.localeCompare("http://silverneedle.azurewebsites.net/images/apple.jpg") == 0){
    food_id = "09003";
  } else if (fu1.localeCompare("http://silverneedle.azurewebsites.net/images/cake.jpeg") == 0){
    food_id = "18086";
  } else if (fu1.localeCompare("http://silverneedle.azurewebsites.net/images/spaghetti.jpg") == 0){
    food_id = "06233";
  }
  alert(food_id);

  $.get( "http://api.nal.usda.gov/ndb/reports/?ndbno="+food_id+"&type=b&format=json&api_key=7zFPyRh49yeSbG1RARODB9db2td0lHf3uoxNecfl", function() {
  })
  .done(function(data) {
    alert("success!");
    var a = document.getElementById("result");
    temp = "<h2 class='heading'>Result</h2><br>";
    temp += "<img style=\"width:200px;height:200px;\" src=\""+fu1+"\"><br>";
    temp += "<div class=\"result_text\">"
    temp += data["report"]["food"]["name"] + "<br><br>";
    temp += "<table>"
    for (var i = 0; i < data["report"]["food"]["nutrients"].length; i++){
      var obj = data["report"]["food"]["nutrients"][i];
      temp += "<tr><td>" + obj["name"] + "</td><td>" + obj["value"] + "g</td></tr>";
      new_energy = Cookies.get('energy');
      new_protein = Cookies.get('protein');
      new_fat = Cookies.get('fat');
      new_sugar = Cookies.get('sugar');
      Cookies.set('energy', new_energy);
      Cookies.set('protein', new_protein);
      Cookies.set('fat', new_fat);
      Cookies.set('sugar', new_sugar);
      alert(Cookies.get('energy'));
    }
    temp = temp + "</table></div>"
    a.innerHTML = temp;
  })
  .fail(function() {
    alert("error!");
  });
}
