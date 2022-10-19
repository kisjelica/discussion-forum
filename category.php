<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Discussion Forum</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/style.css">
</head>
<?php
require('config/Database.php');
require('class/User.php');
require('class/Category.php');
require('class/Topic.php');
$database = new Database();
$db = $database->getConnection();
$categories = new Category($db);
$topics = new Topic($db);
?>

<body>
    <div class="container">
        <div class="row">
            <h2>Discussion Forum</h2>
            <?php include("top_menus.php"); ?>
            <?php if (empty($_GET['category_id'])) { ?>
                <div class="single category">
                    <ul class="list-unstyled">
                        <li><span style="font-size:25px;font-weight:bold;">Categories</span> <span class="pull-right"><span style="font-size:20px;font-weight:bold;">Topics / Posts</span></span></li>
                        <?php
                        $result = $categories->getCategoryList();
                        while ($category = $result->fetch_assoc()) {
                            $categories->category_id = $category['category_id'];
                            $totalTopic = $categories->getCategoryTopicsCount();
                            $totalPosts = $categories->getCategorypostsCount();
                        ?>
                            <li><a href="category.php?category_id=<?php echo $category['category_id']; ?>" title=""><?php echo $category['name']; ?> <span class="pull-right"><?php echo $totalTopic; ?> / <?php echo $totalPosts; ?></span></a></li>
                        <?php } ?>
                    </ul>
                </div>
            <?php } else if(!empty($_GET['category_id'])) {?>
                <div class="single category">
                    <?php
                    $categories->category_id = $_GET['category_id'];
                    $categoryDetails = $categories ->getCategory();
                    ?>
                    <span style="font-size:20px;"><a href="category.php"><< <?php echo $categoryDetails['name']; ?></a></span>
                    <br>   <br>
                    <ul class="list-unstyled">
                        <li class="text-right">
                        <a type="button" class="btn btn-primary" href="compose.php?category_id=<?php echo $_GET['category_id'];?>"><span style="font-size:20px;font-weight:bold;color:white;">Create New Topic</span></a>
                        </li><br>
                        <li><span style="font-size:20px;font-weight:bold;">Topics</span> <span class="pull-right"><span style="font-size:15px;font-weight:bold;">Posts</span></span></li>
                        <?php
                        $topics->category_id = $_GET['category_id'];
                        $result = $topics->getTopicList();
                        while($topic = $result->fetch_assoc()) {
                            $topics->topic_id = $topic['topic_id'];
                            $totalTopicPosts = $topics->getTopicPostCount();
                        ?>
                            <li><a href="post.php?topic_id=<?php echo $topic['topic_id'];?>" title=""><?php echo $topic['subject']; ?> <span class="pull-right"><?php echo $totalTopicPosts; ?></span></a></li>
                            <?php } ?>
                        </ul>
                </div>

                <?php } ?>
        </div>
    </div>
    <div class="insert-post-ads1" style="margin-top:20px;">
</body>

</html>