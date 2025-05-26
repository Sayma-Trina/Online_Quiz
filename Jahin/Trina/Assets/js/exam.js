document.addEventListener('DOMContentLoaded', function() {
    // Exam Form Validation
    const examForm = document.getElementById('examForm');
    if (examForm) {
        examForm.addEventListener('submit', function(e) {
            let isValid = true;
            const fieldsToValidate = [
                'exam_title', 'exam_duration', 'total_question',
                'marks_right_answer', 'marks_wrong_answer', 'status'
            ];

            // Basic required field validation
            fieldsToValidate.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (!field || field.value.trim() === '') {
                    isValid = false;
                    field.style.border = '2px solid red';
                } else {
                    field.style.border = '1px solid #ced4da';
                }
            });

            // Simple number validation for numeric fields
            const numberFields = ['exam_duration', 'total_question', 
                                'marks_right_answer', 'marks_wrong_answer'];
            numberFields.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (field && isNaN(field.value)) {
                    isValid = false;
                    field.style.border = '2px solid red';
                }
            });

            if (!isValid) {
                e.preventDefault();
                alert('Please fill all required fields correctly!');
                return false;
            }
        });
    }

    // Question Form Validation
    const questionForm = document.getElementById('questionsForm');
    if (questionForm) {
        questionForm.addEventListener('submit', function(e) {
            let isValid = true;
            const fieldsToValidate = [
                'question_title', 'option_title_1', 
                'option_title_2', 'option_title_3',
                'option_title_4', 'answer_option'
            ];

            // Validate required text fields
            fieldsToValidate.forEach(fieldId => {
                const field = document.getElementById(fieldId);
                if (!field || field.value.trim() === '') {
                    isValid = false;
                    field.style.border = '2px solid red';
                } else {
                    field.style.border = '1px solid #ced4da';
                }
            });

            // Validate answer is between 1-4
            const answerField = document.getElementById('answer_option');
            if (answerField && (isNaN(answerField.value) || answerField.value < 1 || answerField.value > 4)) {
                isValid = false;
                answerField.style.border = '2px solid red';
            }

            if (!isValid) {
                e.preventDefault();
                alert('Please fill all question fields correctly!\n-Answer must be between 1-4');
                return false;
            }
        });
    }
});