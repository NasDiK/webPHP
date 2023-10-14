<?php
  require_once '.\utils\logger.php';
  require_once './consts.php';

  $logger = new Logger();

  $randBannerNum = rand(1, 5);

  $logger->info(
    $logTypes['BANNER_SHOW'] . ' | ' . $randBannerNum
  );

  $banners = [
    '1' => './assets/banners/01.gif',
    '2' => './assets/banners/02.gif',
    '3' => './assets/banners/03.gif',
    '4' => './assets/banners/04.gif',
    '5' => './assets/banners/05.gif'
  ];
  
  $pages = [
    '1' => './pages/first.php',
    '2' => './pages/second.php',
    '3' => './pages/third.php',
    '4' => './pages/fourth.php',
    '5' => './pages/fifth.php'
  ];

  $bannerPath =  $banners[$randBannerNum];
  $pagePath =  $pages[$randBannerNum];
?>

<div style="display: flex; flex-direction: column; gap: 16px;">
  <a href="/stats">Статистика</a>
  <a href=<? echo $pagePath ?>>
    <img src=<? echo $bannerPath ?> alt="" />
  </a>
</div>