<?php

use Cake\Core\Configure;

Configure::write('Sys.titleText', 'Matrículas');
Configure::write('Sys.titleHTML', '<i class="fa fa-book"></i> <b>Matrículas</b>');
Configure::write('Sys.titleShort', '<i class="fa fa-book"></i>');

Configure::write('App.defaultLocale', 'pt_BR');
ini_set('intl.default_locale', Configure::read('App.defaultLocale'));