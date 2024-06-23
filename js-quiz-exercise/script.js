document.addEventListener('DOMContentLoaded', function() {
    const submitBtn = document.querySelector('.submit-btn');
    const refreshBtn = document.querySelector('.refresh-btn');
    const note = document.querySelector('.note');
    const resultDiv = document.querySelector('.result');

    submitBtn.addEventListener('click', function() {
        let correctAnswers = 0;
        const totalQuestions = document.querySelectorAll('.question').length;
        const totalMarks = totalQuestions * 10; //each question of 10mark
        let allQuestionsAnswered = true; //tocheck if all ques are answered
        const questions = document.querySelectorAll('.question');
        //to check each answer
        questions.forEach(question => {
            const answers = question.querySelectorAll('input[type="radio"]');
            let isQuestionAnswered = false;
            answers.forEach(answer => {
                if (answer.checked) {
                    isQuestionAnswered = true;
                    if ((answer.value === 'q1-a4' && question.querySelector('input[value="q1-a4"]')) ||
                        (answer.value === 'q2-a2' && question.querySelector('input[value="q2-a2"]')) ||
                        (answer.value === 'q3-a2' && question.querySelector('input[value="q3-a2"]')) ||
                        (answer.value === 'q4-a3' && question.querySelector('input[value="q4-a3"]')) ||
                        (answer.value === 'q5-a4' && question.querySelector('input[value="q5-a4"]'))) {
                        answer.parentElement.classList.remove('incorrect');
                        answer.parentElement.classList.add('correct');
                        correctAnswers++;
                    } else {
                        answer.parentElement.classList.remove('correct');
                        answer.parentElement.classList.add('incorrect');
                    }
                }
            });
            if (!isQuestionAnswered) {
                allQuestionsAnswered = false;
                return;
            }
        });

        //calculate percentage
        const percentage = (correctAnswers / totalQuestions) * 100;

        if (allQuestionsAnswered) {
            //displaying result
            resultDiv.textContent = `You scored ${correctAnswers * 10} out of ${totalMarks}. You achieved (${percentage}%) score.`;
            note.style.display = 'none';
            resultDiv.style.display = 'block';
        } else {
            resultDiv.textContent = 'Please answer all questions before submitting.';
            note.style.display = 'none';
            resultDiv.style.display = 'block';
        }
    });

    refreshBtn.addEventListener('click', function() {
        //clearing choices on click of refresh button
        const answers = document.querySelectorAll('input[type="radio"]');
        answers.forEach(answer => {
            answer.checked = false;
            answer.parentElement.classList.remove('correct', 'incorrect');
        });
        resultDiv.textContent = ''; //clear result
        note.style.display = 'block';
        resultDiv.style.display = 'none';
    });
});
