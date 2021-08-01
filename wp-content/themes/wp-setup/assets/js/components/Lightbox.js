class Lightbox {
  constructor(init) {
    console.log("new Lightbox");
    this.gallery = init.gallery;
    this.images = [...this.gallery.querySelectorAll(".gallery__image")];

    this.addEventListeners();
  }

  addEventListeners = () => {
    this.images.forEach((image) => {
      image.addEventListener("click", this.onClickImage);
    });
  };

  onClickImage = (e) => {
    const image = e.currentTarget;
    console.log(image);

    if (this.overlay) {
      this.onClickOverlay();
    }

    this.overlay = document.createElement("div");
    this.overlay.id = "overlay";
    this.overlay.addEventListener("click", this.onClickOverlay);
    const imageClone = image.cloneNode(true);
    imageClone.classList = "";
    this.overlay.appendChild(imageClone);
    document.body.appendChild(this.overlay);
  };

  onClickOverlay = (e) => {
    document.body.removeChild(this.overlay);
    this.overlay = null;
  };
}

export default Lightbox;
