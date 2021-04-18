var keys = "";

document.addEventListener('keydown', function(event) {
    keys = keys + event.keyCode
	if(keys == "877373838079828483"){
		playSound("/wii.mp3");
	}
	if(keys == "83775452"){
		playSound("/sm64.mp3");
	}

	if(keys.length >= 1000){
		keys = "";
	}
}, true);

function playSound(url){
  var audio = document.createElement('audio');
  audio.style.display = "none";
  audio.src = url;
  audio.autoplay = true;
  audio.onended = function(){
    audio.remove()
  };
  document.body.appendChild(audio);
}
