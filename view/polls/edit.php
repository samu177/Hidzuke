<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$poll = $view->getVariable("poll");
$dates = $view->getVariable("dates");
$errors = $view->getVariable("errors");
$user = $view->getVariable("user");
$usersDates = $view->getVariable("usersDates");
?>

<div id="view-edit" class="container">
  <form id="delete" action="index.php?controller=poll&action=delete" method="POST">
    <input type="hidden" name="id" value="<?= $poll->getId()?>">
  </form>
  <form action="index.php?controller=poll&action=edit" method="POST">
    <input type="hidden" id="del-dates" name="delete" value="">
    <input type="hidden" name="id" value="<?= $poll->getId()?>">
    <div class="row flex-row-reverse">
      <div class="col-md-6 view-list">
        <div class="header">
          <div class="row">
            <div class="col-7 col-sm-9 col-md-8 col-lg-9">
              <a href="index.php?controller=main&action=index"><img src="assets/img/logo-black.png"></a>
            </div>
            <div class="col-3 col-sm-1 col-md-2 col-lg-1">
              <button class="btn btn-custom-blue btn-flag dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="false"><?php
                if($_SESSION['__currentlang__']=="es"){
                  echo '<span class="flag-icon flag-icon-es">';
                }else{
                  echo '<span class="flag-icon flag-icon-gb">';
                }?></span></button>
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
      </div>
      <div class="col-md-6 view-list">
        <div class="header header-md">
          <div class="row">
            <div class="md-form poll-title-edit">
              <input value="<?=$poll->getTitle()?>" name="title" type="text" class="form-control" required>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="row ">
      <div class="md-form poll-description-edit">
        <input value="<?=$poll->getDescription()?>" name="description" type="text" class="form-control" required>
      </div>
    </div>
    <div class="row ">
      <span class="poll-view-description poll-link"><b><?= i18n("share")?></b> localhost/Hidzuke/index.php?controller=poll&link=<?=$poll->getLink()?></span>
    </div>
    <div class="row ">
      <div class="badge-list">
        <input id="badge-dates" type="hidden" name="badge-dates" value="">
      </div>
    </div>
    <div class="row align-items-center table-content">

      <div class="table-container square scrollbar-blue bordered-blue">

        <table class="poll-table">
          <thead>
            <tr>
              <th class="add-date">
              </th>
              <?php foreach ($dates as $date) {?>
                <th>
                  <a href="#" class="remove" data-target="<?= $date->getId()?>"><span class="poll-remove"><i class="fas fa-times-circle"></i></span></a>
                  <small class="month"><?= i18n($date->getDay()->format('F'))?></small>
                  <span class="day" data-date="<?= $date->getDay()->format('Y-m-d')?>"><?= $date->getDay()->format('d')?></span>
                  <small class="month"><?= i18n($date->getDay()->format('D'))?></small>
                  <small class="month hini"><?= substr($date->getHini(),0,-3)?></small>
                  <small class="month hend"><?= substr($date->getHend(),0,-3)?></small>
                </th>
              <?php } ?>
            </tr>
          </thead>
          <tbody>
            <tr class="count">
              <td class="add-date">
                <span>
                  <i class="fas fa-plus-square"></i>
                </span>
              </td>
              <?php foreach ($dates as $date) {?>
                <td>
                  <span><?=$date->getVotes()?></span><span> <i class="fas fa-check"></i></span>
                </td>
              <?php } ?>
            </tr>
            <tr class="check">
              <td class="add-date"></td>
              <?php foreach ($dates as $date) {?>
                <td>
                <?php
                  foreach ($usersDates as $key => $value) {
                    if($date->getId() == $key){
                      foreach ($value as $keyU => $valueU) {
                        if($user == $keyU){ ?>
                            <span><i class="fas fa-check"></i></span>
                        <?php }
                      }
                    }
                  }
                ?>
                </td>
              <?php } ?>
            </tr>
            <tr class="people-list">
              <td class="add-date last"></td>
              <?php foreach ($dates as $date) {?>
                <td>
                  <a class="btn btn-custom-blue"  href="#" >
                    <i class="fas fa-user"></i>
                  </a>
                </td>
              <?php } ?>
            </tr>
          </tbody>
        </table>
      </div>
    </div>
    <div class="row text-center">
      <div class="col-12">
        <div class="form-group">
          <button type="submit" class="btn btn-lg mx-auto btn-custom-blue"><?= i18n("ok")?></button>
          <a class="btn btn-lg mx-auto btn-custom-orange" href="index.php?controller=poll&action=index&id=<?=$poll->getId()?>"><?= i18n("cancel")?></a>
          <button type="submit" class="btn btn-lg mx-auto btn-danger" form="delete"><?= i18n("delete")?></button>
        </div>
      </div>
    </div>
  </div>
    </form>
    <!-- Central Modal Small -->
    <div class="modal fade" id="centralModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title w-100" id="myModalLabel"><?= i18n("label_day")?></h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              <form id="addDate">
                <div class="modal-body">
                  <div class="form-group">
                    <label for="poll-date"><?= i18n("date")?></label>
                    <input type="date" class="form-control" id="poll-date" required>
                  </div>
                  <div class="form-group">
                    <label for="poll-hour-init"><?= i18n("hini")?></label>
                    <input type="time" class="form-control" id="poll-hour-init" required>
                  </div>
                  <div class="form-group">
                    <label for="poll-hour-end"><?= i18n("hend")?></label>
                    <input type="time" class="form-control" id="poll-hour-end" required>
                  </div>
                </div>
                <div class="modal-footer justify-content-center">
                  <button type="button" class="btn btn-custom-orange" data-dismiss="modal"><?= i18n("close")?></button>
                  <button type="submit" class="btn btn-custom-blue"><?= i18n("addDate")?></button>
                </div>
              </form>
            </div>
          </div>
        </div>
  </div>
  <!-- Central Modal Small -->
<script type="text/javascript" src="assets/js/mdb.min.js"></script>
<script type="text/javascript">

  function removeDate(elem){
    var close = $(elem);
    removeDateList(close.parent().text().trim());
    close.parent().remove();

  }
  function removeDateList(day){
    var $dates_val = $('#badge-dates').val().split('.');
    var $dates_val_new = '';
    for ( var i = 0, l = $dates_val.length; i < l; i++ ) {
      var v_date = $dates_val[i].split('/');
      var v_date_time = v_date[0] + ' ' + v_date[1] + '-' + v_date[2];
      if(v_date_time != day){
        if($dates_val_new.length == 0){
          $dates_val_new = v_date[0] + '/' + v_date[1] + '/' + v_date[2];
        }else{
          $dates_val_new += '.' + v_date[0] + '/' + v_date[1] + '/' + v_date[2];
        }
      }
    }
    $('#badge-dates').val($dates_val_new);
  }

  function checkDay(date, hini, hend){
    var t_day = $('.poll-table thead th .day');
    var t_hini = $('.poll-table thead th .hini');
    var t_hend = $('.poll-table thead th .hend');
    var check = false;

    console.log(date);

    for ( var i = 0, l = t_day.length; i < l && !check; i++ ){
      if($(t_day[i]).data("date") === date && $(t_hini[i]).text() === hini && $(t_hend[i]).text() === hend ){
        check = true;
      }
    }

    var $dates_val = $('#badge-dates').val().split('.');

    for ( var i = 0, l = $dates_val.length; i < l && !check; i++ ) {
      var v_date = $dates_val[i].split('/');
      console.log(v_date[0]);
      if(v_date[0] === date && v_date[1] === hini && v_date[2] === hend ){
        check = true;
      }
    }

    return check;
  }
  $(document).ready(function() {
    $('.add-date').on('click', function(){
      $('#centralModal').modal();
    });

    $('.remove').on('click', function(){
      var th_close = $(this).parent();
      var index = th_close.parent().children().index(th_close);
      $($('.poll-table thead th').get(index)).remove();
      $($('.poll-table .count td').get(index)).remove();
      $($('.poll-table .check td').get(index)).remove();
      $($('.poll-table .people-list td').get(index)).remove();

      var del = $('#del-dates');
      if(del.val().length == 0){
        del.val($(this).data('target'));
      }else{
        del.val(del.val() + ',' + $(this).data('target'));
      }
    });

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
        var $dates = $('#badge-dates');
        if($dates.val().length == 0){
          $dates.val($dates.val() + date + '/' + hini + '/' + hend);
        }else{
          $dates.val($dates.val() + '.' + date + '/' + hini + '/' + hend);
        }
        console.log($dates.val());
      }
      event.preventDefault();
    });


  });
</script>
