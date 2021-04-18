<html>
	<head>
		<style>

			@font-face {
				font-family: 'Minecraftia';
				src: url("/assets/fonts/Minecraftia-Regular.ttf") format("truetype");
				font-weight: normal;
				font-style: normal;
			}

			body {
				margin: 0px !important;
				padding: 0px !important;
				font-family: "Minecraftia" !important;
				background: #202225;
				overflow: hidden;
			}
			ul {
				list-style: none;
			}
			.wrapper{ 
				color: #ffffff;
				overflow: hidden;
			}

			.top {
				position: fixed;
				height: 72px;
				width: 100vw;
				background: #7289da;
				z-index: 100;
			}

			.top_logo {
				-webkit-transition: opacity .25s ease-out;
				background: url("https://www.iloot.it/assets/images/Discord_widget/Discord_Logo.png");
				background-size: 198px 64px;
				height: 64px;
				width: 198px;
				position: absolute;
				left: 6px;
				top: 6px;
			}

			.top_online {
				position: absolute;
				right: 6px;
				top: 22px;
			}
			.middle {
				position: absolute;
				top: 72px;
				overflow-y: scroll;
				width: 100vw;
				height: calc(100vh - 72px - 32px);
			}
			.users {
				position: absolute;
				left: 22px;
			}

			.user--image {
				width: 64px;
				height: 64px;
			}


		</style>
<div class="wrapper">
	<div class="top">
		<div class="top_logo"></div>
		<div id="set_online" class="top_online"></div>
	</div>
	<div class="middle">
		<div class="channels">

		</div>

		<div class="users">
			<div class="users--header">MEMBERS ONLINE</div>
		</div>
		
	</div>
	<div class="footer">
		<div class="footer_text"> Free voice chat from Discord</div>
		<div class="footer_connect">Connect</div>
	</div>
</div>







<script>
var channelBody = document.querySelector('.channels');
var userBody = document.querySelector('.users');



function discordAPI(){
  var init = {
    method: 'GET',
    mode: 'cors',
    cache: 'reload'
  }
  fetch('https://discordapp.com/api/guilds/355981469744889856/widget.json', init).then(function(response){
    if(response.status != 200){
      console.log("it didn't work" + response.status);
      return
    }
    response.json().then(function(data){
      //var channels = data.channels;
      var users = data.members;
      var serverName = data.name;

      let liWrap = document.createElement('ul');
      liWrap.classList.add('channels--list--wrap');


      function channelsFill(){
        for(let i = 0; i<data.channels.length; i++){
          let li = document.createElement('li');
          li.classList.add('channel--name');
          li.innerText = data.channels[i].name;
          liWrap.appendChild(li);
          channelBody.appendChild(liWrap) ;
        }
      }


      function usersFill(){
	var online = 0;
        for(let n = 0;n < data.members.length; n++){
          online = online + 1;
          let userWrap = document.createElement('div');
          let userName = document.createElement('span');
          let userImage = document.createElement('img');
          let userGame = document.createElement('span');
          let userStatus = document.createElement('div');
          let imageWrap = document.createElement('div');
          let botTag = document.createElement('div');
          userWrap.classList.add('user');
          
          userName.classList.add('username');
          
          userStatus.classList.add('user--status');
          
          imageWrap.classList.add('image--wrap');
          
          userGame.classList.add('user--game');
          
          botTag.classList.add('bot--tag');
          
          
          botTag.innerText = 'BOT';
          

          if(users[n].nick === undefined){
            userName.innerText = users[n].username;
          }else{
            userName.innerText = users[n].nick;
          }
          
          if(users[n].status === 'online'){
            userStatus.classList.add('status--online')
          }
          if(users[n].status === 'idle'){
            userStatus.classList.add('status--idle');
          }
          if(users[n].status ==='dnd'){
            userStatus.classList.add('status--dnd');
          }
          
          if(users[n].bot === true){
            
            userWrap.appendChild(botTag);
          }
          
          if(users[n].game !== undefined){
                      
            userGame.innerText = users[n].game.name;
          }
          
          userWrap.appendChild(userGame);
          userImage.classList.add('user--image');
          userImage.setAttribute('src', data.members[n].avatar_url);
          
          imageWrap.appendChild(userStatus);
          imageWrap.appendChild(userImage)
          userWrap.appendChild(imageWrap);
          userWrap.appendChild(userName);
         
          userBody.appendChild(userWrap);

        }
	document.getElementById("set_online").innerHTML = "<b>" + online + " </b> Online";
      }      

      channelsFill();
      usersFill();
    })
  })
    .catch(function(err){
    console.log('fetch error: ' + err)
  })


}
discordAPI()
</script>
