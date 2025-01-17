<?php
    $comments = db_paginate('comments', 'WHERE status="show" AND news_id="'.request('id').'"', 15, 'asc', '*', ['id' => request('id') ]);
    
?>
<div class="container mt-5 mb-5">
    
    <div class="row height d-flex justify-content-center align-items-center">
        
        <div class="col-md-7">
            
            <div class="card">
                
                <div class="p-3">
                    <h6><?php echo  trans('main.comments') ; ?></h6>
                </div>
                <div class="alert alert-danger error_message d-none"></div>
                <form method="post" id="comment_form" action="<?php echo  url('add/comment?news_id=' . request('id')) ; ?>">
                    <div class="mt-3 d-flex flex-row align-items-center p-3 form-color">
                        <input type="text" class="form-control" name="name" placeholder="<?php echo  trans('main.name') ; ?>">
                        <input type="email" class="form-control" name="email" placeholder="<?php echo  trans('main.email') ; ?>">
                    </div>
                    <div class="mt-3 d-flex flex-row align-items-center p-3 form-color">
                        <img src="https://placehold.co/400" width="50" class="rounded-circle mr-2">
                        <textarea class="form-control" name="comment" placeholder="<?php echo  trans('main.write_comment') ; ?>"></textarea>
                    </div>
                    <button class="btn btn-success add_comment" type="button"><?php echo  trans('main.add') ; ?></button>
                    <input type="hidden" name="_method" value="post">
                </form>
                <script>
                    $(document).on('click', '.add_comment', function () {
                        var form_date = $('#comment_form').serialize();
                        // console.log("Serialized Form Data:", form_date);  // Debug form data

                        $.ajax({
                            url: $('#comment_form').attr('action'),
                            dataType: 'json',
                            type: 'post',
                            data: form_date,
                            beforeSend: function () {
                                $('.error_message').html('').addClass('d-none');
                            },
                            success: function (data) {
                                console.log("AJAX Success Response:", data);  // Log server response
                                if (data.status === true) {
                                    location.reload();
                                }
                                $('.error_message').html('').addClass('d-none');
                            },
                            error: function (xhr) {
                                console.log("AJAX Error Response:", xhr.responseJSON);  // Log errors

                                var errors = xhr.responseJSON;
                                if (errors != null) {
                                    var error_html = '<ul>';
                                    $.each(errors, function (key, val) {
                                        console.log("Error:", key, val);  // Log each field error
                                        for (i = 0; i < val.length; i++) {
                                            error_html += '<li>' + val[i] + '</li>';
                                        }
                                    });
                                    error_html += '</ul>';
                                    $('.error_message').html(error_html).removeClass('d-none');
                                }
                            }
                        });
                        return false;
                    });
                </script>
                <div class="mt-2">
                    <?php while ($comment = mysqli_fetch_assoc($comments['query'])): ?>
                        <div class="d-flex flex-row p-3">
                            <img src="https://placehold.co/400" width="40" height="40" class="rounded-circle me-3">
                            <div class="w-100">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex flex-row align-items-center">
                                        <span class="ms-2"><?php echo  $comment['name'] ; ?></span>
                                    </div>
                                </div>
                                <p class="text-justify comment-text mb-0"><?php echo  $comment['comment'] ; ?></p>
                            </div>
                        </div>
                    <?php endwhile; ?>
                </div>
            </div>
            <?php echo  $comments['render'] ; ?>
        </div>
    </div>

</div>
