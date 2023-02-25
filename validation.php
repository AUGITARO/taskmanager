<?php

function required(string $value): ?string 
{
    if (mb_strlen($value) === 0) {
        return 'Введите название задачи!';
    }

    return null;
}
    