<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
        <a class="navbar-brand" href="<?=url('/')?>">Logo</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="<?=url('/')?>"><?= trans('main.home') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=url('register')?>"><?= trans('main.register') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=url('login')?>"><?= trans('main.login') ?></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=url('users')?>"><?= trans('main.users') ?></a>
                </li>
                <li class="nav-item">
                    <?php if (session('locale') == 'ar') : ?>
                        <li><a class="nav-link" href="<?=url('lang?lang=en')?>"><?=trans('main.english')?></a></li>
                    <?php else: ?>
                        <li><a class="nav-link" href="<?=url('lang?lang=ar')?>"><?=trans('main.arabic')?></a></li>
                    <?php endif; ?>
                </li>
            </ul>
<!--            <form class="d-flex" role="search">-->
<!--                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">-->
<!--                <button class="btn btn-outline-success" type="submit">Search</button>-->
<!--            </form>-->
        </div>
    </div>
</nav>

<?php
    //echo url('lang?lang=ar'); // http://localhost/php-anonymous/lang?lang=ar
    //echo url('lang?lang=en'); // http://localhost/php-anonymous/lang?lang=en
?>