import MicroModal from 'micromodal';

function modal() {
  const closeAnimationSpeed = 1000;
  const autoplay = 1;

  const init = () => {
    inlineModals();
    videoModals();
  };

  /**
   * Read more about usage from https://micromodal.now.sh/#usage
   */

  const inlineModals = () => {
    MicroModal.init({
      awaitCloseAnimation: true,
    });
  };

  /**
   * Example markup:
   *   <a href="https://www.youtube.com/watch?v=dbbque0Y4FU" class="js-video-modal" data-video-id="dbbque0Y4FU" data-video-provider="youtube" />
   */

  const videoModals = () => {
    const videoElements = document.querySelectorAll('.js-video-modal');

    Array.from(videoElements).forEach((el) => {
      el.addEventListener('click', (e) => {
        e.preventDefault();

        const id = el.getAttribute('data-video-id');
        const type = el.getAttribute('data-video-provider');

        if (!id || !type) return false;

        openVideoModal(id, type);
      });
    });
  };

  const openVideoModal = (id, type) => {
    const modalEl = document.getElementById(`modal-${id}`);

    /**
     * Stop the old modal element from being destroyed if it's
     * just been closed. Otherwise create a new modal and open it.
     */

    if (modalEl !== null) {
      if (typeof modalEl.closeAnimationTimeout !== 'undefined') {
        clearTimeout(modalEl.closeAnimationTimeout);
      }

      MicroModal.show(`modal-${id}`, {
        awaitCloseAnimation: true,
        onClose: (close) => closeVideoModal(close),
      });
    } else {
      createVideoModal(id, type);
    }
  };

  const createVideoModal = (id, type) => {
    const modal = document.createElement('div');
    const embedCode = getEmbedCode(id, type);

    if (embedCode) {
      modal.innerHTML = buildVideoModal(id, embedCode);
      document.body.appendChild(modal);

      MicroModal.show(`modal-${id}`, {
        awaitCloseAnimation: true,
        onClose: (close) => closeVideoModal(close),
      });
    }
  };

  const closeVideoModal = (el) => {
    el.closeAnimationTimeout = setTimeout(() => {
      document.body.removeChild(el.parentNode);
    }, closeAnimationSpeed);
  };

  const buildVideoModal = (id, embedCode) => {
    return `
      <div class="c-modal micromodal-slide" id="modal-${id}" aria-hidden="true">
        <div class="c-modal__overlay c-modal__overlay--opaque" tabindex="-1" data-micromodal-close>
          <div class="c-modal__container c-modal__container--video" role="dialog" aria-modal="true">
            <div class="c-modal__responsive-wrapper">
              ${embedCode}
            </div>
          </div>
          <button class="c-modal__close c-modal__close--outside" aria-label="Close modal" data-micromodal-close></button>
        </div>
      </div>
    `;
  };

  const getEmbedCode = (id, type) => {
    switch (type) {
      case 'youtube': {
        return youTubeEmbed(id);
      }
      case 'vimeo': {
        return vimeoEmbed(id);
      }
      default:
        return false;
    }
  };

  const youTubeEmbed = (id) => {
    return `<iframe width="560" height="315" src="https://www.youtube.com/embed/${id}?autoplay=${autoplay}" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>`;
  };

  const vimeoEmbed = (id) => {
    return `<iframe width="640" height="360" src="https://player.vimeo.com/video/${id}?autoplay=${autoplay}" frameborder="0" allow="autoplay; fullscreen" webkitallowfullscreen mozallowfullscreen allowfullscreen></iframe>`;
  };

  init();
}

export default modal;
