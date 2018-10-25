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

<div id="view" class="container">
  <div class="row flex-row-reverse">
    <div class="col-md-6 view-list">
      <div class="header">
        <div class="row">
          <div class="col-7 col-sm-9 col-md-8 col-lg-9">
            <a href="index.php?controller=main&action=index"><img src="assets/img/logo-black.png"></a>
          </div>
          <div class="col-3 col-sm-1 col-md-2 col-lg-1">
            <button class="btn btn-custom-blue btn-flag dropdown-toggle mr-4" type="button" data-toggle="dropdown" aria-haspopup="true"
              aria-expanded="false"><span class="flag-icon flag-icon-es"></span></button>
            <div class="dropdown-menu">
              <a class="dropdown-item" href="#"><span class="flag-icon flag-icon-es"></span> ESPAÑA</a>
              <a class="dropdown-item" href="#"><span class="flag-icon flag-icon-gb"></span> Ingles</a>
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
          <h2 class="poll-view-title"><?=$poll->getTitle()?></h2>
        </div>
      </div>
    </div>
  </div>
  <div class="row ">
    <span class="poll-view-description"><?=$poll->getDescription()?></span>
  </div>
  <div class="row ">
    <span class="poll-view-description poll-link"><b>Compartir:</b> Hidzuke/index.php?controller=poll&action=link&link=<?=$poll->getLink()?></span>
  </div>
  <div class="row ">
    <span class="poll-view-description">Día mas votado: <b><?= ( $poll->getDate() != NULL ? $poll->getDate()->format('d-F-Y')." de ".$poll->getHours() : 'no se ha votado ningun día')?></b></span>
  </div>
  <div class="row align-items-center table-content">
    <div class="table-container square scrollbar-blue bordered-blue">
      <?php if (count($dates) != 0) {?>
      <table class="poll-table">
        <thead>
          <tr>
            <?php foreach ($dates as $date) {?>
              <th>
                <input type="hidden" id="date<?= $date->getId()?>" value="<?= $date->getId()?>">
                <small class="month"><?= $date->getDay()->format('F')?></small>
                <span class="day"><?= $date->getDay()->format('d')?></span>
                <small class="month"><?= $date->getDay()->format('D')?></small>
                <small class="month"><?= substr($date->getHini(),0,-3)?></small>
                <small class="month"><?= substr($date->getHend(),0,-3)?></small>
              </th>
            <?php } ?>
          </tr>
        </thead>
        <tbody>
          <tr class="count">
            <?php foreach ($dates as $date) {?>
              <td>
                <span><?=$date->getVotes()?></span><span> <i class="fas fa-check"></i></span>
              </td>
            <?php } ?>
          </tr>
          <tr class="check">
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
            <?php foreach ($dates as $date) {?>
              <td>
                <a class="btn btn-custom-blue"  href="#" data-toggle="modal" data-target="#centralModalSm" data-users="<?= implode(',',$usersDates[$date->getId()])?>">
                  <i class="fas fa-user"></i>
                </a>
              </td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
    <?php }else{ ?>
      <div class="row ">
        <span class="poll-view-description">Ningun día ha sido añadido</span>
      </div>
    <?php } ?>
    </div>

    <!-- Central Modal Small -->
    <div class="modal fade" id="centralModalSm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">

        <!-- Change class .modal-sm to change the size of the modal -->
        <div class="modal-dialog modal-sm" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h4 class="modal-title w-100" id="myModalLabel">Lista votos</h4>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
            </div>
          </div>
        </div>
      </div>
      <!-- Central Modal Small -->
  </div>
  <div class="row text-center">
    <div class="col-12">
      <form id="formDates" action="index.php?controller=poll&action=confirmChanges" method="POST">
        <input type="hidden" name="poll" value="<?= $poll->getId()?>">
        <input type="hidden" id="dateList" name="dateList" value="">
        <div class="form-group">
          <?php if (count($dates) != 0) {?>
            <button type="submit" class="btn btn-lg btn-custom-orange">Confirmar</button>
          <?php } if ($user == $poll->getId_user()) {?>
            <a class="btn btn-lg mx-auto btn-custom-blue" href="#">Editar</a>
          <?php } ?>
        </div>
      </form>
    </div>
  </div>

</div>
<script type="text/javascript" src="assets/js/mdb.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.poll-table .check td').on('click', function(){
      var cell = $(this);
      var index = cell.parent().children().index(cell);
      var votecell = $(cell.parent().parent().find('.count').children().get(index));
      var vote = $(votecell).children().get(0);
      if(cell.children().length != 0){
        cell.children().remove();
        $(vote).text(parseInt($(vote).text()) - 1);
      } else {
        var check = $('<span>', {}).append(
          $('<i>', { class: 'fas fa-check' })
        );
        cell.append(check);
        $(vote).text(parseInt($(vote).text()) + 1);
      }
    });

    $('#centralModalSm').on('show.bs.modal', function (event) {
      var button = $(event.relatedTarget);
      var recipient = button.data('users');

      var user = recipient.split(',');

      var modal = $(this);
      var body = modal.find(".modal-body");
      body.children().remove();
      for ( var i = 0, l = user.length; i < l; i++ ) {
        body.append($('<span>', {class:'people'}).text(user[i]));
      }
    });

    $('#formDates').on('submit', function(){
      var table = $('.poll-table');
      var days = table.find('thead th');
      var checks = table.find('tbody tr.check td');
      var inputDays = $('#dateList');
      inputDays.val('')
      for ( var i = 0, l = checks.length; i < l; i++ ) {
        if($(checks[i]).children().length == 1){
          var index = $(checks[i]).parent().children().index(checks[i]);
          var day = days[index];
          if(inputDays.val().length == 0){
            inputDays.val($(day).find('input').val());
          }else{
            inputDays.val(inputDays.val() + ',' + $(day).find('input').val());
          }
        }
      }
    });
  });
</script>
