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
        <a href="<?= $link->url("guide.index", ["id" => $guide->getId()])?>" class="cardLink">
            <div class="row">
                <div class="card col-12 col-sm-6 col-lg-3 cardActualities">
                    <div class="row no-gutters">
                        <div class="col-md-4  d-flex align-items-center">
                            <img src="<?= $guide->getBannerImage() ?>" class="card-img bannerImg" alt="<?= $guide->getName() ?>">
                        </div>
                        <div class="col-md-8">
                            <div class="card-body bodyActualities">
                                <h5 class="card-title titleActualities"><?= $guide->getName() ?>
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
    <?php foreach ($data["names"] as $name):?>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" aria-label="" class="<?= $name ?>" checked>
            </div>
        </div>
        <span class="input-group-text"><?= $name ?></span>
    </div>
    <?php endforeach; ?>
</div>

<div class="container guides" id="guides">
    <h1>Guides</h1>
    <div class="row row-cols-2">
        <?php foreach ($data["guides"] as $guide):?>
            <div class="card col-12 col-sm-6 col-lg-3 cardGuide <?= $guide->getName() ?>">
                <div class="d-flex justify-content-center align-items-center">
                    <img src="<?= $guide->getIcon() ?>" class="card-img img-fluid" alt="<?= $guide->getName() ?>">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-center"><?= $guide->getName() ?></h5>
                    <a href="<?= $link->url("guide.index", ["id" => $guide->getId()]) ?>"
                       class="btn btn-primary">Guide</a>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

