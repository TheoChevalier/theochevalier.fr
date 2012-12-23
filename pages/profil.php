<?php include("pages/header.php");
include("pages/body.php");
include("locales/profil.php");
$ProfileLoaded = true; ?>
</div>

  <div id="welcome"><div class="home_image drop-shadow lifted"><img src="img/Theo_Chevalier_MozCamp.jpg" alt="" /></div><div id="welcome_inline"><?=$langage['welcome_inline'][$lang]?></div></div>
	<article id="profil">
      <div class="clear"></div>
      <section id="home_items">
        <ul>
          <li>
            <a id="remo" href="https://reps.mozilla.org/u/tchevalier/">
              <div class="home_icons"></div>
              <h3><?=$langage['remo_title'][$lang]?></h3>
              <p>
                <?=$langage['remo'][$lang]?>
              </p>
            </a>
          </li>
          <li>
            <a id="blog" href="index.php?page=6&amp;lang=<?=$lang?>">
              <div class="home_icons"></div>
              <h3><?=$langage['blog_title'][$lang]?></h3>
              <p>
                <?=$langage['blog'][$lang]?>
              </p>
            </a>
          </li>
          <li>
            <a id="school" href="index.php?page=5&amp;lang=<?=$lang?>">
              <div class="home_icons"></div>
              <h3><?=$langage['school_title'][$lang]?></h3>
              <p>
                <?=$langage['school'][$lang]?>
              </p>
            </a>
          </li>
        </ul>
      </section>
	</article>
