<!DOCTYPE html>
<html>
<head>
	<title>Canvas</title>
	<style type="text/css">
		.content{
			width: 80%;
			min-height: 200px;
			background-color: gray;
			margin: auto;
		}
		canvas{
			background-color: white;
			margin:auto;
		}
		.otherClass{

		}
	</style>
</head>
<body>  
	<div class='content otherClass' data-id='1'>
		<canvas id="canvas" width="500" height="250" ></canvas>

	</div>
	<script type="text/javascript">
		var canvas = null, ctx = null, x = 0, y = 0;
		var lastPress = 65, speed = 5, player = null, food =null;

		window.requestAnimationFrame = (function(){
			return window.requestAnimationFrame || 
			window.mozRequestAnimationFrame || 
			window.webkitRequestAnimationFrame || 
			function (callback){
				window.setTimeout(callback,17);
			}
		}());

		function paint(ctx)
		{
			ctx.fillStyle = "black";
			ctx.fillRect(0,0,canvas.width,canvas.height)

			ctx.fillStyle = "#0f0";
			player.paint(ctx);

			ctx.fillStyle = "red";
			food.paint(ctx);

			// ctx.fillStyle = "#0f0";
			// ctx.fillRect(x,y,10,10);
		}

		function act(){
 

			if(lastPress==65 || lastPress == 37){ //izquierda
				player.x -= speed;
				if (player.x < 0 ) {
					player.x = canvas.width;
				}
			}

			if(lastPress==68 || lastPress == 39){ //derecha
				player.x += speed;
				if(player.x > canvas.width){
					player.x = -10;
				}
			}

			if(lastPress==87 || lastPress == 38){ //arriba
				player.y -= speed;
				if (player.y < 0) {
					player.y = canvas.height;
				}
			}

			if(lastPress==83 || lastPress == 40){ //abajo
				player.y += speed;
				if (player.y > canvas.height) {
					player.y = -10;
				}
			} 

			if(player.intersects(food)){
				food.x = random(canvas.width);
				food.y = random(canvas.height);
			}
		}

		function run(){
			window.requestAnimationFrame(run);
			act();
			paint(ctx);
		}

		function init(){
			canvas = document.getElementById('canvas');
			ctx = canvas.getContext('2d');

			player = new Rectangle(0,0,10,10);
			food = new Rectangle(70,50,10,10);

			run();
		} 
		
		window.addEventListener('load',init,false);
		
		document.addEventListener('keydown',function(e){ 
			if(e.keyCode==65 || e.keyCode ==  37 || e.keyCode ==  68 || e.keyCode ==  39 || e.keyCode ==  87 || e.keyCode ==  38 || e.keyCode ==  83 || e.keyCode ==  40 )
				lastPress = e.keyCode; 
		})

		function Rectangle(x,y,w,h){
			this.x = x;
			this.y = y;
			this.w = w;
			this.h = h;

			this.paint = function(ctx){
				ctx.fillRect(this.x,this.y,this.w,this.h);
			}

			this.intersects = function(rect){
				if (this.x < rect.x + rect.w && this.x + this.w > rect.x && 
					this.y < rect.y + rect.h && this.y + this.h > rect.y){
					return true;
				}
			}
		}

		function random(m){
			return Math.floor(Math.random()*m);
		}
	</script>
</body>
</html>







