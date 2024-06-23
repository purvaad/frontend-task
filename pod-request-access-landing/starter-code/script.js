const emailInput = document.getElementById('email');
const emailError = document.querySelector('.hero__email-error');
const submit = document.getElementById('submit');
  
    //function to validate email 
    function validateEmail(email) {
      const format = /^[^\s@]+@[^\s@]+\.[^\s@]+$/;
      return format.test(email);
    }
  
    //function to check input email
    function checkInput() {
      const email = emailInput.value;
      if (!validateEmail(email)) {
        emailError.style.display = 'block';
      } else {
        emailError.style.display = 'none';
        window.location.reload();
      }
    }
  
    // Add event listener to input
    submit.addEventListener('click', checkInput);