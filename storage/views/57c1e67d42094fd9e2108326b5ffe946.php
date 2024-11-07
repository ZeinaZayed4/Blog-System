<?php
    view('admin.layouts.header', ['title' => trans('admin.users')]);
?>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h2><?php echo  trans('admin.users') ; ?> - <?php echo  trans('admin.create') ; ?></h2>
            <a class="btn btn-info" href="<?php echo  aurl('users') ; ?>"><?php echo  trans('admin.users') ; ?></a>
        </div>
        <?php 
            $name = get_error('name');
            $email = get_error('email');
            $mobile = get_error('mobile');
            $password = get_error('password');
            $user_type = get_error('user_type');
         ?>
        <form method="post" action="<?php echo  aurl('users/create') ; ?>" enctype="multipart/form-data">
            <input type="hidden" name="_method" value="post" />
            <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="name"> <?php echo  trans('user.name') ; ?></label>
                        <input type="text" id="name" name="name" placeholder="<?php echo  trans('user.name') ; ?>"
                               class="form-control <?= !empty($name) ? 'is-invalid' : '' ?>"
                               value="<?php echo  old('name') ; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="email"> <?php echo  trans('user.email') ; ?></label>
                        <input type="text" id="email" name="email" placeholder="<?php echo  trans('user.email') ; ?>"
                               class="form-control <?= !empty($email) ? 'is-invalid' : '' ?>"
                               value="<?php echo  old('email') ; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="password"> <?php echo  trans('user.password') ; ?></label>
                        <input type="text" id="password" name="password" placeholder="<?php echo  trans('user.password') ; ?>"
                               class="form-control <?= !empty($password) ? 'is-invalid' : '' ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile"> <?php echo  trans('user.mobile') ; ?></label>
                        <input type="text" id="mobile" name="mobile" placeholder="<?php echo  trans('user.mobile') ; ?>"
                               class="form-control <?= !empty($mobile) ? 'is-invalid' : '' ?>"
                               value="<?php echo  old('mobile') ; ?>">
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="user_type"> <?php echo  trans('user.user_type') ; ?></label>
                        <select id="user_type" name="user_type" class="form-select <?= !empty($user_type) ? 'is-invalid' : '' ?>">
                            <option disabled selected><?php echo  trans('admin.choose') ; ?></option>
                            <option value="user" <?php echo  old('user_type') == 'user' ? 'selected' : '' ; ?>><?php echo  trans('user.user') ; ?></option>
                            <option value="admin" <?php echo  old('user_type') == 'admin' ? 'selected' : '' ; ?>><?php echo  trans('user.admin') ; ?></option>
                        </select>
                    </div>
                </div>
            </div>
            <input type="submit" class="btn btn-success" value="<?php echo  trans('admin.create') ; ?>"/>
        </form>

<?php view('admin.layouts.footer'); ?>
