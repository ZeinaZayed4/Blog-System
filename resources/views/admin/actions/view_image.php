<?php
    if (!empty($image)):
    $rand = md5(rand(000, 999));
?>
<img src="{{ $image }}" data-bs-toggle="modal" data-bs-target="#showImage{{ $rand }}"
     style="width: 25px; height: 25px; cursor: pointer;" alt="bla">

<!-- Modal -->
<div class="modal fade" id="showImage{{ $rand }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="showImageLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-body">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                <img src="{{ $image }}" style="width: 100%; height: 80%" alt="">
            </div>
        </div>
    </div>
</div>
<?php endif; ?>