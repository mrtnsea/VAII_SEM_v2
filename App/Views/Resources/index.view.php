<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="tableOfContent sidebar" id="table">
    <ul>
        <li>
            <a href="#guides">Guides</a>
        </li>
        <li>
            <a href="#banners">Character Banners</a>
        </li>
        <li>
            <a href="#char-icons">Character Icons</a>
        </li>
        <li>
            <a href="#splash-arts">Character Splash-Arts</a>
        </li>
        <li>
            <a href="#relic-icons">Relic Icons</a>
        </li>
        <li>
            <a href="#pieces">Relic Pieces</a>
        </li>
    </ul>
</div>

<div class="res-container">
    <form id="resourceForm" method="post" enctype="multipart/form-data" action="<?= $link->url("add") ?>">
        <div class="form-label-group mb-3">
            <input id="fileInput" type="file" name="fileInput" accept="image/png, image/jpeg, image/webp" />
            <div class="invalid-feedback" id="imageError"></div>
        </div>
        <div class="form-label-group mb-3">
            <input name="name" type="text" id="name" class="form-control" placeholder="Name"
                   required autofocus>
            <div class="invalid-feedback" id="nameError"></div>
        </div>
        <div class="form-label-group mb-3">
            <select id="selector" name="type">
                <option value="Guide">Guide</option>
                <option value="Banner">Banner</option>
                <option value="Character Icon">Character Icon</option>
                <option value="Splash-art">Splash Art</option>
                <option value="Relic Icon">Relic Icon</option>
                <option value="Relic piece">Relic Piece</option>
            </select>
        </div>
        <div class="text-center">
            <button class="btn btn-primary" type="submit" name="submit">Add Resource
            </button>
            <div class="feedback" id="submitFeedback"><?= @$data["feedback"] ?></div>
            <div class="invalid-feedback" id="submitError"><?= @$data["error"] ?></div>
        </div>
    </form>
</div>

<div class="res-container" id="guides">
    <h1>Guides</h1>
    <div class="resource">
        <?php foreach ($data["guides"] as $guide):?>
            <div class="card col-12 col-sm-6 col-lg-3 cardGuide" id="guide:<?= $guide->getId() ?>">
                <button type="button" class="btn-close guide" aria-label="Close" id="<?= $guide->getId() ?>"></button>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="<?= $guide->getIcon() ?>" class="card-img img-fluid" alt="<?= $guide->getName() ?>">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-center"><?= $guide->getName() . " Guide" ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="res-container" id="banners">
    <h1>Character Banners</h1>
    <div class="resource">
        <?php foreach ($data["banners"] as $banner):
            $name = pathinfo($banner, PATHINFO_FILENAME)?>
            <div class="card col-12 col-sm-9 col-lg-9 cardGuide banner" id="banner:<?= $banner ?>">
                <button type="button" class="btn-close img" aria-label="Close" id="<?= $banner ?>"></button>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="<?= $banner ?>" class="card-img img-fluid" alt="<?= $name ?>">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-center"><?= $name ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="res-container" id="char-icons">
    <h1>Character Icons</h1>
    <div class="resource">
        <?php foreach ($data["char-icons"] as $icon):
            $name = pathinfo($icon, PATHINFO_FILENAME)?>
            <div class="card col-12 col-sm-6 col-lg-3 cardGuide icon" id="icon:<?= $icon ?>">
                <button type="button" class="btn-close img" aria-label="Close" id="<?= $icon ?>"></button>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="<?= $icon ?>" class="card-img img-fluid" alt="<?= $name ?>">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-center"><?= $name ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="res-container" id="splash-arts">
    <h1>Character Splash-Arts</h1>
    <div class="resource">
        <?php foreach ($data["splash-arts"] as $splash):
            $name = pathinfo($splash, PATHINFO_FILENAME)?>
            <div class="card col-12 col-sm-6 col-lg-3 cardGuide splash" id="splash:<?= $splash ?>">
                <button type="button" class="btn-close img" aria-label="Close" id="<?= $splash ?>"></button>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="<?= $splash ?>" class="card-img img-fluid" alt="<?= $name ?>">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-center"><?= $name ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="res-container" id="relic-icons">
    <h1>Relic Icons</h1>
    <div class="resource">
        <?php foreach ($data["relic-icons"] as $icon):
            $name = pathinfo($icon, PATHINFO_FILENAME)?>
            <div class="card col-12 col-sm-6 col-lg-3 cardGuide icon" id="icon:<?= $icon ?>">
                <button type="button" class="btn-close img" aria-label="Close" id="<?= $icon ?>"></button>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="<?= $icon ?>" class="card-img img-fluid" alt="<?= $name ?>">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-center"><?= $name ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<div class="res-container" id="pieces">
    <h1>Relic Pieces</h1>
    <div class="resource">
        <?php foreach ($data["pieces"] as $piece):
            $name = pathinfo($piece, PATHINFO_FILENAME)?>
            <div class="card col-12 col-sm-6 col-lg-3 cardGuide piece" id="piece:<?= $piece ?>">
                <button type="button" class="btn-close img" aria-label="Close" id="<?= $piece ?>"></button>
                <div class="d-flex justify-content-center align-items-center">
                    <img src="<?= $piece ?>" class="card-img img-fluid" alt="<?= $name ?>">
                </div>
                <div class="card-body text-center">
                    <h5 class="card-title text-center"><?= $name ?></h5>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>
