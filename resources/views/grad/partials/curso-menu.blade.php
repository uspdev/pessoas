<h4>
  <a href="route('graduacao.cursos')">Cursos</a>
  <i class="fas fa-angle-right"></i> ({{ $curso['codcur'] }}) {{ $curso['nomcur'] }}
  | ({{ $curso['codhab'] }}) {{ $curso['nomhab'] }}
  <i class="fas fa-angle-right"></i> {{ $view ?? '??' }}
</h4>
