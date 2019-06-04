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
                            <video id="bpv-video" class="bpv-video" controls preload="metadata" poster=""></video>
                            <!-- <div id="bpv-overlay" class="bpv-overlay">
                                <div class="bpv-overlay-icon">
                                    <img class="img-responsive center-block" src="{{asset('icons/svg/play-circle.svg')}}" />
                                </div>
                            </div> -->
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
                    var video = document.querySelector('video');

                    var assetURL = '/NEWBOOMplop/video/cake_fragmented.mp4';
                    // Need to be specific for Blink regarding codecs
                    // ./mp4info frag_bunny.mp4 | grep Codec
                    var mimeCodec = 'video/mp4; codecs="avc1.42E01E, mp4a.40.2"';

                    if ('MediaSource' in window && MediaSource.isTypeSupported(mimeCodec)) {
                      var mediaSource = new MediaSource();
                      //console.log(mediaSource.readyState); // closed
                      video.src = URL.createObjectURL(mediaSource);
                      mediaSource.addEventListener('sourceopen', sourceOpen);
                    } else {
                      console.error('Unsupported MIME type or codec: ', mimeCodec);
                    }

                    function sourceOpen (_) {
                      //console.log(this.readyState); // open
                      var mediaSource = this;
                      var sourceBuffer = mediaSource.addSourceBuffer(mimeCodec);
                      fetchAB(assetURL, function (buf) {
                        sourceBuffer.addEventListener('updateend', function (_) {
                          mediaSource.endOfStream();
                          video.play();
                          //console.log(mediaSource.readyState); // ended
                        });
                        sourceBuffer.appendBuffer(buf);
                      });
                    };

                    function fetchAB (url, cb) {
                      console.log(url);
                      var xhr = new XMLHttpRequest;
                      xhr.open('get', url);
                      xhr.responseType = 'arraybuffer';
                      xhr.onload = function () {
                        cb(xhr.response);
                      };
                      xhr.send();
                    };
                    
                </script>
                
            </div>
        </div>
    </body>
</html>
