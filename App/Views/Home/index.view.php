<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="container actualities">
    <h1>What's new</h1>
    <?php foreach (array_values($data["guides"]) as $i => $guide):?>
        <?php if ($i == 4)
            break;
        $tag = "";
        $bg_tag = "";
        if ($guide->getVersion() == 1) {
            $tag = "New";
            $bg_tag = "bg-secondary";
        } else {
            $tag = "Update";
            $bg_tag = "bg-primary";
        }
        ?>
        <a href="<?= $guide->getInfographicImage() == null
            ? $link->url("guide.index", ["id" => $guide->getId()])
            : $guide->getInfographicImage()?>" class="cardLink">
            <div class="row">
                <div class="card col-12 col-sm-6 col-lg-3 cardActualities">
                    <div class="row no-gutters">
                        <div class="col-md-4  d-flex align-items-center">
                            <img src="<?= $data["banners"][$i] ?>" class="card-img bannerImg" alt="<?= $data["names"][$i] ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body bodyActualities">
                                <h5 class="card-title titleActualities"><?= $data["names"][$i] ?>
                                    <span class="badge <?=$bg_tag?>"><?= $tag ?></span>
                                </h5>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </a>
    <?php endforeach; ?>
</div>

<div class="container sidebar">
    <?php foreach (array_values(array_unique($data["names"])) as $i => $name):?>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" aria-label="" checked>
            </div>
        </div>
        <span class="input-group-text"><?= $name ?></span>
    </div>
    <?php endforeach; ?>
</div>

<div class="container guides" id="guides">
    <h1>Guides</h1>
    <div class="row row-cols-2">
        <?php foreach (array_values($data["guides"]) as $i => $guide):?>
            <div class="card col-12 col-sm-6 col-lg-3 cardGuide">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="<?= $data["icons"][$i] ?>" class="card-img img-fluid" alt="<?= $data["names"][$i] ?>">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-center"><?= $data["names"][$i] ?></h5>
                    <a href="<?= $data["guides"][$i]->getInfographicImage() == null
                        ? $link->url("guide.index", ["id" => $guide->getId()])
                        : $data["guides"][$i]->getInfographicImage()?>"
                       class="btn btn-primary"><?= $data["guides"][$i]->getInfographicImage() == null ? "Guide" : "Infographic" ?></a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

