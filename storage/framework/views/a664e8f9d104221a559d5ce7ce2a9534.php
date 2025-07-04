<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <script src="https://cdn.jsdelivr.net/npm/muuri@0.9.5/dist/muuri.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/web-animations-js@2.3.2/web-animations.min.js"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/3.3.5/vue.global.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">AdminPanel</a>
          <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>
          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
              <li class="nav-item">
                <a class="nav-link active" aria-current="page" href="<?php echo e(route('show_admin_page')); ?>">Главная</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('show_categories_page')); ?>">Категории</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('show_words_page')); ?>">Слова</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('show_games_page')); ?>">Игры</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('show_styles_page')); ?>">Стили</a>
              </li>
              <?php if(auth()->guard()->check()): ?>
              <li class="nav-item">
                <a class="nav-link" href="<?php echo e(route('AdminLog')); ?>">выйти</a>
              </li>
              <?php endif; ?>
            </ul>
          </div>
        </div>
      </nav>
      <?php echo $__env->yieldContent('content'); ?>
</body>
</html>
<?php /**PATH D:\Desktop\Работатьнад\sorter\resources\views/admin/adminLayout/appAdmin.blade.php ENDPATH**/ ?>