<?php
    $category = db_find('categories', request('category_id'));
    redirect_if(empty($category), url('/'));
    
    $news = db_paginate('news', 'WHERE category_id="' . $category['id'] . '"', 10);
    
    view('front.layouts.header', ['title' => $category['name']]);
?>
    <div class="p-4 p-md-5 mb-4 rounded text-body-emphasis bg-body-secondary">
        <div class="col-lg-6 px-0">
            <h1 class="display-4 fst-italic">{{ $category['name'] }}</h1>
            <p class="lead my-3">{{ $category['description'] }}</p>
        </div>
    </div>

    <div class="row mb-2">
        <?php while ($row = mysqli_fetch_assoc($news['query'])): ?>
            <div class="col-md-6">
                <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
                    <div class="col p-4 d-flex flex-column position-static">
<!--                        <strong class="d-inline-block mb-2 text-primary-emphasis">World</strong>-->
                        <h3 class="mb-0">{{ $row['title'] }}</h3>
                        <div class="mb-1 text-body-secondary">{{ $row['created_at'] }}</div>
                        <p class="card-text mb-auto">{{ $row['description'] }}</p>
                        <a href="{{ url('news?category_id='.$row['category_id'].'&id='.$row['id']) }}" class="icon-link gap-1 icon-link-hover stretched-link">
                            {{ trans('main.readmore') }}
                            <svg class="bi"><use xlink:href="#chevron-right"/></svg>
                        </a>
                    </div>
                    <div class="col-auto d-none d-lg-block">
                        <?php
                            if (!empty($row['image'])) {
                                $img = url('storage/'.$row['image']);
                            } elseif (!empty($category['icon'])) {
                                $img = url('storage/'.$category['icon']);
                            } else {
                                $img = url('assets/images/news.webp');
                            }
                        ?>
                        <img src="{{ $img }}" class="bd-placeholder-img" style="width: 200px; height: 250px;">
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
<?php view('front.layouts.footer'); ?>