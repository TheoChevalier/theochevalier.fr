<!DOCTYPE html>
<!--[if lt IE 7]> <html class="no-js ie6 oldie" lang="fr"> <![endif]-->
<!--[if IE 7]>    <html class="no-js ie7 oldie" lang="fr"> <![endif]-->
<!--[if IE 8]>    <html class="no-js ie8 oldie" lang="fr"> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang="<?=$lang?>"> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <title><?php if(isset($page_titre)) echo $page_titre." | "; echo NAME; ?></title>
  <meta name="author" content="<?=NAME?>"/>
  <meta name="title" content="<?php if(isset($page_titre)) echo $page_titre." | ".NAME; else echo $langage_index['title'][$lang]; ?>" />
  <meta name="description" content="<?php if(isset($page_desc)) echo $page_desc; else echo $langage_index['description'][$lang]; ?>" />
  <meta name="keywords" content="<?php if(isset($page_keywords)) echo $page_keywords; ?> Théo Chevalier, Théo, Chevalier, développeur, développement, webdesign, webmaster, carcassonne, aude, languedoc-roussillon, languedoc, roussillon, créateur, créer, professionnel, création, site internet, site, étudiant, mozilla" />
  <meta name="medium" content="blog" />
  <link rel="image_src" href="<?=ROOTPATH?>/img/<?php if(isset($page_img)) echo $page_img; else echo "logo.jpg"; ?>" />
  <meta name="viewport" content="width=device-width,initial-scale=1" />
  <link rel="alternate" type="application/rss+xml"  href="<?=ROOTPATH.'/'.$lang?>_rss.xml">
  <link href='http://fonts.googleapis.com/css?family=Sansita+One' rel='stylesheet' type='text/css'>
  <link rel="shortcut icon" href="favicon.ico" type="image/x-icon" />
  <?php
  //require_once 'css-crush/CssCrush.php';
  /*$options = array(
    'debug' => true);*/
  //$global_css = CssCrush::file('/css/style.css'); ?>
    <link rel="stylesheet" type="text/css" href="css/style.css" />
  <!--[if lte IE 8]><link rel="stylesheet" href="css/iestyle.css" /><![endif]-->
</head>
