# Preprocessed Input

The preprocessed input contains of the following files:
- `students.csv`: Has two headers - `name`, `roll_no`.
- `courses.csv`: Has five headers - `name`, `course_code`, `credits`, `criteria`, `cutoffs`.

If the criteria is `manual`, that is the faculty will manually assign students grade - cutoffs column will be empty.
Otherwise, cutoff column has 7 distinct values - representing cutoffs for AA, AB, BB upto DD. Any score below the final cutoff should be assigned fail grade.

- `course_registrations.csv`: Has three headers - `name`, `roll_no`, `course_code`.
- `exams.csv`: Has three headers -> `name`, `course_code`, `maximum_marks`, `weightage`
- `exam_results.csv`: Has five headers -> `student_name`, `roll_no`, `course_code`, `exam_name`, `marks_obtained`.
