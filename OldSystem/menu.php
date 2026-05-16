<?php

echo '
<ul class="nav justify-content-center">
  <li class="nav-item">
    <a class="nav-link" href="pgindex.php">Home</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="pgArquivoCorrente.php">Arquivo Corrente</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="pgArquivoIntermediario.php">Arquivo Intermediário</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="pgArquivoEliminacao.php">Arquivo Eliminação</a>
  </li>
  <li class="nav-item">
    <a class="nav-link" href="pgArquivoPermanente.php">Arquivo Permanente</a>
  </li>
  <!-- Dropdown -->
 <li class="nav-item dropdown custom-dropdown">
  <a class="nav-link dropdown-toggle" href="#" id="dropdownMenuAlteracoes" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
    Alterações
  </a>
  <div class="dropdown-menu" aria-labelledby="dropdownMenuAlteracoes">
    <a class="dropdown-item" href="pgAdicionarCaixa.php">Adicionar</a>
    <a class="dropdown-item" href="pgAlterarCaixa.php">Alterar</a>
    <a class="dropdown-item" href="pgExcluirCaixa.php">Excluir</a>
  </div>
</li>

</ul>
';
?>
