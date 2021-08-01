class GACE {
  constructor(data) {
    window.dataLayer = window.dataLayer || [];
    this.gtag("js", new Date());
    this.gtag("config", data.id, { anonymize_ip: true });
  }

  triggerEvent = (cat, act, lab, val) => {
    // ga('send', 'event', 'Kategorie', 'Aktion', 'Label', value);
    ga("send", "event", cat, act, lab, val);
  };

  triggerEventDelayed = (cat, act, lab, val, time) => {
    // ga('send', 'event', 'Kategorie', 'Aktion', 'Label', value);
    clearTimeout(this.gaTimeout);
    this.gaTimeout = setTimeout(() => {
      ga("send", "event", cat, act, lab, val);
    }, time);
  };

  gtag = (data) => {
    window.dataLayer.push(data);
  };
}

export default GACE;
