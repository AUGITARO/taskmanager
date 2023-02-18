          <div class="container">
            
                <div class="left-wrapper">
                    <h1>Your Projects</h1>
                    <h2><?= esc($_SESSION['user']['login']) ?></h2>
                    <a href="./logout.php">exit</a>
                    <ul class="project-list">

                        <?php $tab = isset($_GET['tab']) ? "&tab={$_GET['tab']}" : ''; ?>

                        <?php foreach ($projects ?? [] as $project): ?>
                            <?php $classname = isset($_GET['project']) && $_GET['project'] === $project['id'] ? ' project--active' : ''; ?>
                            <li class="project<?= $classname ?>">
                                <a
                                    class="project-name"
                                    href="/index.php?project=<?= esc($project['id']) . $tab ?>"
                                ><?= esc($project['name']) ?></a>
                            </li>
                        <?php endforeach; ?>

                    </ul>
                    <a class="new-project" href="create-project.php">+</a>
                </div>

            <div class="right-wrapper">

                <div class="filters">

                    <div class="search">
                        <form action="search.php" method="get" style="display: flex;">
                            <input autofocus value="<?= $_GET['q'] ?? ''?>"class="search-task" type="search" name="q" placeholder="Найти задачу">
                            <input type="submit">
                        </form>
                    </div>

                    <div class="buttons">
                        <?php $project = isset($_GET['project']) ? "project={$_GET['project']}&" : ''; ?>

                        <?php $classname = isset($_GET['tab']) && $_GET['tab'] === "all" ? ' filter-btn--active' : ''; ?>
                        <a class="filter-btn<?= $classname ?>" href="/index.php?<?= $project ?>tab=all">Все</a>

                        <?php $classname = isset($_GET['tab']) && $_GET['tab'] === "today" ? ' filter-btn--active' : ''; ?>
                        <a class="filter-btn<?= $classname ?>" href="/index.php?<?= $project ?>tab=today">Повестка дня</a>

                        <?php $classname = isset($_GET['tab']) && $_GET['tab'] === "tomorrow" ? ' filter-btn--active' : ''; ?>
                        <a class="filter-btn<?= $classname ?>" href="/index.php?<?= $project ?>tab=tomorrow">Завтра</a>

                        <?php $classname = isset($_GET['tab']) && $_GET['tab'] === "overdue" ? ' filter-btn--active' : ''; ?>
                        <a class="filter-btn<?= $classname ?>" href="/index.php?<?= $project ?>tab=overdue">Просроченные</a>

                        <div>
                            <?php $is_checked = isset($_GET['show-completed']) && $_GET['show-completed'] === '1' ? ' checked' : '';  ?>
                            <input type="checkbox" class="checkbox-input" name="show-completed" id="checkbox"<?= $is_checked ?>>
                            <label for="checkbox">
                                <span class="checkbox"></span>
                            </label>
                            <label for="checkbox">
                                <span class="checkbox-text">Показать выполненые</span>
                            </label>
                        </div>
                      </div>
                </div>

                <div class="tasks-list">
                    
                    <?php foreach ($tasks ?? [] as $task): ?>
                        <?php $classname = strpos($task['deadline'], date('Y-m-d')) === 0 ? ' task--important' : '';?>
                        <div class="task<?= $classname ?>">
                            <div class="left-task-wrapper">
                                <a href="execute-task.php?id=<?= $task['id'] ?>">
                                    <?php $classname = intval($task['is_completed']) === 1 ? ' status--complete' : ''?>
                                    <div class="status<?= $classname ?>"></div>
                                </a>
                            </div>
                            <div class="right-task-wrapper">
                                <div class="task-name">
                                    <p><?= $task['name'] ?></p>
                                </div>
                                <div class="task-data-file">

                                    <?php if (isset($task['file_path'])): ?>
                                        <a href="/uploads/<?= $task['file_path'] ?>" download>
                                            <svg class="download" viewBox="0 0 50 50" xmlns="http://www.w3.org/2000/svg">
                                                <g id="Icons">
                                                    <path d="m43 32v6a5 5 0 0 1 -5 5h-26a5 5 0 0 1 -5-5v-6h-2v6a7 7 0 0 0 7 7h26a7 7 0 0 0 7-7v-6z"></path>
                                                    <path d="m25 39a1 1 0 0 0 .71-.29l12-12-1.42-1.42-10.29 10.3v-30.59h-2v30.59l-10.29-10.3-1.42 1.42 12 12a1 1 0 0 0 .71.29z"></path>
                                                </g>
                                            </svg>
                                            <p><?= $task['file_path'] ?></p>
                                        </a>
                                    <?php endif;?>
                                    
                                    <p class="deadline"><?= date('Y-m-d', strtotime($task['deadline'])) ?></p>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>

                    <a target="_blank" class="new-project" href="create-task.php">+</a>
                </div>
            </div>

        </div>
        