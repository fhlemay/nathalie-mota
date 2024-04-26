<!-- <!DOCTYPE html>
<html>

<head></head>

<body>
  <h1>Nathalie Mota : single.php</h1>
</body>

</html> -->

<?php

use Timber\Timber;

$context = Timber::context();
Timber::render('single.twig', $context);
