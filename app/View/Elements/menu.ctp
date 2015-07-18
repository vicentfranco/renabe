<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="<?php echo $this->Html->url(array('controller'=>'pages', 'action'=>'display')); ?>">Renabe</a>
    </div>

    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav navbar-left">
        <li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'index')); ?>">Usuarios</a></li>
      </ul>
      <ul class="nav navbar-nav">
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Formularios <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="<?php echo $this->Html->url(array('controller'=>'formulariosf1', 'action'=>'index')) ?>">F1 - Productores de la Agricultura Familiar</a></li>
            <li><a href="<?php echo $this->Html->url(array('controller'=>'formulariosf2', 'action'=>'index')) ?>">F2 - Productores Indigenas, Urbanos y Periurbanos</a></li>
            <li><a href="<?php echo $this->Html->url(array('controller'=>'formulariosf3', 'action'=>'index')) ?>">F3 - Productores Agropecuarios Consolidados</a></li>
            <li class="divider"></li>
            <li><a href="#">Ver Anexos</a></li>
          </ul>
        </li>
        <li class="dropdown">
          <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Reportes <span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Beneficiarios por Departamento</a></li>
            <li><a href="#">Beneficiarios por Distritos</a></li>
            <li><a href="#">Beneficiarios por Comite o Asentamiento</a></li>
            <li class="divider"></li>
            <li><a href="#">F1 - Productores de la Agricultura Familiar</a></li>
            <li class="divider"></li>
            <li><a href="#">Productores</a></li>
          </ul>
        </li>
      </ul>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="<?php echo $this->Html->url(array('controller'=>'users', 'action'=>'logout')); ?>">Salir  <span class="glyphicon glyphicon glyphicon-log-out" aria-hidden="true"></span></a></li>
      </ul>
      <form class="navbar-form navbar-right" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="Search">
        </div>
        <button type="submit" class="btn btn-default">Submit</button>
      </form>
    </div>
  </div>
</nav>