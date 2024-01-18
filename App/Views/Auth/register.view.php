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
                    <h5 class="card-title text-center">Register</h5>
                    <form class="form-signin" method="post" id="registerForm" action="<?= $link->url("register") ?>">
                        <div class="form-label-group mb-3">
                            <input name="login" type="text" id="login" class="form-control" placeholder="Login"
                                   value="<?= @$data["login"] ?>" required autofocus>
                            <div class="invalid-feedback" id="loginError"><?= @$data["loginError"] ?></div>
                        </div>

                        <div class="form-label-group mb-3">
                            <input name="password" type="password" id="password" class="form-control"
                                   placeholder="Password" value="<?= @$data["password"] ?>" required>
                            <div class="invalid-feedback" id="passwordError"></div>
                        </div>

                        <div class="form-label-group mb-3">
                            <input name="passwordRep" type="password" id="passwordRep" class="form-control"
                                   placeholder="Repeat password" value="<?= @$data["passwordRep"] ?>" required>
                            <div class="invalid-feedback" id="passwordRepError"></div>
                        </div>

                        <div class="text-center">
                            <button class="btn btn-primary" type="submit" name="submit">Register
                            </button>
                        </div>
                    </form>

                    <a  aria-current="page" href="<?= $link->url("auth.login") ?>">Log in</a>
                </div>
            </div>
        </div>
    </div>
</div>
