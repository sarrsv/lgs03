<?php
// Fetch the Google Sheet content
$googleSheetContent = file_get_contents("https://docs.google.com/spreadsheets/d/e/your_spreadsheet_id/pubhtml?gid=0&single=true");

// Extract URLs from the Google Sheet content
preg_match_all('/<td>(https?:\/\/.+)<\/td>/', $googleSheetContent, $matches);
$redirectUrls = $matches[1]; // Array of extracted URLs

// Set the target date for the countdown
$targetDate = strtotime("2023-08-31 00:00:00");

// Calculate the time remaining for the countdown
$now = time();
$timeRemaining = $targetDate - $now;
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Countdown Timer with Redirect</title>
<style>
  /* Your CSS styles here */
</style>
</head>
<body>
<div class="container">
  <p class="text">Welcome to My Countdown Page!</p>
  <div class="countdown" id="countdown"></div>
</div>

<script>
// Update the countdown every second
const countdownInterval = setInterval(() => {
  const timeRemaining = <?php echo $timeRemaining; ?>;

  if (timeRemaining <= 0) {
    clearInterval(countdownInterval);
    // Redirect to the URL fetched from Google Sheet
    window.location.href = "<?php echo $redirectUrl; ?>";
  } else {
    const days = Math.floor(timeRemaining / (1000 * 60 * 60 * 24));
    const hours = Math.floor((timeRemaining % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
    const minutes = Math.floor((timeRemaining % (1000 * 60 * 60)) / (1000 * 60));
    const seconds = Math.floor((timeRemaining % (1000 * 60)) / 1000);
    document.getElementById("countdown").innerHTML = `${days}d ${hours}h ${minutes}m ${seconds}s`;
  }
}, 1000);
</script>
</body>
</html>
