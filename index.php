<?php

require_once "vendor/autoload.php";
require_once "src/functions.php";

$loader = new \Twig\Loader\FilesystemLoader("templates_twig");
$twig = new \Twig\Environment($loader);

$page = $_GET["page"] ?? "list";
$data = getData();

/* ДОБАВЛЕНИЕ ДАННЫХ */
if ($_SERVER["REQUEST_METHOD"] === "POST") {

    $data[] = [
        "title" => $_POST["title"],
        "category" => $_POST["category"],
        "created_at" => date("Y-m-d"),
        "priority" => $_POST["priority"] ?? []
    ];

    saveData($data);

    header("Location: index.php?page=list");
    exit;
}


$filter = new \Twig\TwigFilter('priority_label', function ($value) {
    return is_array($value) ? implode(", ", $value) : $value;
});

$twig->addFilter($filter);

/* РОУТИНГ */
if ($page === "form") {
    echo $twig->render("form.twig");
} else {
    echo $twig->render("list.twig", [
        "data" => $data
    ]);
}