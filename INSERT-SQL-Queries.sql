-- INSERT TABLE QUERIES

-- Category Table
INSERT INTO category (category_id, category)
VALUES ('cat1', 'Programming'),
       ('cat2', 'Design'),
       ('cat3', 'Analytics'),
       ('cat4', 'Marketing'),
       ('cat5', 'Business'),
       ('cat6', 'Music'),
       ('cat7', 'Art'),
       ('cat8', 'Literature'),
       ('cat9', 'Science'),
       ('cat10', 'History');

-- Course Table
INSERT INTO course (course_id, category_id, course_title, course_desc, price, language)
VALUES ('course1', 'cat1', 'Python Basics', 'Intro to Python', 50, 'English'),
       ('course2', 'cat2', 'Design Essentials', 'Learn design principles', 0, 'English'),
       ('course3', 'cat3', 'Data Analytics', 'Deep dive into analytics', 100, 'English'),
       ('course4', 'cat4', 'Marketing 101', 'Fundamentals of marketing', 0, 'English'),
       ('course5', 'cat5', 'Business Strategies', 'Strategies for success', 150, 'English'),
       ('course6', 'cat6', 'Music Theory', 'Basics of Music', 0, 'English'),
       ('course7', 'cat7', 'Sketching 101', 'Learn to sketch', 40, 'English'),
       ('course8', 'cat8', 'Literary Classics', 'Dive into classic literature', 30, 'English'),
       ('course9', 'cat9', 'Introduction to Physics', 'Physics basics', 0, 'English'),
       ('course10', 'cat10', 'World History', 'Learn global history', 80, 'English');

-- Instructor Table
INSERT INTO instructor (instructor_id, first_name, last_name, email, signup_date, education_level, occupation, dob)
VALUES ('instr1', 'John', 'Doe', 'john.doe@email.com', '2021-01-01', 'PhD', 'Data Scientist', '1985-10-10'),
       ('instr2', 'Jane', 'Smith', 'jane.smith@email.com', '2021-02-10', 'Masters', 'Designer', '1990-05-05'),
       ('instr3', 'Alice', 'Johnson', 'alice.j@email.com', '2021-01-15', 'PhD', 'Musician', '1986-12-12'),
       ('instr4', 'Bob', 'Williams', 'bob.w@email.com', '2021-02-20', 'Bachelors', 'Artist', '1991-06-06'),
       ('instr5', 'Charlie', 'Brown', 'charlie.b@email.com', '2021-03-01', 'Masters', 'Writer', '1988-02-02'),
       ('instr6', 'Dave', 'Martin', 'dave.m@email.com', '2021-03-15', 'PhD', 'Scientist', '1992-07-07'),
       ('instr7', 'Eve', 'White', 'eve.white@email.com', '2021-01-20', 'Bachelors', 'Historian', '1987-03-03'),
       ('instr8', 'Frank', 'Taylor', 'frank.t@email.com', '2021-02-05', 'Masters', 'Marketer', '1990-11-11'),
       ('instr9', 'Grace', 'Lee', 'grace.l@email.com', '2021-03-10', 'PhD', 'Programmer', '1989-09-09'),
       ('instr10', 'Hank', 'Moore', 'hank.m@email.com', '2021-01-25', 'Bachelors', 'Businessman', '1993-04-04');

-- Course_Instructor Table (Linking courses and instructors)
INSERT INTO course_instructor (course_instructor_id, course_id, instructor_id, creation_date, update_date)
VALUES ('ci1', 'course1', 'instr1', '2021-01-15', '2021-01-20'),
       ('ci2', 'course2', 'instr2', '2021-02-15', '2021-02-20'),
       ('ci3', 'course3', 'instr1', '2021-01-20', '2021-01-25'),
       ('ci4', 'course4', 'instr2', '2021-02-20', '2021-02-25'),
       ('ci5', 'course5', 'instr3', '2021-01-25', '2021-01-30'),
       ('ci6', 'course6', 'instr4', '2021-02-25', '2021-03-01'),
       ('ci7', 'course7', 'instr5', '2021-01-30', '2021-02-04'),
       ('ci8', 'course8', 'instr6', '2021-03-01', '2021-03-06'),
       ('ci9', 'course9', 'instr7', '2021-02-04', '2021-02-09'),
       ('ci10', 'course10', 'instr8', '2021-03-06', '2021-03-11');

-- Student Table
INSERT INTO student (student_id, first_name, last_name, email, signup_date, education_level, program, occupation, dob, region)
VALUES ('stud1', 'Isaac', 'Newton', 'isaac.n@email.com', '2021-03-01', 'Bachelors', 'Science', 'Scientist', '1995-04-04', 'Europe'),
       ('stud2', 'Julia', 'Roberts', 'julia.r@email.com', '2021-03-10', 'Masters', 'Arts', 'Actress', '1992-03-03', 'North America'),
       ('stud3', 'Kevin', 'Spacey', 'kevin.s@email.com', '2021-03-15', 'PhD', 'Literature', 'Actor', '1990-02-02', 'North America'),
       ('stud4', 'Lucy', 'Liu', 'lucy.l@email.com', '2021-03-20', 'Bachelors', 'Business', 'Businesswoman', '1993-01-01', 'Asia'),
       ('stud5', 'Mike', 'Tyson', 'mike.t@email.com', '2021-03-25', 'Bachelors', 'Sports', 'Boxer', '1988-12-12', 'North America'),
       ('stud6', 'Nina', 'Dobrev', 'nina.d@email.com', '2021-03-30', 'Masters', 'Arts', 'Actress', '1991-11-11', 'Europe'),
       ('stud7', 'Oscar', 'Wilde', 'oscar.w@email.com', '2021-04-01', 'PhD', 'Literature', 'Writer', '1987-10-10', 'Europe'),
       ('stud8', 'Paul', 'Walker', 'paul.w@email.com', '2021-04-05', 'Bachelors', 'Arts', 'Actor', '1989-09-09', 'North America'),
       ('stud9', 'Queen', 'Latifah', 'queen.l@email.com', '2021-04-10', 'Masters', 'Music', 'Singer', '1990-08-08', 'North America'),
       ('stud10', 'Robert', 'Pattinson', 'robert.p@email.com', '2021-04-15', 'Bachelors', 'Arts', 'Actor', '1992-07-07', 'Europe'),
       ('stud11', 'Liam', 'Johnson', 'liam.johnson@email.com', '2021-01-05', 'Masters', 'Business', 'Manager', '1990-08-05', 'North America'),
('stud12', 'Emma', 'Smith', 'emma.smith@email.com', '2021-01-10', 'Masters', 'Engineering', 'Engineer', '1991-09-10', 'Europe');

-- Enrollment Table (Inserting records for enrollments, ensuring some students enroll in both free and paid courses)
INSERT INTO enrollment (enrollment_id, student_id, course_id, completion_date, course_rating, purchase_date, time_taken_min, wishlisted, discount_percent, prior_proficiency, final_grade, course_comments, payment_method)
VALUES ('enrol1', 'stud1', 'course1', NULL, 4.5, '2021-04-01', 300, FALSE, 0, 'Beginner', NULL, 'Good course', 'Credit Card'),
    ('enrol2', 'stud1', 'course2', NULL, 4, '2021-04-05', 250, TRUE, 0, 'Intermediate', NULL, 'Decent course', 'None'),
    ('enrol3', 'stud2', 'course2', '2021-05-10', 3.5, '2021-04-10', 200, FALSE, 10, 'Beginner', 'C+', 'Average course', 'Debit Card'),
    ('enrol4', 'stud2', 'course3', '2021-05-15', 5, '2021-04-15', 400, FALSE, 0, 'Advanced', 'A+', 'Excellent course', 'Credit Card'),
    ('enrol5', 'stud3', 'course4', '2021-05-20', 3, '2021-04-20', 350, TRUE, 0, 'Beginner', 'C', 'Below average course', 'None'),
    ('enrol6', 'stud3', 'course5', '2021-05-25', 4.5, '2021-04-25', 500, FALSE, 5, 'Intermediate', 'B+', 'Good course', 'Credit Card'),
    ('enrol7', 'stud4', 'course6', '2021-05-30', 4.8, '2021-04-30', 450, TRUE, 0, 'Advanced', 'A', 'Very good course', 'None'),
    ('enrol8', 'stud4', 'course7', '2021-06-01', 4.2, '2021-05-01', 300, FALSE, 0, 'Beginner', 'B', 'Decent course', 'Credit Card'),
    ('enrol9', 'stud5', 'course8', '2021-06-05', 3.8, '2021-05-05', 280, FALSE, 10, 'Intermediate', 'C+', 'Average course', 'Debit Card'),
    ('enrol10', 'stud5', 'course9', '2021-06-10', 5, '2021-05-10', 550, TRUE, 0, 'Advanced', 'A+', 'Excellent course', 'Credit Card'),
    ('enrol26', 'stud6', 'course4', '2021-05-05', 4.3, '2021-04-02', 320, FALSE, 0, 'Beginner', 'A-', 'Loved the course', 'Credit Card'),
    ('enrol11', 'stud7', 'course5', '2021-05-08', 4.8, '2021-04-03', 420, TRUE, 10, 'Intermediate', 'A+', 'Fantastic content', 'Debit Card'),
    ('enrol12', 'stud8', 'course6', '2021-05-10', 4.1, '2021-04-08', 290, FALSE, 5, 'Advanced', 'B+', 'Great insights', 'Credit Card'),
    ('enrol13', 'stud9', 'course7', '2021-05-12', 4.4, '2021-04-10', 310, TRUE, 0, 'Beginner', 'A', 'Very enlightening', 'Credit Card'),
    ('enrol14', 'stud10', 'course8', '2021-05-15', 4.5, '2021-04-15', 330, FALSE, 0, 'Intermediate', 'A-', 'Well structured', 'Debit Card'),
    ('enrol15', 'stud1', 'course4', '2021-05-20', 4.2, '2021-04-18', 340, FALSE, 5, 'Advanced', 'B+', 'Very informative', 'Credit Card'),
    ('enrol16', 'stud2', 'course5', '2021-05-22', 4.6, '2021-04-20', 360, TRUE, 10, 'Intermediate', 'A', 'Highly recommend', 'Debit Card'),
    ('enrol17', 'stud3', 'course6', '2021-05-25', 4.0, '2021-04-23', 280, FALSE, 0, 'Beginner', 'B', 'Good course overall', 'Credit Card'),
    ('enrol18', 'stud4', 'course7', '2021-05-28', 4.3, '2021-04-28', 320, TRUE, 5, 'Advanced', 'B+', 'Quite detailed', 'Credit Card'),
    ('enrol19', 'stud5', 'course8', '2021-06-01', 4.4, '2021-05-01', 350, FALSE, 0, 'Intermediate', 'A-', 'Worth every penny', 'Debit Card'),
    ('enrol20', 'stud5', 'course7', '2021-06-01', 4.4, '2021-05-01', 350, FALSE, 0, 'Intermediate', 'A-', 'Worth every penny', 'Debit Card'),
    ('enrol21', 'stud11', 'course1', '2021-05-11', 4.5, '2021-04-01', 330, FALSE, 0, 'Beginner', 'A-', 'Loved the course', 'Credit Card'),
('enrol22', 'stud11', 'course2', '2021-05-12', 4.7, '2021-04-02', 320, FALSE, 0, 'Intermediate', 'A', 'Fantastic content', 'Debit Card'),
('enrol23', 'stud11', 'course3', '2021-05-13', 4.8, '2021-04-03', 350, FALSE, 5, 'Advanced', 'A+', 'Great insights', 'Credit Card'),
('enrol24', 'stud11', 'course4', '2021-05-14', 4.6, '2021-04-04', 340, FALSE, 0, 'Advanced', 'A-', 'Very informative', 'Debit Card'),
('enrol25', 'stud12', 'course5', '2021-02-01', 4.5, '2021-01-01', 320, TRUE, 0, 'Beginner', 'B+', 'Good course overall', 'Credit Card');
-- Video Table
INSERT INTO video (video_id, course_id, video_name, length_min, video_url)
VALUES ('video1', 'course1', 'Python Intro', 120, 'url1'),
    ('video2', 'course1', 'Python Variables', 130, 'url2'),
    ('video3', 'course2', 'Design Basics', 125, 'url3'),
    ('video4', 'course3', 'Analytics with SQL', 75, 'url4'),
    ('video5', 'course3', 'Big Data Analytics', 80, 'url5'),
    ('video6', 'course4', 'Marketing Trends 2021', 40, 'url6'),
    ('video7', 'course5', 'Business Growth Strategies', 55, 'url7'),
    ('video8', 'course6', 'Music Theory for Beginners', 35, 'url8'),
    ('video9', 'course7', 'Sketching Techniques', 30, 'url9'),
    ('video10', 'course8', 'Literature in the 20th Century', 45, 'url10');

-- Quiz Table
INSERT INTO quiz (quiz_id, course_id, quiz_type, difficulty_level, quiz_url)
VALUES ('quiz1', 'course1', 'MCQ', 'Easy', 'qurl1'),
       ('quiz2', 'course1', 'Assignment', 'Medium', 'qurl2'),
       ('quiz3', 'course2', 'MCQ', 'Hard', 'qurl3'),
       ('quiz4', 'course3', 'MCQ', 'Medium', 'qurl4'),
       ('quiz5', 'course4', 'MCQ', 'Easy', 'qurl5'),
       ('quiz6', 'course5', 'Assignment', 'Hard', 'qurl6'),
       ('quiz7', 'course6', 'MCQ', 'Easy', 'qurl7'),
       ('quiz8', 'course7', 'MCQ', 'Medium', 'qurl8'),
       ('quiz9', 'course8', 'Assignment', 'Hard', 'qurl9'),
       ('quiz10', 'course9', 'MCQ', 'Medium', 'qurl10');

-- Gift Card Table
INSERT INTO gift_card (gift_card_id, student_id, gift_amount, gift_source)
VALUES ('gc1', 'stud1', 50, 'Event Prize'),
       ('gc2', 'stud2', 25, 'Referral'),
       ('gc3', 'stud3', 75, 'Birthday Offer'),
       ('gc4', 'stud4', 50, 'Anniversary Offer'),
       ('gc5', 'stud5', 100, 'Festive Offer'),
       ('gc6', 'stud6', 40, 'Special Promotion'),
       ('gc7', 'stud7', 60, 'Referral'),
       ('gc8', 'stud8', 80, 'Loyalty Program'),
       ('gc9', 'stud9', 20, 'Survey Participation'),
       ('gc10', 'stud10', 35, 'First Purchase Offer');

-- Student Course Sharing Table
INSERT INTO student_course_sharing (student_course_share_id, student_id, course_id, shared_date, shared_medium,shared_with_student_id)
VALUES ('share1', 'stud1', 'course1', '2021-03-05', 'Email','stud11'),
       ('share2', 'stud1', 'course2', '2021-03-10', 'Social Media','stud11'),
       ('share3', 'stud2', 'course3', '2021-03-15', 'WhatsApp','stud9'),
       ('share4', 'stud3', 'course4', '2021-03-20', 'SMS','stud5'),
       ('share5', 'stud4', 'course5', '2021-03-25', 'Email','stud2'),
       ('share6', 'stud5', 'course6', '2021-03-30', 'Social Media','stud4'),
       ('share7', 'stud6', 'course7', '2021-04-01', 'WhatsApp','stud6'),
       ('share8', 'stud7', 'course8', '2021-04-05', 'SMS','stud2'),
       ('share9', 'stud8', 'course9', '2021-04-10', 'Email','stud6'),
       ('share10', 'stud9', 'course10', '2021-04-15', 'Social Media','stud2');

-- Skill Table
INSERT INTO skill (Skill_id, student_id, Skill_name, proficiency)
VALUES ('skill1', 'stud1', 'Python', 'Intermediate'),
       ('skill2', 'stud1', 'Design', 'Beginner'),
       ('skill3', 'stud2', 'Marketing', 'Advanced'),
       ('skill4', 'stud2', 'SQL', 'Intermediate'),
       ('skill5', 'stud3', 'Sketching', 'Beginner'),
       ('skill6', 'stud4', 'Music Theory', 'Advanced'),
       ('skill7', 'stud5', 'Business Strategy', 'Intermediate'),
       ('skill8', 'stud6', 'Python', 'Beginner'),
       ('skill9', 'stud7', 'Literature', 'Advanced'),
       ('skill10', 'stud8', 'Physics', 'Intermediate');
