<?php
/*Student Management System -->
<!-- Author: Steven Ng -->
<!-- all topics*/
require_once dirname(dirname(__FILE__)) . '\AutoLoader.php';
spl_autoload_register(array('AutoLoader', 'autoLoad'));
if(!isset($_SESSION)){
	session_start();
}
if(!(empty($_SESSION)))
{
	if($_SESSION['sess_role'] == 4)
	{
		header('Refresh: 1.5; url=index.php');
		echo '<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">';
		exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
		style="text-align: center; vertical-align: middle"><p>You do not have the correct privileges to access this page.</p></div></body></html>');
	}
}
else
{
	header('Location: index.php');
}
//$database = new Database();
$database = new PDO('mysql:host=localhost;dbname=sms;charset=utf8', 'root', '');
$layout = new Layout();
$session = new Session($_SESSION, $database);
//var_dump($_POST);
//var_dump($session);
$topicid = $_GET['topicid'] or die(header('Location: error.php'));
$query = $database->query("SELECT * FROM forum WHERE topicID = " . $topicid . "");
if ($query->rowCount() == 0)
{
	//header('Refresh: 1.5; url=index.php');
	echo '<link href="bootstrap/css/confirmationAccount.css" rel="stylesheet">';
	exit('<html><body style="background-color: white; font-size: 20px; font-weight: bold; color: black;"><div class="form-wrapper" 
	style="text-align: center; vertical-align: middle"><p>The discussion topic does not exist. <a href="javascript:void(0)" onclick="loadClassPages(\'#forum\', \'classes/forum.php?classid=\', ' . $_GET['classid'] . ')" >Refresh index.</a></p><br /></div></body>
	</html>');
}
else
{
	$result = $query->fetchAll(PDO::FETCH_ASSOC);
	$respond = $database->query("SELECT * FROM response WHERE topicid = " . $topicid . "");
	$topic = new Topic($result[0], $respond->rowCount());
	//$classid = preg_split("/_+/", $topic->getForumName());
	$classid = $topic->getClassID();
	//var_dump($classid);
}
?>
<div class="container bottomMargin">
	<br />
	<ol class="breadcrumb" id="top">
	  <li><a class="btn btn-link" onclick="loadClassPages('#forum', 'classes/forum.php?classid=', <?php echo $classid; ?>)">Discussion Topics</a></li>
	  <li class="active"><?php echo $topic->getTopicSubject(); ?></li>
	</ol>
	<div class="row">	
		<div>
			<table cellpadding="0" cellspacing="0" border="0" class="table table-bordered" id="discussionTable">
				<div class="row">
					<div class="col-xs-3 col-md-12">
						<button class="btn btn-primary btn-lg" onclick="loadClassPages('#forum', 'classes/respond.php?topicid=', <?php echo $topicid; ?>)">Reply</button>
						<?php
							$stmt = $database->query("SELECT id FROM subscribe WHERE accountID = " . $session->getID() . " AND role = " . $session->getUserType() . " AND topicID = " . $topicid . "");
							if ($stmt->rowCount() == 0)
							{
								echo '<button class="btn btn-warning btn-lg" onclick="subscribe(' . $topicid . ')">Subscribe</button>';
							}
							else
							{
								$id = $stmt->fetchAll(PDO::FETCH_ASSOC);
								echo '<button class="btn btn-warning btn-lg" onclick="unsubscribe(' . $id[0]['id'] . ')">Unsubscribe</button>';
							}
						?>
						<a type="button" class="btn btn-primary btn-sm pull-right" href="#bottom">Scroll To Bottom</a>
					</div>
				</div>
				<thead>
					<tr>
						<th class="no-sort" style="text-align: center;">
							Message
						</th>
						<th style="text-align: center;">
							Date Posted
						</th>
					</tr>
				</thead>
				<tbody>
					<?php
						$count = 0;
						echo $layout->loadDiscussionRow($topic, $session->getUserName(), $session->getUserType());
						foreach ($database->query("SELECT * FROM response WHERE topicID = '" . $topicid . "'") as $row)
						{
							$reply = new Reply($row);
							echo $layout->loadDiscussionResponseRow($reply, $session->getUserName(), $session->getUserType());
						}
					?>
				</tbody>
			</table>
			<br />
			<div class="row" id="bottom">
					<div class="col-xs-3 col-md-12">
						<button class="btn btn-primary btn-lg" onclick="loadClassPages('#forum', 'classes/respond.php?topicid=', <?php echo $topicid; ?>)">Reply</button>
						<a type="button" class="btn btn-primary btn-sm pull-right" href="#top">Scroll To Top</a>
					</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript" language="javascript" charset="utf-8">
$('#discussionTable').dataTable(
{
	"aaSorting": [[1, 'asc']],
	"aoColumnDefs" : [ {
		'bSortable' : false,
		'aTargets' : [ "no-sort" ]
	}]
});

$(document).ready(function(){
	$('a[href^="#"]').on('click',function (e) {
	    e.preventDefault();

	    var target = this.hash,
	    $target = $(target);

	    $('html, body').stop().animate({
	        'scrollTop': $target.offset().top
	    }, 900, 'swing', function () {
	        window.location.hash = target;
	    });
	});
});

function quoteOP(id)
{
	$.post(
			'classes/quote.php',
			{ 
				'type' : 0,
				'classid' : <?php echo $classid[0]; ?>,
				'topicid' : <?php echo $topicid; ?>,
				'id' : id
			},
			function(data){
			  $("#forum").html(data);
			  //loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $topic->getTopicID() ?>);
			}
		  );
	  return false;
}

function quoteResponse(id)
{
	$.post(
			'classes/quote.php',
			{ 
				'type' : 1,
				'classid' : <?php echo $classid[0]; ?>,
				'topicid' : <?php echo $topicid; ?>,
				'id' : id
			},
			function(data){
			  $("#forum").html(data);
			  //loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $topic->getTopicID() ?>);
			}
		  );
	  return false;
}

function editOPMessage(id)
{
		$.post(
			'classes/editResponse.php',
			{ 
				'type' : 0,
				'classid' : <?php echo $classid[0]; ?>,
				'topicid' : <?php echo $topicid; ?>,
				'id' : id
			},
			function(data){
			  $("#forum").html(data);
			  //loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $topic->getTopicID() ?>);
			}
		  );
	  return false;
}

function editMessage(id)
{
		$.post(
			'classes/editResponse.php',
			{ 
				'type' : 1,
				'classid' : <?php echo $classid[0]; ?>,
				'topicid' : <?php echo $topicid; ?>,
				'id' : id
			},
			function(data){
			  $("#forum").html(data);
			  //loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $topic->getTopicID() ?>);
			}
		  );
	  return false;
}

function deleteMessage(id)
{
		$.post(
			'classes/processDeleteResponse.php',
			{ 
				'id' : id
			},
			function(data){
			  //$("#forum").html(data);
			  loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $topic->getTopicID() ?>);
			}
		  );
	  return false;
}

function subscribe(id)
{
		$.post(
			'classes/processSubscription.php',
			{ 
				'id' : id,
				'num' : <?php echo $respond->rowCount(); ?>
			},
			function(data){
				if (data.match(/true/))
				{
					alert("Subscribed.");
					loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $topic->getTopicID() ?>);
				}
				else
				{
					alert("You are already subscribed.");
				}
			}
		  );
	  return false;
}

function unsubscribe(id)
{
		$.post(
			'classes/processUnsubscribe.php',
			{ 
				'id' : id,
			},
			function(data){
				alert("Unsubscribed.");
				loadClassPages('#forum', 'classes/topicPage.php?topicid=', <?php echo $topic->getTopicID() ?>);
			}
		  );
	  return false;
}
</script>