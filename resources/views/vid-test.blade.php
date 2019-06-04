<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Laravel</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Raleway:100,600" rel="stylesheet" type="text/css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
        
        <link rel="stylesheet" href="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/smoothness/jquery-ui.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
        
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        
        <!-- Styles -->
        <style>
            html, body {
                background-color: #fff;
                color: #636b6f;
                font-family: 'Raleway', sans-serif;
                font-weight: 100;
                height: 100vh;
                margin: 0;
            }

            .full-height {
                height: 100vh;
            }

            .flex-center {
                align-items: center;
                display: flex;
                justify-content: center;
            }

            .position-ref {
                position: relative;
            }

            .top-right {
                position: absolute;
                right: 10px;
                top: 18px;
            }

            .content {
                text-align: center;
            }

            .title {
                font-size: 84px;
            }

            .links > a {
                color: #636b6f;
                padding: 0 25px;
                font-size: 12px;
                font-weight: 600;
                letter-spacing: .1rem;
                text-decoration: none;
                text-transform: uppercase;
            }

            .m-b-md {
                margin-bottom: 30px;
            }
        </style>
    </head>
    <body>
        <div class="flex-center position-ref full-height">
            @if (Route::has('login'))
                <div class="top-right links">
                    @auth
                        <a href="{{ url('/home') }}">Home</a>
                    @else
                        <a href="{{ route('login') }}">Login</a>
                        <a href="{{ route('register') }}">Register</a>
                    @endauth
                </div>
            @endif

            <div class="content">
                
                <style>
                    * {
                        box-sizing: border-box;
                    }
                    .bpv-player-container {
                        max-width: 700px;
                        overflow: hidden;
                    }
                    
                    .bpv-player {
                        display: block;
                        position: relative;
                        max-width: 100%;
                    }
                    .bpv-video-container {
                        position: relative;
                    }
                    .bpv-overlay {
                        cursor: pointer;
                        display: flex;
                        align-items: center;
                        justify-content: center;
                        position: absolute;
                        width: 100%;
                        height:100%;
                        left:0;
                        top:0;
                        background-color:rgba(0,0,0,0.4);
                    }
                    .bpv-overlay-icon {
                        position: relative;
                        color:#ffffff;
                        opacity: 0.6;
                        font-size: 80px;
                        width: 30%;
                    }
                    
                    .bpv-video {
                        display: block;
                        position: relative;
                        width: 100%;
                    }
                    .bpv-bottom {
                        background: #000000;
                        position: relative;
                        width: 100%;
                    }
                    video::-webkit-media-controls { display:none !important; }
                    
                    #bpv-progress-bar-container {
                        background: #000;
                        padding: 0 0 5px;
                        width: 100%;
                        position: relative;
                    }
                    #bpv-scrubber-container {
                        position: absolute;
                        left:0;
                        top:-5px;
                        transform: translateX(0);
                    }
                    #bpv-scrubber {
                        background-color: #6eb53f;
                        width: 16px;
                        height: 16px;
                        border-radius: 8px;
                    }
                    #bpv-progress-list {
                        width: 100%;
                        position: relative;
                        height: 7px;
                        background: #636b6f;
                        cursor: pointer;
                    }
                    #bpv-play-progress {
                        position: relative;
                        width: 100%;
                        height: 100%;
                        background-color: #6eb53f;
                        transform: scaleX(0);
                        transform-origin: left;
                    }
                    #bpv-load-progress {
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        left:0;
                        top:0;
                        background-color: #94999C;
                        transform: scaleX(0);
                        transform-origin: left;
                    }
                    
                    .bpv-player > .bpv-bottom > .bpv-controls {
                        display: none;
                        z-index:2147483647;
                        padding: 8px 15px 12px;
                    }
                    .bpv-control {
                        color: #f0f0f0;
                        display: inline-block;
                        vertical-align: middle;
                        font-size: 20px;
                    }
                    #bpv-time-display {
                        font-size: 14px;
                        margin-left: 12px;
                    }
                    #bpv-stop {
                        margin-right: 15px;
                        cursor: pointer;
                    }
                    #bpv-playpause {
                        margin-right: 10px;
                        cursor: pointer;
                        width: 30px;
                    }
                    #bpv-mute {
                        width:20px;
                    }
                    #bpv-mute, #bpv-large {
                        cursor: pointer;
                    }
                    #bpv-fs {
                        margin-left: 12px;
                        cursor: pointer;
                    }
                    
                    #bpv-volume {
                        height: 14px;
                        width: 76px;
                        overflow: hidden;
                        padding-left: 12px;
                    }
                    #bpv-volume-container {
                        margin: 5px 0;
                        height: 4px;
                        width: 100%;
                        position: relative;
                        background: #636b6f;
                    }
                    #bpv-volume-level {
                        position: absolute;
                        width: 100%;
                        height: 100%;
                        background: #008b9e;
                        transform: scaleX(1);
                        transform-origin: left;
                    }
                    #bpv-volume-scrubber-container {
                        position: absolute;
                        width: 14px;
                        height: 14px;
                        right: 0;
                        top:-5px;
                        z-index: 1;
                        cursor: pointer;
                    }
                    #bpv-volume-scrubber {
                        width: 14px;
                        height: 14px;
                        border-radius: 7px;
                        background-color: #f0f0f0;
                    }
                </style>
                
                <div id="bpv-player-container" class="bpv-player-container">
                    <figure id="bpv-player" class="bpv-player">
                        <div id="bpv-video-container" class="bpv-video-container">
                            <video id="bpv-video" class="bpv-video" controls preload="metadata" poster="">
                                <source src="/NEWBOOMplop/video/cake.mp4" type="video/mp4">
                                <source src="/NEWBOOMplop/video/cake.webm" type="video/webm">
                            </video>
                            <div id="bpv-overlay" class="bpv-overlay">
                                <div class="bpv-overlay-icon">
                                    <img class="img-responsive center-block" src="{{asset('icons/svg/play-circle.svg')}}" />
                                </div>
                            </div>
                        </div>
                        <div id="bpv-bottom" class="bpv-bottom">
                            <div id="bpv-progress-bar-container" class="bpv-progress-bar-container">
                                <div id="bpv-progress-list" class="bpv-progress-list">
                                    <div id="bpv-hover-progress" class="bpv-hover-progress"></div>
                                    <div id="bpv-load-progress" class="bpv-load-progress"></div>
                                    <div id="bpv-play-progress" class="bpv-play-progress"></div>
                                    <div id="bpv-scrubber-container">
                                        <div id="bpv-scrubber"></div>
                                    </div>
                                </div>
                            </div>
                            <div id="bpv-controls" class="bpv-controls clearfix">
                                <div class="pull-left">
                                    <div title="Stop" id="bpv-stop" class="bpv-control"><i class="fa fa-stop"></i></div>
                                    <div title="Play / Pause" id="bpv-playpause" class="bpv-control"><i class="fa fa-play"></i></div>
                                    <div title="Mute / Unmute" id="bpv-mute" class="bpv-control"><i class="fa fa-volume-up"></i></div>
                                    <div id="bpv-volume" class="bpv-control">
                                        <div id="bpv-volume-container">
                                            <div id="bpv-volume-scrubber-container"><div id="bpv-volume-scrubber"></div></div>
                                            <div id="bpv-volume-level"></div>
                                        </div>
                                    </div>
                                    <div id="bpv-time-display" class="bpv-control">
                                        <span id="bpv-current-time-display">00:00</span>/<span id="bpv-total-time-display">00:00</span>
                                    </div>
                                </div>
                                <div class="pull-right">
                                    <div title="Large Player" id="bpv-large" class="bpv-control"><i class="fa fa-window-maximize"></i></div>
                                    <div title="Fullscreen" id="bpv-fs" class="bpv-control"><i class="fa fa-expand"></i></div>
                                </div>
                            </div>
                        </div>
                    </figure>
                </div>
                
                <script>
                    // Check if HTML video is supported
                    var supportsVideo = !!document.createElement('video').canPlayType;
                    
                    // then setup the player
                    if (supportsVideo) {
                        
                        // Set the main elements
                        var videoContainer  = document.getElementById('bpv-player-container')
                        var videoPlayer     = document.getElementById('bpv-player');
                        var video           = document.getElementById('bpv-video');
                        var videoOverlay    = document.getElementById('bpv-overlay');
                        var videoControls   = document.getElementById('bpv-controls');

                        // Set the controlling elements
                        var playpause       = document.getElementById('bpv-playpause');
                        var stop            = document.getElementById('bpv-stop');
                        var mute            = document.getElementById('bpv-mute');
                        
                        // Progress bars
                        var scrubber        = document.getElementById('bpv-scrubber-container');
                        var progressBar     = document.getElementById('bpv-progress-list');
                        var playprogress    = document.getElementById('bpv-play-progress');
                        var loadprogress    = document.getElementById('bpv-load-progress');

                        // Display size
                        var large           = document.getElementById('bpv-large');
                        var fs              = document.getElementById('bpv-fs');
                        
                        // Time display
                        var currentTime     = document.getElementById('bpv-current-time-display');
                        var totalTime       = document.getElementById('bpv-total-time-display');
                        
                        // Volume Slider stuff
                        var volumeLevel     = document.getElementById('bpv-volume-level');
                        var volumeWrapper   = document.getElementById('bpv-volume-container');
                        var volumeScrubber  = document.getElementById('bpv-volume-scrubber-container');
                        
                        // icons
                        var playIcon        = playpause.getElementsByClassName('fa')[0];
                        var muteIcon        = mute.getElementsByClassName('fa')[0];
                        var fsIcon          = fs.getElementsByClassName('fa')[0];

                        // Hide the default controls
                        video.controls = false;

                        // Display the user defined video controls
                        videoControls.style.display = 'block';
                        
                        // Handle the vid file
                        var URL = this.window.URL || this.window.webkitURL;
                        var xhr = new XMLHttpRequest(),newvideo;
                        var vidsrc = video.currentSrc;
                        xhr.open("GET",vidsrc,true);    
                        xhr.responseType = "arraybuffer";
                        xhr.send();
                        xhr.addEventListener("load", function () {
                            if (xhr.status === 200) {
                                var oMyBlob = new Blob([xhr.response], { "type" : "video\/mp4" });
                                var docURL = URL.createObjectURL(oMyBlob);
                                video.setAttribute("src", docURL);
                                video.load();
                                console.log(docURL);
                            }
                        });
                        
                        // Drag the video scrubber
                        $('#bpv-scrubber-container').draggable({
                            containment: "parent",
                            axis:"x",
                            start:function(event,ui) {
                                video.pause();
                            },
                            stop:function(event,ui) {
                                var barWidth        = progressBar.offsetWidth;
                                var timePercent     = ui.position.left / barWidth;
                                video.currentTime = video.duration * timePercent;
                                playPauseVid();
                            }
                        });
                        
                        // Drag the volume scrubber
                        $('#bpv-volume-scrubber-container').draggable({
                            containment: "parent",
                            axis:"x",
                            stop:function(event,ui) {
                                var vol = (ui.position.left * 2) / 100;
                                setVolume(vol);
                            }
                        });
                        
                        // Sets the volume
                        function setVolume(vol) {
                            video.volume = vol;
                            volumeLevel.style.transform = 'scaleX(' + vol + ')';
                            if(video.muted) { video.muted = !video.muted; }
                            muteIcon.className = 'fa fa-volume-up';
                        }
                        
                        // Converts seconds to min:sec display
                        function secsToMinSec(secs) {
                            var minutes = Math.floor(secs / 60);
                            var seconds = Math.round(secs % 60);
                            
                            minutes = minutes < 10 ? "0" + minutes : minutes;
                            seconds = seconds < 10 ? "0" + seconds : seconds;
                            
                            return minutes + ":" + seconds;
                        }
                        
                        
                        // plays and pauses a video
                        function playPauseVid() {
                            if (video.paused || video.ended) {
                                video.play();
                                playIcon.className = 'fa fa-pause';
                                videoOverlay.style.display = 'none';
                            }
                            else {
                                video.pause();
                                playIcon.className = 'fa fa-play';
                                videoOverlay.style.display = 'flex';
                            }
                        }
                        
                        // stops a video
                        function stopVid() {
                            video.pause();
                            video.currentTime = 0;
                            playIcon.className = 'fa fa-play';
                            videoOverlay.style.display = 'flex';
                        }
                        
                        // Mutes / unmutes vid
                        function muteVid() {
                            video.muted = !video.muted;
                            
                            if(video.muted) {
                                muteIcon.className          = 'fa fa-volume-off';
                                volumeLevel.style.transform = 'scaleX(0)';
                                volumeScrubber.style.left   = '0';
                            } else {
                                muteIcon.className          = 'fa fa-volume-up';
                                volumeLevel.style.transform = 'scaleX(' + video.volume + ')';
                                volumeScrubber.style.left   = ((video.volume * 100) / 2) + "px";
                            }
                        }
                            
                        // click set volume
                        volumeWrapper.addEventListener('click', function(e) {
                            if(!isFullScreen()) {
                                var pos = (e.pageX - videoContainer.offsetLeft - this.offsetLeft) / this.offsetWidth;
                            } else {
                                var pos = (e.pageX - this.offsetLeft) / this.offsetWidth;
                            }
                            setVolume(pos);
                            volumeScrubber.style.left = (pos * 100) / 2 + "px";
                        });
                        
                        // Play pause
                        playpause.addEventListener('click', function(e) { playPauseVid(); });
                        videoOverlay.addEventListener('click', function(e) { playPauseVid(); });
                        video.addEventListener('click', function(e) { playPauseVid(); });

                        // Stop
                        stop.addEventListener('click', function(e) { stopVid(); });

                        // mute
                        mute.addEventListener('click', function(e) { muteVid(); });
                        
                        // Set time stuff if we can
                        video.addEventListener('loadedmetadata', function() {
                            currentTime.innerHTML   = secsToMinSec(0);
                            totalTime.innerHTML     = secsToMinSec(video.duration);
                        });
                        
                        // update progress bar
                        function handleProgressSize() {
                            var transformVal    = video.currentTime / video.duration;
                            var barWidth        = progressBar.offsetWidth;
                            var scrubberVal     = barWidth * transformVal;
                            scrubber.style.left = scrubberVal + 'px';
                            playprogress.style.transform = "scaleX(" + transformVal + ")";
                        }
                        video.addEventListener('timeupdate', function() {
                            // Progress bars
                            handleProgressSize();
                            // time display
                            currentTime.innerHTML   = secsToMinSec(video.currentTime);
                            totalTime.innerHTML     = secsToMinSec(video.duration);
                            
                        });
                        
                        video.addEventListener('ended',function(e) {
                            playIcon.className = 'fa fa-play';
                        });
                        
                        // handle buffered
                        setInterval(function(e) {
                            var bufferEnd       = video.buffered.end(0);
                            var bufferPercent   = bufferEnd/video.duration;
                            loadprogress.style.transform = "scaleX(" + bufferPercent + ")";
                        },200);

                        // Skip by clicking progress bar
                        progressBar.addEventListener('click', function(e) {
                            if(!isFullScreen()) {
                                var pos = (e.pageX - videoContainer.offsetLeft) / this.offsetWidth;
                            } else {
                                var pos = e.pageX / this.offsetWidth;
                            }
                            video.currentTime = pos * video.duration;
                        });

                        // Fullscreen
                        var fullScreenEnabled = !!(document.fullscreenEnabled || document.mozFullScreenEnabled || document.msFullscreenEnabled || document.webkitSupportsFullscreen || document.webkitFullscreenEnabled || document.createElement('video').webkitRequestFullScreen);
                        if (!fullScreenEnabled) {
                            fs.style.display = 'none';
                        }
                        fs.addEventListener('click', function(e) {
                            handleFullscreen();
                        });
                        var handleFullscreen = function() {
                            if (isFullScreen()) {
                                if (document.exitFullscreen) document.exitFullscreen();
                                else if (document.mozCancelFullScreen) document.mozCancelFullScreen();
                                else if (document.webkitCancelFullScreen) document.webkitCancelFullScreen();
                                else if (document.msExitFullscreen) document.msExitFullscreen();
                                setFullscreenData(false);
                                fsIcon.className = 'fa fa-expand';
                            }
                            else {
                                if (videoPlayer.requestFullscreen) videoPlayer.requestFullscreen();
                                else if (videoPlayer.mozRequestFullScreen) videoPlayer.mozRequestFullScreen();
                                else if (videoPlayer.webkitRequestFullScreen) videoPlayer.webkitRequestFullScreen();
                                else if (videoPlayer.msRequestFullscreen) videoPlayer.msRequestFullscreen();
                                setFullscreenData(true);
                                fsIcon.className = 'fa fa-compress';
                            }
                        }
                        var isFullScreen = function() {
                            return !!(document.fullScreen || document.webkitIsFullScreen || document.mozFullScreen || document.msFullscreenElement || document.fullscreenElement);
                        }
                        var setFullscreenData = function(state) {
                            videoPlayer.setAttribute('data-fullscreen', !!state);
                        }
                        document.addEventListener('fullscreenchange', function(e) {
                            setFullscreenData(!!(document.fullScreen || document.fullscreenElement));
                        });
                        document.addEventListener('webkitfullscreenchange', function() {
                            setFullscreenData(!!document.webkitIsFullScreen);
                        });
                        document.addEventListener('mozfullscreenchange', function() {
                            setFullscreenData(!!document.mozFullScreen);
                        });
                        document.addEventListener('msfullscreenchange', function() {
                            setFullscreenData(!!document.msFullscreenElement);
                        });
                    }
                </script>
                
            </div>
        </div>
    </body>
</html>
