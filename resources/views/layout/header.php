<!DOCTYPE html>
<?php
    if(session_has('locale')) {
        $dir = session('locale') == 'ar' ? 'rtl' : 'ltr';
        $lang = session('locale');
    } else {
        $dir = 'ltr';
        $lang = 'en';
    }
?>
<html lang="<?=$lang?>" dir="<?=$dir?>">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title><?= !empty($title) ? $title : 'Project Name'?></title>
        <?php if (session('locale') == 'ar'): ?>
            <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.rtl.min.css">
        <?php else: ?>
            <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" />
        <?php endif; ?>
    </head>
    <body>
        <?php view('layout.navbar'); ?>
