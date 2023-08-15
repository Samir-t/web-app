<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Weather App</title>
<style>
 /* Define styles for the weather container */
 body{
  background-color:#A1A1A1;
 }
.weather-container {
    display: flex;
    justify-content: center;
    align-self: center;
    margin-top: 100px;
     /* Distribute entries evenly */
     /* Allow entries to wrap onto the next line */
}

/* Define styles for the weather entries */
.weather-entry {
    width: 120px /* Adjust the width as needed */
    border: 1px solid #ccc;
    border-radius: 12px;
    padding: 10px;
    margin-bottom: 20px;
    background-color:#C3A9FF;
    box-shadow: 0px 0px 5px rgba(0, 0, 0, 0.1);
    margin: 8px;
}
#btn {
    padding: 10px 20px;
      font-size: 16px;
      margin-left: 10px;
      border-radius: 5px;
      background-color: #333;
      color: #fff;
      border: none;
      outline: none;
      cursor: pointer;
      transition: background-color 0.3s ease-in-out;
      display:flex;
      justify-content:center;
      align-items: center;
  }
  
  
  #btn:hover {
    background-color:red;
  }

</style>
</head>
<body>

<?php
include "2358902_Samirthapa_connection.php";
$query = "SELECT * FROM information ORDER BY data DESC LIMIT 7";
$data = mysqli_query($con, $query);
$json_array = array();
$Rows = mysqli_num_rows($data);
if ($Rows > 0) {
  while ($row = mysqli_fetch_assoc($data)) {
    $json_array[] = $row;
  }
  $jsonData = json_encode($json_array);
} 
?>
<button id="btn">homepage</button>
<script>

            var jsArray = <?php echo $jsonData; ?>;
            
            const weatherContainer = document.createElement("div");
            weatherContainer.classList.add('weather-container');

            jsArray.forEach(item => {
                const content = `
                    <div class="weather-entry">
                        <h2>${item.name}</h2>
                        <p>Temperature: ${item.temperature}</p>
                        <p>Humidity: ${item.humidity}</p>
                        <p>Date: ${item.data}</p>
                        <p>windspeed: ${item.windspped} m\s</p>
                        <p>pressure: ${item.press} hpa</p>
                    </div>
                `;

                weatherContainer.innerHTML += content;
            });
            document.body.appendChild(weatherContainer);
            btn.addEventListener('click', () => {
      // Navigate to the next page using window.location.replace()
      window.location.replace('2358902_samirThapa.php');
    });
// Append the button to the container
container.appendChild(button);
</script>
</body>
</html>
