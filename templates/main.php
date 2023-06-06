<?php

/** @var string $username */
/** @var array $projects */
/** @var string $show_completed*/
/** @var array $show_completed*/

?>
<div class="container">
    <div class="left-wrapper">
        <h1>Task Manager</h1>
        <p class="account-name"><?= esc($username) ?></p>
        <a class="logout-btn" href="./logout.php">Выход</a>
        <ul class="project-list">

            <?php $tab = isset($_GET['tab']) ? "&tab={$_GET['tab']}" : ''; ?>

            <?php foreach ($projects ?? [] as $project): ?>
                <?php $classname = isset($_GET['project']) && $_GET['project'] === $project['id'] ? ' project--active' : ''; ?>
                <li class="project<?= $classname ?>">
                    <a
                        class="project-name"
                        href="/index.php?project=<?= esc($project['id']) . $tab . ($show_completed ?? '') ?>"
                    ><?= esc($project['name']) ?></a>
                </li>
            <?php endforeach; ?>

        </ul>
        <a class="new-project" href="./create-project.php">Создать проект</a>
    </div>

    <div class="right-wrapper">
        <div class="filters">
            <div class="search">
                <form class="search-form" action="./search.php" method="get">
                    <input
                        class="search-task"
                        value="<?= $_GET['q'] ?? ''?>"
                        type="search"
                        name="q"
                        placeholder="Найти задачу"
                        autofocus
                    >
                    <input class="search-btn" type="submit" value="Найти">
                </form>
            </div>

            <div class="buttons">
                <?php $project = isset($_GET['project']) ? "project={$_GET['project']}&" : ''; ?>
                <?php $show_completed = isset($_GET['show-completed']) ? "&show-completed={$_GET['show-completed']}" : ''; ?>

                <?php $classname = isset($_GET['tab']) && $_GET['tab'] === "all" ? ' filter-btn--active' : ''; ?>
                <a class="filter-btn<?= $classname ?>" href="/index.php?<?= $project ?>tab=all<?= $show_completed ?>">Все</a>

                <?php $classname = isset($_GET['tab']) && $_GET['tab'] === "today" ? ' filter-btn--active' : ''; ?>
                <a class="filter-btn<?= $classname ?>" href="/index.php?<?= $project ?>tab=today<?= $show_completed ?>">Повестка дня</a>

                <?php $classname = isset($_GET['tab']) && $_GET['tab'] === "tomorrow" ? ' filter-btn--active' : ''; ?>
                <a class="filter-btn<?= $classname ?>" href="/index.php?<?= $project ?>tab=tomorrow<?= $show_completed ?>">Завтра</a>

                <?php $classname = isset($_GET['tab']) && $_GET['tab'] === "overdue" ? ' filter-btn--active' : ''; ?>
                <a class="filter-btn<?= $classname ?>" href="/index.php?<?= $project ?>tab=overdue<?= $show_completed ?>">Просроченные</a>

                <div class="checkbox-wrapper">
                    <?php $is_checked = isset($_GET['show-completed']) && $_GET['show-completed'] === '1' ? ' checked' : '';  ?>
                    <input class="checkbox-input" type="checkbox" name="show-completed" id="checkbox"<?= esc($is_checked) ?>>
                    <label class="checkbox-label" for="checkbox">
                        <span class="checkbox-icon"></span>
                        Показать выполненыe
                    </label>
                </div>
            </div>
        </div>

        <div class="tasks-list">

            <?php foreach ($tasks ?? [] as $task): ?>
                <?php $classname = strpos($task['deadline'], date('Y-m-d')) === 0 ? ' task--important' : '';?>
                <div class="task<?= $classname ?>">
                    <a href="execute-task.php?id=<?= esc($task['id']) ?>">
                        <?php $classname = intval($task['is_completed']) === 1 ? ' status--complete' : ''?>
                        <div class="status<?= esc($classname) ?>"></div>
                    </a>
                    <div class="task-name"><?= esc($task['name']) ?></div>

                    <?php if (isset($task['file_path'])): ?>
                        <a class="task-file" href="/uploads/<?= esc($task['file_path']) ?>" download><?= esc($task['file_path']) ?></a>
                    <?php else: ?>
                        <a class="task-file">Файл отсутствует</a>
                    <?php endif; ?>

                    <div class="deadline"><?= date('Y-m-d', strtotime($task['deadline'])) ?></div>
                </div>
            <?php endforeach; ?>

            <a class="new-project" href="./create-task.php" target="_blank">Создать задачу</a>
        </div>
    </div>

</div>
        