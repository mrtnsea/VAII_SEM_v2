<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="options">
    <div class="editor_tools">
        <form method="post" action="<?= $link->url("guide.edit", ["id" => $data["id"]])?>">
            <input type="submit" value="Edit" />
        </form>
        <form method="post" action="<?= $link->url("guide.delete", ["id" => $data["id"]])?>">
            <input type="submit" value="Delete" />
        </form>
    </div>

    <div class="tableOfContent" id="table">
        <h5>Table of contents</h5>
        <ul>
            <?php foreach ($data["sections"] as $section):
                if ($section->getParentSection() == null) { ?>
                    <li>
                        <a href="#<?= $section->getName() ?>" class="guideLink"><?= $section->getName() ?></a>
                        <ul>
                            <?php foreach ($data["sections"] as $child_section):
                                if ($child_section->getParentSection() == $section->getID()) { ?>
                                    <li>
                                        <a href="#<?= $child_section->getName() ?>" class="guideLink"><?= $child_section->getName() ?></a>
                                    </li>
                                <?php } ?>
                            <?php endforeach; ?>
                        </ul>
                    </li>
                <?php } ?>
            <?php endforeach; ?>
        </ul>
    </div>
</div>

<?php foreach (array_values($data["sections"]) as $i => $section): ?>
    <?php
    $top = $section->getOrder() == 1 ? "top" : "";
    $classHeader = $section->getParentSection() == null ? "sectionHeader" : "subSectionHeader";
    $headerType = $section->getParentSection() == null ? "1" : "2";
    ?>
    <div class="section <?= $classHeader?> <?= $top?>" id="<?= $section->getName() ?>">
        <h<?= $headerType?>><?= $section->getHeader() ?></h<?= $headerType?>>
    </div>
    <div class="section">
        <?php if ($section->getOrder() == 1) {
            foreach ($data["images"] as $image):
                if ($image->getSectionID() == $section->getID()) {?>
                    <img src="<?= $image->getImage() ?>" alt="image">
                <?php } endforeach;
        } else { ?>
            <div class="container">
                <?php foreach ($data["images"] as $image):
                    if ($image->getSectionID() == $section->getID()) {
                        if ($image->getCardHeader() != null) { ?>
                            <div class="col-sm">
                                <img src="<?= $image->getImage() ?>" alt="image">
                                <h5><?= $image->getCardHeader() ?></h5>
                            </div>
                        <?php } else { ?>
                            <img src="<?= $image->getImage() ?>" alt="image">
                        <?php }
                    }
                endforeach; ?>
            </div>
        <?php } ?>
        <?php if ($section->getText() != null) { ?>
            <p>
                <?= $section->getText() ?>
            </p>
        <?php } ?>
    </div>
<?php endforeach; ?>
