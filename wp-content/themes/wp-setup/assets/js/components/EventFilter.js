import axios from "axios";
import noUiSlider from "nouislider";

class EventFilter {
  constructor() {
    console.log("new EventFilter");
    this.nonce = document.querySelector('meta[name="csrf-token"]').content;
    this.headers = {
      "Content-Type": "application/json",
      "X-CSRF-TOKEN": this.nonce,
    };
    // console.log(window.ajaxObject.ajaxurl);
    this.ajaxUrl = `/wp-json/api/conducts`;

    this.loaderContainer = document.querySelector(".events__loaderWrapper");
    this.eventsContainer = document.querySelector(".events__events");
    this.filterContainer = document.querySelector(".events__filters");
    this.rangeContainers = [
      ...this.filterContainer.querySelectorAll(".events__rangeContainer"),
    ];
    this.uiSliders = {};
    this.inputs = [...this.filterContainer.querySelectorAll("input")];
    this.filterTriggers = this.inputs.filter((input) => {
      return input.name == "filterTrigger";
    });

    this.data = {
      ajaxNonce: this.nonce,
      places: "",
      types: this.filterContainer.dataset.type,
      altMin: "",
      altMax: "",
      priceMin: "",
      priceMax: "",
      dateMin: "",
      dateMax: "",
    };

    this.addEventListeners();

    this.getFilterValues();
  }

  getConducts = () => {
    const eventsContainerHeight =
      this.eventsContainer.getBoundingClientRect().height;
    this.eventsContainer.style.minHeight = `${eventsContainerHeight}px`;

    this.loaderContainer.style.display = "flex";
    this.eventsContainer.style.opacity = 0;

    axios
      .post(this.ajaxUrl, this.data, {
        headers: this.headers,
      })
      .then((response) => {
        console.log(response);
        this.eventsContainer.innerHTML = response.data.markup;
        this.eventsContainer.style.opacity = 1;
        this.loaderContainer.style.display = "none";
        this.eventsContainer.style.minHeight = `0`;
      })
      .catch((error) => {
        console.log(error);
      });
  };

  addEventListeners = () => {
    this.inputs.forEach((input) => {
      if (input.name.indexOf("Trigger") == -1) {
        input.addEventListener("change", this.onChangeInput);
      }
    });

    this.filterTriggers.forEach((filterTrigger) => {
      filterTrigger.addEventListener("change", this.onChangeFilterTrigger);
    });

    this.rangeContainers.forEach((container, key) => {
      const sliderDiv = container.querySelector(".events__rangeSlider");
      const minInput = container.querySelector(".min");
      const min = parseInt(minInput.value);
      const maxInput = container.querySelector(".max");
      const max = parseInt(maxInput.value);
      const uiSlider = noUiSlider.create(sliderDiv, {
        start: [min, max],
        range: {
          min: [min],
          max: [max],
        },
      });

      this.uiSliders[key] = {
        min: min,
        max: max,
        minInput: minInput,
        maxInput: maxInput,
        uiSlider: uiSlider,
      };

      uiSlider.uiSlidersKey = key;
      uiSlider.on("change", this.onChangeUiSlider);
      uiSlider.on("update", this.onUpdateUiSlider);
    });
  };

  onChangeUiSlider = (
    values,
    handle,
    unencoded,
    tap,
    positions,
    noUiSlider
  ) => {
    const key = noUiSlider.uiSlidersKey;
    const uiSlider = this.uiSliders[key];
    uiSlider.minInput.value = Math.round(values[0]);
    uiSlider.maxInput.value = Math.round(values[1]);
    uiSlider.maxInput.dispatchEvent(new Event("change"));
  };

  onUpdateUiSlider = (
    values,
    handle,
    unencoded,
    tap,
    positions,
    noUiSlider
  ) => {
    const key = noUiSlider.uiSlidersKey;
    const uiSlider = this.uiSliders[key];
    uiSlider.minInput.value = Math.round(values[0]);
    uiSlider.maxInput.value = Math.round(values[1]);
  };

  onChangeFilterTrigger = (e) => {
    const currentTarget = e.currentTarget;
    this.filterTriggers.forEach((filterTrigger) => {
      if (filterTrigger !== currentTarget) {
        filterTrigger.checked = false;
      }
    });
  };

  onChangeInput = (e) => {
    const input = e.currentTarget;
    this.getFilterValues();
  };

  getFilterValues = () => {
    const places = this.inputs
      .filter((input) => {
        return input.name == "place" && input.checked == true;
      })
      .map((place) => {
        return place.value;
      });
    this.data.places = places;

    const types = this.inputs
      .filter((input) => {
        return input.name == "type" && input.checked == true;
      })
      .map((type) => {
        return type.value;
      });
    this.data.types = types;

    const altMin = this.inputs.find((input) => {
      return input.name == "altMin";
    }).value;
    this.data.altMin = altMin;

    const altMax = this.inputs.find((input) => {
      return input.name == "altMax";
    }).value;
    this.data.altMax = altMax;

    const priceMin = this.inputs.find((input) => {
      return input.name == "priceMin";
    }).value;
    this.data.priceMin = priceMin;

    const priceMax = this.inputs.find((input) => {
      return input.name == "priceMax";
    }).value;
    this.data.priceMax = priceMax;

    let dateMin = this.inputs.find((input) => {
      return input.name == "dateMin";
    }).value;
    this.data.dateMin = dateMin;

    const dateMax = this.inputs.find((input) => {
      return input.name == "dateMax";
    }).value;
    this.data.dateMax = dateMax;

    this.getConducts();
  };
}

export default EventFilter;
