
window.addEventListener('DOMContentLoaded', () => {
    const apiKey = 'f1e85ecd8404cd2a160aaf18a03bb05b'; // API key for OpenWeatherMap
    const cityInput = document.getElementById('city-input'); // Input field for city name
    const searchBtn = document.getElementById('search-btn'); // Search button
  
    // Fetch weather data for Tokyo on page load
    getWeatherData('tokyo');
    
    // Event listener for search button click
    searchBtn.addEventListener('click', () => {
      const city = cityInput.value;
      if (city) {
        getWeatherData(city);
      } else {
        alert("Enter a valid city name.");
      }
    });
  
    // On enter key press runs the program
    cityInput.addEventListener('keypress', (event) => {
      if (event.key === 'Enter') {
        const city = cityInput.value;
        if (city) {
          getWeatherData(city);
        } else {
          alert("Enter a valid city name.");
        }
      }
    });
  
    // Function to fetch weather data
    function getWeatherData(city) {
      const url = `https://api.openweathermap.org/data/2.5/weather?q=${city}&units=metric&appid=${apiKey}`;
      if (!navigator.onLine) {
        document.body.innerHTML = "No Internet Connection detected.";
        return;
      }
  
      fetch(url)
        .then(response => {
          if (!response.ok) {
            throw new Error('City not found.');
          }
          return response.json();
        })
        .then(data => {
          displayWeatherData(data);
          console.log(data);
        })
        .catch(error => {
          console.log('Error:', error);
          if (error.message === 'City not found.') {
            alert('City not found. Please enter a valid city name.');
          } else {
            alert('An error occurred while fetching weather data. Please try again later.');
          }
        });
    }
  
    // Function to display weather data on the page
    function displayWeatherData(data) {
      const cityName = data.name;
      const date = new Date().toLocaleDateString('en-US', { dateStyle: 'long' });
      const weatherCondition = data.weather[0].description;
      const iconCode = data.weather[0].icon;
      const temperature = data.main.temp;
      const pressure = data.main.pressure;
      const windSpeed = data.wind.speed;
      const humidity = data.main.humidity;
      const weatherData = {
        cityName: cityName,
        datee: date,
        weatherCondition: weatherCondition,
        temperature: temperature,
        pressure: pressure,
        windSpeed: windSpeed,
        humidity: humidity
      };
    
      const jsonData = JSON.stringify(weatherData);
    
      fetch('2358902_samirThapa.php', {
        method: 'POST',
        body: jsonData,
        headers: {
          'Content-Type': 'application/json'
        }
      })
      .then(response => response.text())
      .then(data => {
        console.log(data); // Handle the response from PHP if needed
      })
      .catch(error => {
        console.error('Error:', error);
      });

      // Display weather information on the page
      document.getElementById("temperature").innerHTML = `<i class="fa-solid fa-temperature-high fa-xl"></i>  Temperature: ${temperature} deg C`;
      document.getElementById("pressure").innerHTML = ` <i class="fa-solid fa-compress-alt fa-xl"></i>   Pressure: ${pressure} hpa`;
      document.getElementById("wind-speed").innerHTML = `<i class="fa-solid fa-wind fa-xl"></i>  Wind Speed: ${windSpeed} m/s`;
      document.getElementById("humidity").innerHTML = `<i class="fa-solid fa-tint fa-xl"></i>  Humidity: ${humidity}%`;
      document.getElementById("city").innerHTML = ` ${cityName}`;
      document.getElementById("date").innerHTML = `${weatherCondition} <br> Date: ${date}`;
      document.getElementById("weather-condition").innerHTML = `<i class="${getWeatherIconClass(iconCode)}"></i>`;
    }
    const nextButton = document.getElementById('nextButton');

    // Add a click event listener to the button
    nextButton.addEventListener('click', () => {
      // Navigate to the next page using window.location.replace()
      window.location.replace('data.php');
    });
    function getWeatherIconClass(iconCode) {
      switch (iconCode) {
        case '01d':
          return 'fas fa-sun'; // sunny day
        case '01n':
          return 'fas fa-moon'; // clear night
        case '02d':
        case '03d':
        case '04d':
          return 'fas fa-cloud-sun'; // partly cloudy day
        case '02n':
        case '03n':
        case '04n':
          return 'fas fa-cloud-moon'; // partly cloudy night
        case '09d':
        case '10d':
          return 'fas fa-cloud-rain'; // rain showers day
        case '09n':
        case '10n':
          return 'fas fa-cloud-rain'; // rain showers night
        case '11d':
          return 'fas fa-bolt'; // thunderstorm day
        case '11n':
          return 'fas fa-bolt'; // thunderstorm night
        case '13d':
          return 'fas fa-snowflake'; // snow day
        case '13n':
          return 'fas fa-snowflake'; // snow night
        case '50d':
        case '50n':
          return 'fas fa-smog'; // misty
        default:
          return 'fas fa-question'; // unknown weather condition
      }
    }
  });
  