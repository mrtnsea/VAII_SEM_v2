<?php

/** @var Array $data */

/** @var \App\Core\LinkGenerator $link */
?>

<div class="container actualities">
    <h1>What's new</h1>
    <?php foreach (array_values($data["guides"]) as $i => $guide):?>
        <div class="actualitiesItem">
            <a href="guide.html" class="cardLink">
                <div class="row">
                    <div class="card col-12 col-sm-6 col-lg-3 cardActualities">
                        <div class="row no-gutters">
                            <div class="col-md-4  d-flex align-items-center">
                                <img src="<?= $data["banners"][$i] ?>" class="card-img bannerImg" alt="<?= $data["names"][$i] ?>">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body bodyActualities">
                                    <h5 class="card-title titleActualities"><?= $data["names"][$i] ?>
                                        <span class="badge bg-secondary">New</span>
                                    </h5>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    <?php endforeach; ?>
</div>

