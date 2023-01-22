<div class="signup">
    <div class="signup-classic">
        <form class="form" method="post" action="create-project.php">
            <h1>Create Project</h1>
            <fieldset class="email">
            <?php $style = isset($errors['project']) ? 'border: 4px solid red;' : ''; ?>

                <input
                    type="text"
                    name="project"
                    placeholder="Project 1"
                    value="<?= $_POST['project'] ?? '' ?>"
                    style="<?= $style ?>"
                >

                <?php if (isset($errors['project'])): ?>
                    <p style="background-color: red;"><?= $errors['project'] ?></p>
                <?php endif; ?>

            </fieldset>
            <button class="btn" type="submit">Create!</button>
        </form>
    </div>
</div>
