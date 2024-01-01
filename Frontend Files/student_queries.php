<!DOCTYPE html>
<html>
<head>
    <title>SQL Query Results</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
        }
        h1 {
            text-align: center;
        }
        table {
            border-collapse: collapse;
            width: 100%;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
    
    <?php
    // Establish a database connection
    $servername = "sql111.infinityfree.com";
    $username = "if0_34849519";
    $password = "bXnKi0wr1bj";
    $dbname = "if0_34849519_udemy_mock";
    
    $conn = new mysqli($servername, $username, $password, $dbname);
    
    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
    
    // Get the selected option from the form
    if (isset($_POST['selected_option'])) {
        $selectedOption = $_POST['selected_option'];
        
        // Run different SQL queries based on the selected option
        if ($selectedOption === 'q1') {
            $keyword = $_POST['search_text'];
            echo "<h1>Search results for ". $keyword. ":</h1>";
            $query = "SELECT DISTINCT result_title as 'Search Results', result_type as 'Found in'
FROM (
SELECT c.course_title AS result_title, 'Course' AS result_type, 1 AS match_order
FROM course c
WHERE c.course_title = '$keyword'
UNION
SELECT CONCAT(i.first_name, ' ', i.last_name) AS result_title, 'Instructor' AS result_type, 2 AS match_order
FROM instructor i
WHERE i.first_name = '$keyword' OR i.last_name = '$keyword'
UNION
SELECT cat.category AS result_title, 'Category' AS result_type, 3 AS match_order
FROM category cat
WHERE cat.category = '$keyword'
UNION
SELECT c.course_title AS result_title, 'Course' AS result_type, 4 AS match_order
FROM course c
WHERE c.course_title LIKE '%$keyword%'
UNION
SELECT CONCAT(i.first_name, ' ', i.last_name) AS result_title, 'Instructor' AS result_type, 5 AS match_order
FROM instructor i
WHERE i.first_name LIKE '%$keyword%' OR i.last_name LIKE '%$keyword%'
UNION
SELECT cat.category AS result_title, 'Category' AS result_type, 6 AS match_order
FROM category cat
WHERE cat.category LIKE '%$keyword%'
) AS results
ORDER BY match_order, result_title
LIMIT 100;
";
        } elseif ($selectedOption === 'q2') {
            echo "<h1>Here are the courses based on your filters:</h1>";
            $minPrice = $_POST['min_price'];
            $maxPrice = $_POST['max_price'];
            $selectedLanguage = $_POST['language'];
            $selectedCategory = $_POST['category_filter'];
            $query = "SELECT course_title as 'Course', price
FROM course
INNER JOIN category on course.category_id = category.category_id
WHERE language = '$selectedLanguage' AND category.category = '$selectedCategory'
AND price >= $minPrice AND price <= $maxPrice
ORDER BY price ASC";
        } elseif ($selectedOption === 'q3') {
            echo "<h1>Here is the list of all courses:</h1>";
            $query = "SELECT course_title as 'Course', course_desc as 'Description', price, language, tag
FROM (
SELECT c.course_id, c.course_title, c.course_desc, c.price, c.language, c.category_id,
CASE
WHEN c.course_id IN (
SELECT e.course_id
FROM (
SELECT course_id, COUNT(*) AS enrollment_count
FROM enrollment
GROUP BY course_id
ORDER BY enrollment_count DESC
LIMIT 3
) e
) THEN 'Bestseller'
WHEN ci.creation_date >= DATE_SUB(NOW(), INTERVAL 1 MONTH) THEN 'New'
ELSE NULL
END AS tag
FROM course c
LEFT JOIN course_instructor ci ON c.course_id = ci.course_id
) AS tagged_courses
ORDER BY tag DESC, price ASC";
} 
        elseif ($selectedOption === 'q4') {
            echo "<h1>Here are the top course categories that similar students like you are learning:</h1>";
            $age = $_POST['age'];
            $education = $_POST['education'];
            $region = $_POST['region'];
            $query = "select category from
(SELECT
cat.category,
COUNT(DISTINCT s.student_id) AS enrolled_students
FROM student s
JOIN enrollment e ON s.student_id = e.student_id
JOIN course c ON e.course_id = c.course_id
JOIN category cat ON c.category_id = cat.category_id
WHERE
s.region = '$region' AND
s.education_level = '$education' AND
" . ($age - 10) . " AND " . ($age + 10) ."
GROUP BY cat.category
ORDER BY enrolled_students DESC) A;
";
        }
        elseif ($selectedOption === 'q5') {
            $selectedCategory = $_POST['category'];
            echo "<h1>Here are the top courses in ". $selectedCategory. ":</h1>";
            $query = "SELECT course_title as 'Course', course_desc as 'Description', price, language
FROM course c
JOIN category ct on c.category_id = ct.category_id
JOIN (
SELECT
course_id,
COUNT(enrollment_id) AS enrollments
FROM enrollment
GROUP BY course_id
ORDER BY enrollments DESC
LIMIT 10
) AS top_courses ON c.course_id = top_courses.course_id
WHERE ct.category = '$selectedCategory'
ORDER BY top_courses.enrollments DESC;
";
        }
        elseif ($selectedOption === 'q6') {
            echo "<h1>Here are the details of all Course Instructors:</h1>";
            $query = "SELECT
concat(i.first_name, ' ',i.last_name) as 'Instructor', i.email,
i.education_level as 'Qualifications', i.occupation as 'Job Title',
COUNT(DISTINCT ci.course_id) AS 'Number of Courses',
COUNT(DISTINCT e.student_id) AS 'Total Students',
ROUND(AVG(e.course_rating), 2) AS 'Average Rating'
FROM instructor i
JOIN course_instructor ci ON i.instructor_id = ci.instructor_id
JOIN course c ON ci.course_id = c.course_id
LEFT JOIN enrollment e ON c.course_id = e.course_id
GROUP BY i.instructor_id, i.first_name, i.last_name
ORDER BY ROUND(AVG(e.course_rating), 2) DESC;
";
        }
        elseif ($selectedOption === 'q7') {
            $sid = $_POST['student_id'];
            echo "<h1>Student Dashboard for ". $sid. ":</h1>";
            $query = "SELECT concat(s.first_name, ' ',s.last_name) as 'Name', email,
s.signup_date as 'Sign-up Date', s.education_level as 'Education Level',
s.program, s.occupation, s.dob as 'Date of Birth', s.region,
COUNT(DISTINCT e.course_id) AS 'Total Courses Enrolled',
COUNT(DISTINCT CASE WHEN e.completion_date IS NULL THEN e.course_id END) AS 'No of Ongoing Courses',
COALESCE(SUM(gc.gift_amount), 0) AS 'Gift Card Balance'
FROM student s
LEFT JOIN enrollment e ON s.student_id = e.student_id
LEFT JOIN gift_card gc ON s.student_id = gc.student_id
WHERE s.student_id = '$sid';
";
        }
        
        else {
            echo "<h2>Please select a valid choice</h2>";
        }
        
        // Execute the query and print the results
        $result = $conn->query($query);
        
        echo "<h2>Query Results</h2>";
        
        if ($result->num_rows > 0) {
            echo "<table>";
            $firstRow = true;
            while ($row = $result->fetch_assoc()) {
                if ($firstRow) {
                    echo "<tr>";
                    foreach ($row as $key => $value) {
                        echo "<th>" . $key . "</th>";
                    }
                    echo "</tr>";
                    $firstRow = false;
                }
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>" . $value . "</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
        
        echo '<h2>Query</h2>';
        echo '<pre style="padding: 10px; background-color: #f5f5f5; border: 1px solid #ddd; overflow: auto; text-align: left;">';
        echo htmlspecialchars($query);
        echo '</pre>';
    }

if ($result === false) {
    echo "Query error: " . $conn->error;
}
    
    // Close the database connection
    $conn->close();
    ?>
    
    <br><br>
    <a href="student.html">Go back to Student Portal</a>
</body>
</html>