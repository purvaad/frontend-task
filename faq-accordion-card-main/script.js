// when question is clicked, questionClicked() func is called 
document.querySelectorAll(".faq-questions").forEach(questionWrapper => {
    questionWrapper.addEventListener("click", questionClicked);
  });
  
  //questionClicked func directs to showAnswer
  function questionClicked() {
    var clickedElement = this;
    showAnswer(clickedElement);
  }
  
  // showANswer only shows ans for question clicked and closes other answers
  function showAnswer(clickedElement) {

    var allQuestions = document.querySelectorAll(".faq-questions");
    
    //goes through each question to check if its ans is active
    allQuestions.forEach(question => {
      if (question.querySelector(".question").classList.contains("active") &&
          question.querySelector(".question") !== clickedElement.querySelector(".question")) {
        //closes the question if it is not the question that is clicked
        toggleQuestion(question);
        rotateArrow(question);
      }
    });
    
    toggleQuestion(clickedElement);        //opens or closes the answer for the clicked question
    rotateArrow(clickedElement);          //rotates the arrow of the clicked question
  }
  
  //func to open or close the answer for a question
  function toggleQuestion(element) {

    element.querySelector(".question").classList.toggle("active");
    var answer = element.querySelector(".answer");

    answer.style.maxHeight = answer.style.maxHeight ? null : answer.scrollHeight + "px";
  }
  
  //func for rotating the arrow of question
  function rotateArrow(element) {
    var arrow = element.querySelector(".arrow");
    arrow.classList.toggle("rotate-180");
  }