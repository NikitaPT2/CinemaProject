<?php
require('components.php');
require('connection.php');
getHeader(false, 7);
?>

<!DOCTYPE html>
<html>

<head>
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/css/bootstrap.min.css">
  <style>
    body {
      background-color: #212529;
      color: #fff;
    }

    .news-title {
      font-size: 22px;
      margin-bottom: 5px;
      color: #fff;
    }

    .news-date {
      font-size: 14px;
      color: #ccc;
      margin-bottom: 10px;
    }

    .news-description {
      color: #ccc;
    }

    hr {
      border-color: #aaa;
    }
  </style>
</head>

<body>

  <div class="container mt-5"
    style="background-color: #333; color: #fff; text-align: center; padding: 20px; margin-top: 10px; margin-bottom: 10px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">
    <h2 class="news-title">Šī lapa vēl tiek izstrādāta</h2>
    <p class="news-description">Nākotnē šeit tiks sniegta plašāka informācija un ziņas ar attēliem.</p>
  </div>

  <?php
  // Izanalizēt RSS plūsmu.
  $rss = simplexml_load_file('https://www.comingsoon.net/feed');

  // Pārbaudīt, vai plūsma ir veiksmīgi ielādēta.
  if ($rss) {
    echo '<div class="container mt-5" style="background-color: #333; color: #fff; padding: 20px; margin-top: 30px; margin-bottom: 50px; border-radius: 10px; box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);">';

    // Iterēt cauri katram vienumam plūsmā.
    foreach ($rss->channel->item as $item) {
      $title = $item->title;
      $link = $item->link;
      $description = $item->description;
      $pubDate = $item->pubDate;
  
      echo '<div class="mb-4">';
      echo '<h2 class="news-title">' . $title . '</h2>';
      echo '<p class="news-date">' . $pubDate . '</p>';
      echo '<p class="news-description">' . $description . '</p>';
      echo '</div>';
      echo '<hr>';
    }

    echo '</div>';
  } else {
    echo 'Failed to load RSS feed.';
  }
  ?>

  <?php
  getFooter();
  ?>

  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>