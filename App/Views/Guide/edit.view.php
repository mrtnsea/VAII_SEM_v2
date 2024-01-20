<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="options">
    <div class="editor_tools">
        <button id="save_button" class="form_button" type="submit" form="guideForm">Save</button>
    </div>
</div>

<form id="guideForm" method="post" action="<?= $link->url("guide.save", ["id" => $data["id"]])?>">
    <?php foreach (array_values($data["sections"]) as $i => $section): ?>
        <?php
        $top = $section->getOrder() == 1 ? "top" : "";
        $classHeader = $section->getParentSection() == null ? "sectionHeader" : "subSectionHeader";
        $headerType = $section->getParentSection() == null ? "Section" : "Subsection";
        $itemType = $section->getParentSection() == null ? "sectionItem" : "subSectionItem";
        ?>
        <div class="section <?= $classHeader ?> <?= $top ?>">
            <h2><?= $headerType ?></h2>
            <div>
                <h5>Header</h5>
                <textarea name="s_header_<?= $section->getID() ?>" class="edit_area"><?= $section->getHeader() ?></textarea>
                <h5>Images</h5>
                <div>
                    <?php foreach ($data["images"] as $image): ?>
                        <?php if ($image->getSectionId() == $section->getId()
                                    && $image->getCardHeader() == null) { ?>
                            <div class="imageItem <?= $itemType ?>" id="<?= $image->getId()?>">
                                <div class="addIcon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12"/>
                                    </svg>
                                </div>
                                <span><?= $image->getImage() ?></span>
                                <div class="space"></div>
                                <button class="trashBin" type="button" id="trash_<?= $image->getId() ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                    </svg>
                                </button>
                            </div>
                        <?php } ?>
                    <?php endforeach; ?>
                    <select id="image_<?= $section->getId() ?>" style="margin-top: 5px;">
                        <?php foreach ($data["resources"] as $res): ?>
                            <option value="<?= $res ?>"><?= $res ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div style="margin-top: 15px;">
                        <button class="addImageButton" style="padding-left: 20px; padding-right: 20px;" id="addImage_<?= $section->getId() ?>" type="button">+</button>
                    </div>
                </div>
                <h5>Cards</h5>
                <div>
                    <?php foreach ($data["images"] as $image): ?>
                        <?php if ($image->getSectionId() == $section->getId()
                            && $image->getCardHeader() != null) { ?>
                            <div class="imageItem <?= $itemType ?>" id="<?= $image->getId() ?>">
                                <div class="addIcon">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-image" viewBox="0 0 16 16">
                                        <path d="M6.002 5.5a1.5 1.5 0 1 1-3 0 1.5 1.5 0 0 1 3 0"/>
                                        <path d="M2.002 1a2 2 0 0 0-2 2v10a2 2 0 0 0 2 2h12a2 2 0 0 0 2-2V3a2 2 0 0 0-2-2h-12zm12 1a1 1 0 0 1 1 1v6.5l-3.777-1.947a.5.5 0 0 0-.577.093l-3.71 3.71-2.66-1.772a.5.5 0 0 0-.63.062L1.002 12V3a1 1 0 0 1 1-1h12"/>
                                    </svg>
                                </div>
                                <span><?= $image->getImage() ?> : <?= $image->getCardHeader()?></span>
                                <div class="space"></div>
                                <button class="trashBin" type="button" id="trash_<?= $image->getId() ?>">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                        <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0"/>
                                    </svg>
                                </button>
                            </div>
                        <?php } ?>
                    <?php endforeach; ?>
                    <select id="card_<?= $section->getId() ?>" style="margin-top: 5px;">
                        <?php foreach ($data["resources"] as $res): ?>
                            <option style="margin-top: 5px;" value="<?= $res ?>"><?= $res ?></option>
                        <?php endforeach; ?>
                    </select>
                    <div style="margin-top: 15px;">
                        <input id="input_<?= $section->getId() ?>" type="text" placeholder="Card header">
                    </div>
                    <div class="invalid-feedback" id="cardHeaderError_<?= $section->getId() ?>"></div>
                    <div style="margin-top: 15px;">
                        <button class="addCardButton" id="addCard_<?= $section->getId() ?>" style="padding-left: 20px; padding-right: 20px" type="button">+</button>
                    </div>
                </div>
                <h5 style="margin-top: 15px;" >Text</h5>
                <textarea name="text_<?= $section->getID() ?>" class="edit_area"><?= $section->getText() ?></textarea>
            </div>
        </div>
        <input type="number" name="s_id_<?= $section->getID() ?>" value="<?= $section->getID() ?>" class="hidden"/>
    <?php endforeach; ?>
    <input type="submit" id="submit-form" class="hidden" />
    <input type="number" name="sectionCount" class="hidden" value="<?= sizeof($data["sections"]) ?>">
    <div class="section" id="buttonDiv">
        <button class="form_button" type="button" onclick="addSection()">Add Section</button>
    </div>
</form>
