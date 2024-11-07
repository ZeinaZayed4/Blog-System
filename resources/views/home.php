<?php view('layout.header', ['title' => trans('main.home')]); ?>
    <h1>
        Home File
    </h1>
    @if(any_errors())
        <div class="alert alert-danger">
            <ol>
                @foreach(all_errors() as $error)
                    <li><?=$error?></li>
                @endforeach
            </ol>
        </div>
    @endif
    
@php
    $email_valid = get_error('email');
    $mobile_valid = get_error('mobile');
    $address_valid = get_error('address');
    
    end_errors();
@endphp

    
<form method="post" action="<?= url('upload'); ?>" enctype="multipart/form-data">
    <label for="email"><b>Email:</b></label>
    <input type="text" name="email" class="form-control <?= !empty($email_valid) ? 'is-invalid' : 'is-valid' ?>"
           id="email"
           value="<?= old('email'); ?>"
    >
    <div class="<?= !empty($email_valid) ? 'invalid-feedback' : 'valid-feedback' ?>">
        <?= $email_valid ?>
    </div>
    <label for="mobile"><b>Mobile:</b></label>
    <input type="text" name="mobile" class="form-control <?= !empty($mobile_valid) ? 'is-invalid' : 'is-valid' ?>"
           id="mobile"
           value="<?= old('mobile'); ?>"
    >
    <div class="<?= !empty($mobile_valid) ? 'invalid-feedback' : 'valid-feedback' ?>">
        <?= $mobile_valid ?>
    </div>
    <label for="address"><b>Address:</b></label>
    <input type="text" name="address" class="form-control <?= !empty($address_valid) ? 'is-invalid' : 'is-valid' ?>"
           id="address"
           value="<?= old('mobile'); ?>"
    >
    <div class="<?= !empty($address_valid) ? 'invalid-feedback' : 'valid-feedback' ?>">
        <?= $address_valid ?>
    </div>
    <input type="hidden" name="_method" value="post">
    <input type="submit" class="btn btn-success" value="Send">
</form>
<?php view('layout.footer'); ?>