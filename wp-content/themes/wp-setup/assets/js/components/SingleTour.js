class SingleTour {
  constructor() {
    console.log("new SingleTour");
    this.dates = [...document.querySelectorAll(".tour__dates")];
    this.tours = [...document.querySelectorAll('[name="tour"]')];
    this.bookingButton = document.querySelector("#bookingButton");

    this.addEventListeners();

    this.onChangeTour();
  }

  addEventListeners = () => {
    this.tours.forEach((tour) => {
      tour.addEventListener("change", this.onChangeTour);
    });
  };

  onChangeTour = (e) => {
    if (!e) {
      return;
    }
    const input = e.currentTarget;
    const wcId = input.value;
    // const conduct = this.tours.find((tour) => {
    //   return tour.checked == true;
    // }).value;
    // const tour = this.bookingButton.dataset.tour;
    const url = this.bookingButton.dataset.url.slice(0, -1);
    // const href = `${url}?event=${tour}&date=${conduct}`;
    const href = `${url}?add-to-cart=${wcId}&quantity=1`;
    this.bookingButton.href = href;
    this.bookingButton.classList.remove("disabled");
  };
}

export default SingleTour;
