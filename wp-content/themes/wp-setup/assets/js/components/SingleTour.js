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

  onChangeTour = () => {
    const conduct = this.tours.find((tour) => {
      return tour.checked == true;
    }).value;
    const tour = this.bookingButton.dataset.tour;
    const url = this.bookingButton.dataset.url.slice(0, -1);
    const href = `${url}?event=${tour}&date=${conduct}`;
    this.bookingButton.href = href;
    console.log(this.bookingButton.href);
  };
}

export default SingleTour;
