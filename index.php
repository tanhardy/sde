<?php
require('connection.php');
?>

<!DOCTYPE html>
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
    <title>Tasks Viewer</title>

    <link type="text/css" rel="stylesheet" href="" />
    <!--[if lt IE 9]>
        <script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

</head>
<body>
<h1>My Tasks</h1>

<?php while ($cursor->hasNext()):
    $task = $cursor->getNext(); ?>
    <h2><?= $task['item_id'] ?></h2>
    <strong>Name:</strong> <?= $task['item_name']?> <br />
    <strong>Price:</strong> <?= $task['price']?><br />
<?php endwhile;?>
</body>
</html>