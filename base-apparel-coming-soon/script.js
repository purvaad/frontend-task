window.addEventListener("load", function () {
    const formbox = document.getElementsByClassName("form")[0];
    const button = document.querySelector(
      ".form button[type='submit'] "
    );
    const inputbox = document.querySelector(".form input");
    button.addEventListener("click", submitForm);

    function submitForm(event) {
      formbox.classList.add("submitted");
      if (!inputbox.checkValidity()) {
        event.preventDefault();
      }
    }
  });