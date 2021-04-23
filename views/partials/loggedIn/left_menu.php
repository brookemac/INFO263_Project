<section>
    <aside id="leftsidebar" class="sidebar">
        <div class="user-info">
            <div class="image">
                <img src="../img/user.png" width="48" height="48" alt="User" />
            </div>
            <div class="info-container">
                <div class="name" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><?php echo htmlspecialchars(($_SESSION["loggedUser"])->getUsername()); ?></div>
                <div class="email"><?php echo htmlspecialchars(($_SESSION["loggedUser"])->getEmail()); ?></div>
                <div class="btn-group user-helper-dropdown">
                    <i class="material-icons" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">keyboard_arrow_down</i>
                    <ul class="dropdown-menu pull-right">
                        <li><a href="logout.php"><i class="material-icons">input</i>Sign Out</a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="menu">
            <ul class="list">
                <li class="header">MENU</li>
                <li>
                    <a href="home.php">
                        <i class="material-icons">home</i>
                        <span>Home</span>
                    </a>
                </li>
                <li>
                    <a href="view_current_state.php">
                        <i class="material-icons">view_module</i>
                        <span>See current state</span>
                    </a>
                </li>
            </ul>
        </div>
        <div class="legal">
            <div class="copyright">
                &copy; 2021 <a href="javascript:void(0);">INFO263 Group</a>.
            </div>
            <div class="version">
                <b>Version: </b> 1.0.0
            </div>
        </div>
    </aside>
</section>