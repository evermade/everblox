function youtubeBackground() {
  const elements = document.querySelectorAll('.js-youtube-background');

  const init = () => {
    if (elements.length) {
      enqueueYoutubeScripts();
    }
  };

  const enqueueYoutubeScripts = () => {
    if (!document.querySelector('script[src$="www.youtube.com/iframe_api"]')) {
      const tag = document.createElement('script');
      tag.src = 'https://www.youtube.com/iframe_api';
      const firstScriptTag = document.getElementsByTagName('script')[0];
      firstScriptTag.parentNode.insertBefore(tag, firstScriptTag);
    }
  };

  /**
   * This global function needs to exist or the Youtube script will have been loaded in vein.
   */
  window.onYouTubeIframeAPIReady = () => {
    // Youtube scripts loaded, lets create some video players!
    Array.from(elements).forEach((el) => {
      setup(el);
    });
  };

  /**
   * Setup a single video player
   */
  const setup = (wrapperEl) => {
    // read settings
    const { id } = wrapperEl.dataset;

    // create a unique id for the player
    const playerID = generateUniquePlayerID(id);

    // create a stunt-div that YT script will turn into an iframe
    const playerEl = document.createElement('div');

    playerEl.id = playerID;
    wrapperEl.appendChild(playerEl);

    const instance = new window.YT.Player(playerID, {
      width: '960',
      height: '540', // will actually be sized by css
      videoId: id,
      playerVars: {
        autoplay: 1,
        loop: 1,
        playlist: id,
        controls: 0,
        modestbranding: 1,
        playsinline: 1,
        enablejsapi: 1,
        origin: location.origin, // need to pass our domain to enable js communication with player
        rel: 0, // used to disable related videos after playback stops. nowadays with rel: 0 only videos from the same channel will be listed.
        fs: 0, // disable fullscreen possibility
        iv_load_policy: 3, // hide video annotations
        wmode: 'transparent', // required to use z-index on the element on IE
      },
      events: {
        onReady: onReady,
        onStateChange: onStateChange,
      },
    });

    return instance;
  };

  /**
   * This will be called for every player after it has been initialized and is ready to start playback
   */
  const onReady = (event) => {
    const player = event.target;
    player.playVideo(); // required for autoplay on mobiles
    player.mute();
  };

  const onStateChange = (event) => {
    // we could probably detect video stoppage here and hide everything to avoid the embarassing related videos -moment
    /*
    if (event.data === window.YT.PlayerState.ENDED) {
      console.log('video state changed to: ended');
    }
    if (event.data === window.YT.PlayerState.PLAYING) {
      console.log('video state changed to: playing');
    }
    if (event.data === window.YT.PlayerState.PAUSED) {
      console.log('video state changed to: paused');
    }
    if (event.data === window.YT.PlayerState.BUFFERING) {
      console.log('video state changed to: buffering');
    }
    if (event.data === window.YT.PlayerState.CUED) {
      console.log('video state changed to: cued');
    }
    */
  };

  /**
   * Generate a guaranteed unique html id-attribute for a player
   */
  const generateUniquePlayerID = (videoId) => {
    let playerId = 'youtube-player-' + videoId;
    if (document.getElementById(playerId)) {
      let suffix = 1;
      do {
        suffix++;
      } while (document.getElementById(playerId + suffix));
      playerId += suffix;
    }
    return playerId;
  };

  init();
}

export default youtubeBackground;
