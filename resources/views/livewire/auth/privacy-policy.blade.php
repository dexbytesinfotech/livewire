<div class="page-header align-items-start min-vh-100">
    <div class="container card col-md-8 my-5">
    <div class="terms-box">
    <div class="row">


<div class="card-body">

    <div class="terms-content">
    <h3>{{ ucfirst($post->title) }}</h4>
    <hr>
    <div>
        {!! htmlspecialchars_decode(nl2br($post->content)) !!}
    </div>
</div>
</div>
</div>
</div>

</div>
</div>


