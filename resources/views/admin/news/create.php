<?php
    view('admin.layouts.header', ['title' => trans('admin.news')]);
    $categories = db_get('categories', '');
?>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2>{{ trans('admin.news') }} - {{ trans('admin.create') }}</h2>
            <a class="btn btn-info" href="{{ aurl('news') }}">{{ trans('admin.news') }}</a>
        </div>
        

        @php
            $title = get_error('title');
            $image = get_error('image');
            $description = get_error('description');
            $category_id = get_error('category_id');
            $content = get_error('content');
        @endphp
        <form method="post" action="{{ aurl('news/create') }}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="post" />
            <div class="row">
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="title"> {{ trans('news.title') }}</label>
                        <input type="text" id="title" name="title" placeholder="{{ trans('news.title') }}"
                               class="form-control <?= !empty($title) ? 'is-invalid' : '' ?>"
                               value="{{ old('title') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="category_id"> {{ trans('news.category_id') }}</label>
                        <select id="category_id" class="form-select <?= !empty($title) ? 'is-invalid' : '' ?>" name="category_id">
                            <option disabled selected>{{ trans('admin.choose') }}</option>
                            <?php while ($category= mysqli_fetch_assoc($categories['query'])): ?>
                                <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                            <?php endwhile; ?>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="image"> {{ trans('news.image') }}</label>
                        <input type="file" id="image" name="image" placeholder="{{ trans('news.image') }}"
                               class="form-control <?= !empty($image) ? 'is-invalid' : '' ?>">
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="description"> {{ trans('news.description') }}</label>
                        <textarea id="description" name="description" placeholder="{{ trans('news.description') }}"
                                  class="form-control <?= !empty($description) ? 'is-invalid' : '' ?>">
                            {{ old('description') }}
                        </textarea>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="form-group">
                        <label for="content"> {{ trans('news.content') }}</label>
                        <textarea id="content" name="content" placeholder="{{ trans('news.content') }}"
                                  class="form-control <?= !empty($content) ? 'is-invalid' : '' ?>">
                            {{ old('content') }}
                        </textarea>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-success" value="{{ trans('admin.create') }}"/>
        </form>
<script>
    ClassicEditor
        .create(document.querySelector('#content'),{
            language: '{{ session_has("locale")?session("locale"):"en" }}',
        })
        .catch(error => {
            console.error(error);
        });
</script>

<?php view('admin.layouts.footer'); ?>
