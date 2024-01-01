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
    <h1>Here's the information you requested</h1>
    
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
        if ($selectedOption === 'q8') {
            echo "<h1>Customer retention rate</h1>
            <h3>Display number of courses enrolled by 
            each student, and the number of days since their last enrollment.</h3>";
            $query = 'SELECT concat(s.first_name, " ",s.last_name) as "Name",email,
            s.signup_date as "Sign-up Date", s.education_level as "Education Level",
            COUNT(e.course_id) AS "Number of courses enrolled",
            DATEDIFF(CURDATE(), MAX(e.purchase_date)) AS "Days since last enrollment"
            FROM student s
            LEFT JOIN enrollment e ON s.student_id = e.student_id
            GROUP BY s.student_id, s.first_name, s.last_name
            ORDER BY s.student_id;';
        }
         elseif ($selectedOption === 'q9') {
            echo "<h1>Past Education Level vs. Course Level</h1>
            <h3>Identify correlations between the past education level of students and the course categories that they are enrolling in, and their completion rates.</h3>";
            $query = 'SELECT
            s.education_level as "Education Level",
            cat.category as "Category",
            COUNT(DISTINCT e.student_id) AS "No of Enrolled Students",
            ROUND(
                COUNT(DISTINCT CASE WHEN e.completion_date IS NOT NULL THEN e.student_id END) /
                COUNT(DISTINCT e.student_id) * 100, 2
            ) AS "Completion Rate"
            FROM student s
            JOIN enrollment e ON s.student_id = e.student_id
            JOIN course c ON e.course_id = c.course_id
            JOIN category cat ON c.category_id = cat.category_id
            GROUP BY s.education_level, cat.category
            ORDER BY s.education_level, cat.category;';
        } 
        elseif ($selectedOption === 'q10') {
            echo "<h1> Course Price Sensitivity</h1>
            <h3>Compare course price with enrolment and completion rates.</h3>";

            $query = 'SELECT
            CASE
                WHEN YEAR(CURDATE()) - YEAR(s.dob) < 18 THEN "<18"
                WHEN YEAR(CURDATE()) - YEAR(s.dob) BETWEEN 18 AND 35 THEN "18-35"
                WHEN YEAR(CURDATE()) - YEAR(s.dob) BETWEEN 36 AND 60 THEN "35-60"
                ELSE ">60"
            END AS "Age_Group",
            CASE
                WHEN c.price = 0 THEN "0"
                WHEN c.price < 50 THEN "<50"
                ELSE ">50"
            END AS "Course_Price",
            COUNT(e.enrollment_id) AS number_of_enrollments
            FROM student s
            JOIN enrollment e ON s.student_id = e.student_id
            JOIN course c ON e.course_id = c.course_id
            GROUP BY Age_Group, Course_Price
            ORDER BY Age_Group, COUNT(e.enrollment_id) DESC;';
        }
         elseif ($selectedOption === 'q11') {
            echo "<h1>Free to Paid Conversation Rate</h1>
            <h3>Count the students who first 
            enrolled in a free course and later enrolled in a paid course.
            </h3>";

            $query = 'SELECT COUNT(DISTINCT s.student_id) AS converted_students
FROM student s
JOIN enrollment e ON s.student_id = e.student_id
JOIN course c ON e.course_id = c.course_id
WHERE c.price = 0
AND s.student_id IN (SELECT student_id FROM enrollment JOIN course ON enrollment.course_id = course.course_id WHERE price > 0);
';
        }elseif ($selectedOption === 'q12') {
            echo "<h1>Course Sharing Mediums - calculates the number of unique courses shared on each medium.</h1>";

            $query = 'SELECT shared_medium, COUNT(DISTINCT course_id) AS number_of_courses_shared
            FROM student_course_sharing
            GROUP BY shared_medium;
            ';
        } 
        elseif ($selectedOption === 'q13') {
            echo "<h1>Course Enrollments Per Semester</h1>
            <h3>calculates the number of enrollments for each week over a semester. 
            The semester is assumed to be from January to June.</h3>";
            $query = 'SELECT 
            YEAR(purchase_date) AS year,
            WEEK(purchase_date) AS week,
            COUNT(enrollment_id) AS number_of_enrollments
        FROM enrollment
        WHERE purchase_date BETWEEN "2021-01-01" AND "2021-06-30"
        GROUP BY YEAR(purchase_date), WEEK(purchase_date)
        ORDER BY year, week;
        ';
        } 
        elseif ($selectedOption === 'q14') {
            echo "<h1>Course Length and Completion Rate Correlation</h1>
            <h3>display the video lengths, total number of enrollments and course completion rates for different courses</h3>";
            $query = 'SELECT  
            CASE 
                WHEN a5.Video_Length_Per_Course >= 0 AND a5.Video_Length_Per_Course < 3 THEN "< 3" 
                WHEN a5.Video_Length_Per_Course >= 3 AND a5.Video_Length_Per_Course < 9 THEN "3-8" 
                WHEN a5.Video_Length_Per_Course >= 9 AND a5.Video_Length_Per_Course < 15 THEN "9-14" 
                WHEN a5.Video_Length_Per_Course >= 15 AND a5.Video_Length_Per_Course < 21 THEN "15-20" 
                WHEN a5.Video_Length_Per_Course >= 21 THEN ">= 21" 
            END AS "Video_Length_Interval_Hrs", 
            SUM(a6.Number_of_Enrollments_Per_Course) AS "Number_of_Enrollments",
            AVG(a6.Completion_Rate) AS "Completion_Rate"
        FROM  
            ( 
            SELECT c.course_id, ROUND(SUM(length_min)/60, 0) AS "Video_Length_Per_Course"
            FROM course c 
            INNER JOIN video v ON c.course_id = v.course_id 
            GROUP BY c.course_id 
            ) AS a5 
        INNER JOIN 
            ( 
            SELECT c.course_id, COUNT(*) AS "Number_of_Enrollments_Per_Course", temp.Completion_Rate
            FROM course c 
            INNER JOIN (
                SELECT
                    e.course_id,
                    ROUND(
                        COUNT(DISTINCT CASE WHEN e.completion_date IS NOT NULL THEN e.student_id END) /
                        COUNT(DISTINCT e.student_id) * 100, 2
                    ) AS "Completion_Rate"
                FROM student s
                JOIN enrollment e ON s.student_id = e.student_id
                GROUP BY e.course_id
            ) AS temp
            ON c.course_id = temp.course_id 
            GROUP BY c.course_id 
            ) AS a6 
        ON a5.course_id = a6.course_id 
        GROUP BY "Video_Length_Interval_Hrs" 
        ORDER BY "Number_of_Enrollments" DESC;
        ';                 
        } 
        elseif ($selectedOption === 'q15') {
            echo "<h1>Important Customers</h1>
            <h3>Identify the customers who need attention from the company.
            <ul>
            <li>It is assumed customers who have purchased more courses from the company than average are “Loyal” customers. Others are labeled as “Normal” customers.</li>
            <li>It is assumed customers who have a greater number of days_since_last_purchase than average are “IDLE” customers. Others are labeled as “Active” customers. </li>
            <li>It is assumed customers who have paid the company more than the average are “Valuable” customers. Others are labeled as “Typical” customers.             </li>
            <li>Based on previous segments, “Loyal” customers who are “Valuable” but are “IDLE” need urgent attention from the company. </li>
            <li>It is assumed that the current date of this analysis is the day after the last purchased ticket we produced in the fake data. In other words, days_since_last_purchase is based on November 9th, 2020. </li>
            </ul>
            </h3>";

            $query = 'SELECT student_id as urgent_attention_customer
            FROM (
                SELECT 
                    student_id,
                    COUNT(enrollment.course_id) AS courses_purchased,
                    MAX(purchase_date) AS last_purchase_date,
                    SUM(price) AS total_spent,
                    AVG(DATEDIFF(purchase_date, "2020-11-09")) OVER() AS avg_days_since_last_purchase,
                    AVG(price) OVER() AS avg_total_spent,
                    AVG(COUNT(enrollment.course_id)) OVER() AS avg_courses_purchased
                FROM enrollment
                JOIN course ON enrollment.course_id = course.course_id
                WHERE price > 0
                GROUP BY student_id
            ) AS CustomerSegmentation
            WHERE 
                courses_purchased > avg_courses_purchased
            AND DATEDIFF(last_purchase_date, "2020-11-09") > avg_days_since_last_purchase
            AND total_spent > avg_total_spent;
            ';
        } 
        elseif ($selectedOption === 'q16') {
            echo "<h1>Class Enrollment Rate</h1>
            <h3>Of all the students who were recommended a class, count how many actually enrolled for the class.</h3>";

            $query = 'SELECT  COUNT(DISTINCT enrollment_id) AS TotalEnrollments , COUNT(DISTINCT CourseSharing.student_id) AS EnrollmentsAfterRecommendation 
            FROM enrollment, (SELECT student_id, shared_with_student_id, course_id  
            FROM student_course_sharing) AS CourseSharing
            WHERE CourseSharing.shared_with_student_id = enrollment.student_id;';
        } 
        elseif ($selectedOption === 'q17') {
            echo "<h1>Bestseller Course Per Category</h1>
            <h3>Find the top 1 bestseller course(s) (the paid course(s) with the most enrollments) in each category. 
            The top 1 bestseller is based on ranking of total number enrollments. If there are multiple courses in top 1 rank with the same number of total enrollments, they will all be displayed.</h3>
            ";

            $query = 'SELECT category_name, course_id, total_enrollments
            FROM (
                SELECT 
                    ca.category AS category_name,
                    c.course_id,
                    COUNT(e.enrollment_id) AS total_enrollments,
                    RANK() OVER(PARTITION BY ca.category ORDER BY COUNT(e.enrollment_id) DESC) as ranking
                FROM course c
                JOIN enrollment e ON c.course_id = e.course_id
                JOIN category ca ON c.category_id = ca.category_id
                WHERE price > 0
                GROUP BY ca.category, c.course_id
            ) AS RankedCourses
            WHERE ranking = 1;
            ';
        } 
         elseif ($selectedOption === 'q18') { 
            echo "<h1>Gift Card Recipient Purchases</h1>
            <h3>We are curious whether students who achieve gift cards are more likely to buy courses. 
            This query find the students who both received gift cards and pay for the non-free courses.</h3>";
                   
            $query = 'SELECT DISTINCT
            s.student_id,
            s.first_name,
            s.last_name
        FROM student s
        JOIN enrollment e ON s.student_id = e.student_id
        JOIN course c ON e.course_id = c.course_id
        JOIN gift_card g ON s.student_id = g.student_id
        WHERE c.price > 0;
        ';
        } 
         elseif ($selectedOption === 'q19') {
            echo "<h1>Average Time for Completion - the average period between purchase date and complete date based on course.</h1>";

            $query = 'SELECT 
            e.course_id,
            c.course_title,
            AVG(DATEDIFF(e.completion_date, e.purchase_date)) AS avg_completion_days
        FROM enrollment e
        JOIN course c ON e.course_id = c.course_id
        WHERE e.completion_date IS NOT NULL
        GROUP BY e.course_id, c.course_title
        ORDER BY avg_completion_days DESC;
        ';                    
        } 
     elseif ($selectedOption === 'q20') {
        echo "<h1>Instructor Course Analysis</h1>
         <h3>Observe the diversity of audiences and course categories for each instructor.
        <br>
        <ul>
        Assumptions:
        <li>Diversity of audiences refers to the total number of different regions for all students in all courses taught by an instructor. </li>
        <li>Diversity of course categories refer to the total number of different categories for all courses taught by an instructor.  </li>
        <li>Category here refers to the main category, not the subcategory.</li>
        
        </ul>
</h3>
        ";

            $query = 'SELECT 
            i.instructor_id,
            i.first_name,
            i.last_name,
            COUNT(DISTINCT s.region) AS audience_diversity,
            COUNT(DISTINCT c.category_id) AS category_diversity
        FROM instructor i
        JOIN course_instructor ci ON i.instructor_id = ci.instructor_id
        JOIN course c ON ci.course_id = c.course_id
        JOIN enrollment e ON c.course_id = e.course_id
        JOIN student s ON e.student_id = s.student_id
        GROUP BY i.instructor_id, i.first_name, i.last_name
        ORDER BY i.instructor_id;
        ';
        }
        else {
            $query = "SELECT * FROM instructor";
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
        
        echo "<h2>Query</h2>";
        echo '<pre style="padding: 10px; background-color: #f5f5f5; border: 1px solid #ddd; overflow: auto; text-align: left;">';
        echo "<p>" . $query . "</p>";
        echo '</pre>';
    }

if ($result === false) {
    echo "Query error: " . $conn->error;
}
    
    // Close the database connection
    $conn->close();
    ?>
    
    <br><br>
    <a href="admin.html">Go back to Admin Portal</a>
</body>
</html>