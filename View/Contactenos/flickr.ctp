<h2>My Flickr Feed</h2> 
<?php foreach($lastFlickrPhotos as $photo) : ?> 
  <img src="<?= $photo['t_url'] ?>" />         
<?php endforeach; ?> 
