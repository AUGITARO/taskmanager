<?php

/** @var array $projects */

?>
<div class="signup">
    <div class="signup-classic">
        <form class="form" method="post" action="create-task.php">
            <h1>Create Task</h1>
            <fieldset class="email">
                <?php $field = 'name'; ?>
                <?php $style = isset($errors[$field]) ? 'border: 4px solid red;' : ''; ?>

                <input
                    type="text"
                    name="<?= $field ?>"
                    placeholder="Name 1"
                    value="<?= $_POST[$field] ?? '' ?>"
                    style="<?= $style ?>"
                >

                <?php if (isset($errors[$field])): ?>
                    <p style="background-color: red;"><?= $errors[$field] ?></p>
                <?php endif; ?>

            </fieldset>
            <fieldset class="email">
                <?php $field = 'deadline'; ?>
                <?php $style = isset($errors[$field]) ? 'border: 4px solid red;' : ''; ?>

                <input
                    type="text"
                    name="<?= $field ?>"
                    placeholder="2001-11-26"
                    value="<?= $_POST[$field] ?? '' ?>"
                    style="<?= $style ?>"
                >
                
                <?php if (isset($errors[$field])): ?>
                    <p style="background-color: red;"><?= $errors[$field] ?></p>
                <?php endif; ?>
                
            </fieldset>
            <fieldset class="email">
                <?php $field = 'project_id'; ?>
                <select name="project_id">
                    
                    <?php foreach ($projects ?? [] as $project): ?>
                        <option value="<?= esc($project['id']) ?>"><?= esc($project['name']) ?></option>
                    <?php endforeach; ?>
                        
                </select>

                <?php if (isset($errors[$field])): ?>
                    <p style="background-color: red;"><?= $errors[$field] ?></p>
                <?php endif; ?>

            </fieldset>
            <button type="submit" class="btn">Create!</button>
        </form>
    </div>
</div>
