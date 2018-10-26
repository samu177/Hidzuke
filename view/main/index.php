<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$polls = $view->getVariable("polls");

$errors = $view->getVariable("errors");
?>

<div id="main" class="container">
  <div class="row">
    <div id="add" class="col-md-6 add">
      <div class="row align-items-center">
        <a class="nounderline add-link btn-add" href="#" data-toggle="modal" data-target="#fullHeightModalLeft">
          <span class="btn-add">
            <i class="fas fa-plus-square"></i>
          </span>
        </a>
      </div>
    </div>
    <div class="col-md-6 view-list">
      <div class="header">
        <div class="row">
          <div class="col-7 col-sm-9 col-md-8 col-lg-9">
            <a href="#"><img src="assets/img/logo-black.png"></a>
          </div>
          <div class="col-3 col-sm-1 col-md-2 col-lg-1">
            <button class="btn btn-custom-blue btn-flag dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false">
              <?php
              if($_SESSION['__currentlang__']=="es"){
                echo '<span class="flag-icon flag-icon-es">';
              }else{
                echo '<span class="flag-icon flag-icon-gb">';
              }?>
              </span>
            </button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="index.php?controller=language&amp;action=change&amp;lang=es"><span class="flag-icon flag-icon-es"></span><?= i18n("esp")?></a>
              <a class="dropdown-item" href="index.php?controller=language&amp;action=change&amp;lang=en"><span class="flag-icon flag-icon-gb"></span><?= i18n("eng")?></a>
            </div>
          </div>
          <div class="col-2 ">
            <a class="nounderline add-link" href="index.php?controller=users&action=logout">
              <span class="log">
                <i class="fas fa-sign-in-alt"></i>
              </span>
            </a>
          </div>
        </div>
      </div>
      <div id="add-small" class="row add-md">
        <div class="col-md-6">
          <div class="row align-items-center">
            <a class="nounderline add-link btn-add" href="#" data-toggle="modal" data-target="#fullHeightModalLeft">
              <span class="btn-add">
                <i class="fas fa-plus-square"></i>
              </span>
            </a>
          </div>
        </div>
        </div>
      <div class="cardList square scrollbar-orange bordered-orange">
        <?php
        foreach ($polls as $poll) {?>
          <a class="nounderline card-link waves-effect waves-light" href="index.php?controller=poll&action=index&id=<?= $poll->getId()?>">
            <?php if($_SESSION["currentuser"] == $poll->getId_user()){
                echo '<div class="card owner">';
              }else{
                echo '<div class="card">';
              }
              ?>
              <div class="row align-items-center">
                <div class="col-2">
                  <span class="color-white card-calendar-icon">
                    <i class="far fa-calendar-alt"></i>
                  </span>
                </div>
                <div class="col-8">
                  <span><?= $poll->getTitle() ?> </span>
                </div>
                <div class="col-2 date-group">
                  <?php if($poll->getDate() != NULL){?>
                  <small class="month"><?= i18n($poll->getDate()->format('F'))?></small>
                  <span class="day"><?= $poll->getDate()->format('d')?></span>
                  <?php } ?>
                </div>
              </div>
            </div>
          </a>
        <?php } ?>
      </div>
    </div>
  </div>

  <!-- Full Height Modal Left -->
  <div class="modal fade left square scrollbar-blue bordered-blue" id="fullHeightModalLeft" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <!-- Add class .modal-full-height and then add class .modal-left (or other classes from list above) to set a position to the modal -->
    <div class="modal-dialog modal-full-height modal-left" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title w-100" id="myModalLabel"><?= i18n("label_add")?></h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <form id="addDate">
        </form>
        <form action="index.php?controller=main&amp;action=add" method="POST">
          <div class="modal-body">
            <div class="form-group">
              <label for="poll-title"><?= i18n("title")?></label>
              <input type="text" class="form-control" id="poll-title" minlength="5" maxlength="50" name="title" placeholder="<?= i18n("newtitle")?>" required>
            </div>
            <div class="form-group">
              <label for="poll-description"><?= i18n("descript")?></label>
              <input type="text" class="form-control" id="poll-description" minlength="5" maxlength="100" name="description" placeholder="<?= i18n("newdescript")?>" required>
            </div>
            <div class="form-group">
              <label for="poll-date-list"><?= i18n("datelist")?></label>
              <div class="badge-list">
                <input id="dates" type="text" name="dates" value="" class="d-none">
              </div>
            </div>
            <div class="form-group">
              <label for="poll-date"><?= i18n("date")?></label>
              <input type="date" class="form-control" name="date" id="poll-date" form="addDate" required>
            </div>
            <div class="form-group">
              <label for="poll-hour-init"><?= i18n("hini")?></label>
              <input type="time" class="form-control" name="hini" id="poll-hour-init" form="addDate" required>
            </div>
            <div class="form-group">
              <label for="poll-hour-end"><?= i18n("hend")?></label>
              <input type="time" class="form-control" name="hfin" id="poll-hour-end" form="addDate" required>
            </div>
            <div class="form-group">
              <button type="submit" class="btn btn-success" form="addDate"><?= i18n("addDate")?></button>
              </div>
          </div>
          <div class="modal-footer justify-content-center">
            <button type="button" class="btn btn-custom-orange" data-dismiss="modal"><?= i18n("close")?></button>
            <button type="submit" class="btn btn-custom-blue"><?= i18n("addEvent")?></button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!-- Full Height Modal Left -->
</div>


<script type="text/javascript" src="assets/js/mdb.js"></script>
<script type="text/javascript">
  function removeDate(elem){
    var close = $(elem);
    removeDateList(close.parent().text().trim());
    close.parent().remove();

  }
  function removeDateList(day){
    var $dates_val = $('#dates').val().split('.');
    var $dates_val_new = '';
    for ( var i = 0, l = $dates_val.length; i < l-1; i++ ) {
      var v_date = $dates_val[i].split('/');
      var v_date_time = v_date[0] + ' ' + v_date[1] + '-' + v_date[2];
      if(v_date_time != day){
        $dates_val_new += v_date[0] + '/' + v_date[1] + '/' + v_date[2] + '.';
      }
    }
    $('#dates').val($dates_val_new);
  }

  function checkDay(date, hini, hend){
    var $dates_val = $('#dates').val().split('.');
    var check = false;

    for ( var i = 0, l = $dates_val.length; i < l; i++ ) {
      var v_date = $dates_val[i].split('/');
      if(v_date[0] === date && v_date[1] === hini && v_date[2] === hend ){
        check = true;
        break;
      }

    }
    return check;
  }

  $(document).ready(function () {
    $('#addDate').on('submit', function(event){

      var date = $("#poll-date").val();
      var hini = $("#poll-hour-init").val();
      var hend = $("#poll-hour-end").val();

      if(!checkDay(date, hini, hend)){
        var datetime = $('<span>', {class: 'badge badge-dark'}).append([
          date + ' ' + hini + '-' + hend + '&nbsp;&nbsp;',
          $('<a>', {href: '#', class: 'remove-date', onclick: 'removeDate(this)'}).append(
            $('<i>', {class: 'far fa-times-circle'})
          )
        ]);
        $('.badge-list').append(datetime);
        var $dates = $('#dates');
        $dates.val($dates.val() + date + '/' + hini + '/' + hend + '.');
      }
      event.preventDefault();
    });
  });
</script>
