-- CREATE TABLE QUERIES

CREATE TABLE category (
    category_id VARCHAR(20) PRIMARY KEY,
    category VARCHAR(100)
);

CREATE TABLE course (
    course_id VARCHAR(20) PRIMARY KEY,
    category_id VARCHAR(20),
    course_title VARCHAR(100),
    course_desc TEXT,
    price FLOAT,
    language VARCHAR(45),
    FOREIGN KEY (category_id) REFERENCES category(category_id)
);

CREATE TABLE video (
    video_id VARCHAR(20) PRIMARY KEY,
    course_id VARCHAR(20),
    video_name VARCHAR(255),
    length_min FLOAT,
    video_url VARCHAR(100),
    FOREIGN KEY (course_id) REFERENCES course(course_id)
);

CREATE TABLE quiz (
    quiz_id VARCHAR(20) PRIMARY KEY,
    course_id VARCHAR(20),
    quiz_type VARCHAR(20),
    difficulty_level VARCHAR(20),
    quiz_url VARCHAR(100),
    FOREIGN KEY (course_id) REFERENCES course(course_id)
);

CREATE TABLE instructor (
    instructor_id VARCHAR(20) PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    signup_date DATE,
    education_level VARCHAR(45),
    occupation VARCHAR(100),
    dob DATE
);

CREATE TABLE course_instructor (
    course_instructor_id VARCHAR(20) PRIMARY KEY,
    course_id VARCHAR(20),
    instructor_id VARCHAR(20),
    creation_date DATE,
    update_date DATE,
    FOREIGN KEY (course_id) REFERENCES course(course_id),
    FOREIGN KEY (instructor_id) REFERENCES instructor(instructor_id)
);

CREATE TABLE student (
    student_id VARCHAR(20) PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    signup_date DATE,
    education_level VARCHAR(100),
    program VARCHAR(100),
    occupation VARCHAR(100),
    dob DATE,
    region VARCHAR(45)
);

CREATE TABLE enrollment (
    enrollment_id VARCHAR(20) PRIMARY KEY,
    student_id VARCHAR(20),
    course_id VARCHAR(20),
    completion_date DATE,
    course_rating FLOAT,
    purchase_date DATE,
    time_taken_min FLOAT,
    wishlisted BOOLEAN,
    discount_percent FLOAT,
    prior_proficiency VARCHAR(45),
    final_grade VARCHAR(10),
    course_comments TEXT,
    payment_method VARCHAR(50),
    FOREIGN KEY (student_id) REFERENCES student(student_id),
    FOREIGN KEY (course_id) REFERENCES course(course_id)
);

CREATE TABLE student_course_sharing (
    student_course_share_id VARCHAR(20) PRIMARY KEY,
    student_id VARCHAR(20),
    course_id VARCHAR(20),
    shared_date DATE,
    shared_medium VARCHAR(50),
    shared_with_student_id VARCHAR(20),
    FOREIGN KEY (student_id) REFERENCES student(student_id),
    FOREIGN KEY (course_id) REFERENCES course(course_id),
    FOREIGN KEY (shared_with_student_id) REFERENCES student(student_id)
);

CREATE TABLE gift_card (
    gift_card_id VARCHAR(20) PRIMARY KEY,
    student_id VARCHAR(20),
    gift_amount DECIMAL(6,2),
    gift_source VARCHAR(50),
    FOREIGN KEY (student_id) REFERENCES student(student_id)
);

CREATE TABLE skill (
    Skill_id VARCHAR(20) PRIMARY KEY,
    student_id VARCHAR(20),
    Skill_name VARCHAR(50),
    proficiency VARCHAR(20),
    FOREIGN KEY (student_id) REFERENCES student(student_id)
);
