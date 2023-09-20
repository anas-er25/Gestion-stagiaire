var autoCloseAlerts = document.querySelectorAll(".auto-close-alert");

autoCloseAlerts.forEach(function (alert) {
  setTimeout(function () {
    alert.classList.remove("show");
  }, 3000);
});
