<?php

$layout = 'auth';
/** @var Array $data */
/** @var \App\Core\LinkGenerator $link */
?>

<div class="container">
    <div class="row">
        <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
            <div class="card card-signin my-5">
                <div class="card-body">
                    <h5 class="card-title text-center">Log in</h5>
                    <form class="form-signin" method="post" id="loginForm">
                        <div class="form-label-group mb-3">
                            <input name="login" type="text" id="login" class="form-control" placeholder="Login"
                                   value="<?= @$data["login"] ?>" required autofocus>
                            <div class="text-danger" id="loginError"></div>
                        </div>

                        <div class="form-label-group mb-3">
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Password" value="<?= @$data["password"] ?>" required>
                            <div class="text-danger" id="passwordError"><?= @$data["passwordError"] ?></div>
                        </div>
                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" name="submit">LOG IN
                            </button>
                            <div class="feedback" id="logSuccess"></div>
                        </div>
                    </form>
                    <a aria-current="page" href="<?= $link->url("register") ?>">Register</a>
                    <a aria-current="page" href="<?= $link->url("home.index") ?>">Home</a>
                </div>
            </div>
        </div>
    </div>
</div>


