<?php
require_once('User.php');


function isValidEmail(): bool|int
{
    $email = $_POST["email"];
    $regexp = "/(\\S+)@(\\S+)/";
    return preg_match($regexp, $email);
}


function isValidPassword(): bool
{
    $password = $_POST["password"];
    $repeatPassword = $_POST["repeatPassword"];
    return $password === $repeatPassword;
}


function isValidForm(): bool|string
{
    if (isValidEmail() && isValidPassword())
    {
        $result = array('registration' => true, 'message' => "Вы успешно зарегестрировались");

    }
    elseif (!isValidEmail() && isValidPassword())
    {
        $result = array('registration' => false, 'message' => "Email не содержит @");
    }
    elseif (isValidEmail() && !isValidPassword())
    {
        $result = array('registration' => false, 'message' => "Пароли не совпадают");
    }
    else
    {
        $result = array('registration' => false, 'message' => "Email не содержит @ и Пароли не совпадают");
    }
    return json_encode($result);
}


function isSetEmail($users): void
{
    for ($i = 0; $i < count($users); $i++)
    {
        if ($users[$i]->email != null)
        {
            $logMessage = "[id: {$users[$i]->id}] [{$users[$i]->name} with email address set: {$users[$i]->email}]\n";
        }
        else
        {
            $logMessage = "[id: {$users[$i]->id}] [{$users[$i]->name} with unset email address]\n";
        }
        file_put_contents('logs.txt',$logMessage, FILE_APPEND);
    }
}


function searchForMatches($users, $newUser): bool
{
    for ($i = 0; $i < count($users); $i++)
    {
        if ($users[$i]->email === $newUser->email)
        {
            return false;
        }
    }
    return true;
}

