class Lightbox {
  constructor(init) {
    console.log("new Lightbox");
    this.gallery = init.gallery;
    this.images = [...this.gallery.querySelectorAll(".gallery__image")];

    this.addEventListeners();
  }

  addEventListeners = () => {
    this.images.forEach((image, key) => {
      image.addEventListener("click", (e) => {
        this.onClickImage(e, key);
      });
    });
  };

  onClickImage = (e, key) => {
    const image = e.currentTarget;

    this.currentStep = key;

    if (this.overlay) {
      this.onClickOverlay();
    }

    this.overlay = document.createElement("div");
    this.overlay.id = "overlay";
    this.overlay.addEventListener("click", this.onClickOverlay);
    const imageClone = image.cloneNode(true);
    imageClone.classList = "";
    this.image = imageClone;

    const arrowLeft = document.createElement("div");
    arrowLeft.classList.add("overlay__arrow");
    arrowLeft.innerHTML =
      '<canvas width="25" height="45"></canvas><svg width="24" height="45" viewBox="0 0 24 45" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M22 42.8281L2 22.8281L22 2.82812" stroke="#1295D8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    arrowLeft.addEventListener("click", (e) => {
      this.onClickArrow(e, -1);
    });

    const arrowRight = document.createElement("div");
    arrowRight.classList.add("overlay__arrow");
    arrowRight.innerHTML =
      '<canvas width="25" height="45"></canvas><svg width="25" height="45" viewBox="0 0 25 45" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.82788 2.82812L22.8279 22.8281L2.82788 42.8281" stroke="#1295D8" stroke-width="4" stroke-linecap="round" stroke-linejoin="round"/></svg>';
    arrowRight.addEventListener("click", (e) => {
      this.onClickArrow(e, 1);
    });

    this.overlay.appendChild(arrowLeft);
    this.overlay.appendChild(imageClone);
    this.overlay.appendChild(arrowRight);

    document.body.appendChild(this.overlay);
  };

  onClickOverlay = (e) => {
    const clicked = e.target;

    if (clicked == this.overlay) {
      document.body.removeChild(this.overlay);
      this.overlay = null;
    }
  };

  onClickArrow = (e, step) => {
    let newStep = this.currentStep + step;
    if (this.currentStep + step > this.images.length - 1) {
      newStep = 0;
    } else if (this.currentStep + step < 0) {
      newStep = this.images.length - 1;
    }
    const newImg = this.images[newStep];
    this.image.title = newImg.title;
    this.image.alt = newImg.alt;
    this.image.srcset = newImg.srcset;
    this.image.sizes = newImg.sizes;
    this.image.src = newImg.src;

    this.currentStep = newStep;
  };
}

export default Lightbox;
