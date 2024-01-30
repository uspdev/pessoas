@extends('layouts.app')

@section('content')
  @forelse($orientadores as $orientador)
    <div>
      {{ $orientador->nompes }} {{ $orientador->dtavalfim }}
    </div>

  @empty
  @endforelse
@endsection
