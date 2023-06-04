          <div class="container">
            
                <div class="left-wrapper">
                    <h1>Your Projects</h1>
                    <h2>Пользователь: <?= esc($_SESSION['user']['login']) ?></h2>
                    <a class="logout-btn" href="./logout.php">Выход</a>
                    <ul class="project-list">

                        <?php $tab = isset($_GET['tab']) ? "&tab={$_GET['tab']}" : ''; ?>

                        <?php foreach ($projects ?? [] as $project): ?>
                            <?php $classname = isset($_GET['project']) && $_GET['project'] === $project['id'] ? ' project--active' : ''; ?>
                            <li class="project<?= $classname ?>">
                                <a
                                    class="project-name"
                                    href="/index.php?project=<?= esc($project['id']) . $tab . $show_completed ?>"
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
                            <input type="checkbox" class="checkbox-input" name="show-completed" id="checkbox"<?= esc($is_checked) ?>>
                            <label class="checkbox" for="checkbox">Показать выполненыe</label>
                        </div>
                      </div>
                </div>

                <div class="tasks-list">
                    
                    <?php foreach ($tasks ?? [] as $task): ?>
                        <?php $classname = strpos($task['deadline'], date('Y-m-d')) === 0 ? ' task--important' : '';?>
                        <div class="task<?= $classname ?>">
                            <div class="left-task-wrapper">
                                <a href="execute-task.php?id=<?= esc($task['id']) ?>">
                                    <?php $classname = intval($task['is_completed']) === 1 ? ' status--complete' : ''?>
                                    <div class="status<?= esc($classname) ?>"></div>
                                </a>
                            </div>
                            <div class="right-task-wrapper">
                                <div class="task-name">
                                    <p><?= esc($task['name']) ?></p>
                                </div>
                                <div class="task-data-file">

                                    <?php if (isset($task['file_path'])): ?>
                                        <a href="/uploads/<?= esc($task['file_path']) ?>" download>
                                            <svg class="download" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                                <g id="Icons">
                                                    <path d="m43 32v6a5 5 0 0 1 -5 5h-26a5 5 0 0 1 -5-5v-6h-2v6a7 7 0 0 0 7 7h26a7 7 0 0 0 7-7v-6z"></path>
                                                    <path d="m25 39a1 1 0 0 0 .71-.29l12-12-1.42-1.42-10.29 10.3v-30.59h-2v30.59l-10.29-10.3-1.42 1.42 12 12a1 1 0 0 0 .71.29z"></path>
                                                </g>
                                            </svg>
                                            <p style="width: 200px; text-overflow: ellipsis; overflow: hidden;"><?= esc($task['file_path']) ?></p>
                                        </a>
                                    <?php endif;?>
                                    
                                    <p class="deadline"><?= date('Y-m-d', strtotime($task['deadline'])) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <a class="new-project" href="./create-task.php" target="_blank">Создать задачу</a>
                </div>
            </div>

        </div>
        