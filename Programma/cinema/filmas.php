<?php
require('components.php');
getHeader(true, 3);
?>

<div class="content">

  <table class="table table-dark">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col">Filma nosaukums</th>
        <th scope="col">Žanrs</th>
        <th scope="col">Datums</th>
        <th scope="col">Laiks</th>
        <th scope="col">Cena</th>
        <th scope="col">Nodzest vai rediģēt
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            <div class="buttons">
              <i class="fa fa-plus" style="font-size:20px"></i>
            </div>
          </button>

          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h1 class="modal-title fs-5" id="exampleModalLabel" style="color:black;">Reģistrēt jaunu filmu</h1>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <form style="color: black" method="post" name="createFilm" id="createFilm">
                    <input type="hidden" name="createFilm" value="1">
                    <div class="form-group">
                      <label for="film-name">Film Name:</label>
                      <input type="text" class="form-control" id="film-name" name="film-name" required>
                    </div>
                    <div class="form-group">
                      <label for="film-name">Filmas žanrs:</label>
                      <input type="text" class="form-control" id="film-genre" name="film-genre" required>
                    </div>

                    <div class="form-group">
                      <label for="film-description">Film Description:</label>
                      <textarea class="form-control" id="film-description" name="film-description" rows="3"
                        required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="datetimepicker">Date picker:</label>
                      <div class='input-group date' id='datetimepicker'>
                        <input type='date' class="form-control" name="date" data-format="dd.MM.yyyy" />
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="time">Time:</label>
                      <input type="text" class="form-control timepicker" name="time">
                    </div>

                    <div class="form-group">
                      <label for="film-price">Cena:</label>
                      <input type="text" class="form-control price" pattern="[0-9]+(.[0-9]+)?"
                        title="Please enter a valid integer" name="film-price">
                    </div>

                    <div class="form-group">
                      <label for="image-url">Image URL:</label>
                      <input type="text" class="form-control" id="image-url" name="image-url" required>
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                  <button type="button" class="btn btn-primary" id="create-film">Save changes</button>
                </div>
              </div>
            </div>
          </div>
        </th>
      </tr>
    </thead>

    <tbody>
      <?php
      getFilmList();
      if (isset($_GET["delete"])) {
        $deleteID = $_GET["delete"];
        require('connection.php');

        $query = "CALL deleteFilm(" . $deleteID . ");";

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        if ($result == 1) { ?>
          <script> window.location = window.location.pathname </script>
          <?php
        }
      }

      if (isset($_POST["createFilm"])) {
        require('connection.php');
        $filmName = $_POST["film-name"];
        $filmGenre = $_POST["film-genre"];
        $filmDescription = $_POST["film-description"];
        $date = $_POST["date"];
        $time = $_POST["time"];
        $price = $_POST["film-price"];
        $imageUrl = $_POST["image-url"];

        $query = "CALL createFilm('". $filmName ."', '". $filmGenre ."', '". $filmDescription ."', '". $date ."', '". $time ."', '". $price ."', '". $imageUrl ."');";
        
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        if ($result == 1) { ?>
          <script> window.location = window.location.pathname </script>
          <?php
        }
      }
      ?>
    </tbody>
  </table>
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

<script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://code.jquery.com/jquery-3.6.2.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>

<script>
  $('.addfilm').on('click', function () {
    var mymodal = $('#exampleModal');
    mymodal.show();
  })

  $(function () {
    $('#datetimepicker input').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
  });

  $('.timepicker').timepicker({
    interval: 30,
    dynamic: false,
    dropdown: true,
    scrollbar: true,
    showMeridian: false,
    timeFormat: "H:i"
  });

  $('.price').on('input', function () {
    $(this).val($(this).val().replace(/[^0-9.]/g, ''));
  });
  
  function createFilm() {
    document.forms["createFilm"].submit();
  }

  $('#create-film').on('click',function(){
    createFilm()
  });

</script>

</body>

</html>