<?php
  require('components.php');
  getHeader(false, 1);
  ?>

<div class="content">
  <div class="slider">
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

      <div class="row">
        <div class="col"></div>

        <div class="col colimg">
          <img src="foto/film1.jpg" alt="film">
          <div class="kor">
            <div class="tekst">
              <h5>Algotņu grupa Ziemassvētku vakarā uzbrūk bagātas ģimenes īpašumam un saņem visus ķīlniekos. Taču
                viņiem nav ne jausmas, ka turpat namā atrodas vēl kāds, kurš kļūs par negaidītu vakara pārsteigumu un
                izrādīsies ļaundaru sīvākais pretinieks. Tas ir Santaklauss, kurš būs gatavs uz pilnīgi visu, lai glābtu
                ģimeni. Un Ziemassvētkus.</h5>
            </div>
          </div>
        </div>

        <div class="col colimg">
          <img src="foto/film2.jpg" alt="film">
          <div class="kor">
            <div class="tekst">
              <h5>Ieguvis savu jauno veidolu, kareivis Džeiks Sallijs kļūst par vadoni un uzņemas aizsargāt savu ģimeni
                un jaunos draugus no alkatīgajiem Zemes biznesmeņiem, kad tie ar līdz zobiem apbruņotu armiju atgriežas
                uz Pandoru.</h5>
            </div>
          </div>
        </div>
        <div class="col"></div>
      </div>

      <div class="row">
        <div class="col"></div>
        <div class="col colimg">
          <img src="foto/film3.jpg" alt="film">
          <div class="kor">
            <div class="tekst">
              <h5>Jautra Ziemassvētku piedzīvojumu filma visai ģimenei. Policista Ervīna Dambja ģimene sliktā
                noskaņojumā ierodas savā lauku mājā un sastop Ziemassvētku vecīti. Mazā Marta un brālītis Toms viņu
                iesaista savas ģimenes glābšanas plānā. Vecāki sāk gatavoties svētkiem, nemaz nenojauzdami, ka
                sastaptais Ziemassvētku vecītis ir no cietuma izbēgušais Bruno Circenis.</h5>
            </div>
          </div>
        </div>
        <div class="col colimg">
          <img src="foto/film4.jpg" alt="film">
          <div class="kor">
            <div class="tekst">
              <h5>Ziemassvētki džungļos stāsta par desmitgadīgo Paulu, kuras ģimene pārcēlusies uz eksotisku valsti, jo
                tēvs ir ģeologs un strādā zelta raktuvēs. Paula ilgojas pēc Ziemassvētkiem, taču ko darīt, ja nav
                ziemas? Izrādās, Paulas jaunais draugs Ahims ir dzirdējis, ka arī džungļu biezoknī sastopams
                Ziemassvētku šamanis. Plāns ir rokā! Tomēr bērni nenojauš, cik bīstami un aizraujoši piedzīvojumi viņus
                sagaida ceļā: pazemes alas, džungļu gari, kanibāli, neparasti dzīvnieki un daudz kas cits!</h5>
            </div>
          </div>
        </div>
        <div class="col"></div>
      </div>
    </div>
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