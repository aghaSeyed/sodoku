<!DOCTYPE HTML>
<html>
   <head>
      <title>SUDOKU GENERATOR</title>
      <style type="text/css">
         .sudoku {
         margin: 0 auto;
         margin-top: 100px;
         }
         .inline {
         display: inline-block;
         padding: 15px;
         float: left;
         }
      </style>
   </head>
   <body>
      <h1>You are Hojat</h1>
      <div id="root"></div>
      <div class="sudoku">
         <div class="inline" id="ps">
            <div id="in">
               <h3>THE PUZZLE</h3>
            </div>
         </div>
         <div class="inline">
            <h3>Message</h3>
            <h2 id="mess"></h2>
            <div id="message_box"></div>
         </div>
         <div class="inline">
            <h3>Score</h3>
            <div id="score"></div>
         </div>
      </div>
      <button type="button" id="clk2">Disconnect!</button>
      <input id="i"  placeholder="i" required> 
      <input id="j"  placeholder="j" required>
      <input id="num"  placeholder="number" required>
      <button id="sub">Submit</button>
      <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
      <script type="text/javascript" src="sc\node_modules\jquery-simple-websocket\src\jquery.simple.websocket.js"></script>
      <script type="text/javascript">
         function turn(msg){
         	msg = msg.split(":");
         	var name = msg[0];
         	console.log(name);
         	if(name == "hojat")
         	{
         		$("#sub").prop('disabled', true);
         	}
         	if(name == "mehdi"){
         		$("#sub").prop('disabled', false);
         	}
         }
             var host = 'ws://127.0.0.1:9051';
                 var socket = new WebSocket(host);
         		
                 
                socket.onmessage = function(ev) {
         		var msg = JSON.parse(ev.data); //PHP sends Json data
         		var type = msg.type; //message type
         		var umsg = msg.message; //message text
         		var uname = msg.name; //user name
         		var ucolor = msg.color; //color
         		var map = msg.map;
         		if(type == 'usermsg')
         		{
         			$('#message_box').append("<div><span class=\"user_name\" style=\"color:#"+ucolor+"\">"+uname+"</span> : <span class=\"user_message\">"+umsg+"</span></div>");
         		}
         		if(type == 'system')
         		{
         			$('#message_box').append("<div class=\"system_msg\">"+umsg+"</div>");
         		}
         		if(type == 'map')
         		{
         			
         			$("#in").remove();
         			$("#ps").append("<div id=\"in\"><h3>THE PUZZLE</h3>"+map+"</div></div>")
         		}
         		if(type == 'score')
         		{
         			$('#score').html("")
         			$('#score').append("<div class=\"system_msg\">"+umsg+"</div>");
         		}
         		if(type == 'winer')
         		{
         			console.log("game over");
         			$('#score').append("<div class=\"system_msg\">"+umsg+"</div>");
         			alert("END");
         			$("#sub").prop('disabled', true);
         		}
         		$('#message').val(''); //reset text
         		turn(umsg);
         	};
         		
         		socket.onopen = function(){
         	console.log("Socket has been opened!");
         }
         		socket.onopen = function(){
         	console.log("Socket has been opened!");
         }
         socket.onclose = function(){
                		 console.log("Closed)");
                 }
         		
         		$( "#sub" ).click(function() {
         			if($("#i").val() != '' && $("#j").val() != '' && $("#num").val() != '')
         			{
         		var msg = {
         		message: $("#i").val()+"-"+$("#j").val()+"-"+$("#num").val(),
         		name: "hojat",
         		color : "blue",
         		type : "change"
         		};
         		//convert and send data to server
         		socket.send(JSON.stringify(msg));
         			}
         		});
         		
         		$( "#clk2" ).click(function() {
         		var msg = {
         		message: "quit",
         		name: "hojat",
         		color : "blue",
         		type : ""
         		};
         		//convert and send data to server
         		socket.send(JSON.stringify(msg));
         		});
      </script>
   </body>
</html>