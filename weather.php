
<?php 
    if($_GET['city'])
    {
        $city = str_replace(' ','-', $_GET['city']);
        $weather = "";
        $error = "";

        $file_headers = @get_headers("http://completewebdevelopercourse.com/locations/".$city);

        if($file_headers[0] == 'HTTP/1.1 404 Not Found'){
            $error = "That city could not be found";
        }
        else{
        $forecastPage = file_get_contents("http://completewebdevelopercourse.com/locations/".$city);
        $pageArray = explode ('3 Day Weather Forecast Summary:</b><span class="read-more-small"><span class="read-more-content"> <span class="phrase">',$forecastPage);
        if (sizeof($pageArray) > 1) {
            $secondPageArray = explode('</span></span></span>',$pageArray[1]);
            if (sizeof($secondPageArray) > 1) {
               $weather = $secondPageArray[0];
            }
            else{
                $error = "That city could not be found";
            }
        }
        else{
            $error = "That city could not be found";
        }
        }
    }

?>



<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

    <title>Weather scraper</title>
    <style>
        html { 
            background: url(bg.jpg) no-repeat center center fixed; 
            -webkit-background-size: cover;
            -moz-background-size: cover;
            -o-background-size: cover;
            background-size: cover;
        }

        body{
            background: none;
        }

        .container{
            text-align:center;
            margin-top:100px;
            width: 450px;
        }

        #weather {
            margin-top: 15px;
        }

        input {
            margin: 20px 0;
        }
        </style>
  </head>
  <body>
  <div class="container">
    <h1>What's the weather?</h1>

    <form>
  <div class="form-group">
    <label for="city">Enter the name of the city</label>
    <input type="text" class="form-control" id="city" name="city" placeholder="eg:London, Tokyo" value="<?php echo $_GET['city']; ?>" >
    
  </div>
  
  <button type="submit" class="btn btn-primary">Submit</button>
</form>

        <div id="weather"><?php
            if($weather)
            {
                echo '<div class="alert alert-success" role="alert">
                '.$weather.'
              </div>';
            }
            else if($error){
                echo '<div class="alert alert-danger" role="alert">
                '.$error.'
              </div>';
            }
        ?>

        </div>
    </div>



    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>
