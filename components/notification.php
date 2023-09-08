<?php 

if(isset($_SESSION['notification'])){
    echo ' <div class="alert alert-success alert-dismissible fade show" role="alert">
    
    <span class="alert-text"><strong></strong> '.$_SESSION['notification'].'</span>
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>';

}
unset($_SESSION['notification']); 