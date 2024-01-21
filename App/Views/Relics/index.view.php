<?php
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="actualities">
    <div style="text-align: center">
        <h5>Add Artifact</h5>
        <form id="addArtifact">
            <div style="margin-top: 15px">
                Type:
                <select id="type">
                    <?php foreach ($data["pieces"] as $piece): ?>
                        <option value="<?= $piece ?>"><?= $piece ?></option>
                    <?php endforeach; ?>
                </select>
            </div>
            <div style="margin-top: 15px">
                Main stat:
                <select id="main">
                    <option value="Atk%">Atk%</option>
                    <option value="Hp%">Atk%</option>
                    <option value="Speed">Speed</option>
                    <option value="Dmg%">Dmg%</option>
                    <option value="Crit Rate">Crit Rate</option>
                    <option value="Crit Damage">Crit Damage</option>
                </select>
                <input id="mainVal" type="text" placeholder="0">
                <div class="invalid-feedback" id="mainError"></div>
            </div>
            <div style="margin-top: 15px">
                1. substat:
                <select id="first">
                    <option value="Atk%">Atk%</option>
                    <option value="Hp%">Atk%</option>
                    <option value="Speed">Speed</option>
                    <option value="Dmg%">Dmg%</option>
                    <option value="Crit Rate">Crit Rate</option>
                    <option value="Crit Damage">Crit Damage</option>
                </select>
                <input id="firstVal" type="text" placeholder="0">
                <div class="invalid-feedback" id="firstError"></div>
            </div>
            <div style="margin-top: 15px">
                2. substat:
                <select id="second">
                    <option value="Atk%">Atk%</option>
                    <option value="Hp%">Atk%</option>
                    <option value="Speed">Speed</option>
                    <option value="Dmg%">Dmg%</option>
                    <option value="Crit Rate">Crit Rate</option>
                    <option value="Crit Damage">Crit Damage</option>
                </select>
                <input id="secondVal" type="text" placeholder="0">
                <div class="invalid-feedback" id="secondError"></div>
            </div>
            <div style="margin-top: 15px">
                3. substat:
                <select id="third">
                    <option value="Atk%">Atk%</option>
                    <option value="Hp%">Atk%</option>
                    <option value="Speed">Speed</option>
                    <option value="Dmg%">Dmg%</option>
                    <option value="Crit Rate">Crit Rate</option>
                    <option value="Crit Damage">Crit Damage</option>
                </select>
                <input id="thirdVal" type="text" placeholder="0">
                <div class="invalid-feedback" id="thirdError"></div>
            </div>
            <div style="margin: 15px">
                <button id="addRelic" type="button">Add</button>
                <div class="invalid-feedback" id="relicUploadError"></div>
            </div>
        </form>
    </div>
</div>

<div class="sidebar">
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" aria-label="" class="Atk%">
            </div>
        </div>
        <span class="input-group-text">Atk%</span>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" aria-label="" class="Hp%">
            </div>
        </div>
        <span class="input-group-text">Hp%</span>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" aria-label="" class="Dmg%">
            </div>
        </div>
        <span class="input-group-text">Dmg%</span>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" aria-label="" class="Speed">
            </div>
        </div>
        <span class="input-group-text">Speed</span>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" aria-label="" class="Crit Rate">
            </div>
        </div>
        <span class="input-group-text">Crit Rate</span>
    </div>
    <div class="input-group mb-3">
        <div class="input-group-prepend">
            <div class="input-group-text">
                <input type="checkbox" aria-label="" class="Crit Damage">
            </div>
        </div>
        <span class="input-group-text">Crit Damage</span>
    </div>
</div>

<div class="guides" style="display: flex; flex-wrap: wrap; justify-content: space-evenly">
    <?php foreach ($data["relics"] as $relic):?>
        <div class="card col-12 col-sm-6 col-lg-3 cardGuide" id="<?= $relic->getId() ?>">
            <button type="button" class="btn-close relic" aria-label="Close" id="<?= $relic->getId() ?>"></button>
            <div class="d-flex justify-content-center align-items-center">
                <img style="width: 100px; height:100px" src="<?= $relic->getIcon() ?>" class="card-img img-fluid" alt="relic">
            </div>
            <div class="card-body text-center">
                <h5 class="card-title text-center" id="main_<?= $relic->getId() ?>">
                    <?= $relic->getMain() ?>: <?= $relic->getMainVal()?>
                </h5>
                <div class="text-center" id="first_<?= $relic->getId() ?>">
                    <?= $relic->getFirst() ?>: <?= $relic->getFirstVal() ?>
                </div>
                <div class="text-center" id="second_<?= $relic->getId() ?>">
                    <?= $relic->getSecond() ?>: <?= $relic->getSecondVal() ?>
                </div>
                <div class="text-center" id="third_<?= $relic->getId() ?>">
                    <?= $relic->getThird() ?>: <?= $relic->getThirdVal() ?>
                </div>
            </div>
        </div>
    <?php endforeach; ?>
</div>
