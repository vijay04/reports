<div class="navbar navbar-inverse navbar-fixed-top">
  <div class="navbar-inner">
    <div class="container">
      <button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="brand" href="<?php print base_url(); ?>">Reports</a>
      <div class="nav-collapse collapse">
        <?php if ($this->ion_auth->logged_in()) : ?>
          <p class="navbar-text pull-right"><a href="<?php print base_url() . 'auth/logout'; ?>">Logout</a></p>
          <ul class="nav">
            <li><a href="#about">About</a></li>
            <li><a href="#contact">Contact</a></li>
            <li class="dropdown">
              <a href="#" class="dropdown-toggle" data-toggle="dropdown">Admin<b class="caret"></b></a>
              <ul class="dropdown-menu">
                <li><a href="<?php print base_url() . 'auth'; ?>">User List</a></li>
              </ul>
            </li>
          </ul>
          
        <?php else : ?>
          <p class="navbar-text pull-right"><a href="<?php print base_url() . 'auth'; ?>">Login</a></p>
        <?php endif; ?>
      </div><!--/.nav-collapse -->
    </div>
  </div>
</div>