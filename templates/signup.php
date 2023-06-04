<div class="signup">
    <div class="signup-classic">
        <h1>Sign up to TaskManager</h1>
        <form action="" method="post" class="form">
        <fieldset class="username">
        <?php $style = isset($errors['username']) ? 'border: 4px solid red;' : ''; ?>
            <input
                type="text"
                name="username"
                placeholder="username"
                value="<?= $_POST['username'] ?? '' ?>"
                style="<?= $style ?>"
            >

            <?php if (isset($errors['username'])): ?>
                <p style="background-color: red;"><?= $errors['username'] ?></p>
            <?php endif; ?>
        </fieldset>
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
        <button type="submit" class="btn">sign up</button>
        </form>
        <!-- TODO: перенести стилизацию в css файл -->
        <a class="register-link" href="login.php">Есть аккаунт? - вам сюда!</a>
    </div>
    </div>
