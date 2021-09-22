import axios from "axios";

class BookingForm {
  constructor() {
    console.log("BookingForm");

    this.nonce = document.querySelector('meta[name="csrf-token"]').content;
    this.headers = {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": this.nonce,
    };
    this.ajaxUrl = `/wp-json/api/booking`;

    this.form = document.querySelector("#bookingform");
    console.log(this.form);

    this.nameInput = this.form.querySelector('input[name="name"]');
    this.lastnameInput = this.form.querySelector('input[name="lastname"]');
    this.emailInput = this.form.querySelector('input[name="email"]');
    this.phoneInput = this.form.querySelector('input[name="phone"]');
    this.streetNumberInput = this.form.querySelector(
      'input[name="streetnumber"]'
    );
    this.zipInput = this.form.querySelector('input[name="zip"]');
    this.townInput = this.form.querySelector('input[name="town"]');
    this.numberInput = this.form.querySelector('select[name="number"]');
    this.eventInput = this.form.querySelector('input[name="event"]');
    this.conductInput = this.form.querySelector('input[name="conduct"]');

    this.addEventListeners();
  }

  addEventListeners = () => {
    this.form.addEventListener("submit", this.onSubmitForm);
  };

  onSubmitForm = (e) => {
    e.preventDefault();

    this.data = {
      ajaxNonce: this.nonce,
      name: this.nameInput.value,
      lastname: this.lastnameInput.value,
      email: this.emailInput.value,
      phone: this.phoneInput.value,
      street: this.streetNumberInput.value,
      zip: this.zipInput.value,
      town: this.townInput.value,
      number: this.numberInput.value,
      event: this.eventInput.value,
      conduct: this.conductInput.value,
    };

    axios
      .post(this.ajaxUrl, this.data, {
        headers: this.headers,
      })
      .then((response) => {
        console.log(response);
        const success = response.data.success;
        console.log(success);
      })
      .catch((error) => {
        console.log(error);
      });

    console.log(this.data);
  };
}

export default BookingForm;
