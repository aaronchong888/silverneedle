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
            temp = temp + "<img src=\"images/apple.jpg\" alt=\"Apple\" style=\"width:200px;height:200px;\"><br>";
            temp = temp + "Description: <br>" + data["description"]["tags"] +"<br>";
            temp = temp + "Caption: <br>" + data["description"]["captions"][0]["text"] +"<br>";
            /*for (var i = 0; i < data.length; i++) {
                temp = temp + "  " + key2 + " : " + data[key][key2] +"<br>";
            };
            Object.keys(data).forEach(function(key) {
              temp = temp + key + " : " + data[key] +"<br>";
              Object.keys(data[key]).forEach(function(key2) {
                temp = temp + "  " + key2 + " : " + data[key][key2] +"<br>";
              });
            });
*/
            a.innerHTML = temp;
        })
        .fail(function() {
            alert("error");
        });
}
/*
function updateProfile(){
  
  // TODO: 1. Retrive the nick name, gender and brief introduction
  //          from the input elements with id "nickNameInputBox", 
  //          "genderInputBox" and "briefIntroInputBox", repectively. 
  var nickname = document.getElementById("nickNameInputBox");
  var gender = document.getElementById("genderInputBox");
  var intro = document.getElementById("briefIntroInputBox");
  var xmlhttp;
  if (window.XMLHttpRequest) {
    xmlhttp = new XMLHttpRequest();
  } else {
    xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
  }

  xmlhttp.onreadystatechange = function () {
    if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
      // TODO: 3. Replace the innerHTML of the <h3 id="heading"> element 
      //          with responseText. Then set a "style" attribute
      //          in the <h3 id="heading"> element with value of "color:red;".
      //			    Hint: use "setAttribute()" http://www.w3schools.com/jsref/met_element_setattribute.asp
		var a = document.getElementById("heading");
		a.innerHTML = xmlhttp.responseText;
		a.setAttribute("style", "color:red;");
    }
  }

  // TODO: 2. Generate the HTTP GET request, carrying 3 key-value pairs corresponding to
  //          "nickName", "gender" and "briefIntro"
  xmlhttp.open("GET", "handleUpdate.php?nickName="+ nickname.value+ "&gender="+ gender.value+ "&briefIntro="+ intro.value, true);
  xmlhttp.send();
}

function inputCheck(){

  // TODO: Check the input gender value in the input element with ID "genderInputBox":
  //       if the input value is not "F" nor "M" nor "", show an alert box with the message "Gender should be either F or M"
  //	     and refocus the cursor on the gender input box
	var gender = document.getElementById("genderInputBox");
	if (gender.value !== "F" && gender.value !== "M" && gender.value !== ""){
		alert("Gender should be either F or M");
		gender.focus();
		return false;
	}
}
*/