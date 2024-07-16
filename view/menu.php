<?php
session_start();
// hide all error
error_reporting(0);
// protect .php
$get_self = explode("/", $_SERVER['PHP_SELF']);
$self[] = $get_self[count($get_self) - 1];

if ($self[0] !== "index.php"  && $self[0] !== "") {
  include_once("../core/route.php");
} else {

  if (file_exists('assets/img/logo-' . $m_user . '.png')) {
    $logo = 'assets/img/logortrw.png';
  } else {
    $logo = 'assets/img/logortrw.png';
  }
  if ($m_user != "admin" && !isMobile()) {

?>
    <div class="sidenav unselect">
      <div class="text-center" id="brand">RTRWNET</div>
      <div class="image-circle" style="background-image: url('<?= $logo ?>')"></div>
      <div class="sidenav_item tooltip">
        <select id="lsession" style="border:none;border-radius: 3px;font-weight: bold; width: 100%;" onchange="connect('statconn',this.value)">
          <!-- <option id="load-session" value="0"></option> -->
          <?php
          $i = -2;
          foreach (file('./config/config.php', FILE_SKIP_EMPTY_LINES) as $line) {
            $s = explode("'", $line)[1];
            $i++;
            if ($s == "" || $s == "mikhmon") {
            } else {
          ?>
              <option value="<?= $s; ?>"><?= strtoupper($s); ?></option>
          <?php }
          } ?>
        </select>
        &nbsp;
        <small><span id="statconn" style="position:relative;  z-index:1000; font-size:10px;" class="tooltiptext-right hide"></span></small>
      </div>
      <a href="?<?= $m_user ?>" class="sidenav_item <?= $dash_ma ?>"><i class="fa fa-th-large"></i> Dashboard</a>
      <a href="?<?= $m_user ?>/hotspot" class="sidenav_item <?= $hotspot_ma ?>"><i class="fa fa-wifi"></i> Hotspot</a>
      <!-- <a href="#" class="sidenav_item <?= $voucher_ma ?>" ><i class="fa fa-ticket"></i> Voucher</a>
  <a href="#" class="sidenav_item <?= $quickprint_ma ?>" ><i class="fa fa-print"></i> Quick Print</a> -->
      <a href="?admin/settings/&r=<?= $m_user ?>" class="sidenav_item <?= $settings_ma ?>"><i class="fa fa-list"></i> List Router</a>
      <a id="logOut" title="Logout" class="sidenav_item"><i class="fa fa-sign-out"></i> Logout</a>


    </div>

  <?php } else if ($m_user == "admin" && !isMobile()) { ?>

    <div class="sidenav unselect">
      <div class="text-center" id="brand">RTRWNET</div>
      <div class="image-circle" style="background-image: url('<?= $logo ?>')"></div>
      <a href="?<?= $m_user ?>/settings" class="sidenav_item <?= $settings_ma ?>"><i class="fa fa-list"></i> List Router</a>
      <a id="logOut" title="Logout" class="sidenav_item"><i class="fa fa-sign-out"></i> Logout</a>

    </div>




  <?php } else if ($m_user !== "admin" && isMobile()) { ?>

    <div class="navbar" id="mnav">
      <a id="mactive" class=" mNavBtn"><?php if ($page == "") {
                                          echo $navicon . " Dashboard";
                                        } else {
                                          echo $navicon . " " . ucfirst($page);
                                        } ?></a>
      <li></li>
      <a href="?<?= $m_user ?>" class="<?= $dash_ma ?>"><i class="fa fa-th-large"></i> Dashboard</a>
      <a href="?<?= $m_user ?>/hotspot" class="<?= $hotspot_ma ?>"><i class="fa fa-wifi"></i> Hotspot</a>
      <!-- <a href="#" class="<?= $voucher_ma ?>" ><i class="fa fa-ticket"></i> Voucher</a>
  <a  class="<?= $quickprint_ma ?>" ><i class="fa fa-print"></i> Quick Print</a> -->
      <a href="?admin/settings/&r=<?= $m_user ?>" class="<?= $settings_ma ?>"><i class="fa fa-list"></i> List Router</a>
      <a id="statconn" class="" title="Idle Timeout">
        <i style="font-size: 16px" class="fa fa-hourglass-half mr-1"></i>
        <span id="timer">10:00</span>
      </a>
      <a id="sessionslk"><span>
          <select id="lsession" style="width: 99%; border: none; border-radius: 3px; font-weight: bold; padding:10px; -webkit-appearance: none;-moz-appearance: none;appearance: none;" onchange="connect('statconn',this.value)">
            <!-- <option id="load-session" value="0"></option> -->
            <?php
            $i = -2;
            foreach (file('./config/config.php', FILE_SKIP_EMPTY_LINES) as $line) {
              $s = explode("'", $line)[1];
              $i++;
              if ($s == "" || $s == "mikhmon") {
              } else {
            ?>
                <option value="<?= $s; ?>"><?= strtoupper($s); ?></option>
            <?php }
            } ?>
          </select>
        </span>
        &nbsp;
      </a>

      <div id="Mtheme" class="btn-group text-center hide">
        <button title="Light" onclick="setTheme('light')" class="bg-light">&nbsp;</button>
        <button title="Dark" onclick="setTheme('dark')" class="bg-dark">&nbsp;</button>
        <button title="Blue" onclick="setTheme('blue')" class="bg-blue">&nbsp;</button>
        <button title="Green" onclick="setTheme('green')" class="bg-green">&nbsp;</button>
        <button title="Pink" onclick="setTheme('pink')" class="bg-pink">&nbsp;</button>
      </div>

      <a href="javascript:void(0);" style="font-size:20px;height:30px;" class="nav_icon mNavBtn"><i class="fa fa-bars" style="padding:4px;"></i></a>
    </div>


  <?php } else if ($m_user == "admin" && isMobile()) { ?>

    <div class="navbar" id="mnav">

      <a id="mactive"><?php if ($page == "") {
                        echo $navicon . " Dashboard";
                      } else {
                        echo $navicon . " " . ucwords(str_replace("_", " ", $page));
                      } ?></a>
      <a href="?<?= $m_user ?>/settings" class="<?= $settings_ma ?>"><i class="fa fa-gear"></i> Pengaturan</a>
      <a id="logOut" title="Logout"><i class="fa fa-sign-out"></i> Logout</a>
      <a class="" title="Idle Timeout">
        <i style="font-size: 16px" class="fa fa-hourglass-half mr-1"></i>
        <span id="timer">10:00</span>
      </a>
      <a href="?<?= $m_user ?>/about" class="<?= $about_ma ?>"><i class="fa fa-info-circle"></i> About</a>

      <a href="javascript:void(0);" style="font-size:20px;height:30px;" class="nav_icon mNavBtn"><i class="fa fa-bars"></i></a>
    </div>



<?php }
} ?>