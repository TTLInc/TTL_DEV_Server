<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title>JB Clock</title>
        <link rel="stylesheet" href="css/jbclock.css" type="text/css" media="all" />
        <script type="text/javascript" src="js/jquery-1.8.0.min.js"></script>
        <script type="text/javascript" src="js/jbclock.js"></script>
                <script type="text/javascript">
            $(document).ready(function(){
                JBCountDown({
                    secondsColor : "#0793DE",
                    secondsGlow  : "none",
                    startDate   : "1357034400",
                    endDate     : "1386496800",
                    now         : "1357034400"
                });
            });
        </script>
    </head>

    <body>
            <div class="clock">
                <!--
                <div class="clock_days">
                    <div class="bgLayer">
                        <canvas id="canvas_days" width="122" height="122">
                            Your browser does not support the HTML5 canvas tag.
                        </canvas>
                        <p class="val">0</p>
                        <p class="type_days">Days</p>
                    </div>
                </div>

                <div class="clock_hours">
                    <div class="bgLayer">
                        <canvas id="canvas_hours" width="122" height="122">
                            Your browser does not support the HTML5 canvas tag.
                        </canvas>

                        <p class="val">0</p>
                        <p class="type_hours">Hours</p>
                    </div>
                </div>

                <div class="clock_minutes">
                    <div class="bgLayer">
                        <canvas id="canvas_minutes" width="122" height="122">
                            Your browser does not support the HTML5 canvas tag.
                        </canvas>
                        <div class="text">
                            <p class="val">0</p>
                            <p class="type_minutes">Minutes</p>
                        </div>
                    </div>
                </div>
				-->
                <!-- Seconds -->
                <div class="clock_seconds">
                    <div class="bgLayer">
                        <canvas id="canvas_seconds" width="122" height="122">
                            Your browser does not support the HTML5 canvas tag.
                        </canvas>
                        <p class="val">0</p>
                    </div>
                </div>
                <!-- Seconds -->
            </div>

    </body>
</html>
