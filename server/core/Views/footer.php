
        <script src="<?php echo isset ($assetsFolder) ? $assetsFolder : ''; ?>/vendors/jquery/jquery-3.4.1.min.js"></script>
        <script src="<?php echo isset ($assetsFolder) ? $assetsFolder : ''; ?>/vendors/bootstrap/js/bootstrap.min.js"></script>
        <script src="<?php echo isset ($assetsFolder) ? $assetsFolder : ''; ?>/vendors/fontawesome/js/all.min.js"></script>
        <?php
        if (isset($routes)) {
            switch ($routes->controllerName()) {
                default:
                    switch ($routes->methodName()) {
                        default: 
        ?>
        
        <script src="<?php echo isset ($assetsFolder) ? $assetsFolder : ''; ?>/server.js"></script>
        <?php
                            break;
                        case 'setup':
        ?>
        		
        <script src="<?php echo isset ($assetsFolder) ? $assetsFolder : ''; ?>/setup.js"></script>
        <?php
                            break;
                    }
                    break;
                case '\App\Controllers\ServerLogin':
                    switch ($routes->methodName()) {
                        default:
        ?>
        
		<script src="<?php echo isset ($assetsFolder) ? $assetsFolder : ''; ?>/login.js"></script>
        <?php
                            break;
                    }
                    break;
            }
        }
        ?>
		
	</body>
</html>