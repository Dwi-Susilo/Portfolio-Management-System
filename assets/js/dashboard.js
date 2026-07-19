document.addEventListener("DOMContentLoaded", function () {
  let pulses = document.querySelectorAll(".pulse");

  pulses.forEach(function (btn) {
    for (let i = 0; i < 20; i++) {
      let span = document.createElement("span");

      // Mengatur posisi vertikal tiap baris agar rapi
      span.style.top = `${i * 3}px`;

      // Memberikan efek acak (delay) agar animasinya tidak barengan
      let randomDelay = Math.random() * 2;
      span.style.animationDelay = randomDelay + "s";

      btn.appendChild(span);
    }
  });
});
