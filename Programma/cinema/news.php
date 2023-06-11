<?php
require('components.php');
require('connection.php');
getHeader(false, 2);

// Function to translate text using Yandex.Translate API
function translateText($text, $targetLanguage) {
  // Replace with your own Yandex.Translate API key
  $apiKey = 'your-api-key';

  $url = 'https://translate.yandex.net/api/v1.5/tr.json/translate';
  $params = [
    'key' => $apiKey,
    'text' => $text,
    'lang' => $targetLanguage,
  ];

  $query = http_build_query($params);
  $requestUrl = $url . '?' . $query;

  // Send the API request
  $response = file_get_contents($requestUrl);

  if ($response) {
    $translation = json_decode($response, true);

    if ($translation && isset($translation['text'][0])) {
      return $translation['text'][0];
    }
  }

  return $text; // Return the original text if translation fails
}

// Parse the RSS feed
$rss = simplexml_load_file('https://www.comingsoon.net/feed');

// Check if the feed was loaded successfully
if ($rss) {
  // Iterate over each item in the feed
  foreach ($rss->channel->item as $item) {
    $title = $item->title; // Get the title
    $link = $item->link; // Get the link
    $description = $item->description; // Get the description
    $pubDate = $item->pubDate; // Get the publication date
    $categories = $item->category; // Get the categories

    // Translate the description to Latvian
    $translatedDescription = translateText($description, 'lv');

    // Output the news item
    echo '<h2><a href="' . $link . '">' . $title . '</a></h2>';
    echo '<p>' . $translatedDescription . '</p>';
    echo '<p>Publication Date: ' . $pubDate . '</p>';

    // Output the categories
    echo '<p>Categories:</p>';
    echo '<ul>';
    foreach ($categories as $category) {
      echo '<li>' . $category . '</li>';
    }
    echo '</ul>';

    echo '<hr>';
  }
} else {
  echo 'Failed to load RSS feed.';
}

getFooter();
?>
</body>
</html>
