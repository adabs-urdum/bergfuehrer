"use strict";

import "babel-polyfill";
// import BookingForm from "./components/BookingForm";
import EventFilter from "./components/EventFilter";
// import Swiper from "swiper";
import GACE from "./components/googleAnalyticsCustomEvents";
import Lightbox from "./components/Lightbox";
import SingleTour from "./components/SingleTour";
import Swiper, { Pagination, Navigation, Autoplay } from "swiper";
Swiper.use([Pagination, Navigation, Autoplay]);

Array.prototype.shuffle = function () {
  return this.sort(function () {
    return Math.random() - 0.5;
  });
};

Array.prototype.getRandomValue = function () {
  return this.shuffle()[0];
};

Array.prototype.uniqueValues = function () {
  return [...new Set(this)];
};

document.addEventListener("DOMContentLoaded", function () {
  // set GA-ID
  // const gace = new GACE({
  //   id: "UA-164327129-1",
  // });
  // var mySwiper = new Swiper(".gallery", {
  //   speed: 400,
  //   spaceBetween: 0,
  // });
  const galleries = [...document.querySelectorAll(".gallery")];
  galleries.forEach((gallery) => {
    new Lightbox({
      gallery: gallery,
    });
  });

  if (document.querySelector("body").classList.contains("single-tour")) {
    new SingleTour();
  }

  const events = document.querySelector("section.events");
  if (events) {
    new EventFilter();
  }

  const bookingform = document.querySelector("section.bookingform");
  if (bookingform) {
    new BookingForm();
  }

  const cartForm = document.querySelector(".woocommerce-cart-form");
  if (cartForm) {
    history.pushState(null, "", location.href.split("?")[0]);
  }

  const swipers = [...document.querySelectorAll(".swiper-container")];
  swipers.forEach((swiper) => {
    const mySwiper = new Swiper(swiper, {
      speed: 400,
      loop: true,
      autoplay: {
        delay: 5000,
      },
      // navigation: {
      //   nextEl: ".next",
      //   prevEl: ".previous",
      // },
      // pagination: {
      //   el: ".swiper-pagination",
      //   type: "bullets",
      //   clickable: true,
      // },
    });
  });
});
