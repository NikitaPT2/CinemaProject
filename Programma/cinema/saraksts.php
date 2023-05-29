<?php
require('components.php');
getHeader(false, 2);
?>

<div class="content">
  <div class="filmlist">
    <?php
    getFilmSaraksts();
    ?>
  </div>
</div>

<footer class="text-center text-lg-start text-white" style="background-color: #1c2331">

  <section class="d-flex justify-content-between p-4" style="background-color: #7c4dffc4">
  </section>

  <section class="">
    <div class="container text-center text-md-start mt-5">
      <div class="row mt-3">
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <h6 class="text-uppercase fw-bold">GRONEMA</h6>
          <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
          <p>
            Mūsu uzņēmums tika dibināts 2022. gadā un jau tagad ir viens no labākajiem kinoteātriem.
          </p>
        </div>

        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <h6 class="text-uppercase fw-bold">kontaktinformācija</h6>
          <hr class="mb-4 mt-0 d-inline-block mx-auto" style="width: 60px; background-color: #7c4dff; height: 2px" />
          <p><i class="fas fa-home mr-3"></i> nikitogka@gmail.com</p>
          <p><i class="fas fa-envelope mr-3"></i> +371 25373811</p>
        </div>
      </div>
    </div>
  </section>
  <div class="text-center p-3" style="background-color: rgba(0, 0, 0, 0.2)">©2022 Copyright:
    <a class="text-white">Nikita Groshev</a>
  </div>
</footer>
</body>

</html>