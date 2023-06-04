<?php

/** @var array $errors */

?>
<div class="signup">
    <div class="signup-classic">
        <form action="" class="form" method="post">
            <h1>Log into TaskManager</h1>
            <fieldset class="email">
            <?php $style = isset($errors['email']) ? 'border: 4px solid red;' : ''; ?>
                <input
                    type="text"
                    name="email"
                    value="<?= $_POST['email'] ?? '' ?>"
                    placeholder="email"
                    style="<?= $style ?>"
                >

                <?php if (isset($errors['email'])): ?>
                    <p style="background-color: red;"><?= $errors['email'] ?></p>
                <?php endif; ?>

            </fieldset>
            <fieldset class="password">
                <?php $style = isset($errors['password']) ? 'border: 4px solid red;' : ''; ?>
                <input
                    type="password"
                    name="password"
                    value="<?= $_POST['password'] ?? '' ?>"
                    placeholder="password"
                    style="<?= $style ?>"
                >

                <?php if (isset($errors['password'])): ?>
                    <p style="background-color: red;"><?= $errors['password'] ?></p>
                <?php endif; ?>

            </fieldset>
            <button type="submit" class="btn">log in</button>
        </form>
        <!-- TODO: перенести стилизацию в css -->
        <a class="register-link" href="signup.php">Нет аккаунта? - вам сюда!</a>
    </div>
</div>
