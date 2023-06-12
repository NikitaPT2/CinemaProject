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
          <button type="button" class="btn btn-primary addfilm" data-bs-toggle="modal" data-bs-target="#exampleModal">
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
                    <div class="input-group">
                      <div class="form-group">
                        <label for="film-name">Filmas nosaukums:</label>
                        <input list="options" name="film-name" class="form-control" id="film-name"
                          placeholder="Filmas nosaukums" type="text">
                        <datalist id="options">

                        </datalist>
                      </div>
                    </div>

                    <div class="form-group hide-block">
                      <label for="film-name">Filmas žanrs:</label>
                      <input type="text" class="form-control" id="film-genre" name="film-genre" required>
                    </div>

                    <div class="form-group hide-block">
                      <label for="vecums">Vecums:</label>
                      <input type="text" class="form-control" id="vecums" name="vecums">
                    </div>

                    <div class="form-group hide-block">
                      <label for="film-description">Filmas apraksts:</label>
                      <textarea class="form-control" id="film-description" name="film-description" rows="3"
                        required></textarea>
                    </div>

                    <div class="form-group">
                      <label for="datetimepicker">Datums:</label>
                      <div class='input-group date'>
                        <input type='date' class="form-control" name="date" data-format="dd.MM.yyyy" />
                        <span class="input-group-addon">
                          <span class="glyphicon glyphicon-calendar"></span>
                        </span>
                      </div>
                    </div>
                    <div class="form-group">
                      <label for="time">Laiks:</label>
                      <input type="text" class="form-control timepicker" name="time">
                    </div>

                    <div class="form-group hide-block">
                      <label for="film-price">Cena:</label>
                      <input type="text" class="form-control price" pattern="[0-9]+(.[0-9]+)?"
                        title="Please enter a valid integer" name="film-price">
                    </div>

                    <div class="form-group hide-block">
                      <label for="image-url">Image URL:</label>
                      <input type="text" class="form-control" id="image-url" name="image-url">
                    </div>

                    <div class="form-group">
                      <label for="image-url">Valoda:</label>
                      <input type="text" class="form-control" id="valoda" name="valoda" value="ENG; LV sub">
                    </div>
                  </form>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Aizvērt</button>
                  <button type="button" class="btn btn-primary" id="create-film">Saglabāt</button>
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
        $valoda = $_POST["valoda"];
        $vecums = $_POST["vecums"];

        $query = "CALL createFilm('" . $filmName . "', '" . $filmGenre . "', '" . $filmDescription . "', '" . $date . "', '" . $time . "', '" . $price . "', '" . $imageUrl . "','" . $valoda . "','" . $vecums . "');";

        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        if ($result == 1) { ?>
          <script> window.location = window.location.pathname </script>
          <?php
        }
      }
      
      if (isset($_POST["editFilm1"])) {
        require('connection.php');
        $filmName = $_POST["edit-film-name"];
        $filmGenre = $_POST["edit-film-genre"];
        $filmDescription = $_POST["edit-film-description"];
        $date = $_POST["edit-date"];
        $time = $_POST["edit-time"];
        $price = $_POST["edit-price"];
        $imageUrl = $_POST["edit-url"];
        $valoda = $_POST["edit-valoda"];
        $seansID = $_POST["seansID"];

        $query = "CALL editFilm('" . $filmName . "', '" . $filmGenre . "', '" . $filmDescription . "', '" . $date . "', '" . $time . "', '" . $price . "', '" . $imageUrl . "','" . $valoda . "', '" . $seansID . "');";
        echo $query;
        $result = mysqli_query($connection, $query) or die(mysqli_error($connection));

        if ($result == 1) { ?>
          <script> window.location = window.location.pathname </script>
          <?php
        }
      }
      ?>
    </tbody>
  </table>
  
  <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <h1 class="modal-title fs-5" id="editModalLabel" style="color:black;">Reģistrēt jaunu filmu</h1>
          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
          <form style="color: black" method="post" name="editFilm" id="editFilm">
            <input type="hidden" class="editFilm1" name="editFilm1" value="1">
            <input type="hidden" class="seansID" name="seansID">

            <div class="input-group">
              <div class="form-group">
                <label for="film-name">Filmas nosaukums:</label>
                <input list="options" name="edit-film-name" class="form-control edit-film-name"
                  placeholder="Filmas nosaukums" type="text">
                <datalist id="options">

                </datalist>
              </div>
            </div>

            <div class="form-group">
              <label for="film-name">Filmas žanrs:</label>
              <input type="text" class="form-control edit-film-genre" name="edit-film-genre" required>
            </div>

            <div class="form-group">
              <label for="film-description">Filmas apraksts:</label>
              <textarea class="form-control edit-film-description" name="edit-film-description" rows="3" required></textarea>
            </div>

            <div class="form-group">
              <label for="datetimepicker">Datums:</label>
              <div class='input-group date' id='datetimepicker'>
                <input type='date' class="form-control edit-date" name="edit-date" data-format="dd.MM.yyyy" />
                <span class="input-group-addon">
                  <span class="glyphicon glyphicon-calendar"></span>
                </span>
              </div>
            </div>
            <div class="form-group">
              <label for="time">Laiks:</label>
              <input type="text" class="form-control edit-time" name="edit-time">
            </div>

            <div class="form-group">
              <label for="film-price">Cena:</label>
              <input type="text" class="form-control edit-price" pattern="[0-9]+(.[0-9]+)?"
                title="Please enter a valid integer" name="edit-price">
            </div>

            <div class="form-group">
              <label for="image-url">Image URL:</label>
              <input type="text" class="form-control edit-url" name="edit-url">
            </div>

            <div class="form-group">
              <label for="image-url">Valoda:</label>
              <input type="text" class="form-control edit-valoda" name="edit-valoda">
            </div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-primary edit-film">Rediģēt</button>
        </div>
      </div>
    </div>
  </div>
</div>

<?php
getFooter();
?>

<script src="https://code.jquery.com/jquery-3.6.2.js" integrity="sha256-pkn2CUZmheSeyssYw3vMp1+xyub4m+e+QK4sQskvuo4="
  crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js"
  integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.1/moment.min.js"></script>
<script src="https://code.jquery.com/ui/1.13.0/jquery-ui.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-timepicker/1.13.18/jquery.timepicker.min.js"></script>

<script>
  //Pasākuma rediģēšanas pogas notikuma apstrādātājs
  $('.editBtn').on('click', function () {
    var editModal = $('#editModal');
    var seansID = $(this).attr('data-seansID');
    $.ajax({
      url: "editfilmulist.php",
      type: "POST",
      data: { param1: seansID },
      success: function (response) {
        var result = JSON.parse(response);
        console.log(result);
        var filmName =$('.edit-film-name')
        filmName.val(result.result.nosaukums)

        var descr = $('.edit-film-description')
        descr.val(result.result.apraksts)

        var editDate = $('.edit-date')
        editDate.val(result.result.datums)

        var editTime = $('.edit-time')
        editTime.val(result.result.laiks)

        var editPrice = $('.edit-price')
        editPrice.val(result.result.cena)

        var editURL = $('.edit-url')
        editURL.val(result.result.saite)

        var editLang = $('.edit-valoda')
        editLang.val(result.result.valoda)

        var zanr = $('.edit-film-genre')

        var seansID = $('.seansID')
        zanr.val(result.result.zanrs)
        seansID.val(result.result.id_seansi)
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
    editModal.show();
  })

  //Notikuma apstrādātājs pogai "Pievienot filmu"
  $('.addfilm').on('click', function () {
    var mymodal = $('#exampleModal');
    mymodal.show();
    $.ajax({
      url: "getfilmulist.php",
      type: "POST",
      data: {},
      success: function (response) {
        console.log(response);
        var result = JSON.parse(response);
        $('#options').empty();
        result.result.forEach(function (item) {
          var option = $('<option>').attr('value', item);
          $('#options').append(option);
        })
      },
      error: function (jqXHR, textStatus, errorThrown) {
        console.log(textStatus, errorThrown);
      }
    });
  })

  // Notikuma apstrādātājs laukam "film-name" vērtības maiņai
  $('#film-name').on('change', function () {
    var optionList = $('#options');
    var value = $(this).val();
    console.log(value);
    var display = true;
    var options = optionList.find('option');
    options.each(function () {
      console.log($(this).val());
      var option = $(this).val();
      if (value === option) {
        display = false;
      }
    });
    displayFields(display);
  })

  // Funkcija, kas parāda vai paslēpj blokus atkarībā no padotā parametra
  function displayFields(display) {
    var blocks = $('.hide-block');
    if (display) {
      blocks.css('display', 'block');
    } else {
      blocks.css('display', 'none');
    }
    console.log(display);
  }

  // Inicializē datuma izvēlni
  $(function () {
    $('#datetimepicker input').datepicker({
      format: 'yyyy-mm-dd',
      autoclose: true
    });
  });

  // Inicializē laika izvēlni
  $('.timepicker').timepicker({
    interval: 30,
    dynamic: false,
    dropdown: true,
    scrollbar: true,
    showMeridian: false,
    timeFormat: "H:i"
  });

  // Notikuma apstrādātājs laukam "price", lai tiktu ierobežots tikai skaitļu un punktu ievade
  $('.price').on('input', function () {
    $(this).val($(this).val().replace(/[^0-9.]/g, ''));
  });

  // Funkcija, kas iesniedz formu "createFilm"
  function createFilm() {
    document.forms["createFilm"].submit();
  }

  // Notikuma apstrādātājs pogai "create-film"
  $('#create-film').on('click', function () {
    createFilm()
  });

  // Funkcija, kas iesniedz formu "editFilm"
  function editFilm() {
    document.forms["editFilm"].submit();
  }

  // Notikuma apstrādātājs klasei "edit-film"
  $('.edit-film').on('click', function () {
    editFilm()
  });

</script>

</body>

</html>