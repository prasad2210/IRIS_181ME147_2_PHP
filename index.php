<!doctype html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"
    integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css"
    integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
  <style type="text/css">
    .main-content {
      background-color: #fff;
    }

    a {
      color: inherit;
    }

    .breadcrumb {
      background-color: transparent !important;
      padding: .1rem 0rem !important;
      margin-bottom: .25rem !important;
    }

    .dropmenu::after {
      display: inline-block;
      width: 0;
      height: 0;
      margin-left: 1.6em;
      content: "";
      border-top: .3em solid;
      border-right: .3em solid transparent;
      border-bottom: 0;
      border-left: .3em solid transparent;
    }

    ul {
      list-style-type: none;
    }

    #log-in {
      position: relative;
      top: 20px;
      left: 10px;
    }

    nav a:hover {
      background-color: #CCE5FF;

    }
  </style>

  <title>GPA calculator</title>
</head>
<?php 
  include("./php//connection.php");

  $status =  '';
  if(array_key_exists("submit", $_POST)){
    $query = "SELECT `id` FROM `courses` WHERE courseCode = '".mysqli_real_escape_string($conn, $_POST['courseCode'])."'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result)> 0){
      $status = '<div class="alert alert-warning text-center col-md-12" role="alert">Course already exists.<button type="button" class="close" data-dismiss="alert">x</button> </div>';
    }
    else{
      $query = "INSERT INTO `courses` (`courseName`, `courseCode`, `courseCredit`) VALUES 
      ('".mysqli_real_escape_string($conn, $_POST['courseName'])."', '".mysqli_real_escape_string($conn, $_POST['courseCode'])."', '".mysqli_real_escape_string($conn, $_POST['courseCredit'])."')";
      if(mysqli_query($conn, $query)){
        $status = '<div class="alert alert-success text-center col-md-12" role="alert">Course is added<button type="button" class="close" data-dismiss="alert">x</button> </div>';
      }
      else{
        $status = '<div class="alert alert-danger text-center col-md-12" role="alert">Could not add Course. try again<button type="button" class="close" data-dismiss="alert">x</button> </div>';
      }
    }
  }

  $mainBody = '';
  $subBody1 = '';
  $subBody2 = '';
  $count = 0;
  $query = "SELECT * FROM `courses`";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
      $count++;
      $mainBody .= '<tr>
        <th scope="row">'.$count.'</th>
        <td>'.$row["courseName"].'</td>
        <td>'.$row["courseCode"].'</td>
        <td>'.$row["courseCredit"].'</td>
      </tr>';
      if($count == "1"){
       $subBody1 .= '<li class="nav-item">
       <a class="nav-link active" id="'.$row["id"].'" data-toggle="tab" href="#tab-'.$row["id"].'" role="tab" aria-controls="home" aria-selected="true">'.$row["courseName"].'</a>
       </li>';
       $subBody2 .= '<div class="tab-pane fade show active" id="tab-'.$row["id"].'" role="tabpanel" aria-labelledby="profile-tab"><div class="text-center">
       <h3> Add all exams for '.$row["courseName"].'</h3>
       <form method="POST">
         <div class="form-group">
           <label for="examName">Exams</label>
           <input type="text" class="form-control" id="examName" name="examName" placeholder="Ex. Quiz1" required>
         </div>
         <div class="form-group">
           <label for="maximum">Maximum Marks</label>
           <input type="number" class="form-control" id="maximum" name="maximum" placeholder="Ex. 5" min = "0"required>
         </div>
         <div class="form-group">
           <label for="waitage">Waitage in percentage</label>
           <input type="number" class="form-control" id="waitage" name="waitage" min="1" max="100"placeholder="Ex. 25" required>
         </div>
         <div class="justify-content-center">
         <input type="hidden" name="courseId" value="'.$row["id"].'">
           <button type="submit" name="exam" value="exam" class="btn btn-primary">Add Exam</button>
         </div>
       </form>
       <form method="POST">
       <button type="submit" name="done" value="done" class="btn btn-primary">Done</button>
       </form>
       </div>
       </div>';
      }
      else{
        $subBody1 .= '<li class="nav-item ">
       <a class="nav-link" id="'.$row["id"].'" data-toggle="tab" href="#tab-'.$row["id"].'" role="tab" aria-controls="home" aria-selected="true">'.$row["courseName"].'</a>
       </li>';
       $subBody2 .= '<div class="tab-pane fade" id="tab-'.$row["id"].'" role="tabpanel" aria-labelledby="profile-tab"><div class="text-center">
       <h3> Add all exams for '.$row["courseName"].'</h3>
       <form method="POST">
         <div class="form-group">
           <label for="examName">Exams</label>
           <input type="text" class="form-control" id="examName" name="examName" placeholder="Ex. Quiz1" required>
         </div>
         <div class="form-group">
           <label for="maximum">Maximum Marks</label>
           <input type="number" class="form-control" id="maximum" name="maximum" placeholder="Ex. 5" min="0" required>
         </div>
         <div class="form-group">
           <label for="waitage">Waitage in percentage</label>
           <input type="number" class="form-control" id="waitage" name="waitage" min="1" max="100"placeholder="Ex. 25" required>
           <input type="hidden" class="form-control" name="courseId" value="'.$row["id"].'">
         </div>
         <div class="justify-content-center">
            
            <button type="submit" name="exam" value="exam" class="btn btn-primary">Add Exam</button>
         </div>
       </form>
       <form method="POST">
       <button type="submit" name="done" value="done" class="btn btn-primary">Done</button>
       </form>
       </div>
       </div>';
      }
    }
  }
  $status1 =  '';
  if(array_key_exists("exam", $_POST)){
    $query = "INSERT INTO `exams` (`courseId`, `examName`, `maximum`, `waitage`) VALUES 
    ('".mysqli_real_escape_string($conn, $_POST['courseId'])."', '".mysqli_real_escape_string($conn, $_POST['examName'])."', '".mysqli_real_escape_string($conn, $_POST['maximum'])."', 
    '".mysqli_real_escape_string($conn, $_POST['waitage'])."')";
    if(mysqli_query($conn, $query)){
      $status = '<div class="alert alert-success text-center col-md-12" role="alert">exam is added<button type="button" class="close" data-dismiss="alert">x</button> </div>';
    }
    else{
      $status = '<div class="alert alert-danger text-center col-md-12" role="alert">Could not add exam. try again<button type="button" class="close" data-dismiss="alert">x</button> </div>';
    }
  }
  $mainBody1 = '';
  $count = '0';
  $query = "SELECT * FROM `exams`";
  $result = mysqli_query($conn, $query);
  if(mysqli_num_rows($result)>0){
    while($row = mysqli_fetch_assoc($result)){
      $count++;
      $query = "SELECT `courseName` FROM `courses` WHERE id = '".mysqli_real_escape_string($conn, $row['courseId'])."'";
      $row1 = mysqli_fetch_array(mysqli_query($conn, $query));
      if(array_key_exists("courseName", $row1)){
        $mainBody1 .= '<tr>
        <th scope="row">'.$count.'</th>
        <td>'.$row1["courseName"].'</td>
        <td>'.$row["examName"].'</td>
        <td>'.$row["maximum"].'</td>
        <td>'.$row["waitage"].'</td>
      </tr>';
      }
    }
  }
  $query1 ='';

  if(array_key_exists("done", $_POST)){

        $query = "SELECT * FROM `courses`";
        $result = mysqli_query($conn, $query);
        if(mysqli_num_rows($result)>0){
          echo mysqli_num_rows($result);
          while($row = mysqli_fetch_assoc($result)){
            $query1 = '';
            echo $row['courseCode'];
            $query = "SELECT `examName` FROM `exams` WHERE courseId = ".mysqli_real_escape_string($conn, $row['id'])."";
            $result = mysqli_query($conn, $query); 
            $query1 = "CREATE TABLE ".mysqli_real_escape_string($conn, $row['courseCode'])." (
              id INT(11) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
              studentName TEXT(50) NOT NULL,
              studentId TEXT(30) NOT NULL,";
            while($row1 = mysqli_fetch_assoc($result)){
              $query1 .= "".mysqli_real_escape_string($conn, $row1['examName'])." int(11) NOT NULL,";
            } 
            $query1 = rtrim($query1, ",");
            $query1 .= ");";
            //echo $query1;
            if(mysqli_query($conn, $query1)){
              echo "prasa";
            }
            else{
              echo "sakshi";
            }
          }
        //}
      //}
    }
  }

?>

<body>
  <div class="row ">
    <figure><img src="./images/top_nav.PNG" width="100%" height="40px"></figure>
  </div>
  <div class="row">
    <div class="col-xl-10">
      <figure><img src="./images/second_nav.PNG" width="100%" height="80px"></figure>
    </div>
    <div class="col-xl-1 mt-4 font-weight-bold">
    </Div>
  </div>

  <div class="container-fluid border">
    <div class="row">
      <div class="col-md-1"></div>
      <div class="col-md-7 py-2">
        <h5>GPA Calculator</h5>
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb remalign">
            <li class="breadcrumb-item"><a href="#">Home</a></li>
            <li class="breadcrumb-item">GPA Calculator</li>
          </ol>
        </nav>
      </div>
      <div class="col-md-4 pl-4">
        <figure><img src="./images/3rd_pic.PNG" width="250px" height="35px" style="position: relative; top: 10px;">
        </figure>
      </div>
    </div>
  </div>
  <div class="row"> 
      <?php echo $status; ?>

    </div>
  <div class="row  border border-top-0">

    <div class="col-md-4 p-4 ml-4 border border-top-0">
      <div class="text-center">
        <h3> Add all Courses</h3>
        <form method="POST">
          <div class="form-group">
            <label for="courseName">Course Name</label>
            <input type="text" class="form-control" id="courseName" name="courseName" placeholder="Ex. Physics" required>
          </div>
          <div class="form-group">
            <label for="courseCode">Course Code</label>
            <input type="text" class="form-control" id="courseCode" name="courseCode" placeholder="Ex. PH110" required>
          </div>
          <div class="form-group">
            <label for="courseCode">Course Credits</label>
            <input type="number" class="form-control" id="courseCode" name="courseCredit" min="1" placeholder="Ex. 3" required>
          </div>
          <div class="justify-content-center">
            <button type="submit" name="submit" value="submit" class="btn btn-primary">Add Course</button>
          </div>
        </form>

        </div>
          <div class="row text-center mx-2">
        </div>
    </div>
    <div class="col-md-7 px-2  ml-2  border border-top-0" id="main-area">
      <table class="table table-striped ">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Course Name</th>
            <th scope="col">Course Code</th>
            <th scope="col">Credits</th>
            </tr>
        </thead>
        <tbody>
          <?php echo $mainBody;?>
        </tbody>
      </table>
    </div>
  </div>
  <div class="row border border-top-0">
    <div class="col-md-4 p-4 ml-4 border border-top-0">
        <ul class="nav nav-tabs" id="myTab" role="tablist">
          <?php echo $subBody1;?>
      </ul>
      <div class="tab-content" id="myTabContent">
        <?php echo $subBody2;?>
      </div>
    </div>
    <div class="col-md-7 px-2  mx-2  border border-top-0" id="main-area">
    <div class="row"> 
      <?php echo $status; ?>
      
    </div>
      <div class="row">
        <div class="col-md-12 bg-light p-2 m-2">
          <div class=" p-2 m-2"> 
            <div class="alert alert-danger text-center col-md-12" role="alert"><h4> Warning: Add student name and roll number in first two Columns and next add all exam marks sequentially.</h4>  
            </div>  
          </div>
        </div>
        <table class="table table-striped ">
        <thead>
            <tr>
            <th scope="col">#</th>
            <th scope="col">Course Name</th>
            <th scope="col">Exam </th>
            <th scope="col">Maximum marks</th>
            <th scope="col">Waitage</th>
            </tr>
        </thead>
        <tbody>
          <?php echo $mainBody1;?>
        </tbody>
      </table>
      </div>
      <div>
        <ul class="nav nav-tabs" id="myTab1" role="tablist">
          <?php ?>
      </ul>
      </div>
    </div>
  </div>


  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"
    crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
    integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"
    crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"
    integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"
    crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/tether/1.4.7/js/tether.min.js"></script>
  <script type="text/javascript">


    // $('#myTab a').on('click', function (e) {
    //   e.preventDefault();
    //   $(this).tab('show');
    // });

    // function hideShowMenu(){
    //   if($("#hideShowMenuText").html() == "Close Menu"){
    //     $("#hideShowMenuIcon").removeClass("fa-align-right");
    //     $("#hideShowMenuIcon").addClass("fa-align-left");
    //     $("#hideShowMenuText").html("Show module menu");
    //     $("#dash").attr("hidden", true);
    //     $("#main-area").removeClass("col-md-10");
    //     $("#main-area").addClass("col-md-12");
    //   }
    //   else{
    //     $("#hideShowMenuIcon").removeClass("fa-align-left");
    //     $("#hideShowMenuIcon").addClass("fa-align-right");
    //     $("#hideShowMenuText").html("Close Menu");
    //     $("#dash").attr("hidden", false);
    //     $("#main-area").removeClass("col-md-12");
    //     $("#main-area").addClass("col-md-10");
    //   }
    //}
    // $("form").submit(function(e){
    //     if(!($("#inputPassword2").val() === $("#repeatPassword2").val())){
    //         $("#error").html('<div class="alert alert-warning" role="alert">Passwords does not matches!! Try again</div>');
    //         return false;
    //     }
    //     else {
    //         $("#error").html("");
    //         return true;
    //     }
    // });

    // $("#submit-button").submit(function(e){
    //   $('#registration').modal('show');
    //   return false;
    // });

//     $(document).ready(function() {
//       $('#submit-button button').on('click', function(e){
//       $("#editModal").val(this.id);
//       
//       e.preventDefault();
//   });
// });

  </script>
</body>

</html>