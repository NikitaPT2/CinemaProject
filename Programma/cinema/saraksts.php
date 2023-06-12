<?php
require('components.php');
getHeader(false, 2);
?>

<div class="content">
  <div class="filmlist mb-0">
    <?php
    getFilmSaraksts();
    ?>
  </div>
</div>

<?php
getFooter();
?>
</body>

</html>