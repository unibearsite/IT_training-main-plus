@extends('layouts.app')
@include('auth.head')
@include('auth.header')

@section('content')
  <div class="container col-lg-6 col-md-10">
    <div class="contact-title w-75">
      <h2>ランキング</h2>
    </div>
  </div>
  <?php $counter = 1;?>
  @foreach( $cstPosts as $cstPost )
  <section style="width: 1000px; margin: 0 auto;">
    <div style="display: flex; background-color: #fff;">
      <?php if ( $counter == 1 ) { ?>
        <div class="fs-1 fw-bold my-4">
          <span class="mx-5"><?= $counter."位"; ?></span>
          <span class="ms-3">{{ $cstPost->name }}</span>
          <span class="ms-5">Lesson{{ $cstPost->lesson_id }}</span>
          <span class="ms-5">{{ $cstPost->title }}</span>
        </div>
        <?php } elseif ( $counter == 2 ) { ?>
          <div class="fs-2 fw-bold my-4">
            <span class="mx-5"><?= $counter."位"; ?></span>
            <span class="ms-3">{{ $cstPost->name }}</span>
            <span class="ms-5">Lesson{{ $cstPost->lesson_id }}</span>
            <span class="ms-5">{{ $cstPost->title }}</span>
          </div>
          <span class="mx-5 fs-2 fw-bold  my-4"><?= $counter."位"; ?></span>
        <?php } elseif ( $counter == 3 ) { ?>
          <div class="fs-3 fw-bold my-4">
            <span class="mx-5"><?= $counter."位"; ?></span>
            <span class="ms-3">{{ $cstPost->name }}</span>
            <span class="ms-5">Lesson{{ $cstPost->lesson_id }}</span>
            <span class="ms-5">{{ $cstPost->title }}</span>
          </div>
        <?php } else { ?>
          <div class="my-3">
            <span class="mx-5"><?= $counter."位"; ?></span>
            <span class="ms-3">{{ $cstPost->name }}</span>
            <span class="ms-5">Lesson{{  $cstPost->lesson_id }}</span>
            <span class="ms-5">{{ $cstPost->title }}</span>
          </div>
        <?php } ?>
    </div>
  </section>
  <?php $counter++; ?>
  @endforeach

  @endsection

{{-- フッターここに入る --}}
@include('auth.footer')
