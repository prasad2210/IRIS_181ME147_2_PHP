# IRIS_181ME147_2_PHP

This is an a GPA calculator dashboard which is develped to extend iris website of nitk.(requirenment task)

## Set Up Instructions For Running Website
1. Start the Apache and MySQL modules using the XAMPP controller.
2. Open the phpMyAdmin and create a database "gpacalculator".
3. Import the gpacalculator.sql file present in the database folder.
4. Open the htdocs folder in the xampp folder. Copy paste the folder IRIS_181ME147_2_PHP.
5. Open the browser (chrome), type localhost/IRIS_181ME147_2_PHP and you should see the index page of the website.

## operating steps

1. start by adding all courses you need to add
2. add all exams their waitage, and max. marks.
 ### To be implemented
3. upload a csv file with name and roll no as first two columns and respective marks in all exams.
3. redirect ti the second page where you can see all statical data for all the courses and have 3 options
    1. manual
    2. Percentile
    3. cutoffs
   if you select manual list will be shown where you can assign a grades manually
   in second and third case you need to give seven values as to give grades from AA, AB to DD
   Once Done redirected to new page showing a data w.r.t. students.
       
## known bugs
1. It is creating a one table when looping through a courses data
## Reference
  1. w3school
  2. stackoverflow
