<?php
    view('admin.layouts.header', ['title' => trans('admin.users') . '-'.trans('admin.edit')]);
    
    $user = db_find('users', request('id'));
    redirect_if(empty($user), aurl('users'));
?>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2>{{ trans('admin.users') }} - {{ trans('admin.edit') }}</h2>
            <a class="btn btn-info" href="{{ aurl('users') }}">{{ trans('admin.users') }}</a>
        </div>

        @php
        $name = get_error('name');
        $email = get_error('email');
        $mobile = get_error('mobile');
        $password = get_error('password');
        $user_type = get_error('user_type');
        @endphp
        <form method="post" action="{{ aurl('users/edit?id='.$user['id']) }}" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="post" />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name"> {{ trans('user.name') }}</label>
                        <input type="text" id="name" name="name" placeholder="{{ trans('user.name') }}"
                               class="form-control <?= !empty($name) ? 'is-invalid' : '' ?>"
                               value="{{ $user['name'] }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email"> {{ trans('user.email') }}</label>
                        <input type="text" id="email" name="email" placeholder="{{ trans('user.email') }}"
                               class="form-control <?= !empty($email) ? 'is-invalid' : '' ?>"
                               value="{{ $user['email'] }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password"> {{ trans('user.password') }}</label>
                        <input type="password" id="password" name="password" placeholder="{{ trans('user.password') }}"
                               class="form-control <?= !empty($password) ? 'is-invalid' : '' ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile"> {{ trans('user.mobile') }}</label>
                        <input type="text" id="mobile" name="mobile" placeholder="{{ trans('user.mobile') }}"
                               class="form-control <?= !empty($mobile) ? 'is-invalid' : '' ?>"
                               value="{{ old('mobile') }}">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_type"> {{ trans('user.user_type') }}</label>
                        <select id="user_type" name="user_type" class="form-select <?= !empty($user_type) ? 'is-invalid' : '' ?>">
                            <option disabled selected>{{ trans('admin.choose') }}</option>
                            <option value="user" {{ old('user_type') == 'user' ? 'selected' : '' }}>{{ trans('user.user') }}</option>
                            <option value="admin" {{ old('user_type') == 'admin' ? 'selected' : '' }}>{{ trans('user.admin') }}</option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-success" value="{{ trans('admin.save') }}"/>
        </form>
<?php view('admin.layouts.footer'); ?>
