<!DOCTYPE html>
<html>
<head>
  <title>Weather Forecast</title>
  <link rel="stylesheet" type="text/css" href="2358902_samirthapa.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;700&family=Roboto:wght@100&display=swap" rel="stylesheet">
</head>
<body>
  <div id="main">
    <div id="h-tag"><h1>Weather Forecast</h1></div>
    <div class="center">
    <input type="text" id="city-input" placeholder="Tokyo" required onkeydown="work()">
    <button id="search-btn">Search</button>
    </div>
    <div id="assigned"><p id="weather-condition" class="weather_condtion"></p><h2 id="city"></h2></div>
       <div id="info">
      <h2 id="date" class="date"></h2>
      </div>
     
    <div id="details">
      <div class="det"><div id="temperature" class="box temperature" ></div>
      <div id="pressure" class="box pressure"></div></div>
      <button id="nextButton">History</button>
      <div class="dets"> <div id="wind-speed" class="box wind-speed"></div>
      <div id="humidity" class="box humidity" ></div></div>
      
      </div>
  </div>
  <?php
  include '2358902_Samirthapa_connection.php';
  if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $jsonData = file_get_contents("php://input");
    $weatherData = json_decode($jsonData, true);
  
    $cityName = $weatherData['cityName'];
    $date = $weatherData['datee'];
    $weatherCondition = $weatherData['weatherCondition'];
    $temperature = $weatherData['temperature'];
    $pressure = $weatherData['pressure'];
    $windSpeed = $weatherData['windSpeed'];
    $humidity = $weatherData['humidity'];
  
    // Store data in the database
    if ($cityName !== null && $date !== null && $weatherCondition !== null && $temperature !== null && $pressure !== null && $windSpeed !== null && $humidity !== null) {
      // Store data in the database
      $query = "INSERT INTO information (name, data, weather_condition, windspped, temperature, press, humidity)
                VALUES ('$cityName', '$date', '$weatherCondition', '$windSpeed', '$temperature', '$pressure', '$humidity')";
      mysqli_query($con, $query);
  }
}

?>
  <script src="2358902_samirThapa.js"></script>
  <script src="https://kit.fontawesome.com/495c6333f1.js" crossorigin="anonymous"></script>
</body>
</html>
