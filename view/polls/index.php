<?php
//file: view/users/login.php

require_once(__DIR__."/../../core/ViewManager.php");
$view = ViewManager::getInstance();
$poll = $view->getVariable("poll");
$dates = $view->getVariable("dates");
$errors = $view->getVariable("errors");
?>

<div id="view" class="container">
  <div class="row flex-row-reverse">
    <div class="col-md-6 view-list">
      <div class="header">
        <div class="row">
          <div class="col-7 col-sm-9 col-md-8 col-lg-9">
            <a href="#"><img src="assets/img/logo-black.png"></a>
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
            <a class="nounderline add-link" href="#">
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
      <table class="poll-table">
        <thead>
          <tr>
            <?php foreach ($dates as $date) {?>
              <th>
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
                <span><?=$date->getVotes()?> <i class="fas fa-check"></i></span>
              </td>
            <?php } ?>
          </tr>
          <tr class="check">
            <?php foreach ($dates as $date) {?>
                <td>
                  <span><i class="fas fa-check"></i></span>
                </td>
            <?php } ?>
          </tr>
          <tr class="people-list">
            <?php foreach ($dates as $date) {?>
              <td>
                <a class="btn btn-custom-blue"  href="#" data-toggle="modal" data-target="#centralModalSm">
                  <i class="fas fa-user"></i>
                </a>
              </td>
            <?php } ?>
          </tr>
        </tbody>
      </table>
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
              <span class="people">Juan Apellido Apellido 1</span>
              <span class="people">Juan Apellido Apellido 2</span>
              <span class="people">Juan Apellido Apellido 3</span>
              <span class="people">Juan Apellido Apellido 4</span>
              <span class="people">Juan Apellido Apellido 5</span>
            </div>
          </div>
        </div>
      </div>
      <!-- Central Modal Small -->
  </div>
  <div class="row text-center">
    <div class="col-12">
      <div class="form-group">
        <a class="btn btn-lg mx-auto btn-custom-orange" href="#">Confirmar</a>
        <a class="btn btn-lg mx-auto btn-custom-blue" href="#">Editar</a>
      </div>
    </div>
  </div>

</div>
<script type="text/javascript" src="assets/js/mdb.min.js"></script>
<script type="text/javascript">
  $(document).ready(function() {
    $('.poll-table .check td').on('click', function(){
      var cell = $(this);
      if(cell.children().length != 0){
        cell.children().remove();
      } else {
        var check = $('<span>', {}).append(
          $('<i>', { class: 'fas fa-check' })
        );
        cell.append(check);
      }
    });
  });
</script>
