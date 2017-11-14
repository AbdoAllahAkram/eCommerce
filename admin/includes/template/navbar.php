<nav class="navbar navbar-inverse">
    <div class="container">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#NavApp" aria-expanded="false">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="dashboard.php">OrangeShop</a>
        </div>

        <div class="collapse navbar-collapse" id="NavApp">
            <ul class="nav navbar-nav">
                <li class="active"><a href="categories.php"><?php echo lang('CATEGORIES') ?> <span class="sr-only">(current)</span></a></li>
                <li><a href="items.php"><?php echo lang('ITEMS') ?></a></li>
                <li><a href="members.php"><?php echo lang('MEMBERS') ?></a></li>
                <li><a href="#"><?php echo lang('STATISTICS') ?></a></li>
                <li><a href="#"><?php echo lang('LOGS') ?></a></li>

            </ul>

            <ul class="nav navbar-nav navbar-right">
                <li><a href="#">Link</a></li>
                <li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false"><?php echo $username; ?> <span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        <li><a href="members.php?do=Edit&userid=<?php echo $_SESSION['ID']; ?>"><?php echo lang('EDIT PROFILE') ?></a></li>
                        <li><a href="#"><?php echo lang('SETTINGS') ?></a></li>
                        <li role="separator" class="divider"></li>
                        <li><a href="logout.php"><?php echo lang('LOGOUT') ?></a></li>
                    </ul>
                </li>
            </ul>
        </div>
    </div>
</nav>