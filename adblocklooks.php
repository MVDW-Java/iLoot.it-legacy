<script
  src="https://code.jquery.com/jquery-3.3.1.js"
  integrity="sha256-2Kok7MbOyxpgUVvAk/HJ2jigOSYS2auK4Pfzbm7uH60="
  crossorigin="anonymous"></script>

<style>
body{
  margin: 0;
  padding: 0;
}
</style>

<script>
$(document).ready(function(){
 var source = "music.mp3"
 var audio = document.createElement("audio");
 var audioloop = true;

 audio.autoplay = true;

 setInterval(function(){

if(audioloop){
blink()
}

}, 1500);
                
              
    function blink() {
        $(".connect").fadeTo(500, 0.5).fadeTo(1000, 1.0);
    }


 //
 audio.load()
 audio.addEventListener("load", function() { 
        audio.src = source;
     audio.play(); 
 }, true);

audio.addEventListener('ended', function(){
        audio.src = source;

        audio.play(); 
}, false);


audio.addEventListener('timeupdate', function(){
               var buffer = .44
                if(audio.currentTime > this.duration - buffer){
                   audio.currentTime = 0
                    audio.play()
}
                }, false);
 
        audio.src = source;
});
function resize() {
	$("#frame").css("width","100% !important");
  }
</script>
<body>
<iframe id="frame" onresize="resize()" src="https://youtube.com" style="width:100%; !important; height:100%; border:none;" >Your browser doesn't support iFrames.</iframe>