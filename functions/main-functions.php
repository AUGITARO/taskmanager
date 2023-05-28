<?php

function includeTemplate(string $name, array $data = []): string
{
    $name = 'templates/' . $name;
    $result = '';

    if (!is_readable($name)) {
        return $result;
    }

    ob_start();
    extract($data);
    require $name;

    $result = ob_get_clean();

    return $result;
}

function is_date_valid(string $date): bool 
{
    $format_to_check = 'Y-m-d';
    $dateTimeObj = date_create_from_format($format_to_check, $date);

    return $dateTimeObj !== false && array_sum(date_get_last_errors()) === 0;
}

function esc(string $str): string
{
    return htmlspecialchars($str);
}

function get_post_input(string $form_name): array
{
    $input = [];

    $forms = [
        'signup' => ['username', 'email', 'password'],
        'login' => ['email', 'password'],
        'create-project' => ['project'],
        'create-task' => ['name', 'deadline', 'project_id']
    ];

    if (!isset($forms[$form_name])) {
        return $input;
    }

    foreach ($forms[$form_name] as $input_name) {
        $input[$input_name] = trim($_POST[$input_name] ?? '');
    }

    return $input;
}

function debug(array $array): void
{
    print('<pre>');
    print_r($array);
    print('</pre>');
    exit;
}

