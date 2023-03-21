@extends('laravel-usp-theme::master')

@section('title')
  @parent
@endsection

@section('styles')
  @parent
  <style>
    .card-header-sticky {
      position: -webkit-sticky;
      position: sticky !important;
      top: 0;
      z-index: 100;
      background-color: #F0F0F0;
    }
  </style>
@endsection

@section('javascripts_bottom')
  @parent
  <script>
    // Seu código .js
  </script>
@endsection
