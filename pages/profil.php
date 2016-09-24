<?php include("pages/header.php");
include("pages/body.php");
include("locales/profil.php");
$ProfileLoaded = true; ?>
</div>

  <div id="welcome"><div class="home_image drop-shadow lifted"><img src="img/Theo_Chevalier_Tahoe.jpg" alt="" /></div><div id="welcome_inline"><?=$langage['welcome_begin'][$lang]?><br><?=$langage['welcome_end'][$lang]?></div></div>
	<article id="profil">
      <div class="clear"></div>
      <section id="home_items">
        <ul>
          <li>
            <a id="remo" href="https://mozillians.org/u/tchevalier/">
              <div class="home_icons"></div>
              <h3><?=$langage['remo_title'][$lang]?></h3>
              <p>
                <?=$langage['remo'][$lang]?>
              </p>
            </a>
          </li>
          <li>
            <a id="blog" href="https://blog.theochevalier.fr">
              <div class="home_icons"></div>
              <h3><?=$langage['blog_title'][$lang]?></h3>
              <p>
                <?=$langage['blog'][$lang]?>
              </p>
            </a>
          </li>
          <li>
            <a id="school" href="/cv">
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
