$(document).ready(function() {
   // Event handler for clicking on questions
    $('.question').click(function(event) {
        var currentQuestion = $(this);
        
        // If the current question is already selected
        if (currentQuestion.hasClass('selected')) {  
            currentQuestion.removeClass('selected');
            currentQuestion.find(".arrow").removeClass("rotate"); 
            currentQuestion.next('.answer').slideUp();
            currentQuestion.parent().removeClass('active');
        } else {
            // If a new question is selected
            $('.question').removeClass('selected');
            $('.question').find(".arrow").removeClass("rotate");
            $('.answer').slideUp();
            currentQuestion.addClass('selected');
            currentQuestion.next('.answer').slideDown();
            currentQuestion.find(".arrow").addClass("rotate");
            $('.faq-questions').removeClass('active');
            currentQuestion.parent().addClass('active');
        }
    });
});
