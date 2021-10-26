<!DOCTYPE html>
<html lang="<?php echo isset ($locale) ? $locale : 'id'; ?>">
<head>
	<meta charset="<?php echo isset ($charset) ? $charset : 'utf-8'; ?>" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
	<meta name="description" content="" />
	<meta name="author" content="" />
	<title></title>
	<link rel="stylesheet" href="https://demos.creative-tim.com/now-ui-dashboard/assets/demo/demo.css" />
<?php if (isset ($pageAssets)): ?>
<?php foreach ($pageAssets->getStyles () as $style): ?>
	<link rel="stylesheet" href="<?php $style->print (); ?>" />
<?php endforeach; ?>
<?php endif; ?>
<?php if (isset ($psassets) && (count ($psassets) > 0)): ?>
<?php foreach ($psassets['styles'] as $psstyle): ?>
	<link rel="stylesheet" href="<?php echo $psstyle; ?>" />
<?php endforeach; ?>
<?php endif; ?>
</head>
<body class="">