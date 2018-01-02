var noConflict 	= jQuery.noConflict();
var sClock		=	"";
var mClock		=	"";
var hClock		=	"";
(function(noConflict){
	var gVars = {};
	noConflict.fn.tzineClock = function(opts){
		var container = this.eq(0);
		if(!container){
			try{
				console.log("Invalid selector!");
			} catch(e){}
			return false;
		}
		if(!opts) opts = {}; 
		var defaults = {
			/* Additional options will be added in future versions of the plugin. */
		};

		/* Merging the provided options with the default ones (will be used in future versions of the plugin): */
			noConflict.each(defaults,function(k,v){
			opts[k] = opts[k] || defaults[k];
		})

		// Calling the setUp function and passing the container,
		// will be available to the setUp function as "this":
		setUp.call(container);
		return this;
	}
	function setUp(){
		// The colors of the dials:
		var colors = ['orange','blue','green'];
		var tmp;
		var srTimeUp = 0;
		for(var i=0;i<3;i++){
			// Creating a new element and setting the color as a class name:
			tmp = noConflict('<div>').attr('class',colors[i]+' clock').html(
					'<div class="display"></div>'+
					'<div class="front left"></div>'+
					'<div class="rotate left">'+
					'<div class="bg left"></div>'+
					'</div>'+
					'<div class="rotate right">'+
					'<div class="bg right"></div>'+
					'</div>'
			);
			// Appending to the container:
			noConflict(this).append(tmp);
			// Assigning some of the elements as variables for speed:
			tmp.rotateLeft 		= tmp.find('.rotate.left');
			tmp.rotateRight 	= tmp.find('.rotate.right');
			tmp.display 		= tmp.find('.display');
			// Adding the dial as a global variable. Will be available as gVars.colorName
			gVars[colors[i]] = tmp;
		}

		// Setting up a interval, executed every 1000 milliseconds:
		setInterval(function(){
			/*
			var currentTime = new Date();
			var h = currentTime.getHours();
			var m = currentTime.getMinutes();
			var s = currentTime.getSeconds();
			*/
			var srTime = _startTime - 1;
			
			var remainingTime = secondsTimeSpanToHMS(srTime);	
			var durationRemaining = Array();
			durationRemaining = remainingTime.split("-"); 
			
			var h = durationRemaining[0];
			var m = durationRemaining[1];
			var s = durationRemaining[2];
			
			animation(gVars.green	, 	60-s, 60, true);
			animation(gVars.blue	, 	m, 60 );
			animation(gVars.orange	, 	h, 24);
			
		},1000);
	}
	
	function animation(clock, current, total, sec)
	{
		// Calculating the current angle:
		var angle = (360/total)*(current+1);
	
		var element;

		if(current==0)
		{
			// Hiding the right half of the background:
			clock.rotateRight.hide();
			
			// Resetting the rotation of the left part:
			rotateElement(clock.rotateLeft,0);
		}
		
		if(angle<=180)
		{
			// The left part is rotated, and the right is currently hidden:
			element = clock.rotateLeft;
		}
		else
		{
			// The first part of the rotation has completed, so we start rotating the right part:
			clock.rotateRight.show();
			clock.rotateLeft.show();
			
			rotateElement(clock.rotateLeft,180);
			
			element = clock.rotateRight;
			angle = angle-180;
		}

		rotateElement(element,angle);
		
		// Setting the text inside of the display element, inserting a leading zero if needed:
		//clock.display.html(current<10?'0'+current:current);
		if(sec === true){
			clock.display.html(60-current);
			clock.display.html(60-current);
		}else{
			clock.display.html(current);
		}
		
	}
	
	function rotateElement(element,angle)
	{
	//angle = 180;
	//alert("ELEMENT:"+ element+ "ANGLE"+ angle);
		// Rotating the element, depending on the browser:
		var rotate = 'rotate('+angle+'deg)';
		
		if(element.css('MozTransform')!=undefined)
			element.css('MozTransform',rotate);
			
		else if(element.css('WebkitTransform')!=undefined)
			element.css('WebkitTransform',rotate);
	
		// A version for internet explorer using filters, works but is a bit buggy (no surprise here):
		else if(element.css("filter")!=undefined)
		{
			var cos = Math.cos(Math.PI * 2 / 360 * angle);
			var sin = Math.sin(Math.PI * 2 / 360 * angle);
			
			element.css("filter","progid:DXImageTransform.Microsoft.Matrix(M11="+cos+",M12=-"+sin+",M21="+sin+",M22="+cos+",SizingMethod='auto expand',FilterType='nearest neighbor')");
	
			element.css("left",-Math.floor((element.width()-200)/2));
			element.css("top",-Math.floor((element.height()-200)/2));
		}
	
	}
	
})(jQuery)