<?php
  require('components.php');
  getHeader(false, 1);
  ?>

<div class="content">
  <div class="slider d-none d-md-block">
    <div class="container">
      <div class="row">
        <div class="col"></div>
        <div class="col-10">
          <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
            <div class="carousel-indicators">
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
                aria-current="true" aria-label="Slide 1"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
                aria-label="Slide 2"></button>
              <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
                aria-label="Slide 3"></button>
            </div>

            <div class="carousel-inner">
              <div class="carousel-item active">
                <img src="foto/cinema.jpg" class="d-block w-100" alt="..." width="960" height="540">
              </div>
              <div class="carousel-item">
                <iframe width="960" height="540" src="https://www.youtube.com/embed/o5F8MOz_IDw"
                  title="YouTube video player" frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>
              </div>
              <div class="carousel-item">
                <iframe width="960" height="540" src="https://www.youtube.com/embed/08QSsgQYQrI"
                  title="YouTube video player" frameborder="0"
                  allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
                  allowfullscreen></iframe>
              </div>
            </div>

            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
              data-bs-slide="prev">
              <span class="carousel-control-prev-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Previous</span>
            </button>

            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
              data-bs-slide="next">
              <span class="carousel-control-next-icon" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
        </div>
        <div class="col"></div>
      </div>
    </div>
  </div>

  <div class="info">
      <div class="container text-center">
        <?php
          getFilmBanners();
        ?>
      </div>
  </div>
</div>

<?php
getFooter();
?>
</body>

</html>