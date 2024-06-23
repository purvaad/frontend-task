const form = document.getElementById("registrationForm");
const nameInput = document.getElementById("name");
const emailInput = document.getElementById("email");
const passwordInput = document.getElementById("password");
const phoneInput = document.getElementById("phone");
const genderInputs = document.querySelectorAll('input[name="gender"]');
const languageSelect = document.getElementById("language");
const zipCodeInput = document.getElementById("zipCode");

form.addEventListener("submit", (event) => {
  event.preventDefault();
  resetErrors();

  let isValid = true;

  if (nameInput.value.trim() === "") {
    setError(nameInput, "*Name is required");
    isValid = false;
  }

  const emailRegex = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
  if (!emailRegex.test(emailInput.value.trim())) {
    setError(emailInput, "*Invalid email format");
    isValid = false;
  }

  if (
    !/(?=.*[a-z])(?=.*[A-Z])(?=.*[!@#$%^&*()_+{}|:"<>?`~\-=\[\]\\;',./])(?=.{8,})/.test(
      passwordInput.value
    )
  ) {
    setError(
      passwordInput,
      "*Password must be at least 8 characters long and \ncontain at least one lowercase letter, one uppercase letter, \nand one special character"
    );
    isValid = false;
  }

  const phoneRegex = /^\d{10}$/;
  if (
    phoneInput.value.trim() !== "" &&
    !phoneRegex.test(phoneInput.value.trim())
  ) {
    setError(phoneInput, "*Invalid phone number format");
    isValid = false;
  }

  let genderSelected = false;
  genderInputs.forEach((input) => {
    if (input.checked) {
      genderSelected = true;
    }
  });
  if (!genderSelected) {
    setError(genderInputs[0], "*Please select a gender");
    isValid = false;
  }

  if (languageSelect.value === "") {
    setError(languageSelect, "*Please select a language");
    isValid = false;
  }

  // const zipCodeRegex = /^\d{6}$/;
  const zipCodeRegex = /^\d{5}(?:[-\s]\d{4})?$/;
  if (
    zipCodeInput.value.trim() !== "" &&
    !zipCodeRegex.test(zipCodeInput.value.trim())
  ) {
    setError(zipCodeInput, "*Invalid zip code format");
    isValid = false;
  }

  if (isValid) {
    form.submit();
  }
});

function setError(input, message) {
  const errorElement = document.getElementById(`${input.id}Error`);
  errorElement.textContent = message;
  input.classList.add("error");
}

function resetErrors() {
  const errorElements = document.querySelectorAll(".error-message");
  errorElements.forEach((element) => {
    element.textContent = "";
  });
  const inputElements = document.querySelectorAll("input, select");
  inputElements.forEach((element) => {
    element.classList.remove("error");
  });
}
