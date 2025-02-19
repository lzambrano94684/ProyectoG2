<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="icon" href="/styleVideo/assets/favicon.svg" />
    <link rel="stylesheet" href="/styleVideo/styles/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link
        href="https://fonts.googleapis.com/css2?family=Inter:wght@100;400;700&display=swap"
        rel="stylesheet"
    />
    <title>Cancer de mama</title>
</head>
<body>
<main class="wrapper">
    <div class="player">
        <div class="player-overlay" data-fullscreen="false">
            <div class="container">
                <div class="information-container">
                    <!--<h1 class="title">Rain</h1>
                    <p class="description">
                      This is an example paragraph that serves to exemplify a
                      description of a video. This text is only visible at the
                      beginning of the video and when the mouse is over the screen.
                    </p>-->
                </div>
                <div class="player-container">
                    <div class="video-progress">
                        <div class="video-progress-filled"></div>
                    </div>
                    <div class="player-controls">
                        <div class="player-buttons">
                            <button
                                aria-label="play"
                                class="button play"
                                title="play"
                                type="button"
                            ></button>
                            <button
                                aria-label="pause"
                                class="button pause"
                                hidden
                                title="pause"
                                type="button"
                            ></button>
                            <button
                                aria-label="backward"
                                class="button backward"
                                title="backward"
                                type="button"
                            ></button>
                            <button
                                aria-label="forward"
                                class="button forward"
                                title="forward"
                                type="button"
                            ></button>
                            <button
                                aria-label="volume"
                                class="button volume"
                                title="volume"
                                type="button"
                            ></button>
                            <button
                                aria-label="silence"
                                class="button silence"
                                hidden
                                title="silence"
                                type="button"
                            ></button>
                            <div class="volume-progress">
                                <div class="volume-progress-filled"></div>
                            </div>
                            <div class="time-container">
                                <p class="current-time">0:00</p>
                                <p class="time-separator">/</p>
                                <p class="duration-video">0:00</p>
                            </div>
                        </div>
                        <div class="expand-container">
                            <button
                                aria-label="expand"
                                class="button expand"
                                title="expand"
                                type="button"
                            ></button>
                            <button
                                aria-label="reduce"
                                class="button reduce"
                                hidden
                                title="reduce"
                                type="button"
                            ></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <video
            class="video"
            src="/video/Cancer De Mama Final - Exeltis-1.mp4"
        ></video>
    </div>
</main>
<script src="/styleVideo/js/index.js"></script>
</body>
</html>
