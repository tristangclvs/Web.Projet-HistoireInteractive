<?php include("entete.php");
$requete = "SELECT * FROM histoire";
$resultat = $BDD -> query($requete);
$n = $resultat -> rowCount();

$tab = $resultat->fetchAll();
?>

    <a href="https://codesandbox.io/s/k86ez1?file=/index.html:2227-2396"> Swiper Navigation</a>
    <a href="https://codesandbox.io/s/jc2glw?file=/index.html:395-1051"> Scroll Container</a>
    <!-- Swiper -->
    <div class="swiper mySwiper">
        <div class="swiper-wrapper">

            <?php
            foreach ($tab as $key => $ligne){ ?>
                <div class="swiper-slide">
                    <div class="card h-100 cardHist ">
                        <img src="images/<?=$ligne['image']?>" class="card-img-top" alt="...">

                        <div class="card-body">
                            <h5 class="card-title text-dark "> <a class="linkHist" href="histoire.php?id=<?=$ligne['id']?>"> <?=$ligne['titre'] ?></a></h5>

                            <p class="card-text text-dark"> <?=$ligne['description'] ?></p>

                            <?php
                            if ($_SESSION["admin"]){?>
                                <form action="scripts/script_cacherHistoire.php?id=<?=$ligne['id']?>" method="post">
                                    <button type="submit" class="btn btn-outline-dark">Cacher l'histoire</button>
                                </form>
                                <?php
                            }
                            ?>
                        </div>
                    </div>
                </div>
                <?php
            }
            ?>



            <!--
                        <div class="swiper-slide">Slide 2</div>
                        <div class="swiper-slide">Slide 3</div>
                        <div class="swiper-slide">Slide 4</div>
                        <div class="swiper-slide">Slide 5</div>
                        <div class="swiper-slide">Slide 6</div>
                        <div class="swiper-slide">Slide 7</div>
                        <div class="swiper-slide">Slide 8</div>
                        <div class="swiper-slide">Slide 9</div>
            -->
        </div>
        <div class="swiper-button-next"></div>
        <div class="swiper-button-prev"></div>
    </div>


<?php include("footer.php") ?>